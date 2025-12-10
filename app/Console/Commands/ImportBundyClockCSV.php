<?php

namespace App\Console\Commands;

use App\Models\EmployeeList;
use App\Models\EmployeeAttendance;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Import attendance data from CSV files exported by bundy clock
 * 
 * Usage:
 *   php artisan bundy:import-csv storage/bundy-exports/attendance.csv
 *   php artisan bundy:import-csv storage/bundy-exports/ --all
 * 
 * CSV Format:
 *   employee_id,timestamp,action
 *   123,2025-12-09 08:30:15,in
 *   124,2025-12-09 08:35:20,in
 */
class ImportBundyClockCSV extends Command
{
    protected $signature = 'bundy:import-csv 
                            {path : Path to CSV file or directory} 
                            {--all : Process all CSV files in directory}
                            {--archive : Move processed files to archive}';

    protected $description = 'Import bundy clock attendance data from CSV files';

    private $imported = 0;
    private $failed = 0;
    private $skipped = 0;

    public function handle()
    {
        $path = $this->argument('path');
        $processAll = $this->option('all');
        $archive = $this->option('archive');

        $this->info('🕐 Bundy Clock CSV Import Started');
        $this->info('Path: ' . $path);
        $this->newLine();

        if ($processAll) {
            $this->processDirectory($path, $archive);
        } else {
            $this->processFile($path, $archive);
        }

        $this->newLine();
        $this->info('✅ Import Summary:');
        $this->info("   Imported: {$this->imported}");
        $this->info("   Failed: {$this->failed}");
        $this->info("   Skipped: {$this->skipped}");

        Log::info('Bundy Clock CSV Import completed', [
            'imported' => $this->imported,
            'failed' => $this->failed,
            'skipped' => $this->skipped,
        ]);

        return Command::SUCCESS;
    }

    private function processDirectory(string $directory, bool $archive)
    {
        if (!is_dir($directory)) {
            $this->error("Directory not found: {$directory}");
            return;
        }

        $files = glob($directory . '/*.csv');
        
        if (empty($files)) {
            $this->warn('No CSV files found in directory');
            return;
        }

        $this->info("Found " . count($files) . " CSV files");
        $this->newLine();

        foreach ($files as $file) {
            $this->processFile($file, $archive);
        }
    }

    private function processFile(string $filePath, bool $archive)
    {
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            $this->failed++;
            return;
        }

        $this->info("Processing: " . basename($filePath));

        $handle = fopen($filePath, 'r');
        if (!$handle) {
            $this->error("Could not open file: {$filePath}");
            $this->failed++;
            return;
        }

        // Skip header row if present
        $firstLine = fgetcsv($handle);
        if ($this->isHeaderRow($firstLine)) {
            // Continue to data rows
        } else {
            // First row is data, process it
            $this->processRow($firstLine, 1);
        }

        $lineNumber = 2;
        while (($row = fgetcsv($handle)) !== false) {
            $this->processRow($row, $lineNumber);
            $lineNumber++;
        }

        fclose($handle);

        if ($archive) {
            $this->archiveFile($filePath);
        }

        $this->info("✓ Completed: " . basename($filePath));
        $this->newLine();
    }

    private function processRow(array $row, int $lineNumber)
    {
        // Expected format: employee_id, timestamp, action
        if (count($row) < 3) {
            $this->warn("Line {$lineNumber}: Invalid format (expected 3 columns)");
            $this->skipped++;
            return;
        }

        $employeeId = trim($row[0]);
        $timestamp = trim($row[1]);
        $action = strtolower(trim($row[2]));

        // Validate action
        if (!in_array($action, ['in', 'out'])) {
            $this->warn("Line {$lineNumber}: Invalid action '{$action}' (must be 'in' or 'out')");
            $this->failed++;
            return;
        }

        // Find employee
        $employee = EmployeeList::where('id', $employeeId)
            ->orWhere('employee_code', $employeeId)
            ->first();

        if (!$employee) {
            $this->warn("Line {$lineNumber}: Employee not found (ID: {$employeeId})");
            $this->failed++;
            return;
        }

        try {
            $timestamp = Carbon::parse($timestamp);
        } catch (\Exception $e) {
            $this->warn("Line {$lineNumber}: Invalid timestamp format '{$timestamp}'");
            $this->failed++;
            return;
        }

        $date = $timestamp->toDateString();

        // Get or create attendance record
        $attendance = EmployeeAttendance::firstOrCreate(
            [
                'employee_id' => $employee->id,
                'date' => $date,
            ],
            [
                'f_name' => $employee->f_name,
                'l_name' => $employee->l_name,
                'position' => $employee->position,
                'attendance_status' => 'Idle',
            ]
        );

        // Process punch
        if ($action === 'in') {
            if ($attendance->punch_in_time !== null) {
                $this->warn("Line {$lineNumber}: Employee {$employee->f_name} already punched in");
                $this->skipped++;
                return;
            }

            // Calculate if late
            $scheduledStart = Carbon::parse($date)->setHour(8)->setMinute(0);
            $gracePeriodEnd = $scheduledStart->copy()->addMinutes(15);
            $isLate = $timestamp->isAfter($gracePeriodEnd);
            $lateMinutes = $isLate ? $timestamp->diffInMinutes($scheduledStart) : 0;

            $attendance->update([
                'punch_in_time' => $timestamp,
                'time_in' => $timestamp,
                'attendance_status' => 'On Site',
                'is_late' => $isLate,
                'late_minutes' => $lateMinutes,
                'grace_period_applied' => $timestamp->between($scheduledStart, $gracePeriodEnd),
                'validation_status' => 'pending',
            ]);

            $this->info("  ✓ {$employee->f_name} {$employee->l_name} punched IN at {$timestamp->format('H:i')}");
            $this->imported++;

        } else { // out
            if ($attendance->punch_in_time === null) {
                $this->warn("Line {$lineNumber}: Employee {$employee->f_name} not punched in yet");
                $this->failed++;
                return;
            }

            if ($attendance->punch_out_time !== null) {
                $this->warn("Line {$lineNumber}: Employee {$employee->f_name} already punched out");
                $this->skipped++;
                return;
            }

            $attendance->update([
                'punch_out_time' => $timestamp,
                'time_out' => $timestamp,
                'attendance_status' => 'Present',
            ]);

            $hoursWorked = $timestamp->diffInMinutes($attendance->punch_in_time) / 60;
            $this->info("  ✓ {$employee->f_name} {$employee->l_name} punched OUT at {$timestamp->format('H:i')} (" . round($hoursWorked, 2) . " hours)");
            $this->imported++;
        }

        Log::info('Bundy Clock CSV: Attendance imported', [
            'employee_id' => $employee->id,
            'employee_name' => $employee->f_name . ' ' . $employee->l_name,
            'timestamp' => $timestamp->format('Y-m-d H:i:s'),
            'action' => $action,
        ]);
    }

    private function isHeaderRow(array $row): bool
    {
        // Check if first row contains column names
        $firstColumn = strtolower(trim($row[0] ?? ''));
        return in_array($firstColumn, ['employee_id', 'employee', 'badge', 'id']);
    }

    private function archiveFile(string $filePath)
    {
        $archiveDir = dirname($filePath) . '/archive';
        
        if (!is_dir($archiveDir)) {
            mkdir($archiveDir, 0755, true);
        }

        $fileName = basename($filePath);
        $timestamp = now()->format('Ymd_His');
        $newName = $archiveDir . '/' . $timestamp . '_' . $fileName;

        if (rename($filePath, $newName)) {
            $this->info("  → Archived to: {$newName}");
        } else {
            $this->warn("  → Could not archive file");
        }
    }
}

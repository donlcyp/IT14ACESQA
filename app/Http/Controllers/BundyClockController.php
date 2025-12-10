<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Bundy Clock Integration Controller
 * 
 * This controller handles incoming data from bundy clock devices
 * and automatically records employee attendance in the database.
 */
class BundyClockController extends Controller
{
    /**
     * Receive punch data from bundy clock device
     * 
     * Expected JSON payload from bundy clock:
     * {
     *     "employee_id": "123",      // Employee ID or badge number
     *     "timestamp": "2025-12-09 08:30:15",
     *     "action": "in",            // "in" or "out"
     *     "device_id": "BUNDY001"    // Optional: bundy clock device identifier
     * }
     * 
     * Alternative CSV format support:
     * employee_id,timestamp,action
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function receivePunch(Request $request)
    {
        try {
            // Validate incoming data
            $validated = $request->validate([
                'employee_id' => 'required',
                'timestamp' => 'required|date',
                'action' => 'required|in:in,out,IN,OUT',
                'device_id' => 'nullable|string',
            ]);

            // Normalize action
            $action = strtolower($validated['action']);
            $timestamp = Carbon::parse($validated['timestamp']);
            $employeeId = $validated['employee_id'];

            // Find employee by ID or badge number
            $employee = Employee::where('id', $employeeId)
                ->orWhere('employee_code', $employeeId)
                ->first();

            if (!$employee) {
                Log::warning("Bundy Clock: Employee not found", [
                    'employee_id' => $employeeId,
                    'timestamp' => $timestamp,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found',
                    'employee_id' => $employeeId,
                ], 404);
            }

            $date = $timestamp->toDateString();

            // Get or create today's attendance record
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

            // Process punch action
            if ($action === 'in') {
                return $this->processPunchIn($attendance, $timestamp, $validated['device_id'] ?? null);
            } else {
                return $this->processPunchOut($attendance, $timestamp, $validated['device_id'] ?? null);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("Bundy Clock: Validation failed", [
                'errors' => $e->errors(),
                'payload' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid data format',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error("Bundy Clock: Exception occurred", [
                'message' => $e->getMessage(),
                'payload' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Process punch-in from bundy clock
     */
    private function processPunchIn(EmployeeAttendance $attendance, Carbon $timestamp, ?string $deviceId)
    {
        // Check if already punched in
        if ($attendance->punch_in_time !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Already punched in at ' . $attendance->punch_in_time->format('H:i:s'),
                'punch_in_time' => $attendance->punch_in_time->format('Y-m-d H:i:s'),
            ], 422);
        }

        // Calculate if late (after 8:00 AM with 15-minute grace period)
        $scheduledStart = Carbon::parse($attendance->date)->setHour(8)->setMinute(0);
        $gracePeriodEnd = $scheduledStart->copy()->addMinutes(15);
        $isLate = $timestamp->isAfter($gracePeriodEnd);
        $lateMinutes = $isLate ? $timestamp->diffInMinutes($scheduledStart) : 0;

        // Update attendance record
        $attendance->update([
            'punch_in_time' => $timestamp,
            'time_in' => $timestamp,
            'attendance_status' => 'On Site',
            'is_late' => $isLate,
            'late_minutes' => $lateMinutes,
            'grace_period_applied' => $timestamp->between($scheduledStart, $gracePeriodEnd),
            'validation_status' => 'pending', // Requires HR validation
        ]);

        Log::info("Bundy Clock: Punch In recorded", [
            'employee_id' => $attendance->employee_id,
            'employee_name' => $attendance->f_name . ' ' . $attendance->l_name,
            'timestamp' => $timestamp->format('Y-m-d H:i:s'),
            'is_late' => $isLate,
            'device_id' => $deviceId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Punch in recorded successfully',
            'data' => [
                'employee_id' => $attendance->employee_id,
                'employee_name' => $attendance->f_name . ' ' . $attendance->l_name,
                'punch_in_time' => $timestamp->format('Y-m-d H:i:s'),
                'status' => 'On Site',
                'is_late' => $isLate,
                'late_minutes' => $lateMinutes,
                'validation_status' => 'pending',
            ],
        ], 200);
    }

    /**
     * Process punch-out from bundy clock
     */
    private function processPunchOut(EmployeeAttendance $attendance, Carbon $timestamp, ?string $deviceId)
    {
        // Check if punched in first
        if ($attendance->punch_in_time === null) {
            return response()->json([
                'success' => false,
                'message' => 'Must punch in first',
            ], 422);
        }

        // Check if already punched out
        if ($attendance->punch_out_time !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Already punched out at ' . $attendance->punch_out_time->format('H:i:s'),
                'punch_out_time' => $attendance->punch_out_time->format('Y-m-d H:i:s'),
            ], 422);
        }

        // Calculate hours worked
        $hoursWorked = $timestamp->diffInMinutes($attendance->punch_in_time) / 60;

        // Update attendance record
        $attendance->update([
            'punch_out_time' => $timestamp,
            'time_out' => $timestamp,
            'attendance_status' => 'Present', // Mark as present after punch out
        ]);

        Log::info("Bundy Clock: Punch Out recorded", [
            'employee_id' => $attendance->employee_id,
            'employee_name' => $attendance->f_name . ' ' . $attendance->l_name,
            'punch_in' => $attendance->punch_in_time->format('Y-m-d H:i:s'),
            'punch_out' => $timestamp->format('Y-m-d H:i:s'),
            'hours_worked' => round($hoursWorked, 2),
            'device_id' => $deviceId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Punch out recorded successfully',
            'data' => [
                'employee_id' => $attendance->employee_id,
                'employee_name' => $attendance->f_name . ' ' . $attendance->l_name,
                'punch_in_time' => $attendance->punch_in_time->format('Y-m-d H:i:s'),
                'punch_out_time' => $timestamp->format('Y-m-d H:i:s'),
                'hours_worked' => round($hoursWorked, 2),
                'status' => 'Present',
            ],
        ], 200);
    }

    /**
     * Receive batch punch data (for bundy clocks that sync periodically)
     * 
     * Expected JSON payload:
     * {
     *     "device_id": "BUNDY001",
     *     "records": [
     *         {"employee_id": "123", "timestamp": "2025-12-09 08:30:15", "action": "in"},
     *         {"employee_id": "124", "timestamp": "2025-12-09 08:35:20", "action": "in"}
     *     ]
     * }
     */
    public function receiveBatchPunch(Request $request)
    {
        try {
            $validated = $request->validate([
                'device_id' => 'required|string',
                'records' => 'required|array|min:1',
                'records.*.employee_id' => 'required',
                'records.*.timestamp' => 'required|date',
                'records.*.action' => 'required|in:in,out,IN,OUT',
            ]);

            $results = [
                'success' => 0,
                'failed' => 0,
                'details' => [],
            ];

            foreach ($validated['records'] as $record) {
                $punchRequest = new Request([
                    'employee_id' => $record['employee_id'],
                    'timestamp' => $record['timestamp'],
                    'action' => $record['action'],
                    'device_id' => $validated['device_id'],
                ]);

                $response = $this->receivePunch($punchRequest);
                $responseData = $response->getData(true);

                if ($responseData['success']) {
                    $results['success']++;
                } else {
                    $results['failed']++;
                }

                $results['details'][] = [
                    'employee_id' => $record['employee_id'],
                    'timestamp' => $record['timestamp'],
                    'action' => $record['action'],
                    'success' => $responseData['success'],
                    'message' => $responseData['message'],
                ];
            }

            Log::info("Bundy Clock: Batch sync completed", [
                'device_id' => $validated['device_id'],
                'total' => count($validated['records']),
                'success' => $results['success'],
                'failed' => $results['failed'],
            ]);

            return response()->json([
                'success' => true,
                'message' => "Processed {$results['success']} records successfully, {$results['failed']} failed",
                'results' => $results,
            ], 200);

        } catch (\Exception $e) {
            Log::error("Bundy Clock: Batch sync failed", [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Batch sync failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Health check endpoint for bundy clock devices
     */
    public function healthCheck()
    {
        return response()->json([
            'status' => 'online',
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'message' => 'Bundy clock integration is operational',
        ], 200);
    }

    /**
     * Test endpoint - can be disabled in production
     */
    public function test(Request $request)
    {
        if (config('app.env') === 'production') {
            return response()->json(['message' => 'Test endpoint disabled in production'], 403);
        }

        return response()->json([
            'message' => 'Bundy Clock API is working',
            'received_data' => $request->all(),
            'timestamp' => now()->format('Y-m-d H:i:s'),
        ], 200);
    }
}

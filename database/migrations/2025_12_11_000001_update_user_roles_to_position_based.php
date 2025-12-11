<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Map positions to their corresponding roles
        $roleMapping = [
            'Project Manager' => 'PM',
            'Site Supervisor' => 'SS',
            'Finance Manager' => 'FM',
            'HR/Timekeeper' => 'HR',
            'HR' => 'HR',
            'Quality Assurance Officer' => 'QA',
            'Construction Worker' => 'CW',
            'Laborer' => 'CW',
        ];

        // Update user roles based on employee_list position if user_position column doesn't exist
        if (!Schema::hasColumn('users', 'user_position')) {
            // Get employees and update their associated user roles
            $employees = DB::table('employee_list')
                ->join('users', 'employee_list.user_id', '=', 'users.id')
                ->select('users.id', 'employee_list.position')
                ->get();

            foreach ($employees as $employee) {
                $role = $roleMapping[$employee->position] ?? 'CW'; // Default to CW if position not found
                DB::table('users')
                    ->where('id', $employee->id)
                    ->where('role', '!=', 'OWNER') // Don't change OWNER role
                    ->update(['role' => $role]);
            }
        } else {
            // Update user roles based on their position
            foreach ($roleMapping as $position => $role) {
                DB::table('users')
                    ->where('user_position', $position)
                    ->where('role', '!=', 'OWNER') // Don't change OWNER role
                    ->update(['role' => $role]);
            }

            // For any employees without a position, check the employee_list table
            // and update their user role based on the employee's position
            $employees = DB::table('employee_list')
                ->join('users', 'employee_list.user_id', '=', 'users.id')
                ->select('users.id', 'employee_list.position')
                ->get();

            foreach ($employees as $employee) {
                $role = $roleMapping[$employee->position] ?? 'CW'; // Default to CW if position not found
                DB::table('users')
                    ->where('id', $employee->id)
                    ->where('role', '!=', 'OWNER') // Don't change OWNER role
                    ->update(['role' => $role]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert roles back to USER as fallback
        DB::table('users')
            ->whereIn('role', ['PM', 'FM', 'HR', 'QA', 'SS', 'CW'])
            ->where('role', '!=', 'OWNER')
            ->update(['role' => 'USER']);
    }
};

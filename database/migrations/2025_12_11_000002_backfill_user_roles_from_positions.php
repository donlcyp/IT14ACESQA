<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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

        // 1) If users have a user_position column, map ROLE only where it's still USER.
        if (Schema::hasColumn('users', 'user_position')) {
            $users = DB::table('users')
                ->where('role', 'USER')
                ->whereNot('role', 'OWNER')
                ->whereNotNull('user_position')
                ->select('id', 'user_position')
                ->get();

            foreach ($users as $user) {
                $newRole = $roleMapping[$user->user_position] ?? 'CW';
                DB::table('users')->where('id', $user->id)->update(['role' => $newRole]);
            }
        }

        // 2) Fallback: map based on employee_list position where role is still USER.
        $employees = DB::table('employee_list')
            ->join('users', 'employee_list.user_id', '=', 'users.id')
            ->where('users.role', 'USER')
            ->whereNot('users.role', 'OWNER')
            ->select('users.id', 'employee_list.position')
            ->get();

        foreach ($employees as $employee) {
            $newRole = $roleMapping[$employee->position] ?? 'CW';
            DB::table('users')->where('id', $employee->id)->update(['role' => $newRole]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert mapped roles back to USER (excluding OWNER)
        DB::table('users')
            ->whereIn('role', ['PM', 'FM', 'HR', 'QA', 'SS', 'CW'])
            ->whereNot('role', 'OWNER')
            ->update(['role' => 'USER']);
    }
};

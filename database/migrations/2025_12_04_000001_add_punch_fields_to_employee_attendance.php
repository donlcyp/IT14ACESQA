<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employee_attendance', function (Blueprint $table) {
            // Add new punch-related columns
            if (!Schema::hasColumn('employee_attendance', 'punch_in_time')) {
                $table->timestamp('punch_in_time')->nullable()->comment('Automatic timestamp when employee punches in');
            }
            if (!Schema::hasColumn('employee_attendance', 'punch_out_time')) {
                $table->timestamp('punch_out_time')->nullable()->comment('Automatic timestamp when employee punches out');
            }
            if (!Schema::hasColumn('employee_attendance', 'is_late')) {
                $table->boolean('is_late')->default(false)->comment('Whether employee was late to work');
            }
            if (!Schema::hasColumn('employee_attendance', 'late_minutes')) {
                $table->integer('late_minutes')->default(0)->comment('Number of minutes late');
            }
            if (!Schema::hasColumn('employee_attendance', 'grace_period_applied')) {
                $table->boolean('grace_period_applied')->default(false)->comment('Whether grace period was applied');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_attendance', function (Blueprint $table) {
            if (Schema::hasColumn('employee_attendance', 'punch_in_time')) {
                $table->dropColumn('punch_in_time');
            }
            if (Schema::hasColumn('employee_attendance', 'punch_out_time')) {
                $table->dropColumn('punch_out_time');
            }
            if (Schema::hasColumn('employee_attendance', 'is_late')) {
                $table->dropColumn('is_late');
            }
            if (Schema::hasColumn('employee_attendance', 'late_minutes')) {
                $table->dropColumn('late_minutes');
            }
            if (Schema::hasColumn('employee_attendance', 'grace_period_applied')) {
                $table->dropColumn('grace_period_applied');
            }
        });
    }
};

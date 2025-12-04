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
            // Add validation-related columns
            if (!Schema::hasColumn('employee_attendance', 'validation_status')) {
                $table->enum('validation_status', ['pending', 'approved', 'rejected'])->default('pending')->after('grace_period_applied')
                    ->comment('Attendance validation status: pending, approved, or rejected by HR/Timekeeper');
            }
            if (!Schema::hasColumn('employee_attendance', 'validated_by')) {
                $table->foreignId('validated_by')->nullable()->after('validation_status')
                    ->constrained('users')->nullOnDelete()
                    ->comment('User ID of the HR/Timekeeper who validated this attendance');
            }
            if (!Schema::hasColumn('employee_attendance', 'validation_notes')) {
                $table->text('validation_notes')->nullable()->after('validated_by')
                    ->comment('Notes from HR/Timekeeper regarding the validation decision');
            }
            if (!Schema::hasColumn('employee_attendance', 'validated_at')) {
                $table->timestamp('validated_at')->nullable()->after('validation_notes')
                    ->comment('Timestamp when the HR/Timekeeper approved or rejected the attendance');
            }
            if (!Schema::hasColumn('employee_attendance', 'rejection_reason')) {
                $table->string('rejection_reason')->nullable()->after('validated_at')
                    ->comment('Reason for rejecting the attendance punch-in');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_attendance', function (Blueprint $table) {
            if (Schema::hasColumn('employee_attendance', 'validation_status')) {
                $table->dropColumn('validation_status');
            }
            if (Schema::hasColumn('employee_attendance', 'validated_by')) {
                $table->dropForeign(['validated_by']);
                $table->dropColumn('validated_by');
            }
            if (Schema::hasColumn('employee_attendance', 'validation_notes')) {
                $table->dropColumn('validation_notes');
            }
            if (Schema::hasColumn('employee_attendance', 'validated_at')) {
                $table->dropColumn('validated_at');
            }
            if (Schema::hasColumn('employee_attendance', 'rejection_reason')) {
                $table->dropColumn('rejection_reason');
            }
        });
    }
};

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
        Schema::create('attendance_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained('employee_attendance')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employee_list')->cascadeOnDelete();
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete()
                ->comment('HR/Timekeeper who validated this attendance');
            $table->enum('validation_status', ['pending', 'approved', 'rejected'])->default('pending')
                ->comment('Status of the attendance validation');
            $table->text('validation_notes')->nullable()
                ->comment('HR/Timekeeper notes about the decision');
            $table->string('rejection_reason')->nullable()
                ->comment('Specific reason if attendance is rejected');
            $table->timestamp('validated_at')->nullable()
                ->comment('When the validation was completed');
            $table->timestamps();

            // Indexes for common queries
            $table->index(['attendance_id', 'validation_status']);
            $table->index(['employee_id', 'validation_status']);
            $table->index(['validated_by']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_validations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds Site Supervisor verification fields for attendance workflow
     */
    public function up(): void
    {
        Schema::table('employee_attendance', function (Blueprint $table) {
            // SS verification status
            $table->enum('ss_verification_status', ['pending', 'verified', 'denied'])->nullable()->after('validation_status');
            $table->foreignId('ss_verified_by')->nullable()->after('ss_verification_status')->constrained('users')->nullOnDelete();
            $table->timestamp('ss_verified_at')->nullable()->after('ss_verified_by');
            
            // Index for filtering
            $table->index('ss_verification_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_attendance', function (Blueprint $table) {
            $table->dropIndex(['ss_verification_status']);
            $table->dropForeign(['ss_verified_by']);
            $table->dropColumn([
                'ss_verification_status',
                'ss_verified_by',
                'ss_verified_at'
            ]);
        });
    }
};

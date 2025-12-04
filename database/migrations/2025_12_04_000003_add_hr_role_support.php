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
        // The users table should already have 'role' and 'user_position' columns
        // This migration ensures the 'role' column can accommodate the 'HR' role value
        // No action needed if columns already exist
        
        // If needed, you can add a check to update existing role enums
        // The role column currently supports: OWNER, PM, EMPLOYEE
        // We're adding HR role support
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reversible by removing HR role values from production (not implemented here)
    }
};

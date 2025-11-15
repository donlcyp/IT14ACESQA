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
        // For MySQL, we need to alter the ENUM column to add 'Idle'
        DB::statement("ALTER TABLE employees MODIFY COLUMN status ENUM('Idle', 'On Site', 'On Leave', 'Absent') DEFAULT 'Idle'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to the original ENUM values
        DB::statement("ALTER TABLE employees MODIFY COLUMN status ENUM('On Site', 'On Leave', 'Absent') DEFAULT 'On Site'");
    }
};

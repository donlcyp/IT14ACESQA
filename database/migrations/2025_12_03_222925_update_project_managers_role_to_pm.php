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
        // Update all users with position 'Project Manager' to have role 'PM'
        DB::table('users')
            ->where('user_position', 'Project Manager')
            ->update(['role' => 'PM']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert Project Manager roles back to USER
        DB::table('users')
            ->where('user_position', 'Project Manager')
            ->where('role', 'PM')
            ->update(['role' => 'USER']);
    }
};

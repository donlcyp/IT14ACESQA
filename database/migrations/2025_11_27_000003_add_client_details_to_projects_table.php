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
        Schema::table('projects', function (Blueprint $table) {
            // Add client detail columns after client_id
            $table->string('client_prefix')->nullable()->after('client_id');
            $table->string('client_first_name')->nullable()->after('client_prefix');
            $table->string('client_last_name')->nullable()->after('client_first_name');
            $table->string('client_suffix')->nullable()->after('client_last_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['client_prefix', 'client_first_name', 'client_last_name', 'client_suffix']);
        });
    }
};

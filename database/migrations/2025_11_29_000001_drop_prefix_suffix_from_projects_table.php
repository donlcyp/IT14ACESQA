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
            // Drop the columns if they exist
            if (Schema::hasColumn('projects', 'client_prefix')) {
                $table->dropColumn('client_prefix');
            }
            if (Schema::hasColumn('projects', 'client_suffix')) {
                $table->dropColumn('client_suffix');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Recreate the columns if rollback is needed
            if (!Schema::hasColumn('projects', 'client_prefix')) {
                $table->string('client_prefix')->nullable()->after('client_id');
            }
            if (!Schema::hasColumn('projects', 'client_suffix')) {
                $table->string('client_suffix')->nullable()->after('client_last_name');
            }
        });
    }
};

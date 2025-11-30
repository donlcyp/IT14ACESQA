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
            // Add project_type column if it doesn't exist
            if (!Schema::hasColumn('projects', 'project_type')) {
                $table->enum('project_type', ['Plumbing Work', 'Fire Safety'])->nullable()->after('industry');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'project_type')) {
                $table->dropColumn('project_type');
            }
        });
    }
};

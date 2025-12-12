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
            // Modify project_type column to support longer strings
            if (Schema::hasColumn('projects', 'project_type')) {
                // Change from ENUM to VARCHAR
                $table->string('project_type', 100)->nullable()->change();
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
                $table->enum('project_type', ['Plumbing Works', 'Fire Safety', 'Fire Detection Alarm System', 'Gas Line Installation', 'Air-Conditioning System Installation & Maintenance', 'Ducting Works'])->nullable()->change();
            }
        });
    }
};

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
        Schema::table('materials', function (Blueprint $table) {
            // Add project_record_id if it doesn't exist
            if (!Schema::hasColumn('materials', 'project_record_id')) {
                $table->foreignId('project_record_id')
                    ->nullable()
                    ->constrained('project_records')
                    ->cascadeOnDelete()
                    ->after('id');
            }
            
            // Add project_id if it doesn't exist (for reference)
            if (!Schema::hasColumn('materials', 'project_id')) {
                $table->foreignId('project_id')
                    ->nullable()
                    ->constrained('projects')
                    ->cascadeOnDelete()
                    ->after('project_record_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            if (Schema::hasColumn('materials', 'project_record_id')) {
                $table->dropForeignIdFor(\App\Models\ProjectRecord::class);
            }
            if (Schema::hasColumn('materials', 'project_id')) {
                $table->dropForeignIdFor(\App\Models\Project::class);
            }
        });
    }
};

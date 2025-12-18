<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds task-related fields for Site Supervisor task management
     */
    public function up(): void
    {
        Schema::table('project_updates', function (Blueprint $table) {
            // Task type field to differentiate tasks from progress reports
            $table->enum('type', ['task', 'progress', 'issue'])->default('progress')->after('status');
            
            // Task-specific fields
            $table->integer('completion_percentage')->nullable()->after('type');
            $table->integer('workers_present')->nullable()->after('completion_percentage');
            $table->string('weather_condition')->nullable()->after('workers_present');
            $table->json('photos')->nullable()->after('weather_condition');
            $table->text('notes')->nullable()->after('photos');
            
            // Priority for issues/tasks
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->nullable()->after('notes');
            
            // Issue type for categorization
            $table->string('issue_type')->nullable()->after('priority');
            
            // Index for filtering by type
            $table->index('type');
            $table->index('material_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_updates', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['material_id']);
            $table->dropColumn([
                'type',
                'completion_percentage',
                'workers_present',
                'weather_condition',
                'photos',
                'notes',
                'priority',
                'issue_type'
            ]);
        });
    }
};

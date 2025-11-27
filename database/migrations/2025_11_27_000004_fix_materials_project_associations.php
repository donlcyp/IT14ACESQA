<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Material;
use App\Models\Project;
use App\Models\ProjectRecord;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all materials without project associations
        $materials = Material::whereNull('project_id')->whereNull('project_record_id')->get();

        foreach ($materials as $material) {
            // Try to find a matching project by name (if available in supplier or material_name)
            // For now, assign to the first available project if it exists
            $project = Project::first();
            
            if ($project) {
                // Update the material with project association
                $material->project_id = $project->id;
                
                // Try to find or create a project record
                $projectRecord = ProjectRecord::where('project_id', $project->id)->first();
                if ($projectRecord) {
                    $material->project_record_id = $projectRecord->id;
                }
                
                $material->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set project associations back to null
        DB::table('materials')
            ->whereNotNull('project_id')
            ->whereNotNull('project_record_id')
            ->update([
                'project_id' => null,
                'project_record_id' => null
            ]);
    }
};

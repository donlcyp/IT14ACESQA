<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Material;

$materials = Material::with(['project', 'projectRecord.project'])->get();

echo "\n=== Materials with Project Associations ===\n\n";

foreach ($materials as $material) {
    $projectName = $material->project?->project_name ?? 
                   $material->projectRecord?->project?->project_name ?? 
                   'N/A';
    
    echo "ID: {$material->id}\n";
    echo "Name: {$material->material_name}\n";
    echo "Project: $projectName\n";
    echo "Project ID: {$material->project_id}\n";
    echo "ProjectRecord ID: {$material->project_record_id}\n";
    echo "---\n";
}

?>

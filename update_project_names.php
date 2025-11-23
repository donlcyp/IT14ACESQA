<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$projects = \App\Models\Project::all();
foreach ($projects as $project) {
    $project->update(['project_name' => $project->description ?? $project->project_code]);
    echo "Updated: {$project->project_code} -> {$project->project_name}\n";
}
echo "\nAll projects updated!\n";
?>

<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$projects = \App\Models\Project::select('id', 'project_code', 'project_name', 'description')->get();
echo "Project Database Structure:\n";
echo str_repeat("=", 80) . "\n";
foreach ($projects as $p) {
    echo "ID: {$p->id}\n";
    echo "  Project Code (ID): {$p->project_code}\n";
    echo "  Project Name: {$p->project_name}\n";
    echo "  Description: " . ($p->description ?? 'N/A') . "\n\n";
}
?>

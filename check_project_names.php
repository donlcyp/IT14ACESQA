<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$projects = \App\Models\Project::select('id', 'project_code', 'description')->get();
foreach ($projects as $p) {
    echo "ID: {$p->id}, Code: {$p->project_code}, Description: " . ($p->description ?? 'N/A') . "\n";
}
?>

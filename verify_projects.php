<?php
require __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$projects = \App\Models\Project::all();

echo "Total Projects: " . count($projects) . "\n\n";

foreach ($projects as $project) {
    echo "Project: " . $project->project_name . "\n";
    echo "  Client: " . ($project->client_first_name ?? 'N/A') . " " . ($project->client_last_name ?? 'N/A') . "\n";
    echo "  Prefix: " . ($project->client_prefix ?? 'N/A') . "\n";
    echo "  Status: " . $project->status . "\n";
    echo "---\n";
}

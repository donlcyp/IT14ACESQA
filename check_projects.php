<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$projects = \App\Models\Project::with('client', 'assignedPM', 'employees')->limit(5)->get();
echo "Total Projects: " . count($projects) . "\n\n";

foreach ($projects as $p) {
    echo "Project: " . $p->project_code . "\n";
    echo "  Client: " . ($p->client?->company_name ?? 'N/A') . "\n";
    echo "  PM: " . ($p->assignedPM?->name ?? 'N/A') . "\n";
    echo "  Employees: " . $p->employees->count() . "\n";
    echo "  Status: " . $p->status . "\n\n";
}
?>

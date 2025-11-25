<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

// Test creating a ProjMatManage with null employee_id
try {
    $projMatManage = \App\Models\ProjMatManage::create([
        'project_id' => 1,
        'client_id' => 1,
        'employee_id' => null,
    ]);
    echo "✓ Successfully created ProjMatManage with null employee_id\n";
    echo "ID: {$projMatManage->id}, Project: {$projMatManage->project_id}, Client: {$projMatManage->client_id}, Employee: {$projMatManage->employee_id}\n";
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>

<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Material;

$materials = Material::with(['project', 'projectRecord.project'])->get();

echo "\n=== Materials with Status and Costs ===\n\n";

$totalExpenses = 0;
$approvedExpenses = 0;
$pendingExpenses = 0;
$failedExpenses = 0;

foreach ($materials as $material) {
    $projectName = $material->project?->project_name ?? 
                   $material->projectRecord?->project?->project_name ?? 
                   'N/A';
    
    echo "ID: {$material->id}\n";
    echo "Name: {$material->material_name}\n";
    echo "Status: {$material->status}\n";
    echo "Total Cost: {$material->total_cost}\n";
    echo "Project: $projectName\n";
    echo "---\n";
    
    $totalExpenses += $material->total_cost;
    
    if (strtolower($material->status) == 'approved') {
        $approvedExpenses += $material->total_cost;
    } elseif (strtolower($material->status) == 'pending') {
        $pendingExpenses += $material->total_cost;
    } elseif (strtolower($material->status) == 'fail') {
        $failedExpenses += $material->total_cost;
    }
}

echo "\n=== Expense Summary ===\n";
echo "Total Expenses: ₱$totalExpenses\n";
echo "Approved: ₱$approvedExpenses\n";
echo "Pending: ₱$pendingExpenses\n";
echo "Failed: ₱$failedExpenses\n";

?>

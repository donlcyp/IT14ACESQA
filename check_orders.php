<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';

use App\Models\PurchaseOrder;
use App\Models\Project;

// Get first project
$project = Project::first();

if ($project) {
    echo "Project: " . $project->project_name . "\n";
    echo "Total Purchase Orders: " . $project->purchaseOrders()->count() . "\n";
    echo "Approved Orders: " . $project->purchaseOrders()->where('status', 'approved')->count() . "\n";
    echo "\nAll Purchase Orders:\n";
    
    $project->purchaseOrders()->get()->each(function($po) {
        echo "  ID: {$po->purchase_order_id} | Status: {$po->status} | Material: {$po->material_id}\n";
    });
    
    // Check all purchase orders in system
    echo "\n\nAll Purchase Orders in Database:\n";
    PurchaseOrder::all()->each(function($po) {
        echo "  ID: {$po->purchase_order_id} | Project: {$po->project_id} | Status: {$po->status}\n";
    });
} else {
    echo "No projects found\n";
}
?>

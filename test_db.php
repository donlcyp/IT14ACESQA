<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Material;
use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\EmployeeList;

echo "=== DATABASE CONNECTION TEST ===\n";
echo "✓ Users: " . User::count() . "\n";
echo "✓ Clients: " . Client::count() . "\n";
echo "✓ Projects: " . Project::count() . "\n";
echo "✓ Materials: " . Material::count() . "\n";
echo "✓ Purchase Orders: " . PurchaseOrder::count() . "\n";
echo "✓ Invoices: " . Invoice::count() . "\n";
echo "✓ Employee List: " . EmployeeList::count() . "\n";
echo "\n=== DATABASE CONNECTION SUCCESSFUL ===\n";

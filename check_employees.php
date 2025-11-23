<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$employees = \App\Models\EmployeeList::limit(5)->get();
echo "Total Employees: " . \App\Models\EmployeeList::count() . "\n";
foreach ($employees as $e) {
    echo "ID: {$e->id}, Name: {$e->f_name} {$e->l_name}\n";
}
?>

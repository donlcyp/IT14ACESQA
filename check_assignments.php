<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

// Check project_employees table
$projectEmployees = \Illuminate\Support\Facades\DB::table('project_employees')->get();
echo "Total Project-Employee Assignments: " . count($projectEmployees) . "\n\n";

foreach ($projectEmployees as $pe) {
    $project = \App\Models\Project::find($pe->project_id);
    $employee = \App\Models\Employee::find($pe->employee_id);
    echo "Project: " . $project->project_code . " - Employee: " . $employee->f_name . " " . $employee->l_name . "\n";
}

// Check employees
$employees = \App\Models\Employee::all();
echo "\n\nTotal Employees: " . count($employees) . "\n";

// Check attendance
$attendance = \App\Models\EmployeeAttendance::all();
echo "Total Attendance Records: " . count($attendance) . "\n";
?>

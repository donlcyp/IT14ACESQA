<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Material;
use App\Models\ProjectRecord;
use App\Models\EmployeeList;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use App\Models\EmployeeAttendance;
use App\Models\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing data
        DB::table('logs')->truncate();
        DB::table('invoices')->truncate();
        DB::table('purchase_orders')->truncate();
        DB::table('materials')->truncate();
        DB::table('project_records')->truncate();
        DB::table('projects')->truncate();
        DB::table('employee_attendance')->truncate();
        DB::table('employee_list')->truncate();
        DB::table('users')->truncate();
        DB::table('clients')->truncate();

        // ============ USERS ============
        $owner = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'OWNER',
            'user_position' => 'Administrator',
            'status' => 'Active',
        ]);

        $pm1 = User::create([
            'name' => 'Shane Beriong',
            'email' => 'pm1@example.com',
            'password' => Hash::make('password'),
            'role' => 'PM',
            'user_position' => 'Project Manager',
            'status' => 'Active',
        ]);

        $pm2 = User::create([
            'name' => 'Project Manager',
            'email' => 'pm2@example.com',
            'password' => Hash::make('password'),
            'role' => 'PM',
            'user_position' => 'Project Manager',
            'status' => 'Active',
        ]);

        $fm = User::create([
            'name' => 'Finance Manager',
            'email' => 'fm@example.com',
            'password' => Hash::make('password'),
            'role' => 'FM',
            'user_position' => 'Finance Manager',
            'status' => 'Active',
        ]);

        $qa = User::create([
            'name' => 'QA Officer',
            'email' => 'qa@example.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
            'user_position' => 'Quality Assurance Officer',
            'status' => 'Active',
        ]);

        $fieldStaff = User::create([
            'name' => 'Field Staff',
            'email' => 'fieldstaff@example.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
            'user_position' => 'Field Staff',
            'status' => 'Active',
        ]);

        // ============ CLIENTS ============
        $client1 = Client::create([
            'company_name' => 'ABC Corporation',
            'contact_person' => 'Mr Bong Bong Marcos',
            'email' => 'contact@abc.com',
            'phone' => '555-0101',
            'address' => '123 Business Ave',
        ]);

        $client2 = Client::create([
            'company_name' => 'Tech Innovators Inc',
            'contact_person' => 'Sarah Johnson',
            'email' => 'contact@techinnovators.com',
            'phone' => '555-0102',
            'address' => '456 Tech Boulevard',
        ]);

        $client3 = Client::create([
            'company_name' => 'Construction Experts Ltd',
            'contact_person' => 'Robert Chen',
            'email' => 'contact@constexperts.com',
            'phone' => '555-0103',
            'address' => '789 Construction Way',
        ]);

        $client4 = Client::create([
            'company_name' => 'Sin City Development',
            'contact_person' => 'Michael Torres',
            'email' => 'contact@sincitydev.com',
            'phone' => '555-0104',
            'address' => '321 Urban Plaza',
        ]);

        $client5 = Client::create([
            'company_name' => 'Marina Development Corp',
            'contact_person' => 'Jennifer Lee',
            'email' => 'contact@marinadev.com',
            'phone' => '555-0105',
            'address' => '654 Waterfront Avenue',
        ]);

        // ============ PROJECTS ============
        $project1 = Project::create([
            'project_code' => 'PROJ-001',
            'project_name' => 'Website Development',
            'description' => 'Full stack website development with responsive design',
            'location' => 'Manila',
            'industry' => 'Technology',
            'date_started' => now()->subMonths(3),
            'assigned_pm_id' => $pm2->id,
            'client_id' => $client2->id,
            'client_prefix' => 'Ms',
            'client_first_name' => 'Sarah',
            'client_last_name' => 'Johnson',
            'allocated_amount' => 150000,
            'used_amount' => 125000,
            'status' => 'Ongoing',
        ]);

        $project2 = Project::create([
            'project_code' => 'PROJ-002',
            'project_name' => 'Yes king road',
            'description' => 'Road construction and infrastructure development',
            'location' => 'Luzon',
            'industry' => 'Construction',
            'date_started' => now()->subMonths(6),
            'assigned_pm_id' => $pm1->id,
            'allocated_amount' => 500000,
            'status' => 'Ongoing',
        ]);

        $project3 = Project::create([
            'project_code' => 'PROJ-003',
            'project_name' => 'ambaturoad',
            'description' => 'Amphibious road development project',
            'location' => 'Visayas',
            'industry' => 'Infrastructure',
            'date_started' => now()->subMonths(2),
            'assigned_pm_id' => $pm1->id,
            'client_id' => $client1->id,
            'allocated_amount' => 300000,
            'used_amount' => 200000,
            'status' => 'Ongoing',
        ]);

        $project4 = Project::create([
            'project_code' => 'PROJ-004',
            'project_name' => 'Ghost Project',
            'description' => 'Special project - needs review',
            'location' => 'Manila',
            'industry' => 'Consulting',
            'assigned_pm_id' => $pm1->id,
            'allocated_amount' => 100000,
            'status' => 'Ongoing',
            'archived' => true,
            'archived_at' => now()->subMonths(2),
            'archive_reason' => 'Cancelled',
        ]);

        $project5 = Project::create([
            'project_code' => 'PROJ-005',
            'project_name' => 'Sin City',
            'description' => 'Urban development and infrastructure project',
            'location' => 'Metro Manila',
            'industry' => 'Real Estate',
            'date_started' => now()->subMonths(1),
            'assigned_pm_id' => $pm2->id,
            'client_id' => $client4->id,
            'client_first_name' => 'Michael',
            'client_last_name' => 'Torres',
            'client_prefix' => 'Mr',
            'allocated_amount' => 450000,
            'used_amount' => 180000,
            'status' => 'Ongoing',
        ]);

        $project6 = Project::create([
            'project_code' => 'PROJ-006',
            'project_name' => 'Marina It Park',
            'description' => 'Information Technology park development in marina area',
            'location' => 'Bay City',
            'industry' => 'Technology',
            'date_started' => now()->subWeeks(2),
            'assigned_pm_id' => $pm1->id,
            'client_id' => $client5->id,
            'client_first_name' => 'Jennifer',
            'client_last_name' => 'Lee',
            'client_prefix' => 'Ms',
            'allocated_amount' => 600000,
            'used_amount' => 250000,
            'status' => 'Ongoing',
        ]);

        // ============ PROJECT RECORDS ============
        $pr1 = ProjectRecord::create([
            'project_id' => $project1->id,
            'title' => 'Website Development',
            'client' => 'Tech Innovators Inc',
            'inspector' => 'QA Officer',
            'time' => now()->format('H:i:s'),
            'color' => '#16a34a',
        ]);

        $pr2 = ProjectRecord::create([
            'project_id' => $project2->id,
            'title' => 'Yes King Road',
            'client' => 'Government',
            'inspector' => 'Eulesis Culaba',
            'time' => now()->format('H:i:s'),
            'color' => '#3b82f6',
        ]);

        $pr3 = ProjectRecord::create([
            'project_id' => $project3->id,
            'title' => 'Ambaturoad',
            'client' => 'ABC Corporation',
            'inspector' => 'Eulesis Culaba',
            'time' => now()->format('H:i:s'),
            'color' => '#f59e0b',
        ]);

        $pr4 = ProjectRecord::create([
            'project_id' => $project5->id,
            'title' => 'Sin City',
            'client' => 'Sin City Development',
            'inspector' => 'QA Officer',
            'time' => now()->format('H:i:s'),
            'color' => '#dc2626',
        ]);

        $pr5 = ProjectRecord::create([
            'project_id' => $project6->id,
            'title' => 'Marina IT Park',
            'client' => 'Marina Development Corp',
            'inspector' => 'QA Officer',
            'time' => now()->format('H:i:s'),
            'color' => '#8b5cf6',
        ]);

        // ============ MATERIALS ============
        $material1 = Material::create([
            'project_record_id' => $pr1->id,
            'project_id' => $project1->id,
            'material_name' => 'Server Hardware',
            'batch_serial_no' => 'BATCH-001',
            'supplier' => 'Tech Supplies',
            'quantity_received' => 5,
            'unit_of_measure' => 'units',
            'unit_price' => 2500,
            'total_cost' => 12500,
            'date_received' => now()->subDays(5),
            'status' => 'Approved',
        ]);

        $material2 = Material::create([
            'project_record_id' => $pr2->id,
            'project_id' => $project2->id,
            'material_name' => 'pvc',
            'batch_serial_no' => 'BATCH-002',
            'supplier' => 'Solid Steel',
            'quantity_received' => 2,
            'unit_of_measure' => 'Meter',
            'unit_price' => 3000,
            'total_cost' => 6000,
            'date_received' => now()->subDays(3),
            'status' => 'Approved',
        ]);

        $material3 = Material::create([
            'project_record_id' => $pr2->id,
            'project_id' => $project2->id,
            'material_name' => 'pipe',
            'batch_serial_no' => 'BATCH-003',
            'supplier' => 'Diamond is Unbreakable',
            'quantity_received' => 20,
            'unit_of_measure' => 'Meter',
            'unit_price' => 1000,
            'total_cost' => 20000,
            'date_received' => now()->subDays(1),
            'status' => 'Fail',
            'remarks' => 'Defective pipes - need replacement',
        ]);

        // ============ PURCHASE ORDERS ============
        $po1 = PurchaseOrder::create([
            'project_id' => $project1->id,
            'material_id' => $material1->id,
            'quantity' => 5,
            'order_date' => now()->subDays(10),
            'status' => 'Completed',
        ]);

        $po2 = PurchaseOrder::create([
            'project_id' => $project2->id,
            'material_id' => $material2->id,
            'quantity' => 2,
            'order_date' => now()->subDays(8),
            'status' => 'Completed',
        ]);

        $po3 = PurchaseOrder::create([
            'project_id' => $project2->id,
            'material_id' => $material3->id,
            'quantity' => 20,
            'order_date' => now()->subDays(7),
            'status' => 'Completed',
        ]);

        // ============ INVOICES ============
        Invoice::create([
            'purchase_order_id' => $po1->id,
            'created_by' => $owner->id,
            'invoice_number' => 'INV-0001',
            'total_amount' => 12500,
            'amount' => 12500,
            'payment_status' => 'paid',
            'approval_status' => 'approved',
        ]);

        Invoice::create([
            'purchase_order_id' => $po2->id,
            'created_by' => $owner->id,
            'invoice_number' => 'INV-0002',
            'total_amount' => 6000,
            'amount' => 6000,
            'payment_status' => 'pending',
            'approval_status' => 'pending',
        ]);

        Invoice::create([
            'purchase_order_id' => $po3->id,
            'created_by' => $owner->id,
            'invoice_number' => 'INV-0003',
            'total_amount' => 20000,
            'amount' => 20000,
            'payment_status' => 'pending',
            'approval_status' => 'pending',
        ]);

        // ============ EMPLOYEE LISTS ============
        EmployeeList::create([
            'user_id' => $fieldStaff->id,
            'f_name' => 'Field',
            'l_name' => 'Staff',
            'position' => 'Field Staff',
        ]);

        EmployeeList::create([
            'user_id' => $qa->id,
            'f_name' => 'QA',
            'l_name' => 'Officer',
            'position' => 'Quality Assurance Officer',
        ]);

        // ============ LOGS ============
        Log::create([
            'user_id' => $owner->id,
            'action' => 'LOGIN',
            'log_date' => now()->subHours(2),
            'details' => json_encode([
                'ip_address' => '192.168.1.1',
                'user_agent' => 'Mozilla/5.0',
            ]),
        ]);

        Log::create([
            'user_id' => $pm1->id,
            'action' => 'LOGIN',
            'log_date' => now()->subHours(1),
            'details' => json_encode([
                'ip_address' => '192.168.1.2',
                'user_agent' => 'Mozilla/5.0',
            ]),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✓ Database seeded successfully with comprehensive data!');
        $this->command->info('✓ Total Projects: ' . Project::count());
        $this->command->info('✓ Total Materials: ' . Material::count());
        $this->command->info('✓ Total Invoices: ' . Invoice::count());
        $this->command->info('✓ Total Activity Logs: ' . Log::count());
    }
}

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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $owner = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'OWNER',
            'user_position' => 'Administrator',
            'status' => 'Active',
        ]);

        $pm = User::create([
            'name' => 'Project Manager',
            'email' => 'pm@example.com',
            'password' => Hash::make('password'),
            'role' => 'PM',
            'user_position' => 'PM',
            'status' => 'Active',
        ]);

        $emp = User::create([
            'name' => 'John Doe',
            'email' => 'employee@example.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
            'user_position' => 'Field Staff',
            'status' => 'Active',
        ]);

        $client = Client::create([
            'company_name' => 'ABC Corporation',
            'contact_person' => 'John Smith',
            'email' => 'contact@abc.com',
            'phone' => '555-0101',
            'address' => '123 Business Ave',
        ]);

        $project = Project::create([
            'project_code' => 'PROJ-001',
            'project_name' => 'Website Development',
            'description' => 'Website Development',
            'location' => 'New York',
            'industry' => 'Technology',
            'assigned_pm_id' => $pm->id,
            'client_id' => $client->id,
            'allocated_amount' => 50000,
            'status' => 'Ongoing',
        ]);

        // Create a project record for material management
        $projectRecord = ProjectRecord::create([
            'project_id' => $project->id,
            'title' => 'Website Development - Phase 1',
            'client' => 'ABC Corporation',
            'inspector' => 'John Doe',
            'time' => now()->format('H:i:s'),
            'color' => '#16a34a',
        ]);

        $material = Material::create([
            'project_record_id' => $projectRecord->id,
            'project_id' => $project->id,
            'material_name' => 'Server Hardware',
            'supplier' => 'Tech Supplies',
            'quantity_received' => 5,
            'unit_of_measure' => 'units',
            'unit_price' => 2500,
            'total_cost' => 12500,
            'status' => 'Approved',
        ]);

        $po = PurchaseOrder::create([
            'project_id' => $project->id,
            'material_id' => $material->id,
            'quantity' => 5,
            'order_date' => now(),
            'status' => 'Completed',
        ]);

        Invoice::create([
            'purchase_order_id' => $po->id,
            'created_by' => $owner->id,
            'invoice_number' => 'INV-0001',
            'total_amount' => 12500,
            'amount' => 12500,
            'payment_status' => 'paid',
            'approval_status' => 'approved',
        ]);

        EmployeeList::create([
            'user_id' => $emp->id,
            'f_name' => 'John',
            'l_name' => 'Doe',
            'position' => 'Field Staff',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✓ Database seeded successfully!');
    }
}

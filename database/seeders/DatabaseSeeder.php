<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectRecord;
use App\Models\Material;
use App\Models\Invoice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing data (order matters due to foreign keys)
        DB::table('materials')->truncate();
        DB::table('invoices')->truncate();
        DB::table('financial_data')->truncate();
        DB::table('project_records')->truncate();
        DB::table('projects')->truncate();
        DB::table('employees')->truncate();
        DB::table('users')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed Users
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@ajjcrisber.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Engr. Dela Cruz',
                'email' => 'delacruz@ajjcrisber.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Engr. Ramirez',
                'email' => 'ramirez@ajjcrisber.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Engr. Flores',
                'email' => 'flores@ajjcrisber.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Engr. Santos',
                'email' => 'santos@ajjcrisber.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Seed Project Records and related Projects
        $recordDefinitions = [
            [
                'title' => 'Assumption School',
                'client' => 'Mrs. Maria Lopez',
                'inspector' => 'Engr. Dela Cruz',
                'time' => '30 mins ago',
                'color' => '#510d0d',
            ],
            [
                'title' => 'Dr. A.P Medical Center',
                'client' => 'Dr. Arturo Pingoy',
                'inspector' => 'Engr. Ramirez',
                'time' => '1 hour ago',
                'color' => '#1b59f8',
            ],
            [
                'title' => 'First Pacific Inn',
                'client' => 'Mr. Ramon Cruz',
                'inspector' => 'Engr. Flores',
                'time' => '2 hours ago',
                'color' => '#f81bc8',
            ],
            [
                'title' => 'Metro Shopping Complex',
                'client' => 'Mr. Carlos Mendoza',
                'inspector' => 'Engr. Santos',
                'time' => '3 hours ago',
                'color' => '#10b981',
            ],
            [
                'title' => 'Green Valley Residential',
                'client' => 'Ms. Patricia Garcia',
                'inspector' => 'Engr. Dela Cruz',
                'time' => '5 hours ago',
                'color' => '#f59e0b',
            ],
            [
                'title' => 'Tech Park Office Building',
                'client' => 'Mr. Robert Tan',
                'inspector' => 'Engr. Ramirez',
                'time' => '1 day ago',
                'color' => '#8b5cf6',
            ],
            [
                'title' => 'Coastal Bridge Project',
                'client' => 'Department of Public Works',
                'inspector' => 'Engr. Flores',
                'time' => '2 days ago',
                'color' => '#ef4444',
            ],
            [
                'title' => 'University Science Lab',
                'client' => 'Dr. Elena Rodriguez',
                'inspector' => 'Engr. Santos',
                'time' => '3 days ago',
                'color' => '#06b6d4',
            ],
        ];

        $createdProjectRecords = [];
        foreach ($recordDefinitions as $definition) {
            $clientParts = $this->splitName($definition['client']);
            $leadParts = $this->splitName($definition['inspector']);

            $project = Project::create([
                'project_name' => $definition['title'],
                'client_prefix' => $clientParts['prefix'],
                'client_first_name' => $clientParts['first_name'],
                'client_last_name' => $clientParts['last_name'],
                'client_suffix' => $clientParts['suffix'],
                'client_name' => $this->composeName($clientParts, $definition['client']),
                'status' => 'On Track',
                'lead_prefix' => $leadParts['prefix'],
                'lead_first_name' => $leadParts['first_name'],
                'lead_last_name' => $leadParts['last_name'],
                'lead_suffix' => $leadParts['suffix'],
                'lead' => $this->composeName($leadParts, $definition['inspector']),
            ]);

            $createdProjectRecords[] = ProjectRecord::create([
                'project_id' => $project->id,
                'title' => $definition['title'],
                'client' => $definition['client'],
                'inspector' => $definition['inspector'],
                'time' => $definition['time'],
                'color' => $definition['color'],
            ]);
        }

        // Seed Invoices
        $createdBy = User::first()?->id;
        $invoiceDefinitions = [
            [
                'invoice_number' => 'INV-0001',
                'purchase_order_number' => 'PO-1001',
                'total_amount' => 50000.00,
                'payment_status' => 'paid',
                'approval_status' => 'approved',
                'invoice_date' => '2025-01-16',
                'verification_date' => '2025-01-18',
                'payment_date' => '2025-01-20',
            ],
            [
                'invoice_number' => 'INV-0002',
                'purchase_order_number' => 'PO-1002',
                'total_amount' => 32000.00,
                'payment_status' => 'unpaid',
                'approval_status' => 'approved',
                'invoice_date' => '2025-02-05',
                'verification_date' => null,
                'payment_date' => null,
            ],
            [
                'invoice_number' => 'INV-0003',
                'purchase_order_number' => 'PO-1003',
                'total_amount' => 70000.00,
                'payment_status' => 'partial',
                'approval_status' => 'pending',
                'invoice_date' => '2025-03-12',
                'verification_date' => null,
                'payment_date' => '2025-03-21',
            ],
        ];

        foreach ($invoiceDefinitions as $definition) {
            Invoice::create(array_merge(
                $definition,
                ['created_by' => $createdBy]
            ));
        }

        $this->call(FinancialDataSeeder::class);
        $this->call(EmployeeSeeder::class);

        // Seed Materials linked to QA Records
        $materials = [
            // Materials for Assumption School (QA Record 1)
            [
                'project_record_id' => $createdProjectRecords[0]->id,
                'name' => 'Steel Beams',
                'batch' => 'SB-2024-001',
                'supplier' => 'Metro Steel Corp',
                'quantity' => 50,
                'unit' => 'pieces',
                'price' => 150.00,
                'total' => 7500.00,
                'date_received' => '2024-01-15',
                'date_inspected' => '2024-01-16',
                'status' => 'Approved',
                'location' => 'Warehouse A - Section 1',
            ],
            [
                'project_record_id' => $createdProjectRecords[0]->id,
                'name' => 'Concrete Mix',
                'batch' => 'CM-2024-002',
                'supplier' => 'BuildRight Materials',
                'quantity' => 25,
                'unit' => 'tons',
                'price' => 85.00,
                'total' => 2125.00,
                'date_received' => '2024-01-20',
                'date_inspected' => '2024-01-21',
                'status' => 'Approved',
                'location' => 'Storage Yard B',
            ],
            [
                'project_record_id' => $createdProjectRecords[0]->id,
                'name' => 'Electrical Cables',
                'batch' => 'EC-2024-003',
                'supplier' => 'PowerTech Solutions',
                'quantity' => 1000,
                'unit' => 'meters',
                'price' => 2.50,
                'total' => 2500.00,
                'date_received' => '2024-01-18',
                'date_inspected' => '2024-01-19',
                'status' => 'Approved',
                'location' => 'Electrical Storage Room',
            ],
            // Materials for Dr. A.P Medical Center (QA Record 2)
            [
                'project_record_id' => $createdProjectRecords[1]->id,
                'name' => 'PVC Pipes',
                'batch' => 'PP-2024-004',
                'supplier' => 'PlumbMaster Inc',
                'quantity' => 200,
                'unit' => 'pieces',
                'price' => 12.75,
                'total' => 2550.00,
                'date_received' => '2024-01-22',
                'date_inspected' => '2024-01-23',
                'status' => 'Approved',
                'location' => 'Plumbing Storage',
            ],
            [
                'project_record_id' => $createdProjectRecords[1]->id,
                'name' => 'Insulation Material',
                'batch' => 'IM-2024-005',
                'supplier' => 'ThermoGuard Ltd',
                'quantity' => 75,
                'unit' => 'boxes',
                'price' => 45.00,
                'total' => 3375.00,
                'date_received' => '2024-01-25',
                'date_inspected' => '2024-01-26',
                'status' => 'In Use',
                'location' => 'Construction Site - Building 1',
            ],
            [
                'project_record_id' => $createdProjectRecords[1]->id,
                'name' => 'Reinforcement Bars',
                'batch' => 'RB-2024-006',
                'supplier' => 'SteelWorks Industries',
                'quantity' => 150,
                'unit' => 'pieces',
                'price' => 45.50,
                'total' => 6825.00,
                'date_received' => '2024-01-28',
                'date_inspected' => '2024-01-29',
                'status' => 'Approved',
                'location' => 'Warehouse C',
            ],
            // Materials for First Pacific Inn (QA Record 3)
            [
                'project_record_id' => $createdProjectRecords[2]->id,
                'name' => 'Roofing Tiles',
                'batch' => 'RT-2024-007',
                'supplier' => 'RoofPro Materials',
                'quantity' => 500,
                'unit' => 'pieces',
                'price' => 8.50,
                'total' => 4250.00,
                'date_received' => '2024-02-01',
                'date_inspected' => '2024-02-02',
                'status' => 'Approved',
                'location' => 'Roofing Storage Area',
            ],
            [
                'project_record_id' => $createdProjectRecords[2]->id,
                'name' => 'Floor Tiles',
                'batch' => 'FT-2024-008',
                'supplier' => 'TileMaster Corp',
                'quantity' => 300,
                'unit' => 'boxes',
                'price' => 35.00,
                'total' => 10500.00,
                'date_received' => '2024-02-05',
                'date_inspected' => '2024-02-06',
                'status' => 'Pending',
                'location' => 'Interior Materials Storage',
            ],
            [
                'project_record_id' => $createdProjectRecords[2]->id,
                'name' => 'Paint',
                'batch' => 'PT-2024-009',
                'supplier' => 'ColorMax Paints',
                'quantity' => 80,
                'unit' => 'gallons',
                'price' => 25.00,
                'total' => 2000.00,
                'date_received' => '2024-02-10',
                'date_inspected' => '2024-02-11',
                'status' => 'Fail',
                'location' => 'Rejection Area - Paint Storage',
            ],
            // Materials for Metro Shopping Complex (QA Record 4)
            [
                'project_record_id' => $createdProjectRecords[3]->id,
                'name' => 'Glass Panels',
                'batch' => 'GP-2024-010',
                'supplier' => 'ClearView Glass',
                'quantity' => 120,
                'unit' => 'panels',
                'price' => 125.00,
                'total' => 15000.00,
                'date_received' => '2024-02-12',
                'date_inspected' => '2024-02-13',
                'status' => 'Approved',
                'location' => 'Glass Storage Facility',
            ],
            [
                'project_record_id' => $createdProjectRecords[3]->id,
                'name' => 'Aluminum Frames',
                'batch' => 'AF-2024-011',
                'supplier' => 'MetalFrame Solutions',
                'quantity' => 200,
                'unit' => 'pieces',
                'price' => 85.00,
                'total' => 17000.00,
                'date_received' => '2024-02-15',
                'date_inspected' => '2024-02-16',
                'status' => 'Approved',
                'location' => 'Metal Storage Yard',
            ],
            // Materials for Green Valley Residential (QA Record 5)
            [
                'project_record_id' => $createdProjectRecords[4]->id,
                'name' => 'Wooden Doors',
                'batch' => 'WD-2024-012',
                'supplier' => 'TimberCraft Doors',
                'quantity' => 60,
                'unit' => 'pieces',
                'price' => 250.00,
                'total' => 15000.00,
                'date_received' => '2024-02-18',
                'date_inspected' => '2024-02-19',
                'status' => 'Approved',
                'location' => 'Door Storage Warehouse',
            ],
            [
                'project_record_id' => $createdProjectRecords[4]->id,
                'name' => 'Window Frames',
                'batch' => 'WF-2024-013',
                'supplier' => 'WindowPro Inc',
                'quantity' => 100,
                'unit' => 'pieces',
                'price' => 180.00,
                'total' => 18000.00,
                'date_received' => '2024-02-20',
                'date_inspected' => '2024-02-21',
                'status' => 'In Use',
                'location' => 'Window Storage Area',
            ],
            // Materials for Tech Park Office Building (QA Record 6)
            [
                'project_record_id' => $createdProjectRecords[5]->id,
                'name' => 'HVAC Units',
                'batch' => 'HV-2024-014',
                'supplier' => 'ClimateControl Systems',
                'quantity' => 25,
                'unit' => 'units',
                'price' => 1200.00,
                'total' => 30000.00,
                'date_received' => '2024-02-22',
                'date_inspected' => '2024-02-23',
                'status' => 'Approved',
                'location' => 'HVAC Storage Facility',
            ],
            [
                'project_record_id' => $createdProjectRecords[5]->id,
                'name' => 'Fire Safety Equipment',
                'batch' => 'FS-2024-015',
                'supplier' => 'SafeGuard Fire Systems',
                'quantity' => 150,
                'unit' => 'pieces',
                'price' => 95.00,
                'total' => 14250.00,
                'date_received' => '2024-02-25',
                'date_inspected' => '2024-02-26',
                'status' => 'Approved',
                'location' => 'Safety Equipment Storage',
            ],
            // Materials for Coastal Bridge Project (QA Record 7)
            [
                'project_record_id' => $createdProjectRecords[6]->id,
                'name' => 'Pre-stressed Concrete Beams',
                'batch' => 'PCB-2024-016',
                'supplier' => 'BridgeWorks Materials',
                'quantity' => 40,
                'unit' => 'beams',
                'price' => 3500.00,
                'total' => 140000.00,
                'date_received' => '2024-03-01',
                'date_inspected' => '2024-03-02',
                'status' => 'Approved',
                'location' => 'Bridge Construction Site',
            ],
            [
                'project_record_id' => $createdProjectRecords[6]->id,
                'name' => 'Steel Cables',
                'batch' => 'SC-2024-017',
                'supplier' => 'CableTech Industries',
                'quantity' => 5000,
                'unit' => 'meters',
                'price' => 15.00,
                'total' => 75000.00,
                'date_received' => '2024-03-05',
                'date_inspected' => '2024-03-06',
                'status' => 'Approved',
                'location' => 'Cable Storage Yard',
            ],
            // Materials for University Science Lab (QA Record 8)
            [
                'project_record_id' => $createdProjectRecords[7]->id,
                'name' => 'Laboratory Equipment',
                'batch' => 'LE-2024-018',
                'supplier' => 'LabTech Supplies',
                'quantity' => 30,
                'unit' => 'units',
                'price' => 2500.00,
                'total' => 75000.00,
                'date_received' => '2024-03-10',
                'date_inspected' => '2024-03-11',
                'status' => 'Pending',
                'location' => 'Lab Equipment Storage',
            ],
            [
                'project_record_id' => $createdProjectRecords[7]->id,
                'name' => 'Specialized Ventilation',
                'batch' => 'SV-2024-019',
                'supplier' => 'AirFlow Systems',
                'quantity' => 15,
                'unit' => 'systems',
                'price' => 1800.00,
                'total' => 27000.00,
                'date_received' => '2024-03-12',
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Ventilation Storage',
            ],
            // Additional materials with varied statuses - Pending
            [
                'project_record_id' => $createdProjectRecords[0]->id,
                'name' => 'Waterproofing Membrane',
                'batch' => 'WM-2024-020',
                'supplier' => 'SealPro Materials',
                'quantity' => 100,
                'unit' => 'rolls',
                'price' => 45.00,
                'total' => 4500.00,
                'date_received' => '2024-03-15',
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Material Storage Area',
            ],
            [
                'project_record_id' => $createdProjectRecords[1]->id,
                'name' => 'Medical Grade Tiles',
                'batch' => 'MGT-2024-021',
                'supplier' => 'HygieneFloor Solutions',
                'quantity' => 200,
                'unit' => 'boxes',
                'price' => 95.00,
                'total' => 19000.00,
                'date_received' => '2024-03-18',
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Medical Supplies Warehouse',
            ],
            [
                'project_record_id' => $createdProjectRecords[2]->id,
                'name' => 'Hotel Fixtures',
                'batch' => 'HF-2024-022',
                'supplier' => 'LuxuryFittings Inc',
                'quantity' => 150,
                'unit' => 'pieces',
                'price' => 125.00,
                'total' => 18750.00,
                'date_received' => '2024-03-20',
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Hotel Supplies Storage',
            ],
            // Additional materials with Approved status
            [
                'project_record_id' => $createdProjectRecords[3]->id,
                'name' => 'LED Lighting Systems',
                'batch' => 'LED-2024-023',
                'supplier' => 'BrightLight Technologies',
                'quantity' => 80,
                'unit' => 'units',
                'price' => 350.00,
                'total' => 28000.00,
                'date_received' => '2024-03-22',
                'date_inspected' => '2024-03-23',
                'status' => 'Approved',
                'location' => 'Electrical Equipment Room',
            ],
            [
                'project_record_id' => $createdProjectRecords[4]->id,
                'name' => 'Smart Home Systems',
                'batch' => 'SHS-2024-024',
                'supplier' => 'TechHome Solutions',
                'quantity' => 40,
                'unit' => 'systems',
                'price' => 1200.00,
                'total' => 48000.00,
                'date_received' => '2024-03-25',
                'date_inspected' => '2024-03-26',
                'status' => 'Approved',
                'location' => 'Smart Systems Storage',
            ],
            [
                'project_record_id' => $createdProjectRecords[5]->id,
                'name' => 'Office Partitions',
                'batch' => 'OP-2024-025',
                'supplier' => 'OfficeSpace Design',
                'quantity' => 60,
                'unit' => 'panels',
                'price' => 280.00,
                'total' => 16800.00,
                'date_received' => '2024-03-28',
                'date_inspected' => '2024-03-29',
                'status' => 'Approved',
                'location' => 'Office Furniture Warehouse',
            ],
            // Additional materials with Fail status
            [
                'project_record_id' => $createdProjectRecords[0]->id,
                'name' => 'Defective Steel Rods',
                'batch' => 'DSR-2024-026',
                'supplier' => 'Metro Steel Corp',
                'quantity' => 30,
                'unit' => 'pieces',
                'price' => 85.00,
                'total' => 2550.00,
                'date_received' => '2024-04-01',
                'date_inspected' => '2024-04-02',
                'status' => 'Fail',
                'location' => 'Rejection Area - Warehouse A',
            ],
            [
                'project_record_id' => $createdProjectRecords[1]->id,
                'name' => 'Substandard Plumbing Fixtures',
                'batch' => 'SPF-2024-027',
                'supplier' => 'PlumbMaster Inc',
                'quantity' => 50,
                'unit' => 'pieces',
                'price' => 45.00,
                'total' => 2250.00,
                'date_received' => '2024-04-03',
                'date_inspected' => '2024-04-04',
                'status' => 'Fail',
                'location' => 'Rejection Area - Medical Center',
            ],
            [
                'project_record_id' => $createdProjectRecords[2]->id,
                'name' => 'Damaged Flooring Material',
                'batch' => 'DFM-2024-028',
                'supplier' => 'TileMaster Corp',
                'quantity' => 100,
                'unit' => 'boxes',
                'price' => 40.00,
                'total' => 4000.00,
                'date_received' => '2024-04-05',
                'date_inspected' => '2024-04-06',
                'status' => 'Fail',
                'location' => 'Rejection Area - Hotel Project',
            ],
            [
                'project_record_id' => $createdProjectRecords[3]->id,
                'name' => 'Non-Compliant Glass Panels',
                'batch' => 'NCGP-2024-029',
                'supplier' => 'ClearView Glass',
                'quantity' => 25,
                'unit' => 'panels',
                'price' => 200.00,
                'total' => 5000.00,
                'date_received' => '2024-04-08',
                'date_inspected' => '2024-04-09',
                'status' => 'Fail',
                'location' => 'Rejection Area - Shopping Complex',
            ],
            [
                'project_record_id' => $createdProjectRecords[4]->id,
                'name' => 'Faulty Door Hardware',
                'batch' => 'FDH-2024-030',
                'supplier' => 'TimberCraft Doors',
                'quantity' => 40,
                'unit' => 'sets',
                'price' => 75.00,
                'total' => 3000.00,
                'date_received' => '2024-04-10',
                'date_inspected' => '2024-04-11',
                'status' => 'Fail',
                'location' => 'Rejection Area - Residential Project',
            ],
            [
                'project_record_id' => $createdProjectRecords[5]->id,
                'name' => 'Defective HVAC Components',
                'batch' => 'DHC-2024-031',
                'supplier' => 'ClimateControl Systems',
                'quantity' => 10,
                'unit' => 'units',
                'price' => 1500.00,
                'total' => 15000.00,
                'date_received' => '2024-04-12',
                'date_inspected' => '2024-04-13',
                'status' => 'Fail',
                'location' => 'Rejection Area - Office Building',
            ],
            [
                'project_record_id' => $createdProjectRecords[6]->id,
                'name' => 'Substandard Concrete Beams',
                'batch' => 'SCB-2024-032',
                'supplier' => 'BridgeWorks Materials',
                'quantity' => 15,
                'unit' => 'beams',
                'price' => 3200.00,
                'total' => 48000.00,
                'date_received' => '2024-04-15',
                'date_inspected' => '2024-04-16',
                'status' => 'Fail',
                'location' => 'Rejection Area - Bridge Project',
            ],
            [
                'project_record_id' => $createdProjectRecords[7]->id,
                'name' => 'Non-Compliant Lab Equipment',
                'batch' => 'NCLE-2024-033',
                'supplier' => 'LabTech Supplies',
                'quantity' => 8,
                'unit' => 'units',
                'price' => 2800.00,
                'total' => 22400.00,
                'date_received' => '2024-04-18',
                'date_inspected' => '2024-04-19',
                'status' => 'Fail',
                'location' => 'Rejection Area - Science Lab',
            ],
            // More Pending materials
            [
                'project_record_id' => $createdProjectRecords[6]->id,
                'name' => 'Bridge Expansion Joints',
                'batch' => 'BEJ-2024-034',
                'supplier' => 'BridgeWorks Materials',
                'quantity' => 20,
                'unit' => 'units',
                'price' => 850.00,
                'total' => 17000.00,
                'date_received' => '2024-04-20',
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Bridge Materials Storage',
            ],
            [
                'project_record_id' => $createdProjectRecords[7]->id,
                'name' => 'Fume Hood Systems',
                'batch' => 'FHS-2024-035',
                'supplier' => 'AirFlow Systems',
                'quantity' => 12,
                'unit' => 'systems',
                'price' => 2200.00,
                'total' => 26400.00,
                'date_received' => '2024-04-22',
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Lab Equipment Pending Inspection',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Created: ' . count($users) . ' users');
        $this->command->info('Created: ' . count($recordDefinitions) . ' project records');
        $this->command->info('Created: ' . count($materials) . ' materials');
        $this->command->info('Created: ' . count($recordDefinitions) . ' projects');
        $this->command->info('Created: ' . count($invoiceDefinitions) . ' invoices');
        $this->command->info('Created: 15 employees');
    }

    /**
     * @return array{prefix:?string,first_name:?string,last_name:?string,suffix:?string}
     */
    private function splitName(string $name): array
    {
        $trimmed = trim($name);

        if ($trimmed === '') {
            return [
                'prefix' => null,
                'first_name' => null,
                'last_name' => null,
                'suffix' => null,
            ];
        }

        $tokens = array_values(array_filter(preg_split('/\s+/', $trimmed) ?: [], fn ($token) => $token !== ''));

        if (empty($tokens)) {
            return [
                'prefix' => null,
                'first_name' => null,
                'last_name' => null,
                'suffix' => null,
            ];
        }

        $prefixes = [
            'mr', 'mrs', 'ms', 'miss', 'dr', 'engr', 'eng', 'sir', 'madam', 'rev', 'attorney', 'atty', 'eng\'r', 'prof', 'arch', 'architect',
        ];

        $suffixes = [
            'jr', 'sr', 'ii', 'iii', 'iv', 'v', 'phd', 'md', 'dmd', 'pe', 'cpa', 'esq',
        ];

        $prefixTokens = [];
        while (!empty($tokens) && $this->matchesTokenList($tokens[0], $prefixes)) {
            $prefixTokens[] = array_shift($tokens);
        }

        $suffixTokens = [];
        while (!empty($tokens) && $this->matchesTokenList(end($tokens), $suffixes)) {
            array_unshift($suffixTokens, array_pop($tokens));
        }

        $firstName = $tokens[0] ?? null;
        $lastName = null;

        if (count($tokens) > 1) {
            $lastName = implode(' ', array_slice($tokens, 1));
        } elseif (!$firstName && !empty($tokens)) {
            $firstName = implode(' ', $tokens);
        }

        return [
            'prefix' => $this->nullIfEmpty(implode(' ', $prefixTokens)),
            'first_name' => $this->nullIfEmpty($firstName),
            'last_name' => $this->nullIfEmpty($lastName),
            'suffix' => $this->nullIfEmpty(implode(' ', $suffixTokens)),
        ];
    }

    private function matchesTokenList(string $token, array $list): bool
    {
        $normalized = strtolower(trim($token, " \t\n\r\0\x0B.,"));

        return in_array($normalized, $list, true);
    }

    private function nullIfEmpty(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed === '' ? null : $trimmed;
    }

    /**
     * @param  array{prefix:?string,first_name:?string,last_name:?string,suffix:?string}  $parts
     */
    private function composeName(array $parts, string $fallback): string
    {
        $segments = array_filter([
            $parts['prefix'],
            $parts['first_name'],
            $parts['last_name'],
            $parts['suffix'],
        ], fn ($segment) => $segment !== null && $segment !== '');

        $assembled = trim(implode(' ', $segments));

        return $assembled !== '' ? $assembled : $fallback;
    }
}

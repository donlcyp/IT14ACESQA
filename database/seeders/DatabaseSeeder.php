<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectRecord;
use App\Models\Material;
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
        DB::table('project_records')->truncate();
        DB::table('projects')->truncate();
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
            $project = Project::create([
                'project_name' => $definition['title'],
                'client_name' => $definition['client'],
                'status' => 'On Track',
                'lead' => $definition['inspector'],
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
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Paint Storage Room',
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
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Created: ' . count($users) . ' users');
        $this->command->info('Created: ' . count($recordDefinitions) . ' project records');
        $this->command->info('Created: ' . count($materials) . ' materials');
        $this->command->info('Created: ' . count($recordDefinitions) . ' projects');
    }
}

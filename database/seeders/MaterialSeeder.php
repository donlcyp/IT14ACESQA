<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
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
                'name' => 'Concrete Mix',
                'batch' => 'CM-2024-002',
                'supplier' => 'BuildRight Materials',
                'quantity' => 25,
                'unit' => 'tons',
                'price' => 85.00,
                'total' => 2125.00,
                'date_received' => '2024-01-20',
                'date_inspected' => '2024-01-21',
                'status' => 'Pending',
                'location' => 'Storage Yard B',
            ],
            [
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
            [
                'name' => 'PVC Pipes',
                'batch' => 'PP-2024-004',
                'supplier' => 'PlumbMaster Inc',
                'quantity' => 200,
                'unit' => 'pieces',
                'price' => 12.75,
                'total' => 2550.00,
                'date_received' => '2024-01-22',
                'date_inspected' => null,
                'status' => 'Pending',
                'location' => 'Plumbing Storage',
            ],
            [
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
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QaRecord;

class QaRecordSeeder extends Seeder
{
    public function run(): void
    {
        QaRecord::create([
            'title' => 'Assumption School',
            'client' => 'Mrs. Maria Lopez',
            'inspector' => 'Engr. Dela Cruz',
            'time' => '30 mins ago',
            'color' => '#510d0d'
        ]);
        QaRecord::create([
            'title' => 'Dr. A.P Medical Center',
            'client' => 'Dr. Arturo Pingoy',
            'inspector' => 'Engr. Ramirez',
            'time' => '30 mins ago',
            'color' => '#1b59f8'
        ]);
        QaRecord::create([
            'title' => 'First Pacific Inn',
            'client' => 'Mr. Ramon Cruz',
            'inspector' => 'Engr. Flores',
            'time' => '30 mins ago',
            'color' => '#f81bc8'
        ]);
    }
}
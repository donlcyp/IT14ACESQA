<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FinancialData;

class FinancialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = date('Y');
        
        // Sample financial data for the past 12 months
        $financialData = [
            ['month' => 1, 'revenue' => 510000, 'expenses' => 270000], // Jan
            ['month' => 2, 'revenue' => 468000, 'expenses' => 312000], // Feb
            ['month' => 3, 'revenue' => 552000, 'expenses' => 228000], // Mar
            ['month' => 4, 'revenue' => 450000, 'expenses' => 288000], // Apr
            ['month' => 5, 'revenue' => 528000, 'expenses' => 252000], // May
            ['month' => 6, 'revenue' => 492000, 'expenses' => 300000], // Jun
            ['month' => 7, 'revenue' => 540000, 'expenses' => 240000], // Jul
            ['month' => 8, 'revenue' => 480000, 'expenses' => 330000], // Aug
            ['month' => 9, 'revenue' => 570000, 'expenses' => 210000], // Sep
            ['month' => 10, 'revenue' => 462000, 'expenses' => 282000], // Oct
            ['month' => 11, 'revenue' => 510000, 'expenses' => 258000], // Nov
            ['month' => 12, 'revenue' => 528000, 'expenses' => 246000], // Dec
        ];

        foreach ($financialData as $data) {
            FinancialData::updateOrCreate(
                [
                    'year' => $currentYear,
                    'month' => $data['month'],
                ],
                [
                    'revenue' => $data['revenue'],
                    'expenses' => $data['expenses'],
                ]
            );
        }
    }
}

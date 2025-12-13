<?php

namespace Database\Seeders;

use App\Models\EmployeeList;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Disable foreign key constraints temporarily
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing employees and users
        EmployeeList::truncate();
        User::truncate();
        
        // Re-enable foreign key constraints
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Owner user
        $ownerUser = User::create([
            'name' => 'Crisber Beriong',
            'email' => 'owner.crisber@example.com',
            'phone' => '+63 917 123 4567',
            'password' => bcrypt('password123'),
            'role' => 'OWNER'
        ]);

        // Get all users to assign to employees
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->error('No users found! Please run UserRoleSeeder first.');
            return;
        }

        $positions = [
            'Project Manager',
            'Site Supervisor',
            'Finance Manager',
            'HR/Timekeeper',
            'Quality Assurance Officer',
            'Construction Worker'
        ];

        // Define employee count for each position
        $employeeCount = [
            'Project Manager' => 5,
            'Site Supervisor' => 5,
            'Finance Manager' => 5,
            'HR/Timekeeper' => 5,
            'Quality Assurance Officer' => 5,
            'Construction Worker' => 20
        ];

        $employeeCounter = 1;

        foreach ($positions as $position) {
            $count = $employeeCount[$position];
            
            // Determine role based on position
            $role = match($position) {
                'Project Manager' => 'PM',
                'HR/Timekeeper' => 'HR',
                'Finance Manager' => 'FM',
                'Quality Assurance Officer' => 'QA',
                'Site Supervisor' => 'SS',
                'Construction Worker' => 'CW',
                default => 'CW'
            };
            
            for ($i = 1; $i <= $count; $i++) {
                // Create a new user for each employee
                // Sanitize position name: remove spaces and special characters (/, -, etc.) for email
                $sanitizedPosition = strtolower(str_replace(['/', '-', ' '], '', $position));
                $email = $sanitizedPosition . $employeeCounter . '@example.com';
                
                // Generate Philippine mobile number format
                $phoneNumber = '+63 9' . str_pad(rand(10, 99), 2, '0', STR_PAD_LEFT) . ' ' 
                             . str_pad(rand(100, 999), 3, '0', STR_PAD_LEFT) . ' ' 
                             . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
                
                // Create user
                $user = User::create([
                    'name' => $faker->firstName() . ' ' . $faker->lastName(),
                    'email' => $email,
                    'phone' => $phoneNumber,
                    'password' => bcrypt('password123'),
                    'role' => $role,
                    'user_position' => $position,
                ]);
                
                // Extract first and last name from the generated full name
                $nameParts = explode(' ', $user->name, 2);
                $firstName = $nameParts[0] ?? $user->name;
                $lastName = isset($nameParts[1]) ? $nameParts[1] : $faker->lastName();
                
                // Create employee record
                EmployeeList::create([
                    'user_id' => $user->id,
                    'f_name' => $firstName,
                    'l_name' => $lastName,
                    'position' => $position,
                ]);
                
                $employeeCounter++;
            }
            
            $this->command->info("Created {$count} {$position} employees (Role: {$role})");
        }

        $this->command->info('');
        $this->command->info('Employee Seeder completed successfully!');
        $this->command->info('');
        $this->command->info('Summary:');
        $this->command->info('1 x Owner (Crisber Beriong)');
        $this->command->info('5 x Project Manager');
        $this->command->info('5 x Site Supervisor');
        $this->command->info('5 x Finance Manager');
        $this->command->info('5 x HR/Timekeeper');
        $this->command->info('5 x Quality Assurance Officer');
        $this->command->info('20 x Construction Worker');
        $this->command->info('');
        $this->command->info('Total: 46 employees created');
    }
}

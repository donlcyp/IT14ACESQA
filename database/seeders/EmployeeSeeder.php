<?php

namespace Database\Seeders;

use App\Models\Employee;
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
        
        // Clear existing employees
        Employee::truncate();
        
        // Re-enable foreign key constraints
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Owner user
        $ownerUser = User::create([
            'name' => 'Crisber Beriong',
            'email' => 'owner.crisber@example.com',
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
                'Finance Manager' => 'USER',
                'Quality Assurance Officer' => 'USER',
                'Site Supervisor' => 'USER',
                'Construction Worker' => 'USER',
                default => 'USER'
            };
            
            for ($i = 1; $i <= $count; $i++) {
                // Create a new user for each employee
                $email = strtolower(str_replace(' ', '', $position)) . $employeeCounter . '@example.com';
                $user = User::create([
                    'name' => $faker->firstName() . ' ' . $faker->lastName(),
                    'email' => $email,
                    'password' => bcrypt('password123'),
                    'role' => $role
                ]);
                
                Employee::create([
                    'user_id' => $user->id,
                    'f_name' => $user->name,
                    'l_name' => $faker->lastName(),
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

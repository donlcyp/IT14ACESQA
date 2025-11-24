<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'position' => 'Project Manager',
                'email' => 'juan.delacruz@ajjcrisber.com',
                'phone' => '+63 912 345 6789',
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'position' => 'Senior Engineer',
                'email' => 'maria.santos@ajjcrisber.com',
                'phone' => '+63 912 345 6790',
            ],
            [
                'first_name' => 'Carlos',
                'last_name' => 'Ramos',
                'position' => 'Civil Engineer',
                'email' => 'carlos.ramos@ajjcrisber.com',
                'phone' => '+63 912 345 6791',
            ],
            [
                'first_name' => 'Ana',
                'last_name' => 'Lozada',
                'position' => 'Structural Engineer',
                'email' => 'ana.lozada@ajjcrisber.com',
                'phone' => '+63 912 345 6792',
            ],
            [
                'first_name' => 'Roberto',
                'last_name' => 'Garcia',
                'position' => 'Electrical Engineer',
                'email' => 'roberto.garcia@ajjcrisber.com',
                'phone' => '+63 912 345 6793',
            ],
            [
                'first_name' => 'Patricia',
                'last_name' => 'Lim',
                'position' => 'Quality Assurance Inspector',
                'email' => 'patricia.lim@ajjcrisber.com',
                'phone' => '+63 912 345 6794',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Tan',
                'position' => 'Site Supervisor',
                'email' => 'michael.tan@ajjcrisber.com',
                'phone' => '+63 912 345 6795',
            ],
            [
                'first_name' => 'Jennifer',
                'last_name' => 'Cruz',
                'position' => 'Architect',
                'email' => 'jennifer.cruz@ajjcrisber.com',
                'phone' => '+63 912 345 6796',
            ],
            [
                'first_name' => 'Daniel',
                'last_name' => 'Villanueva',
                'position' => 'Mechanical Engineer',
                'email' => 'daniel.villanueva@ajjcrisber.com',
                'phone' => '+63 912 345 6797',
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Mendoza',
                'position' => 'Safety Officer',
                'email' => 'lisa.mendoza@ajjcrisber.com',
                'phone' => '+63 912 345 6798',
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Torres',
                'position' => 'Surveyor',
                'email' => 'james.torres@ajjcrisber.com',
                'phone' => '+63 912 345 6799',
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Fernandez',
                'position' => 'Draftsman',
                'email' => 'sarah.fernandez@ajjcrisber.com',
                'phone' => '+63 912 345 6800',
            ],
            [
                'first_name' => 'Mark',
                'last_name' => 'Alvarez',
                'position' => 'Construction Manager',
                'email' => 'mark.alvarez@ajjcrisber.com',
                'phone' => '+63 912 345 6801',
            ],
            [
                'first_name' => 'Grace',
                'last_name' => 'Reyes',
                'position' => 'Environmental Engineer',
                'email' => 'grace.reyes@ajjcrisber.com',
                'phone' => '+63 912 345 6802',
            ],
            [
                'first_name' => 'Paul',
                'last_name' => 'Morales',
                'position' => 'Project Coordinator',
                'email' => 'paul.morales@ajjcrisber.com',
                'phone' => '+63 912 345 6803',
            ],
        ];

        foreach ($employees as $empData) {
            // Create or find user
            $user = User::firstOrCreate(
                ['email' => $empData['email']],
                [
                    'name' => $empData['first_name'] . ' ' . $empData['last_name'],
                    'password' => Hash::make('password'),
                    'role' => 'USER',
                    'user_position' => $empData['position'],
                    'status' => 'Active',
                ]
            );

            // Create or find employee linked to user
            Employee::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'f_name' => $empData['first_name'],
                    'l_name' => $empData['last_name'],
                    'position' => $empData['position'],
                ]
            );
        }
    }
}

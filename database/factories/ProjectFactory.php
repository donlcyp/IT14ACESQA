<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $clientFirst = $this->faker->firstName();
        $clientLast = $this->faker->lastName();

        $leadPrefix = $this->faker->optional(0.3)->randomElement(['Engr.', 'Arch.', 'Dr.', 'Mr.', 'Ms.']);
        $leadFirst = $this->faker->firstName();
        $leadLast = $this->faker->lastName();
        $leadSuffix = $this->faker->optional(0.2)->randomElement(['PE', 'PhD', 'Jr.', 'Sr.']);

        return [
            'project_name' => $this->faker->sentence(3),
            'client_first_name' => $clientFirst,
            'client_last_name' => $clientLast,
            'client_name' => trim(implode(' ', array_filter([$clientFirst, $clientLast]))),
            'status' => $this->faker->randomElement(['Ongoing', 'In Review', 'Mobilizing', 'On Hold', 'Completed']),
            'lead_prefix' => $leadPrefix,
            'lead_first_name' => $leadFirst,
            'lead_last_name' => $leadLast,
            'lead_suffix' => $leadSuffix,
            'lead' => trim(implode(' ', array_filter([$leadPrefix, $leadFirst, $leadLast, $leadSuffix]))),
        ];
    }
}


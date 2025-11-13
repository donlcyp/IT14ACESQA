<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'project_name' => $this->faker->sentence(3),
            'client_name' => $this->faker->company(),
            'status' => $this->faker->randomElement(['On Track', 'In Review', 'Mobilizing', 'On Hold', 'Completed']),
            'lead' => $this->faker->name(),
        ];
    }
}


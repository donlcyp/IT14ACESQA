<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectRecordFactory extends Factory
{
    protected $model = ProjectRecord::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence(3),
            'client' => $this->faker->company(),
            'inspector' => $this->faker->name(),
            'time' => $this->faker->time('H:i'),
            'color' => $this->faker->hexColor(),
        ];
    }
}

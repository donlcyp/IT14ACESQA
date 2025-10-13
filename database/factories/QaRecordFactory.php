<?php

namespace Database\Factories;

use App\Models\QaRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class QaRecordFactory extends Factory
{
    protected $model = QaRecord::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'client' => $this->faker->company(),
            'inspector' => $this->faker->name(),
            'time' => $this->faker->time('H:i'),
            'color' => $this->faker->hexColor(),
        ];
    }
}

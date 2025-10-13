<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\QaRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 1000);
        $price = $this->faker->randomFloat(2, 1, 1000);
        $total = $quantity * $price;

        return [
            'qa_record_id' => QaRecord::factory(),
            'name' => $this->faker->word(),
            'batch' => $this->faker->optional()->word(),
            'supplier' => $this->faker->optional()->company(),
            'quantity' => $quantity,
            'unit' => $this->faker->randomElement(['kg', 'pcs', 'm', 'L', 'box']),
            'price' => $price,
            'total' => $total,
            'date_received' => $this->faker->optional()->date(),
            'date_inspected' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Fail']),
            'location' => $this->faker->optional()->word(),
        ];
    }
}

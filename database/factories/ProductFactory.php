<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'version_id' => Version::get('id')->random()->id,
            'type_id' => Type::get('id')->random()->id,
            'label' => $this->faker->unique()->word,
            'weight' => $this->faker->randomFloat(),
        ];
    }
}

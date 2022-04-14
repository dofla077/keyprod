<?php

namespace Database\Factories;

use App\Enums\OrderState;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numerify('###-#######-#######'),
            'state' => OrderState::Draft->value,
        ];
    }
}

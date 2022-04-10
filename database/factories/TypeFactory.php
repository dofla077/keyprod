<?php

namespace Database\Factories;

use App\Enums\TypeLabel;
use App\Models\Type;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $label = null;
        foreach (TypeLabel::cases() as $typeLabel) {
            if (!Type::whereLabel($typeLabel->value)->first()) {
                $label = $typeLabel->value;
                break;
            }
        }
        abort_unless($label, 403, "You can't create more Type");

        return ['label' => $label];
    }
}

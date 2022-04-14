<?php

namespace Database\Seeders;

use App\Enums\TypeLabel;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Type::count()) {
            foreach (TypeLabel::cases() as $typeLabel) {
                Type::factory()->create(["label" => $typeLabel->value]);
            }
        }
    }
}

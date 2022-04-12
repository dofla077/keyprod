<?php

namespace Database\Seeders;

use App\Enums\VersionLabel;
use App\Models\Version;
use Illuminate\Database\Seeder;

class VersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Version::count()) {
            foreach (VersionLabel::cases() as $versionLabel) {
                Version::factory()->create(["label" => $versionLabel->value]);
            }
        }
    }
}

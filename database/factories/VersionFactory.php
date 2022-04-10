<?php

namespace Database\Factories;

use App\Enums\VersionLabel;
use App\Models\Version;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Version>
 */
class VersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $label = null;
        foreach (VersionLabel::cases() as $versionLabel) {
            if (!Version::whereLabel($versionLabel->value)->first()) {
                $label = $versionLabel->value;
                break;
            }
        }
        abort_unless($label, 403, "You can't create more Version");

        return ['label' => $label];
    }
}

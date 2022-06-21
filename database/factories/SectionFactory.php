<?php

namespace Database\Factories;

use App\Models\Geofence;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->streetName;
        return [
            'questionnaire_id' => Questionnaire::factory(),
            'geofence_id' => Geofence::factory(),
            'title' => $name,
            'description' => $this->faker->paragraph(),
            'location_description' => $this->faker->address,
        ];
    }
}

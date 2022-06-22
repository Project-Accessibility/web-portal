<?php

namespace Database\Factories;

use App\Models\Research;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questionnaire>
 */
class QuestionnaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'research_id' => Research::factory(),
            'title' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'instructions' => $this->faker->paragraph(),
            'help' => $this->faker->paragraph(),
            'open' => $this->faker->boolean,
        ];
    }
}

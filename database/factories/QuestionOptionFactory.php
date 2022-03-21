<?php

namespace Database\Factories;

use App\Enums\QuestionOptionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionOption>
 */
class QuestionOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = QuestionOptionType::cases();
        return [
            'type' => $types[$this->faker->numberBetween(0, count($types)-1)],
            'extra_data' => (object)[]
        ];
    }
}

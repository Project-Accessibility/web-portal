<?php

namespace Database\Factories;

use App\Enums\QuestionOptionType;
use App\Models\Question;
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
        $type = $types[$this->faker->numberBetween(0, count($types) - 1)];
        return [
            'question_id' => Question::factory(),
            'type' => $type,
            'extra_data' => [],
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Participant;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'participant_id' => Participant::factory(),
            'question_option_id' => QuestionOption::factory(),
            'values' => json_encode([]),
        ];
    }
}

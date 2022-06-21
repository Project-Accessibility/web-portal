<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use App\Utils\UniqueRandomParticipantCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'questionnaire_id' => Questionnaire::factory(),
            'code' => (new UniqueRandomParticipantCode())->generate(),
        ];
    }
}

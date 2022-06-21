<?php

namespace Database\Seeders;

use App\Enums\QuestionOptionType;
use App\Models\Answer;
use App\Models\Geofence;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Research;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'info@accessibility.nl',
            'password' => Hash::make('admin'),
        ]);

        $this->createDemoData();
    }

    private function createDemoData()
    {
        $this->createNemoResearch();

        // More demo data can be added here.
    }

    private function createNemoResearch()
    {
        $research = Research::factory()->create([
            'title' => 'NEMO onderzoek',
            'description' =>
                'Dit is onderzoek is in samenwerking met NEMO om te kijken naar de toegankelijkheid vanaf de website tot en met het bezoek.',
        ]);

        $this->createNemoQuestionnaire($research);
    }

    private function createNemoQuestionnaire(Research $research)
    {
        $questionnaire = Questionnaire::factory()->create([
            'research_id' => $research->id,
            'title' => 'Vragenlijst toegankelijkheid',
            'description' => 'De algemene vragenlijst.',
        ]);

        $this->createNemoSections($questionnaire);
    }

    private function createNemoSections(Questionnaire $questionnaire)
    {
        $entrance_section = Section::factory()->create([
            'questionnaire_id' => $questionnaire->id,
            'title' => 'Entree',
            'description' =>
                'Benoem zowel je positieve als negatieve ervaringen.',
            'location_description' =>
                'Dit is het gedeelte waar je NEMO binnen komt.',
        ]);

        $information_section = Section::factory()->create([
            'questionnaire_id' => $questionnaire->id,
            'title' => 'Kassa/infobalie',
            'description' =>
                'Benoem zowel je positieve als negatieve ervaringen.',
            'location_description' =>
                'Hier kan je meer informatie vragen en kaartjes kopen.',
        ]);

        $participant = $this->createNemoParticipant($questionnaire);
        $this->createNemoParticipant($questionnaire);
        $this->createNemoEntranceQuestions($entrance_section, $participant);
    }

    private function createNemoEntranceQuestions(
        Section $section,
        Participant $participant,
    ) {
        $questionOne = Question::factory()->create([
            'section_id' => $section->id,
            'title' => 'Route',
            'question' => 'Hoe is de route naar NEMO toe?',
        ]);

        $questionOneOptions = $this->createQuestionOptions($questionOne);

        $questionOneOptionOne = $questionOneOptions[0];
        $questionOneOptionFour = $questionOneOptions[4];

        $questionTwo = Question::factory()->create([
            'section_id' => $section->id,
            'title' => 'Obstakels',
            'question' => 'Hoe kom je binnen? Zijn hierbij obstakels?',
        ]);

        $this->createNemoAnswerOpen($questionOneOptionOne, $participant);
        $this->createNemoAnswerMultipleChoice(
            $questionOneOptionFour,
            $participant,
        );
    }

    private function createQuestionOptions($question)
    {
        return [
            QuestionOption::factory()->create([
                'question_id' => $question->id,
                'type' => QuestionOptionType::OPEN,
                'extra_data' => [
                    'placeholder' => 'Placeholder question',
                ],
            ]),
            QuestionOption::factory()->create([
                'question_id' => $question->id,
                'type' => QuestionOptionType::IMAGE,
                'extra_data' => [],
            ]),
            QuestionOption::factory()->create([
                'question_id' => $question->id,
                'type' => QuestionOptionType::VIDEO,
                'extra_data' => [],
            ]),
            QuestionOption::factory()->create([
                'question_id' => $question->id,
                'type' => QuestionOptionType::VOICE,
                'extra_data' => [],
            ]),
            QuestionOption::factory()->create([
                'question_id' => $question->id,
                'type' => QuestionOptionType::MULTIPLE_CHOICE,
                'extra_data' => [
                    'multiple' => true,
                    'values' => ['Waarde 1', 'Waarde 2', 'Waarde 3'],
                ],
            ]),
        ];
    }

    private function createNemoParticipant(Questionnaire $questionnaire)
    {
        return Participant::factory()->create([
            'questionnaire_id' => $questionnaire->id,
        ]);
    }

    private function createNemoAnswerOpen(
        QuestionOption $questionOption,
        Participant $participant,
    ) {
        Answer::factory()->create([
            'participant_id' => $participant->id,
            'question_option_id' => $questionOption->id,
            'values' => [
                'De route was erg prettig, de paden waren breed genoeg en de ingang stond duidelijk aangegeven.',
            ],
        ]);
    }

    private function createNemoAnswerMultipleChoice(
        QuestionOption $questionOption,
        Participant $participant,
    ) {
        Answer::factory()->create([
            'participant_id' => $participant->id,
            'question_option_id' => $questionOption->id,
            'values' => ['Waarde 1', 'Waarde 2'],
        ]);
    }
}

<?php

namespace Database\Seeders;

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
            'password' =>
                '$2y$10$.hq3lePFqgfTr5UBK1kOmecCm2rnC7SAosaVAxQ9qm5OHk/Rmf72e',
        ]);

        $this->createQuestionnaires();
    }

    private function createQuestionnaires()
    {
        Questionnaire::factory(1)
            ->create(['open' => true])
            ->each(function (Questionnaire $questionnaire) {
                $participant = Participant::factory()->create([
                    'questionnaire_id' => $questionnaire->id,
                ]);

                $this->createSections($questionnaire, $participant);
            });
    }

    private function createSections(
        Questionnaire $questionnaire,
        Participant $participant,
    ) {
        Section::factory(6)
            ->create(['questionnaire_id' => $questionnaire->id])
            ->each(function (Section $section) use ($participant) {
                $this->createQuestions($section, $participant);
            });
    }

    private function createQuestions(Section $section, Participant $participant)
    {
        Question::factory(6)
            ->create(['section_id' => $section->id])
            ->each(function (Question $question) use ($participant) {
                $this->createQuestionOptions($question, $participant);
            });
    }

    private function createQuestionOptions(
        Question $question,
        Participant $participant,
    ) {
        QuestionOption::factory(6)
            ->create(['question_id' => $question->id])
            ->each(function (QuestionOption $option) use ($participant) {
                $this->createAnswers($option, $participant);
            });
    }

    private function createAnswers(
        QuestionOption $questionOption,
        Participant $participant,
    ) {
        Answer::factory(6)->create([
            'participant_id' => $participant->id,
            'question_option_id' => $questionOption->id,
        ]);
    }
}

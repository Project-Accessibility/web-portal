<?php

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetQuestionnaireRequest;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Section;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class QuestionnaireController extends Controller
{
    public function get(GetQuestionnaireRequest $request, string $code): ?Model
    {
        $request->validated();
        $participant = Participant::whereCode($code)
            ->whereFinished(false)
            ->first();

        $questionnaire = tap($participant->questionnaire, function (
            Questionnaire $questionnaire,
        ) use ($participant) {
            $questionnaire->sections = $questionnaire->sections->map(function (
                Section $section,
            ) use ($participant) {
                $section->questions = $this->getCorrectQuestionForParticipant(
                    $section->questions,
                    $participant->id,
                );
                $section->unsetRelation('questions');

                return $section;
            });
            $questionnaire->unsetRelation('sections');

            return $questionnaire;
        });

        return $questionnaire;
    }

    private function getCorrectQuestionForParticipant(
        Collection $questions,
        string $participantId,
    ): Collection {
        return $questions
            ->groupBy('uuid')
            ->map(function (Collection $questions) use ($participantId) {
                $options = $questions->pluck('options.*.id')->flatten();
                $answer = Answer::whereParticipantId($participantId)
                    ->whereIn('question_option_id', $options)
                    ->first();

                if ($answer) {
                    $question = $questions
                        ->where('id', $answer->option->question_id)
                        ->first();

                    $question->options->map(function (
                        QuestionOption $option,
                    ) use ($participantId) {
                        $option->answer = $option->answers
                            ->where('participant_id', $participantId)
                            ->first();

                        $option->unsetRelation('answers');
                    });
                } else {
                    $question = $questions->sortByDesc('version')->first();
                    $question->options->map(function (QuestionOption $option) {
                        $option->answer = null;

                        $option->unsetRelation('answers');
                    });
                }

                return $question;
            })
            ->flatten();
    }

    public function submit($code): JsonResponse
    {
        $participant = Participant::whereCode($code)
            ->whereFinished(false)
            ->firstOrFail();

        $participant->finished = true;
        $participant->save();

        return response()->json([
            'message' => 'Participant finished!',
        ]);
    }
}

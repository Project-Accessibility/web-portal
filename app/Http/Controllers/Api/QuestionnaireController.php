<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetQuestionnaireRequest;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Section;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function abort_if;

class QuestionnaireController extends Controller
{
    public function get(GetQuestionnaireRequest $request, string $code): ?Model
    {
        $request->validated();
        $participant = Participant::whereCode($code)
            ->whereFinished(false)
            ->first();

        $participant->questionnaire->sections->map(function (
            Section $section,
        ) use ($participant) {
            $section->questions = $section->questions
                ->groupBy('uuid')
                ->map(function (Collection $questions) use ($participant) {
                    $options = $questions->pluck('options.*.id')->flatten();
                    $answer = Answer::whereParticipantId($participant->id)
                        ->whereIn('question_option_id', $options)
                        ->first();

                    if ($answer) {
                        $question = $questions
                            ->where('id', $answer->option->question_id)
                            ->first();
                        $question->options->map(function (
                            QuestionOption $option,
                        ) use ($participant) {
                            $option->answer = $option->answers
                                ->where('participant_id', $participant->id)
                                ->where('question_option_id', $option->id)
                                ->first();

                            $option->unsetRelation('answers');
                        });
                    } else {
                        $question = $questions->sortByDesc('version')->first();
                        $question->options->map(function (
                            QuestionOption $option,
                        ) use ($participant) {
                            $option->answer = null;

                            $option->unsetRelation('answers');
                        });
                    }

                    return $question;
                })
                ->values();

            $section->unsetRelation('questions');

            return $section;
        });

        return $participant->questionnaire;
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function abort_if;

class QuestionnaireController extends Controller
{
    public function getByUserCodes(Request $request): Collection
    {
        $codes = $request->get('codes');
        abort_if(
            !$codes,
            Response::HTTP_NOT_ACCEPTABLE,
            'Er zijn geen codes meegegeven.',
        );

        if (gettype($codes) === 'string') {
            $codes = [$codes];
        }

        return Questionnaire::where('open', true)
            ->whereHas('participants', function (Builder $participant) use (
                $codes,
            ) {
                $participant->whereIn('code', $codes);
            })
            ->get();
    }

    public function get(string $code): ?Model
    {
        $questionnaire = Questionnaire::where('open', true)
            ->whereHas('participants', function (Builder $participant) use (
                $code,
            ) {
                $participant->whereCode($code);
            })
            ->firstOrFail();

        $questionnaire->sections = $this->getSections($code, $questionnaire);

        return $questionnaire;
    }

    public function getSections(
        string $code,
        Questionnaire $questionnaire,
    ): Collection {
        $participantAnswersQuestionsIds = Participant::where('code', $code)
            ->first()
            ->answers->map(function (Answer $answer) {
                return $answer->option()->question->id;
            })
            ->unique()
            ->toArray();

        return $questionnaire->sections->map(function (Section $section) use (
            $participantAnswersQuestionsIds,
        ) {
            $section->questions = $section->questions
                ->groupBy('uuid')
                ->map(function (Collection $questions) use (
                    $participantAnswersQuestionsIds,
                ) {
                    $questionIds = $questions->pluck('id')->toArray();

                    $arrayIntersect = array_intersect(
                        $questionIds,
                        $participantAnswersQuestionsIds,
                    );

                    if (count($arrayIntersect) === 1) {
                        return $questions->where('id', $arrayIntersect[0]);
                    } else {
                        return Question::whereUuid($questions->first()->uuid)
                            ->orderBy('version', 'DESC')
                            ->first();
                    }
                })
                ->flatten();

            return $section;
        });
    }

    public function submit(Questionnaire $questionnaire): Model
    {
        abort(Response::HTTP_NOT_IMPLEMENTED, 'Deze functie werkt nog niet.');
    }
}

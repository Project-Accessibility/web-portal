<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    public function get(int $question, string $code): Model
    {
        return Question::with([
            'options.answers' => function (HasMany $answers) use ($code) {
                $answers->whereHas('participant', function (
                    Builder $participant,
                ) use ($code) {
                    $participant->where('code', $code);
                });
            },
        ])->findOrFail($question);
    }

    public function answer(Question $question, string $code): Model
    {
        abort(Response::HTTP_NOT_IMPLEMENTED, 'Deze functie werkt nog niet');
    }
}

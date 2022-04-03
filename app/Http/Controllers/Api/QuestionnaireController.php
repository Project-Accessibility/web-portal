<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

        if (gettype($codes) === 'string' || gettype($codes) === 'integer') {
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
        return Questionnaire::with(['sections.questions.options'])
            ->where('open', true)
            ->whereHas('participants', function (Builder $participant) use (
                $code,
            ) {
                $participant->whereCode($code);
            })
            ->firstOrFail();
    }
}

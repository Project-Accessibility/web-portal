<?php

namespace App\Http\Controllers;

use App\Casts\DisplayDateTime;
use App\Models\Participant;
use App\Models\Questionnaire;
use App\Models\Research;
use App\Utils\UniqueRandomParticipantCode;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ParticipantController extends Controller
{
    public function overview(Research $research, Questionnaire $questionnaire)
    {
        return redirect()->route('questionnaires.details', [
            $research->id,
            $questionnaire->id,
            'tab' => 'Participanten',
        ]);
    }

    public function store(
        Research $research,
        Questionnaire $questionnaire,
    ): Application|RedirectResponse|Redirector {
        $code = (new UniqueRandomParticipantCode())->generate();

        $questionnaire->participants()->create([
            'code' => $code,
        ]);

        return back()->with('success', 'De participant is aangemaakt!');
    }

    public function details(
        Research $research,
        Questionnaire $questionnaire,
        Participant $participant,
    ): View {
        $participant->load([
            'answers' => function (Relation $query) {
                $query->withCasts([
                    'updated_at' => DisplayDateTime::class,
                ]);
            },
            'answers.questionOption.question.section',
        ]);

        return view(
            'admin.participant.details',
            compact('research', 'questionnaire', 'participant'),
        );
    }

    public function remove(
        Research $research,
        Questionnaire $questionnaire,
        Participant $participant,
    ): Application|RedirectResponse|Redirector {
        $participant->delete();

        return redirect(
            route('questionnaires.details', [
                $research->id,
                $questionnaire->id,
                'tab' => 'Participanten',
            ]),
        )->with('success', 'De participant is verwijderd!');
    }

    public function archive(Research $research, Questionnaire $questionnaire)
    {
    }

    public function archives()
    {
    }

    public function restore(Research $research, Questionnaire $questionnaire)
    {
    }

    public function deletes(Research $research)
    {
    }
}

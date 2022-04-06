<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Models\Questionnaire;
use App\Models\Research;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\Console\Input\Input;

class QuestionnaireController extends Controller
{
    public function create(int $researchId): View
    {
        return view('admin.questionnaire.create', compact('researchId'));
    }

    public function store(
        StoreQuestionnaireRequest $request,
        Research $research,
    ): Application|RedirectResponse|Redirector {
        $request->validated();

        $research->questionnaires()->create($request->all());

        return redirect(
            route('researches.questionnaires', $research->id),
        )->with('success', 'De vragenlijst is aangemaakt!');
    }

    public function edit(Research $research, Questionnaire $questionnaire): View
    {
        return view(
            'admin.questionnaire.edit',
            compact('questionnaire', 'research'),
        );
    }

    public function update(
        StoreQuestionnaireRequest $request,
        Research $research,
        Questionnaire $questionnaire,
    ): RedirectResponse {
        $request->validated();

        $questionnaire->update($request->all());

        return redirect()
            ->route('questionnaires.details', [
                'research' => $research->id,
                'questionnaire' => $questionnaire->id,
                'tab' => 'Details',
            ])
            ->with('success', 'De vragenlijst is aangepast!');
    }

    public function details(
        Request $request,
        Research $research,
        Questionnaire $questionnaire,
    ): View {
        return view(
            'admin.questionnaire.details',
            compact('research', 'questionnaire'),
        );
    }

    public function remove(
        Research $research,
        Questionnaire $questionnaire,
    ): Application|RedirectResponse|Redirector {
        $questionnaire->delete();

        return redirect(
            route('researches.details', [
                $research->id,
                $questionnaire->id,
                'tab' => 'Vragenlijsten',
            ]),
        )->with('success', 'De vragenlijst is verwijderd!');
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

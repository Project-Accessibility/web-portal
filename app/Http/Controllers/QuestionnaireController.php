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
    public function overview(): View
    {
        $researches = Questionnaire::all()->toArray();

        return view('admin.research.overview', [
            'researches' => $researches,
        ]);
    }

    public function create(int $researchId): View
    {
        return view('admin.questionnaire.create', compact('researchId'));
    }

    public function store(
        StoreQuestionnaireRequest $request,
        int $researchId,
    ): Application|RedirectResponse|Redirector {
        $request->validated();

        $research = Research::findOrFail($researchId);
        $research->questionnaires()->create($request->all());

        return redirect(route('researches.questionnaires', $researchId))->with(
            'success',
            'De vragenlijst is aangemaakt!',
        );
    }

    public function edit(int $researchId, Questionnaire $questionnaire): View
    {
        return view(
            'admin.questionnaire.edit',
            compact('questionnaire', 'researchId'),
        );
    }

    public function update(
        StoreQuestionnaireRequest $request,
        int $researchId,
        Questionnaire $questionnaire,
    ): RedirectResponse {
        $request->validated();

        $questionnaire->update($request->all());

        return redirect()
            ->route('questionnaires.details', [
                'research' => $researchId,
                'questionnaire' => $questionnaire->id,
                'tab' => 'Details',
            ])
            ->with('success', 'De vragenlijst is aangepast!');
    }

    public function details(
        Request $request,
        int $researchId,
        Questionnaire $questionnaire,
    ): View {
        return view('admin.questionnaire.details', compact('questionnaire'));
    }

    public function remove(
        int $researchId,
        Questionnaire $questionnaire,
    ): Application|RedirectResponse|Redirector {
        $questionnaire->delete();

        return redirect(
            route('researches.questionnaires', [$researchId, $questionnaire]),
        )->with('success', 'De vraag is verwijderd!');
    }

    public function archive(Research $research)
    {
    }

    public function archives()
    {
    }

    public function restore(Research $research)
    {
    }

    public function deletes()
    {
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResearchRequest;
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
        return view('admin.questionnaire.create');
    }

    public function store(
        StoreResearchRequest $request,
    ): Application|RedirectResponse|Redirector {
        $request->validated();
        Research::create($request->all());

        return redirect(route('researches'))->with(
            'success',
            'Het onderzoek is aangemaakt!',
        );
    }

    public function edit(Research $research): View
    {
        return view('admin.research.edit', [
            'research' => $research,
        ]);
    }

    public function update(
        StoreResearchRequest $request,
        Research $research,
    ): RedirectResponse {
        $request->validated();
        $research->update($request->all());

        return redirect(
            route('researches.details', [
                'research' => $research,
                'tab' => 'Details',
            ]),
        )->with('success', 'Het onderzoek is aangepast!');
    }

    public function details(Request $request, int $researchId, Questionnaire $questionnaire): View
    {
        return view('admin.questionnaire.details', compact(
            'questionnaire'
        ));
    }

    public function remove(
        Research $research,
    ): Application|RedirectResponse|Redirector {
        $research->delete();

        return redirect(route('researches'))->with(
            'success',
            'Het onderzoek is verwijderd!',
        );
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Models\Questionnaire;
use App\Models\Research;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class SectionController extends Controller
{
    public function overview(Research $research, Questionnaire $questionnaire): RedirectResponse
    {
        return redirect()->route('questionnaires.details', [
            $research->id,
            $questionnaire->id,
            'tab' => 'Onderdelen',
        ]);
    }

    public function create(Research $research, Questionnaire $questionnaire): View
    {
        return view('admin.section.create', [
            "research" => $research,
            "questionnaire" => $questionnaire
        ]);
    }

    public function store(
        StoreQuestionnaireRequest $request,
        Research $research,
        Questionnaire $questionnaire,
    ): Application|RedirectResponse|Redirector {
        $request->validated();

        $questionnaire->sections()->create($request->all());

        return redirect(route('questionnaires.sections', [$research->id, $questionnaire->id]))->with(
            'success',
            'Het onderdeel is aangemaakt!',
        );
    }

    public function edit(Questionnaire $questionnaire, Section $section): View
    {
        return view(
            'admin.section.edit',
            compact('section', 'questionnaire'),
        );
    }

    public function update(
        StoreQuestionnaireRequest $request,
        Questionnaire $questionnaire,
        Section $section
    ): RedirectResponse {
        $request->validated();

        $section->update($request->all());

        return redirect()
            ->route('sections.details', [
                'questionnaire' => $questionnaire,
                'section' => $section,
                'tab' => 'Details',
            ])
            ->with('success', 'Het onderdeel is aangepast!');
    }

    public function details(
        Request $request,
        Section $section,
    ): View {
        return view('admin.sections.details', compact('section'));
    }

    public function remove(
        Questionnaire $questionnaire,
        Section $section,
    ): Application|RedirectResponse|Redirector {
        $section->delete();

        return redirect(
            route('questionnaires.sections', [$questionnaire, $section]),
        )->with('success', 'De vraag is verwijderd!');
    }

    public function archive(Section $section)
    {
    }

    public function archives()
    {
    }

    public function restore(Section $section)
    {
    }

    public function deletes()
    {
    }
}

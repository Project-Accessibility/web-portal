<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Models\Questionnaire;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SectionController extends Controller
{
    public function overview(): View
    {
        $sections = Section::all()->toArray();

        return view('admin.questionnaire.details', [
            'sections' => $sections,
            'tab' => "Onderdelen"
        ]);
    }

    public function create(Questionnaire $questionnaire): View
    {
        return view('admin.section.create', compact($questionnaire));
    }

    public function store(
        StoreQuestionnaireRequest $request,
        Questionnaire $questionnaire,
    ): Application|RedirectResponse|Redirector {
        $request->validated();

        $questionnaire->sections()->create($request->all());

        return redirect(route('questionnaires.sections', $questionnaire))->with(
            'success',
            'De vragenlijst is aangemaakt!',
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

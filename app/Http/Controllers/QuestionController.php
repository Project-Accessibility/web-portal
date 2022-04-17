<?php

namespace App\Http\Controllers;

use App\Enums\QuestionOptionType;
use App\Http\Requests\StoreQuestionnaireRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Research;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class QuestionController extends Controller
{
    public function overview(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): RedirectResponse {
        return redirect()->route('sections.details', [
            $research->id,
            $questionnaire->id,
            $section->id,
            'tab' => 'Vragen',
        ]);
    }

    public function create(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): View {
        return view('admin.question.create', [
            'research' => $research,
            'questionnaire' => $questionnaire,
            'section' => $section,
        ]);
    }

    public function store(
        StoreQuestionRequest $request,
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): Application|RedirectResponse|Redirector {
        $request->validated();
        $data = $request->all();

        $question = $section->questions()->create($data);
        $this->storeOptions($question, $data);

        return redirect()
            ->route('sections.details', [
                $research->id,
                $questionnaire->id,
                $section->id,
                'tab' => 'Vragen',
            ])
            ->with('success', 'De vraag is aangemaakt!');
    }

    private function storeOptions($question, $data)
    {
        if ($data['open']) {
            $question->options()->create([
                'type' => QuestionOptionType::OPEN,
                'extra_data' => [
                    'placeholder' => $data['openPlaceholder']
                ],
            ]);
        }
        if ($data['multipleChoice'] && isset($data['list'])) {
            $question->options()->create([
                'type' => QuestionOptionType::MULTIPLE_CHOICE,
                'extra_data' => [
                    'multiple' => $data['multipleAnswers'],
                    'values' => $data['list'],
                ],
            ]);
        }
        if ($data['photo']) {
            $question->options()->create([
                'type' => QuestionOptionType::IMAGE,
                'extra_data' => [],
            ]);
        }
        if ($data['audio']) {
            $question->options()->create([
                'type' => QuestionOptionType::VOICE,
                'extra_data' => [],
            ]);
        }
    }

    public function edit(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
        Question $question,
    ): View {
        return view(
            'admin.question.edit',
            compact('research', 'questionnaire', 'section', 'question'),
        );
    }

    public function update(
        StoreQuestionRequest $request,
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
        Question $question,
    ): RedirectResponse {
        $request->validated();
        $data = $request->all();

        $question->update($data);
        $question->options()->delete();
        $this->storeOptions($question, $data);

        return redirect()
            ->route('questions.details', [
                'research' => $research,
                'questionnaire' => $questionnaire,
                'section' => $section,
                'question' => $question,
                'tab' => 'Details',
            ])
            ->with('success', 'De vraag is aangepast!');
    }

    public function details(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
        Question $question,
    ): View {
        return view(
            'admin.question.details',
            compact('research', 'questionnaire', 'section', 'question'),
        );
    }

    public function remove(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
        Question $question,
    ): Application|RedirectResponse|Redirector {
        $question->delete();

        return redirect(
            route('sections.details', [
                $research->id,
                $questionnaire->id,
                $section->id,
                'tab' => 'Vragen',
            ]),
        )->with('success', 'De vraag is verwijderd!');
    }

    public function archive(Question $question)
    {
    }

    public function archives()
    {
    }

    public function restore(Question $question)
    {
    }

    public function deletes()
    {
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\QuestionOptionType;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Research;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
        $this->saveOptions($question, $data);

        return redirect()
            ->route('sections.details', [
                $research->id,
                $questionnaire->id,
                $section->id,
                'tab' => 'Vragen',
            ])
            ->with('success', 'De vraag is aangemaakt!');
    }

    public function edit(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
        Question $question,
    ): View {
        $question = $question->load('options');
        $questionOptionType = QuestionOptionType::class;
        return view(
            'admin.question.edit',
            compact(
                'research',
                'questionnaire',
                'section',
                'question',
                'questionOptionType',
            ),
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

        if ($questionnaire->open) {
            $data['uuid'] = $question->uuid;
            $question = $section->questions()->create($data);
            $successMessage =
                'Er is een nieuwe versie van de vraag aangemaakt!';
        } else {
            $question->update($data);
            $this->removeOptions($question, $data);
            $successMessage = 'De vraag is aangepast!';
        }
        $this->saveOptions($question, $data);

        return redirect()
            ->route('questions.details', [
                'research' => $research,
                'questionnaire' => $questionnaire,
                'section' => $section,
                'question' => $question,
                'tab' => 'Details',
            ])
            ->with('success', $successMessage);
    }

    private function removeOptions(Question $question, $data)
    {
        $options = $question->options;
        $options->map(function ($option) use ($data) {
            $type = $data[$option->type->value];
            if (!$type) {
                $option->delete();
            }
        });
    }

    private function saveOptions($question, $data)
    {
        $orders = $this->getOrders($data);
        foreach ($orders as $order => $optionType) {
            $type = $optionType->value;
            $saveOption = $data[$type] ?? false;
            if ($saveOption) {
                $this->saveOption($question, $optionType, $order, $data);
            }
        }
    }

    private function getOrders($data): array
    {
        $optionTypes = QuestionOptionType::cases();
        $orders = [];
        foreach ($optionTypes as $optionType) {
            $type = $optionType->value;
            $order = array_search($type, array_keys($data));
            if ($order != 0) {
                $orders[$order] = $optionType;
            }
        }
        ksort($orders);
        return array_values($orders);
    }

    private function saveOption($question, $type, $order, $data)
    {
        $option = QuestionOption::whereType($type->value)
            ->whereQuestionId($question->id)
            ->first();
        if ($option == null) {
            $option = new QuestionOption();
            $option->type = $type;
            $option->question_id = $question->id;
        }
        $option->order = $order;
        $option->extra_data = match ($type) {
            QuestionOptionType::OPEN => [
                'placeholder' => $data['openPlaceholder'],
            ],
            QuestionOptionType::MULTIPLE_CHOICE => [
                'multiple' => $data['multipleAnswers'],
                'values' => $data['list'],
            ],
            QuestionOptionType::RANGE => [
                'min' => $data['rangeMin'],
                'max' => $data['rangeMax'],
                'step' => $data['rangeStep'],
            ],
            default => []
        };
        $option->save();
    }

    public function details(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
        Question $question,
    ): View {
        $questionOptions = $question->options()->get();

        return view(
            'admin.question.details',
            compact(
                'research',
                'questionnaire',
                'section',
                'question',
                'questionOptions',
            ),
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

    public function answer(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
        Question $question,
        Participant $participant,
    ): Factory|View|Application {
        $answers = $question->options
            ->map(function ($option) use ($participant) {
                return Answer::where('participant_id', '=', $participant->id)
                    ->where('question_option_id', '=', $option->id)
                    ->first();
            })
            ->filter(function ($answer) {
                return $answer != null;
            });

        return view(
            'admin.question.answer',
            compact(
                'research',
                'questionnaire',
                'section',
                'question',
                'participant',
                'answers',
            ),
        );
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

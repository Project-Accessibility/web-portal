<?php

namespace App\Http\Controllers;

use App\Casts\DisplayDateTime;
use App\Http\Requests\StoreQuestionnaireRequest;
use App\Models\Questionnaire;
use App\Models\Research;
use App\Utils\TableLink;
use App\Utils\TableLinkParameter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class QuestionnaireController extends Controller
{
    public function overview(Research $research)
    {
        return redirect()->route('researches.details', [
            $research->id,
            'tab' => 'Vragenlijsten',
        ]);
    }

    public function create(Research $research): View
    {
        return view('admin.questionnaire.create', compact('research'));
    }

    public function store(
        StoreQuestionnaireRequest $request,
        Research $research,
    ): Application|RedirectResponse|Redirector {
        $request->validated();

        $research->questionnaires()->create($request->all());

        return redirect()
            ->route('researches.details', [
                $research->id,
                'tab' => 'Vragenlijsten',
            ])
            ->with('success', 'De vragenlijst is aangemaakt!');
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
        Research $research,
        Questionnaire $questionnaire,
    ): View {
        // Sections
        $sections = $questionnaire->sections;
        $sectionHeaders = ['ID', 'Titel', 'Omschrijving'];
        $sectionKeys = ['id', 'title', 'description'];

        $sectionLinkParameters = [
            new TableLinkParameter(routeParameter: 'section', itemIndex: 'id'),
            new TableLinkParameter(
                routeParameter: 'questionnaire',
                routeValue: $questionnaire->id,
            ),
            new TableLinkParameter(
                routeParameter: 'research',
                routeValue: $questionnaire->research->id,
            ),
        ];

        $sectionResultsLinkParameters = collect(
            array_merge($sectionLinkParameters, [
                new TableLinkParameter(
                    routeParameter: 'tab',
                    routeValue: 'results',
                ),
            ]),
        );

        $sectionQuestionsLinkParameters = collect(
            array_merge($sectionLinkParameters, [
                new TableLinkParameter(
                    routeParameter: 'tab',
                    routeValue: 'questions',
                ),
            ]),
        );

        $sectionLinks = collect([
            new TableLink(
                'sections.questions',
                $sectionQuestionsLinkParameters,
            ),
            new TableLink('sections.results', $sectionResultsLinkParameters),
        ]);

        $sectionRowLink = new TableLink(
            'sections.details',
            collect($sectionLinkParameters),
        );

        // Participants
        $participants = $questionnaire
            ->participants()
            ->withMax('answers', 'updated_at')
            ->withCasts([
                'answers_max_updated_at' => DisplayDateTime::class,
            ])
            ->get()
            ->toArray();

        $participantHeaders = ['ID', 'Code', 'Laatst gewijzigd', 'Voltoloid'];
        $participantKeys = ['id', 'code', 'answers_max_updated_at', 'finished'];

        $participantLinkParameters = [
            new TableLinkParameter(
                routeParameter: 'participant',
                itemIndex: 'id',
            ),
            new TableLinkParameter(
                routeParameter: 'questionnaire',
                routeValue: $questionnaire->id,
            ),
            new TableLinkParameter(
                routeParameter: 'research',
                routeValue: $questionnaire->research->id,
            ),
        ];

        $participantRowLink = new TableLink(
            'participants.details',
            collect($participantLinkParameters),
        );

        // Results
        $results = $questionnaire->results()->toArray();

        // Participants
        $participants = $questionnaire
            ->participants()
            ->withMax('answers', 'updated_at')
            ->withCasts([
                'answers_max_updated_at' => DisplayDateTime::class,
            ])
            ->get()
            ->toArray();

        $participantHeaders = ['ID', 'Code', 'Laatst gewijzigd', 'Voltoloid'];
        $participantKeys = ['id', 'code', 'answers_max_updated_at', 'finished'];

        $participantLinkParameters = [
            new TableLinkParameter(
                routeParameter: 'participant',
                itemIndex: 'id',
            ),
            new TableLinkParameter(
                routeParameter: 'questionnaire',
                routeValue: $questionnaire->id,
            ),
            new TableLinkParameter(
                routeParameter: 'research',
                routeValue: $questionnaire->research->id,
            ),
        ];

        $participantRowLink = new TableLink(
            'participants.details',
            collect($participantLinkParameters),
        );

        // Results
        $questionSections = [];
        foreach ($sections as $section) {
            $section['questions'] = $section
                ->questions()
                ->selectRaw(
                    'questions.id, questions.title, count(answers.id) as amountOfAnswers',
                )
                ->join(
                    'question_options',
                    'questions.id',
                    '=',
                    'question_options.question_id',
                )
                ->leftJoin(
                    'answers',
                    'question_options.id',
                    '=',
                    'answers.question_option_id',
                )
                ->groupBy(['questions.id', 'questions.title'])
                ->get()
                ->toArray();
            $questionSections[] = $section;
        }
        $sections = $sections->toArray();

        return view(
            'admin.questionnaire.details',
            compact(
                'research',
                'questionnaire',
                'sections',
                'sectionHeaders',
                'sectionLinks',
                'sectionKeys',
                'sectionRowLink',
                'participants',
                'participantHeaders',
                'participantKeys',
                'participantRowLink',
                'results',
                'participants',
                'participantHeaders',
                'participantKeys',
                'participantRowLink',
                'questionSections'
            ),
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

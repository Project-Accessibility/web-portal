<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Models\Participant;
use App\Models\Questionnaire;
use App\Models\Research;
use App\Utils\TableLink;
use App\Utils\TableLinkParameter;
use Carbon\Carbon;
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

        // Results
        $results = $questionnaire->results()->toArray();

        // Participants
        $participants = $questionnaire
            ->participants()
            ->get()
            ->map(function (Participant $participant) {
                $participant->last_updated = Carbon::parse(
                    $participant->lastUpdated(),
                )->translatedFormat('l d F Y \o\m H:i');

                return $participant;
            })
            ->toArray();

        $participantHeaders = ['ID', 'Code', 'Laatst gewijzigd', 'Voltooid'];
        $participantKeys = ['id', 'code', 'last_updated', 'finished'];

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
                'results',
                'participants',
                'participantHeaders',
                'participantKeys',
                'participantRowLink',
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

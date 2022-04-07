<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionnaireRequest;
use App\Models\Geofence;
use App\Models\Questionnaire;
use App\Models\Research;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SectionController extends Controller
{
    public function overview(
        Research $research,
        Questionnaire $questionnaire,
    ): RedirectResponse {
        return redirect()->route('questionnaires.details', [
            $research->id,
            $questionnaire->id,
            'tab' => 'Onderdelen',
        ]);
    }

    public function create(
        Research $research,
        Questionnaire $questionnaire,
    ): View {
        return view('admin.section.create', [
            'research' => $research,
            'questionnaire' => $questionnaire,
        ]);
    }

    public function store(
        StoreQuestionnaireRequest $request,
        Research $research,
        Questionnaire $questionnaire,
    ): Application|RedirectResponse|Redirector {
        $request->validated();

        $section = $questionnaire->sections()->create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'location_description'=>$request->input('location_description')
        ]);
        $radius = $request->input('radius');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        if($radius && $latitude && $longitude){
            $geofence = Geofence::create([
                'radius' => $radius,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
            $section->geofence_id=$geofence->id;
            $section->save();
        }

        return redirect(
            route('questionnaires.sections', [
                $research->id,
                $questionnaire->id,
            ]),
        )->with('success', 'Het onderdeel is aangemaakt!');
    }

    public function edit(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): View {
        $geofence = Geofence::whereId($section->geofence_id)->first();
        return view(
            'admin.section.edit',
            compact('research', 'questionnaire', 'section', 'geofence'),
        );
    }

    public function update(
        StoreQuestionnaireRequest $request,
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): RedirectResponse {
        $request->validated();

        $section->update($request->all());

        return redirect()
            ->route('sections.details', [
                'research' => $research,
                'questionnaire' => $questionnaire,
                'section' => $section,
                'tab' => 'Details',
            ])
            ->with('success', 'Het onderdeel is aangepast!');
    }

    public function details(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): View {
        $geofence = Geofence::whereId($section->geofence_id)->first();
        return view(
            'admin.section.details',
            compact('research', 'questionnaire', 'section', 'geofence'),
        );
    }

    public function remove(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): Application|RedirectResponse|Redirector {
        $section->delete();

        return redirect(
            route('questionnaires.details', [
                $research,
                $questionnaire,
                'tab' => 'Onderdelen',
            ]),
        )->with('success', 'Het onderdeel is verwijderd!');
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

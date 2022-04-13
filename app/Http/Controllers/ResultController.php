<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Research;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;

class ResultController extends Controller
{
    public function sectionOverview(
        Research $research,
        Questionnaire $questionnaire,
        Section $section,
    ): RedirectResponse {
        return redirect()->route('sections.details', [
            $research->id,
            $questionnaire->id,
            $section->id,
            'tab' => 'Resultaten',
        ]);
    }
}

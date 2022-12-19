<?php

namespace App\Http\Actions\Duplicate;

use App\Http\Handlers\RadarHandler;
use App\Models\Geofence;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Section;

class DuplicateSection
{
    public static function duplicate(
        Questionnaire $questionnaire,
        Section $templateSection,
    ): void {
        $newSection = $questionnaire
            ->sections()
            ->save($templateSection->replicate());

        if (!$newSection instanceof Section) {
            return;
        }

        $templateSection->questions->each(function (Question $question) use (
            $newSection,
        ) {
            DuplicateQuestion::duplicate($newSection, $question);
        });
    }
}

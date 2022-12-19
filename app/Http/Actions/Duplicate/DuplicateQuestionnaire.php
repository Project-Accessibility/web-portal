<?php

namespace App\Http\Actions\Duplicate;

use App\Models\Questionnaire;
use App\Models\Research;
use App\Models\Section;

class DuplicateQuestionnaire
{
    public static function duplicate(
        Research $research,
        Questionnaire $templateQuestionnaire,
    ): void {
        $newQuestionnaire = $research
            ->questionnaires()
            ->save($templateQuestionnaire->replicate(['open']));

        if (!$newQuestionnaire instanceof Questionnaire) {
            return;
        }

        $templateQuestionnaire->sections->each(function (Section $section) use (
            $newQuestionnaire,
        ) {
            DuplicateSection::duplicate($newQuestionnaire, $section);
        });
    }
}

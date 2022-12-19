<?php

namespace App\Http\Actions\Duplicate;

use App\Models\Questionnaire;
use App\Models\Research;

class DuplicateResearch
{
    public static function duplicate(Research $templateResearch): void
    {
        $research = $templateResearch->replicate();

        if (!$research) {
            return;
        }

        $templateResearch->questionnaires->each(function (
            Questionnaire $questionnaire,
        ) use ($research) {
            DuplicateQuestionnaire::duplicate($research, $questionnaire);
        });
    }
}

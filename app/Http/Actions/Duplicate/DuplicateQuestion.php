<?php

namespace App\Http\Actions\Duplicate;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Section;

class DuplicateQuestion
{
    public static function duplicate(
        Section $section,
        Question $templateQuestion,
    ): void {
        $newQuestion = $section
            ->questions()
            ->save($templateQuestion->replicate());

        if (!$newQuestion instanceof Question) {
            return;
        }

        $newQuestion->options->each(function (QuestionOption $option) use (
            $newQuestion,
        ) {
            DuplicateQuestionOption::duplicate($newQuestion, $option);
        });
    }
}

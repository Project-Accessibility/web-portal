<?php

namespace App\Http\Actions\Duplicate;

use App\Models\Question;
use App\Models\QuestionOption;

class DuplicateQuestionOption
{
    public static function duplicate(Question $question, QuestionOption $templateQuestionOption): void
    {
        $question
            ->options()
            ->save($templateQuestionOption->replicate());
    }
}

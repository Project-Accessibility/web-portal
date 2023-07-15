<?php

namespace App\Enums;

enum QuestionOptionType: string
{
    case OPEN = 'OPEN';
    case IMAGE = 'IMAGE';
    case VIDEO = 'VIDEO';
    case VOICE = 'VOICE';
    case MULTIPLE_CHOICE = 'MULTIPLE_CHOICE';
    case RANGE = 'RANGE';

    public function display(): string
    {
        return match ($this) {
            QuestionOptionType::OPEN => 'Open antwoord',
            QuestionOptionType::IMAGE => 'Afbeelding(en)',
            QuestionOptionType::VIDEO => 'Video(\'s)',
            QuestionOptionType::VOICE => 'Spraakopname(s)',
            QuestionOptionType::MULTIPLE_CHOICE => 'Meerkeuze',
            QuestionOptionType::RANGE => 'Schaal',
        };
    }
}

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
    case DATE = 'DATE';
    case DATETIME = 'DATETIME';

    public function display(): string
    {
        return match ($this) {
            QuestionOptionType::OPEN => 'Open antwoord',
            QuestionOptionType::IMAGE => 'Afbeeldingen',
            QuestionOptionType::VIDEO => 'Video\'s',
            QuestionOptionType::VOICE => 'Spraakopnames',
            QuestionOptionType::MULTIPLE_CHOICE => 'Meerkeuze',
            QuestionOptionType::RANGE => 'Schaal',
            QuestionOptionType::DATE => 'Datum',
            QuestionOptionType::DATETIME => 'Datum en tijd'
        };
    }
}

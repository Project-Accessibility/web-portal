<?php

namespace App\Enums;

enum QuestionOptionType: string
{
    case OPEN = 'OPEN';
    case IMAGE = 'IMAGE';
    case VIDEO = 'VIDEO';
    case VOICE = 'VOICE';
    case MULTIPLE_CHOICE = 'MULTIPLE_CHOICE';
    case DATE = 'DATE';
    case DATETIME = 'DATETIME';
}

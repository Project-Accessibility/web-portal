<?php


namespace App\Enums;


use Illuminate\Validation\Rules\Enum;

class QuestionOptionType extends Enum
{
    const OPEN = "Open";
    const IMAGE = "Image";
    const VIDEO = "Video";
    const VOICE = "Voice";
    const MULTIPLE_CHOICE = "MultipleChoice";
    const DATE = "Date";
    const DATETIME = "DateTime";
}

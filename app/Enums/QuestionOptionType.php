<?php

namespace App\Enums;

enum QuestionOptionType
{
  case OPEN;
  case IMAGE;
  case VIDEO;
  case VOICE;
  case MULTIPLE_CHOICE;
  case DATE;
  case DATETIME;
}

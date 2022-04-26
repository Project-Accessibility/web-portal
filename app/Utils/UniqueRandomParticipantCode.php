<?php

namespace App\Utils;

use App\Models\Participant;

class UniqueRandomParticipantCode
{
    public function generate(): string
    {
        $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXZ';
        $participantCodes = Participant::get('code')
            ->pluck('code')
            ->toArray();

        $codeExists = true;
        $code = null;
        while ($codeExists || is_null($code)) {
            $code = substr(str_shuffle($permitted_chars), 0, 5);

            if (!in_array($code, $participantCodes)) {
                $codeExists = false;
            }
        }

        return $code;
    }
}

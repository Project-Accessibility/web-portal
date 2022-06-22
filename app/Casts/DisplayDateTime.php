<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DisplayDateTime implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value
            ? Carbon::parse($value)->translatedFormat('l d F Y \o\m H:i')
            : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return Carbon::createFromFormat('l d F Y \o\m H:i', $value);
    }
}

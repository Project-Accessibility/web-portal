<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DisplayDateTime implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return Carbon::parse($value)->translatedFormat('l d F Y \o\m h:i');
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return Carbon::createFromFormat('l d F Y \o\m h:i', $value);
    }
}

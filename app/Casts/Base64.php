<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Base64 implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return base64_decode($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return base64_encode($value);
    }
}

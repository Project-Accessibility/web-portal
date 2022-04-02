<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        abort_if(
            !$request->header('X-API-Key'),
            406,
            'De request bevat geen header X-API-Key.',
        );

        abort_if(
            gettype($request->header('X-API-Key')) !== 'string',
            406,
            'De header X-API-Key is geen string.',
        );

        abort_if(
            $request->header('X-API-Key') !== Env::get('API_KEY'),
            403,
            'De API key is niet valide.',
        );

        return $next($request);
    }
}

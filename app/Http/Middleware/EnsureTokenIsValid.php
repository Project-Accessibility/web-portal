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
            !$request->header('X-API-KEY'),
            406,
            'De request bevat geen header X-API-KEY.',
        );

        abort_if(
            gettype($request->header('X-API-KEY')) !== 'string',
            406,
            'De header X-API-KEY is geen string.',
        );

        abort_if(
            $request->header('X-API-KEY') !== Env::get('API_KEY'),
            403,
            'De API KEY is niet valide.',
        );

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureHeaderHasKeys
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        abort_if(
            $request->getContentType() === 'application/json',
            Response::HTTP_NOT_ACCEPTABLE,
            'De \'Content-Type\' is niet \'application/json\'.',
        );

        return $next($request);
    }
}

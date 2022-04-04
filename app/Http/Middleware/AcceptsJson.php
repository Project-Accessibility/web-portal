<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcceptsJson
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (!$request->acceptsJson()) {
            return response()->json(
                ['message' => 'Geen header met accept: application/json.'],
                404,
            );
        }

        return $next($request);
    }
}

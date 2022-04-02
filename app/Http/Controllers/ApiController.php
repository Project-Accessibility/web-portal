<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Symfony\Component\ErrorHandler\Error\ClassNotFoundError;

class ApiController extends BaseController
{
    public function get(string $modelClassName): JsonResponse
    {
        $fullClassName = $this->getFullClassName($modelClassName);
        $collection = call_user_func($fullClassName .'::all');

        return $this->getDataResponse($collection);
    }

    public function find(string $modelClassName, int $id): JsonResponse
    {
        $fullClassName = $this->getFullClassName($modelClassName);
        $collection = call_user_func($fullClassName .'::findOrFail', $id);

        return $this->getDataResponse($collection);
    }

    private function getFullClassName(string $modelClassName): string
    {
        $modelName = Str::lower(Str::singular($modelClassName));
        $fullModelClassName = 'App\\Models\\' . $modelName;

        abort_if(
            ! class_exists($fullModelClassName),
            404,
            'Geen model gevonden voor ' . $modelName
        );

        return $fullModelClassName;
    }

    private function getDataResponse($data): JsonResponse {
        return response()->json([
           'data' => $data,
        ]);
    }
}

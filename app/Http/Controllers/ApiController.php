<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class ApiController extends BaseController
{
    public function get(Request $request, string $modelClassName): JsonResponse
    {
        $fullClassName = $this->getFullClassName($modelClassName);

        $functions = $this->prepareFunctions(
            $fullClassName,
            $request->get('functions'),
        );
        $functions['get'] = null;
        $collection = $this->callFunctions($fullClassName, $functions);
        return $this->getDataResponse($collection);
    }

    public function find(
        Request $request,
        string $modelClassName,
        int $id,
    ): JsonResponse {
        $fullClassName = $this->getFullClassName($modelClassName);

        $functions = $this->prepareFunctions(
            $fullClassName,
            $request->get('functions'),
        );
        $functions['findOrFail'] = [$id];

        $collection = $this->callFunctions($fullClassName, $functions);
        return $this->getDataResponse($collection);
    }

    private function getFullClassName(string $modelClassName): string
    {
        $modelName = Str::lower(Str::singular($modelClassName));
        $fullModelClassName = 'App\\Models\\' . $modelName;

        abort_if(
            !class_exists($fullModelClassName),
            404,
            'Geen model gevonden voor ' . $modelName,
        );

        return $fullModelClassName;
    }

    private function getDataResponse($data): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ]);
    }

    private function callFunctions(
        string $fullClassName,
        array $functions,
    ): DatabaseCollection|Model|null {
        $returnValue = $fullClassName;
        foreach ($functions as $function => $parameters) {
            $returnValue =
                $returnValue === $fullClassName
                    ? ($parameters
                        ? $returnValue::$function(...$parameters)
                        : $returnValue::$function())
                    : ($parameters
                        ? $returnValue->$function(...$parameters)
                        : $returnValue->$function());
        }

        return $returnValue;
    }

    private function prepareFunctions(
        string $fullClassName,
        ?array $functions,
    ): array {
        if (!$functions || count($functions) === 0) {
            return [];
        }

        $functions = array_merge(...array_values($functions));

        return collect($functions)
            ->mapWithKeys(function ($value, $key) use ($fullClassName) {
                abort_if(
                    !method_exists($fullClassName, $key) &&
                        !method_exists(Builder::class, $key),
                    406,
                    'fuctie: ' . $key . ' bestaat niet voor deze API services',
                );

                return [
                    $key => $value
                        ? (gettype($value) === 'array'
                            ? $value
                            : [$value])
                        : null,
                ];
            })
            ->toArray();
    }
}

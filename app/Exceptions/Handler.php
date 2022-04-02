<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $exception, Request $request) {
            if (!$request->is('api/*')) {
                return;
            }

            return $this->handleApiException($request, $exception);
        });
    }

    private function handleApiException(
        Request $request,
        Throwable $exception,
    ): JsonResponse {
        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof ValidationException) {
            $exception = $this->convertValidationExceptionToResponse(
                $exception,
                $request,
            );
        }

        if ($exception instanceof NotFoundHttpException) {
            $notFoundException = $exception->getPrevious();

            if ($notFoundException) {
                $modelName = explode('\\', $notFoundException->getModel());
                $ids = $notFoundException->getIds();

                $dutchModelName =
                    $this->getDutchDisplayNameForModel(end($modelName)) ??
                    'model';
                $id = $ids[0] ?? -1;

                $exception = new NotFoundHttpException(
                    ucfirst($dutchModelName) .
                        ($id == -1 ? null : ' ' . $id) .
                        ' is niet gevonden.',
                );
            }
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse(Throwable $exception): JsonResponse
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } elseif (method_exists($exception, 'getCode')) {
            $statusCode = $exception->getCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        $response['message'] = $exception->getMessage();

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        }

        return response()->json($response, $statusCode);
    }

    private function getDutchDisplayNameForModel(string $model): ?string
    {
        return match (strtolower($model)) {
            'research' => 'onderzoek',
            default => null
        };
    }
}

<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelIgnition\Exceptions\ViewException;
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
            if ($request->route() && $request->route()->getPrefix() === 'api') {
                return $this->handleApiException($request, $exception);
            } else {
                return $this->handleWebException($exception);
            }
        });
    }

    private function handleWebException(Throwable $exception)
    {
        if (!env('app_debug')) {
            if ($exception instanceof AuthenticationException) {
                return redirect()
                    ->route('login')
                    ->with('unauth', 'U moet ingelogd zijn.');
            }

            if ($exception instanceof ViewException) {
                $exception = $exception->getPrevious();

                if (
                    !method_exists($exception, 'getStatusCode') ||
                    $exception->getStatusCode() === null
                ) {
                    return response()->view('errors.500');
                }

                return match ($exception->getStatusCode()) {
                    404 => response()->view('errors.404', [
                        'message' => $exception->getMessage(),
                    ]),
                    default => response()->view('errors.500')
                };
            }
        }
    }

    private function handleApiException(
        Request $request,
        Throwable $exception,
    ): JsonResponse {
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
            } else {
                $exception = new NotFoundHttpException(
                    'Het pad is niet gevonden.',
                );
            }
        }

        return $this->customApiResponse($request, $exception);
    }

    private function customApiResponse(
        Request $request,
        Throwable $exception,
    ): JsonResponse {
        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        }

        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse(
                $exception,
                $request,
            );
        }

        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        $response['message'] =
            $statusCode !== 500 || config('app.debug')
                ? $exception->getMessage()
                : 'Er is iets mis gegaan met het ophalen van de data.';

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        } else {
            report($exception);
        }

        return response()->json($response, $statusCode);
    }

    private function getDutchDisplayNameForModel(string $model): ?string
    {
        return match (strtolower($model)) {
            'answer' => 'antwoord',
            'geofence' => 'geofence',
            'participant' => 'participant',
            'question' => 'vraag',
            'questionOption' => 'vraag mogelijkheid',
            'research' => 'onderzoek',
            'section' => 'sectie',
            default => null
        };
    }
}

<?php

use App\Http\Controllers\Api\v3\QuestionController;
use App\Http\Controllers\Api\v3\QuestionnaireController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json('pong');
});

Route::get('/questionnaires/{code}', [QuestionnaireController::class, 'get']);
Route::post('/questionnaires/{code}', [
    QuestionnaireController::class,
    'submit',
]);

Route::post('/questions/{question}/{code}', [
    QuestionController::class,
    'answer',
]);

Route::fallback(function () {
    abort(Response::HTTP_NOT_FOUND, 'Pad is niet gevonden.');
});

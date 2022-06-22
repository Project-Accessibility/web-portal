<?php

use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionnaireController;
use App\Http\Middleware\AcceptsJson;
use App\Http\Middleware\EnsureHeaderHasKeys;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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

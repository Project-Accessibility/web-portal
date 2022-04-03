<?php

use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionnaireController;
use App\Http\Middleware\AcceptsJson;
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

Route::middleware('acceptJson')->group(function () {
    Route::get('/ping', function () {
        return response()->json('pong');
    });

    Route::middleware('api')->group(function () {
        Route::get('/questionnaires/getByCodes', [
            QuestionnaireController::class,
            'getByUserCodes',
        ]);

        Route::get('/questionnaires/{code}', [
            QuestionnaireController::class,
            'get',
        ]);
        Route::get('/questions/{id}', [QuestionController::class, 'get']);
    });
});

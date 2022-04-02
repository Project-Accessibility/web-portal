<?php

use App\Http\Controllers\ApiController;
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

Route::middleware('api')->group(function () {
    Route::get('/{modelClassName}', [ApiController::class, 'get']);
    Route::get('/{modelClassName}/{id}', [ApiController::class, 'find']);
});

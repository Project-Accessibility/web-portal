<?php

use Illuminate\Support\Facades\App;
use App\Http\Controllers\ResearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})
    ->name('welcome')
    ->defaults('display', 'home');

Route::get('/stylesheet', function () {
    return view('stylesheet');
})
    ->name('stylesheet')
    ->defaults('display', 'stylesheet');

// Routes for testing the table links
if (App::environment('testing')) {
    Route::get('/fake-route')->name('fake.route.without.params');

    Route::get('/fake-route/{fake_param_one?}')->name(
        'fake.route.with.one.param',
    );

    Route::get('/fake-route/{fake_param_one}/more-fake/{fake_param_two}')
        ->name('fake.route.with.two.params')
        ->defaults('display', 'test view name');
}
Route::post('/logout', function () {
    return view('welcome');
});

Route::controller(ResearchController::class)->prefix('/researches')->group(function () {
    Route::get('/', 'overview');
    Route::get('/{id}', 'details');
    Route::get('/create', 'create');
    Route::get('/{id}/edit', 'edit');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'remove');
});

<?php

use App\Http\Controllers\ResearchController;
use App\Http\Requests\TestInputsRequest;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\QuestionnaireController;
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

Route::get('/inputs', function () {
    return view('inputs');
})
    ->name('inputs')
    ->defaults('display', 'inputs');

Route::post('/inputs', function (TestInputsRequest $request) {
    $request->validated();
    return view('inputs')->with('success', 'Alle inputs zijn correct');
})
    ->name('inputs.store')
    ->defaults('display', 'inputs');

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

Route::controller(ResearchController::class)
    ->prefix('/researches')
    ->group(function () {
        Route::get('/', 'overview')
            ->name('researches')
            ->defaults('display', 'Onderzoeken');

        Route::get('/create', 'create')
            ->name('researches.create')
            ->defaults('display', 'Aanmaken');

        Route::prefix('/{research}')->group(function () {
            Route::get('/', 'details')->name('researches.details');

            Route::controller(QuestionnaireController::class)
                ->prefix('/questionnaires')
                ->group(function () {
                    Route::get('/create', 'create')
                        ->name('questionnaires.create')
                        ->defaults('display', 'Aanmaken');

                    Route::get('/{questionnaire:id}', 'details')->name(
                        'questionnaires.details',
                    );
                    Route::get('/{questionnaire}/edit', 'edit')
                        ->name('questionnaires.edit')
                        ->defaults('display', 'aanpassen');
                    Route::post('/', 'store')->name('questionnaires.store');
                    Route::put('/{questionnaire}', 'update')->name(
                        'questionnaires.update',
                    );
                    Route::delete('/{questionnaire}', 'remove')->name(
                        'questionnaires.remove',
                    );
                    Route::get('/', function (\App\Models\Research $research) {
                        return redirect()->route('researches.details', [
                            $research->id,
                            'tab' => 'Vragenlijsten',
                        ]);
                    })
                        ->name('researches.questionnaires')
                        ->defaults('display', 'Vragenlijsten');
                });
        });

        Route::get('/{research}/edit', 'edit')
            ->name('researches.edit')
            ->defaults('display', 'Aanpassen');

        Route::post('/', 'store')->name('researches.store');
        Route::put('/{research}', 'update')->name('researches.update');
        Route::delete('/{research}', 'remove')->name('researches.remove');
    });

Route::fallback(function () {
    return redirect()->route('researches');
});

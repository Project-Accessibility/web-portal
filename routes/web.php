<?php

use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SectionController;
use App\Http\Requests\TestInputsRequest;
use App\Models\Questionnaire;
use App\Models\Research;
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

// Preview views

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

Route::get('/questionTypes', function () {
    return view('question-types');
})
    ->name('questionTypesPreview')
    ->defaults('display', 'Question types preview');

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
                    Route::get('/', 'overview')
                        ->name('researches.questionnaires')
                        ->defaults('display', 'Vragenlijsten');

                    Route::get('/create', 'create')
                        ->name('questionnaires.create')
                        ->defaults('display', 'Aanmaken');

                    Route::post('/', 'store')->name('questionnaires.store');

                    Route::prefix('/{questionnaire}')->group(function () {
                        Route::get('/', 'details')->name(
                            'questionnaires.details',
                        );

                        Route::get('/edit', 'edit')
                            ->name('questionnaires.edit')
                            ->defaults('display', 'aanpassen');

                        Route::put('/', 'update')->name(
                            'questionnaires.update',
                        );

                        Route::delete('/', 'remove')->name(
                            'questionnaires.remove',
                        );

                        Route::controller(SectionController::class)
                            ->prefix('/sections')
                            ->group(function () {
                                Route::get('/', 'overview')
                                    ->name('questionnaires.sections')
                                    ->defaults('display', 'Onderdelen');
                                Route::get('/create', 'create')
                                    ->name('sections.create')
                                    ->defaults('display', 'Aanmaken');
                                Route::post('/', 'store')->name(
                                    'sections.store',
                                );
                                Route::prefix('/{section}')->group(function () {
                                    Route::get('/', 'details')->name(
                                        'sections.details',
                                    );
                                    Route::get('/edit', 'edit')
                                        ->name('sections.edit')
                                        ->defaults('display', 'aanpassen');
                                    Route::delete('/', 'remove')->name(
                                        'sections.remove',
                                    );
                                    Route::put('/', 'update')->name(
                                        'sections.update',
                                    );
                                    Route::controller(ResultController::class)
                                        ->prefix('/results')
                                        ->group(function () {
                                            Route::get('/', 'sectionOverview')
                                                ->name('sections.results')
                                                ->defaults(
                                                    'display',
                                                    'Resultaten',
                                                );
                                        });
                                });
                            });

                        Route::get('/results', function (
                            Research $research,
                            Questionnaire $questionnaire,
                        ) {
                            return redirect()->route('questionnaires.details', [
                                $research,
                                $questionnaire,
                                'tab' => 'Resultaten',
                            ]);
                        })
                            ->name('questionnaires.results')
                            ->defaults('display', 'Resultaten');

                        Route::get('/participants', function (
                            Research $research,
                            Questionnaire $questionnaire,
                        ) {
                            return redirect()->route('questionnaires.details', [
                                $research,
                                $questionnaire,
                                'tab' => 'Participanten',
                            ]);
                        })
                            ->name('questionnaires.participants')
                            ->defaults('display', 'Participanten');
                    });
                });
        });

        Route::get('/{research}/edit', 'edit')
            ->name('researches.edit')
            ->defaults('display', 'Aanpassen');

        Route::post('/', 'store')->name('researches.store');
        Route::put('/{research}', 'update')->name('researches.update');
        Route::delete('/{research}', 'remove')->name('researches.remove');
    });

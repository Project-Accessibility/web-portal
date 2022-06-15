<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SectionController;
use App\Http\Requests\TestInputsRequest;
use App\Models\Questionnaire;
use App\Models\Research;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/researches')->name('home');
    Route::controller(ResearchController::class)
        ->prefix('/researches')
        ->group(function () {
            Route::get('/', 'overview')
                ->name('researches')
                ->defaults('display', 'Onderzoeken')
                ->defaults('model', 'researches');
            Route::get('/create', 'create')
                ->name('researches.create')
                ->defaults('display', 'Aanmaken');
            Route::post('/', 'store')->name('researches.store');

            Route::prefix('/{research}')->group(function () {
                Route::get('/', 'details')->name('researches.details');
                Route::get('/edit', 'edit')
                    ->name('researches.edit')
                    ->defaults('display', 'Aanpassen');
                Route::put('/', 'update')->name('researches.update');
                Route::delete('/', 'remove')->name('researches.remove');

                Route::controller(QuestionnaireController::class)
                    ->prefix('/questionnaires')
                    ->group(function () {
                        Route::get('/', 'overview')
                            ->name('researches.questionnaires')
                            ->defaults('display', 'Vragenlijsten')
                            ->defaults('model', 'questionnaires');

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
                                        ->defaults('display', 'Onderdelen')
                                        ->defaults('model', 'sections');
                                    Route::get('/create', 'create')
                                        ->name('sections.create')
                                        ->defaults('display', 'Aanmaken');
                                    Route::post('/', 'store')->name(
                                        'sections.store',
                                    );
                                    Route::prefix('/{section}')->group(
                                        function () {
                                            Route::get('/', 'details')->name(
                                                'sections.details',
                                            );
                                            Route::get('/edit', 'edit')
                                                ->name('sections.edit')
                                                ->defaults(
                                                    'display',
                                                    'aanpassen',
                                                );
                                            Route::delete('/', 'remove')->name(
                                                'sections.remove',
                                            );
                                            Route::put('/', 'update')->name(
                                                'sections.update',
                                            );
                                            Route::controller(
                                                ResultController::class,
                                            )
                                                ->prefix('/results')
                                                ->group(function () {
                                                    Route::get(
                                                        '/',
                                                        'sectionOverview',
                                                    )
                                                        ->name(
                                                            'sections.results',
                                                        )
                                                        ->defaults(
                                                            'display',
                                                            'Resultaten',
                                                        );
                                                });
                                            Route::controller(
                                                QuestionController::class,
                                            )
                                                ->prefix('/questions')
                                                ->group(function () {
                                                    Route::get('/', 'overview')
                                                        ->name(
                                                            'sections.questions',
                                                        )
                                                        ->defaults(
                                                            'display',
                                                            'Vragen',
                                                        )
                                                        ->defaults(
                                                            'model',
                                                            'questions',
                                                        );
                                                    Route::get(
                                                        '/create',
                                                        'create',
                                                    )
                                                        ->name(
                                                            'questions.create',
                                                        )
                                                        ->defaults(
                                                            'display',
                                                            'Aanmaken',
                                                        );
                                                    Route::post(
                                                        '/',
                                                        'store',
                                                    )->name('questions.store');
                                                    Route::prefix(
                                                        '/{question}',
                                                    )->group(function () {
                                                        Route::get(
                                                            '/',
                                                            'details',
                                                        )->name(
                                                            'questions.details',
                                                        );
                                                        Route::get(
                                                            '/edit',
                                                            'edit',
                                                        )
                                                            ->name(
                                                                'questions.edit',
                                                            )
                                                            ->defaults(
                                                                'display',
                                                                'Aanpassen',
                                                            );

                                                        Route::delete(
                                                            '/',
                                                            'remove',
                                                        )->name(
                                                            'questions.remove',
                                                        );
                                                        Route::put(
                                                            '/',
                                                            'update',
                                                        )->name(
                                                            'questions.update',
                                                        );
                                                        Route::get(
                                                            '/answer/{participant}',
                                                            'answer',
                                                        )->name(
                                                            'questions.answer',
                                                        );
                                                    });
                                                });
                                        },
                                    );
                                });

                            Route::controller(ParticipantController::class)
                                ->prefix('/participants')
                                ->group(function () {
                                    Route::get('/', 'overview')
                                        ->name('questionnaires.participants')
                                        ->defaults('display', 'Participanten')
                                        ->defaults('model', 'participants');

                                    Route::post('/', 'store')->name(
                                        'participants.store',
                                    );
                                    Route::prefix('/{participant}')->group(
                                        function () {
                                            Route::get('/', 'details')->name(
                                                'participants.details',
                                            );
                                            Route::delete('/', 'remove')->name(
                                                'participants.remove',
                                            );
                                        },
                                    );
                                });

                            Route::get('/results', function (
                                Research $research,
                                Questionnaire $questionnaire,
                            ) {
                                return redirect()->route(
                                    'questionnaires.details',
                                    [
                                        $research,
                                        $questionnaire,
                                        'tab' => 'Resultaten',
                                    ],
                                );
                            })
                                ->name('questionnaires.results')
                                ->defaults('display', 'Resultaten');
                        });
                    });
            });
        });
});

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

require __DIR__ . '/auth.php';

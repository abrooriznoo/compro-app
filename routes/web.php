<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearningController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LearningController::class, 'index']);

Route::group(['prefix' => 'arithmetic'], function () {
    // Addition Route
    Route::get('/addition', [LearningController::class, 'addition'])->name('arithmetic.addition');
    Route::post('/addition', [LearningController::class, 'additionMethods'])->name('arithmetic.addition.calculate');

    // Subtraction Route
    Route::get('/subtraction', [LearningController::class, 'subtraction'])->name('arithmetic.subtraction');
    Route::post('/subtraction', [LearningController::class, 'subtractionMethods'])->name('arithmetic.subtraction.calculate');

    // Multiplication Route
    Route::get('/multiplication', [LearningController::class, 'multiplication'])->name('arithmetic.multiplication');
    Route::post('/multiplication', [LearningController::class, 'multiplicationMethods'])->name('arithmetic.multiplication.calculate');

    // Division Route
    Route::get('/division', [LearningController::class, 'division'])->name('arithmetic.division');
    Route::post('/division', [LearningController::class, 'divisionMethods'])->name('arithmetic.division.calculate');
});


<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearningController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LearningController::class, 'index']);

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'actionLogin'])->name('auth.action-login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'preventBackHistory']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [DashboardController::class, 'home'])->name('admin.home');
    Route::get('/users', [DashboardController::class, 'users'])->name('admin.users');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

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


<?php

use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearningController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'landing']);

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'actionLogin'])->name('auth.action-login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'preventBackHistory']], function () {
    // Dashboard Admin Routes
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [DashboardController::class, 'home'])->name('admin.home');

    // Users Management Route
    Route::get('/users', [DashboardController::class, 'users'])->name('admin.users');
    Route::post('/users', [UsersController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

    // Blog Management Routes
    Route::get('/blogs', [DashboardController::class, 'blogs'])->name('admin.blogs');
    Route::post('/blogs', [BlogsController::class, 'store'])->name('admin.blogs.store');
    Route::put('/blogs/{id}', [BlogsController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{id}', [BlogsController::class, 'destroy'])->name('admin.blogs.destroy');

    // Category Management Routes
    Route::get('/categories', [DashboardController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');


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


<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UsersController;
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

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Surveys

Route::get('surveys', [SurveyController::class, 'index'])
    ->name('surveys')
    ->middleware('auth');

Route::get('surveys/create', [SurveyController::class, 'create'])
    ->name('surveys.create')
    ->middleware('auth');

Route::post('surveys', [SurveyController::class, 'store'])
    ->name('surveys.store')
    ->middleware('auth');

Route::get('surveys/{survey}/edit', [SurveyController::class, 'edit'])
    ->name('surveys.edit')
    ->middleware('auth');

Route::put('surveys/{survey}', [SurveyController::class, 'update'])
    ->name('surveys.update')
    ->middleware('auth');

Route::delete('surveys/{survey}', [SurveyController::class, 'destroy'])
    ->name('surveys.destroy')
    ->middleware('auth');

Route::put('surveys/{survey}/restore', [SurveyController::class, 'restore'])
    ->name('surveys.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');


Route::get('/survey/{survey}',[AnswersController::class,'index']);
Route::post('/survey/store/{survey}',[AnswersController::class,'store'])->name('entries.store');

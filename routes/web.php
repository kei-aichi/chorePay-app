<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChildController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);

    Route::get('/categories/{category}/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    Route::get('/categories/{category}/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/categories/{category}/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::get('/categories/{category}/tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');

    Route::put('/categories/{category}/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/categories/{category}/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    Route::resource('children', ChildController::class);

    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('calendar.index');

    Route::get('/calendar/{date}', [CalendarController::class, 'show'])
        ->name('calendar.show');
});
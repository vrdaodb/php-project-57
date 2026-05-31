<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Task Statuses
|--------------------------------------------------------------------------
*/

Route::get('/task_statuses', [TaskStatusController::class, 'index'])
    ->name('task_statuses.index');

Route::resource('task_statuses', TaskStatusController::class)
    ->except(['index'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Tasks
|--------------------------------------------------------------------------
|
| Список задач и просмотр задачи доступны всем.
| Создание/редактирование/удаление только авторизованным.
|
*/

Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::get('/tasks/{task}', [TaskController::class, 'show'])
    ->name('tasks.show');

Route::resource('tasks', TaskController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Labels
|--------------------------------------------------------------------------
*/

Route::get('/labels', [LabelController::class, 'index'])
    ->name('labels.index');

Route::resource('labels', LabelController::class)
    ->except(['index'])
    ->middleware('auth');

require __DIR__ . '/auth.php';

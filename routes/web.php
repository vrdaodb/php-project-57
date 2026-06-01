<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test123', function () {
    return 'WORKS';
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

// Публичные маршруты
Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

// Авторизованные действия
Route::middleware('auth')->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');

    Route::match(['put', 'patch'], '/tasks/{task}', [TaskController::class, 'update'])
    ->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');
});

// show ВСЕГДА последним
Route::get('/tasks/{task}', [TaskController::class, 'show'])
    ->name('tasks.show');
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

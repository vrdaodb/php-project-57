<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function index()
{
    $tasks = QueryBuilder::for(Task::class)
        ->allowedFilters(
            AllowedFilter::exact('status_id'),
            AllowedFilter::exact('assigned_to_id'),
            AllowedFilter::exact('labels.id'),
        )
        ->get();

    $statuses = TaskStatus::all();
    $users = User::all();
    $labels = Label::all();

    return view('tasks.index', compact('tasks', 'statuses', 'users', 'labels'));
}

    public function create()
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.create', compact('statuses', 'users', 'labels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status_id' => 'required',
        ]);
        $task = new Task();
        $task->fill($request->all());
        $task->created_by_id = auth()->id();
        $task->save();
        $task->labels()->sync($request->labels ?? []);
        flash('Task created successfully')->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'status_id' => 'required',
        ]);
        $task->fill($request->all());
        $task->save();
        $task->labels()->sync($request->labels ?? []);
        flash('Task updated successfully')->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task->created_by_id !== auth()->id()) {
            flash('You are not authorized to delete this task')->error();
            return redirect()->route('tasks.index');
        }
        $task->delete();
        flash('Task deleted successfully')->success();
        return redirect()->route('tasks.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        return view('task_statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:task_statuses|min:1',
        ]);
        TaskStatus::create($request->all());
        flash(__('Task status created successfully'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $request->validate([
            'name' => 'required|min:1|unique:task_statuses,name,' . $taskStatus->id,
        ]);
        $taskStatus->update($request->all());
        flash(__('Task status updated successfully'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
{
    if ($taskStatus->tasks()->exists()) {
        flash('Не удалось удалить статус')->error();
        return redirect()->route('task_statuses.index');
    }
    $taskStatus->delete();
    flash('Task status deleted successfully')->success();
    return redirect()->route('task_statuses.index');
}
}

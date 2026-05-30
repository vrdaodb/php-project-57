<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:labels|min:1',
        ]);
        Label::create($request->all());
        flash('Метка успешно создана')->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $request->validate([
            'name' => 'required|min:1|unique:labels,name,' . $label->id,
        ]);
        $label->update($request->all());
        flash('Метка успешно обновлена')->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash('Не удалось удалить метку')->error();
            return redirect()->route('labels.index');
        }
        $label->delete();
        flash('Метка успешно удалена')->success();
        return redirect()->route('labels.index');
    }
}

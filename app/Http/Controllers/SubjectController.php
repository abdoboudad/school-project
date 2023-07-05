<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('admin.subjects.create',compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level_id'=>'required'
        ]);

        Subject::create($request->all());

        return redirect()->back()
            ->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $levels = Level::all();
        return view('admin.subjects.edit', compact('subject','levels'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $subject->update($request->all());

        return redirect()->back()
            ->with('success', 'la matière modifier avec succès.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()
            ->with('success', 'la matière suprimer avec succès.');
    }
    public function subjectsfind($name){
        $level = Level::where('name',$name)->first();
        return view('admin.subjects.show', compact('level'));
    }
}

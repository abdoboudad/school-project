<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class SectionController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('admin.sections.create', compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level_id' => 'required',
        ]);

        Section::create($request->all());

        return redirect()->back()
            ->with('success', 'la classe créé avec succès.');
    }

    public function show(Section $section)
    {
    }

    public function edit(Section $section)
    {
        $levels = Level::all();
        return view('admin.sections.edit', compact('section', 'levels'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required',
            'level_id' => 'required',
        ]);

        $section->update($request->all());

        return redirect()->back()
            ->with('success', 'la classe modifier avec succès.');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->back()
            ->with('success', 'la classe supprimer avec succès.');
    }

    public function sectionsfind($name){
        if ($name != null) {
            $level = Level::where('name', $name)->first();
            if ($level) {
                return view('admin.sections.show', compact('level'));
            } else {
                abort(404); // Return "Not Found" page
            }
        } else {
            abort(404); // Return "Not Found" page
        }

    }

    public function fetchdata($name){
        header('Access-Control-Allow-Origin: *');
        $sections = Level::find($name)->sections;
        return response()->json($sections);
    }
}

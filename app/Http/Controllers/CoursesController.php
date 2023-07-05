<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Level;
use App\Models\Subject;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    use FileTrait;
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function index()
    {
    }

    public function create()
    {
        $subjects = Subject::all();
        $levels = Level::all();
        return view('admin.courses.create', compact('subjects','levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'max:2048',
            'level'=>'required',
            'type'=>'required',
            'subject_id' => 'required', 
        ]);
        $thumbnail = $this->getData($request,'thumbnail');
        $img = $this->getData($request,'imgs');
        $file = $this->getData($request,'docs');

        Courses::create([
            'title'=>$request->title,
            'type'=>$request->type,
            'thumbnail'=>$thumbnail,
            'photo'=>$img,
            'file'=>$file != null ? implode('',$file) : '',
            'link'=>$request->link,
            'text'=>$request->text,
            'status'=>$request->status != null ? $request->status : 'not active',
            'subject_id'=>$request->subject_id,
        ]);

        return redirect()->back()
            ->with('success', 'Lesson crèe avec succès.');
        return $img;
    }

    public function show(Courses $lesson)
    {
        return view('lessons.show', compact('lesson'));
    }

    public function edit(Courses $lesson,$id)
    {
        $levels = Level::all();
        $course = Courses::findOrFail($id);
        return view('admin.courses.edit', compact('course', 'levels'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'level'=>'required',
            'type'=>'required',
            'subject_id' => 'required', 
        ]);
        $thumbnail = $this->getData($request,'thumbnail');
        $img = $this->getData($request,'imgs');
        $file = $this->getData($request,'docs');

        Courses::findOrFail($id)->update([
            'title'=>$request->title,
            'type'=>$request->type,
            'thumbnail'=>$thumbnail,
            'photo'=>$img,
            'file'=>$file != null ? implode('',$file) : '',
            'link'=>$request->link,
            'text'=>$request->text,
            'status'=>$request->status != null ? $request->status : 'not active',
            'subject_id'=>$request->subject_id,
        ]);

        return redirect()->back()
            ->with('success', 'Lesson modifier avec succès.');
    }

    public function destroy(Courses $lesson,$id)
    {
        Courses::findOrFail($id)->delete();
        return redirect()->back()
            ->with('success', 'Lesson supprimer avec succès.');
    }

    public function fetch($id){
        header('Access-Control-Allow-Origin: *');
        $sections = Level::find($id)->subjects;
        return response()->json($sections);
    }

    public function courses($id){
        $courses = Subject::findOrFail($id)->courses;
        return view('admin.courses.index',compact('courses'));
    }

    public function exams($id){
        $courses = Subject::findOrFail($id)->courses;
        return view('admin.exams.index',compact('courses'));
    }

    public function readcourse($id){
        $course = Courses::findOrFail($id);
        return view('admin.courses.show',['course'=>$course]); 
    }
}

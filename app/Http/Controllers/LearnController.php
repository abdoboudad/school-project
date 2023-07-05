<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearnController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function subjects(){
        $level =  Level::where('name',Auth::user()->level)->first();
        $number = Courses::where('type','cours')->get();
        return view('admin.learn.course.subjects',compact('level','number'));
    } 
    public function courses($id){
        $courses =  Subject::find($id)->courses;
        return view('admin.learn.course.courses',compact('courses'));
    }
    public function examsub(){
        $level =  Level::where('name',Auth::user()->level)->first();
        return view('admin.learn.exam.subjects',compact('level'));
    } 
    public function exams($id){
        $exams =  Subject::find($id)->courses;
        return view('admin.learn.exam.exams',compact('exams'));
    }
}

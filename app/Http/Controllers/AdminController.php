<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('role','admin')->get();
        $teachers = User::where('role','teacher')->get();
        $students =  User::where('role','student')->get();
        return view('admin.index',compact('admins','teachers','students'));
    }

}

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class,'index'])->name('admin');
    Route::post('status/{id}', [ProfileController::class,'status'])->name('status');
    Route::get('user/profile/{name}', [ProfileController::class,'profile'])->name('profile');

    Route::resource('users',UserController::class)->middleware('admin');
    Route::post('profile/updatePassword',[ProfileController::class,'updatePassword'])->name('profile.updatePassword');

    Route::resource('courses',CoursesController::class)->middleware('Teacher');
    Route::get('courses/fetch/{id}',[CoursesController::class,'fetch'])->name('courses.fetch');
    Route::get('courses/getcourses/{id}',[CoursesController::class,'courses'])->name('courses.getcourses'); 
    Route::get('courses/getexams/{id}',[CoursesController::class,'exams'])->name('courses.exams');
    Route::get('courses/course/{id}',[CoursesController::class,'readcourse'])->name('courses.course');
    
    Route::resource('levels',LevelController::class)->middleware('admin');
    
    Route::resource('sections',SectionController::class)->middleware('admin');
    Route::get('sections/sectionsfind/{id}',[SectionController::class,'sectionsfind'])->name('sections.sectionsfind');
    Route::get('sections/fetchdata/{id}',[SectionController::class,'fetchdata'])->name('sections.fetchdata');
    
    Route::resource('subjects',SubjectController::class)->middleware('admin');
    Route::get('subjects/subjectsfind/{id}',[SubjectController::class,'subjectsfind'])->name('subjects.subjectsfind');
    
    Route::get('learn/subjects',[LearnController::class,'subjects'])->name('learn.subjects');
    Route::get('learn/courses/{id}',[LearnController::class,'courses'])->name('learn.courses');
    Route::get('learn/examsub',[LearnController::class,'examsub'])->name('learn.examsub');
    Route::get('learn/exams/{id}',[LearnController::class,'exams'])->name('learn.exams');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

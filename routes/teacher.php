<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Teacher;
use App\Http\Controllers\Teachers\dashboard\StudentController;
use App\Http\Controllers\Teachers\dashboard\QuizzeController;
use App\Http\Controllers\Teachers\dashboard\QeustionController;
use App\Http\Controllers\Teachers\dashboard\OnlineController;


/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {

        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= \App\Models\Student::whereIn('section_id',$ids)->count();
        $data['Students']=\App\Models\Student::whereIn('section_id',$ids)->get();

        return view('Pages.teachers.dashboard',$data);

    });

    Route::group(['namespace' => 'Teachers\dashboard'], function () {
        //==============================students============================
        Route::get('student',[StudentController::class,'index'])->name('student.index');
        Route::get('section',[StudentController::class,'sections'])->name('sections');
        Route::post('attendance',[StudentController::class,'attendance'])->name('attendance');
        Route::post('edit_attendance',[StudentController::class,'editAttendance'])->name('attendance.edit');
        Route::get('attendance_report',[StudentController::class,'attendanceReport'])->name('attendance.report');
        Route::post('attendance_report',[StudentController::class,'attendanceSearch'])->name('attendance.search');

        Route::get('quizes',[QuizzeController::class,'index'])->name('quizes.index');
        Route::get('quizes/{id}',[QuizzeController::class,'show'])->name('quizes.show');
        Route::post('quizes',[QuizzeController::class,'store'])->name('quizes.store');
        Route::put('quizes/{id}',[QuizzeController::class,'update'])->name('quizes.update');
        Route::delete('quizes/{id}',[QuizzeController::class,'destroy'])->name('quizes.destroy');
        Route::get('getNotes/{id}',[QuizzeController::class,'getNotes'])->name('getNotes.show');
        Route::post('repeat_quizze',[QuizzeController::class,'repeat_quizze'])->name('repeat_quizze');

        Route::get('question',[QeustionController::class,'index'])->name('question.index');
        Route::post('question',[QeustionController::class,'store'])->name('question.store');
        Route::put('question/{id}',[QeustionController::class,'update'])->name('question.update');
        Route::delete('question/{id}',[QeustionController::class,'destroy'])->name('question.destroy');

        Route::get('online',[OnlineController::class,'index'])->name('online.index');
        Route::post('online',[OnlineController::class,'store'])->name('online.store');
        Route::put('online/{id}',[OnlineController::class,'update'])->name('online.update');
        Route::delete('online/{id}',[OnlineController::class,'destroy'])->name('online.destroy');

        Route::get('/Get_classrooms/{id}',[QuizzeController::class,'getClassrooms']);
        Route::get('/Get_Sections/{id}',[QuizzeController::class,'Get_Sections']);
        Route::get('/Get_classroomsar/{id}',[QuizzeController::class,'getClassroomsar']);
        Route::get('/Get_Sectionsar/{id}',[QuizzeController::class,'Get_Sectionsar']);
        Route::get('/Get_ssections/{id}', [QuizzeController::class,"Get_ssections"]);
    });

});


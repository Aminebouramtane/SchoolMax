<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Exam;
use App\Http\Controllers\Students\dashboard\ExamController;
use App\Http\Controllers\Students\dashboard\BookstudentController;
use App\Http\Controllers\Students\dashboard\OnlineController;

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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {

        $student = Student::findOrFail(auth()->user()->id);
        $CountSubject = Subject::where('grade_id', $student->grade_id)
            ->where('classe_id', $student->classe_id)
            ->count();
        $CountExams = Exam::where('grade_id', $student->grade_id)
        ->where('classe_id', $student->classe_id)
        ->where('section_id', $student->section_id)
        ->count();


        return view('Pages.students.dashboard',compact('CountSubject','CountExams'));
        // return $CountSubject;
    });

    Route::group(['namespace' => 'Students\dashboard'], function () {

        Route::get('examstudents',[ExamController::class,'index'])->name('examstudents');
        Route::get('examstudents/{id}',[ExamController::class,'show'])->name('examstudents.show');
        Route::post('examstudents',[ExamController::class,'store'])->name('examstudents.store');
        Route::put('examstudents/{id}',[ExamController::class,'update'])->name('examstudents.update');
        Route::delete('examstudents/{id}',[ExamController::class,'destroy'])->name('examstudents.destroy');

        Route::get('bookStudents',[BookstudentController::class,'index'])->name('bookStudents');
        Route::get('bookStudents/{filename}',[BookstudentController::class,'downloadAttachmentStudent'])->name('downloadAttachmentStudent');

        Route::get('onlineClasse',[OnlineController::class,'index'])->name('onlineClasse');

    });

});



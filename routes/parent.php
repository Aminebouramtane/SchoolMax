<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prents\dashboard\MychildrenController;
use App\Models\Student;

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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:add_parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons=Student::where("parent_id",auth()->user()->id)->get();
        return view('Pages.parents.dashboard',compact("sons"));
    });

    Route::group(['namespace' => 'Prents\dashboard'], function () {

        Route::get('mychildren',[MychildrenController::class,'index'])->name('mychildren.index');
        Route::get('mychildren/{id}',[MychildrenController::class,'show'])->name('mychildren.show');
        Route::get('childrenattendances',[MychildrenController::class,'attendances'])->name('children.attendances');
        Route::post('childrenattendances',[MychildrenController::class,'attendanceSearch'])->name('children.attendance.search');

    });

});


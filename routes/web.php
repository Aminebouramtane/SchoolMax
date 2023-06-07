<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AddParentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\GraduatController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeesInvoiceController;
use App\Http\Controllers\ReceiptStudentController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\PaymentStudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SpecialitController;
use App\Http\Controllers\OnlineClasseController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Calendar;



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
//Auth::routes();
Route::get('/',[HomeController::class,'index'])->name('selection');
Route::group(['namespace' => 'Auth'], function () {

Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');

Route::post('/login',[LoginController::class,'login'])->name('login');

Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');

});


Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,"auth" ]
], function(){


	Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
	Route::resource('grades', GradeController::class);
	//Classes
	Route::resource('classes', ClasseController::class);
	Route::post('classes/supp', [ClasseController::class, 'supp'])->name("supp");
	Route::post('classes/updatee', [ClasseController::class, 'updatee'])->name("updatee");
	Route::post('classes/classedelete_all', [ClasseController::class, 'delete_all'])->name("delete_all");
	//end classes
	// ===================================================================================================
	//sections
	Route::resource('sections', SectionController::class);

	Route::get('/classess/{id}', [SectionController::class,"classess"]);
	Route::get('/ssections/{id}', [OnlineClasseController::class,"ssections"]);
	Route::get('/classessar/{id}', [SectionController::class,"classessar"]);
	Route::get('/ssectionsar/{id}', [OnlineClasseController::class,"ssectionsar"]);

	Route::get('/Get_classess/{id}', [SectionController::class,"Get_classess"]);
	Route::get('/Get_ssections/{id}', [OnlineClasseController::class,"Get_ssections"]);
	Route::get('/Get_classessar/{id}', [SectionController::class,"Get_classessar"]);
	Route::get('/Get_ssectionsar/{id}', [SectionController::class,"Get_ssectionsar"]);
	//Parents
	Route::resource('addparents', AddParentController::class);
	//Teachers
	Route::resource('teachers', TeacherController::class);
	//specilits
	Route::resource('specilits',SpecialitController::class);
	//Students
	Route::resource('students', StudentController::class);
	Route::get('/Get_classrooms/{id}', [StudentController::class,'Get_classrooms']);
	Route::get('/Get_Sections/{id}', [StudentController::class,'Get_Sections']);
	// Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
    // Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');

			//Student----->Promotion :
			Route::resource('promotions', PromotionController::class);
			Route::post('promotions/rollback', [PromotionController::class,"rollback"])->name("rollback");
			//Student----->Graduat :
			Route::resource('graduats', GraduatController::class);

	//Fees
	Route::resource('fees', FeeController::class);
	//Fees_invoice
	Route::resource('fees_invoices', FeesInvoiceController::class);
	//receipt_students
	Route::resource('receipt_students',ReceiptStudentController::class);
	//processing_fees
	Route::resource('processing_fees',ProcessingFeeController::class);
	//payment_fees
	Route::resource('payment_fees',PaymentStudentController::class);
	//attendances
	Route::resource('attendances',AttendanceController::class);
	//Subjects
	Route::resource('subjects',SubjectController::class);
	//exam
	Route::resource('exams',ExamController::class);
	//Questions
	Route::resource('questions',QuestionController::class);
	//online_classes
	Route::resource('online_classes',OnlineClasseController::class);
	//Books
	Route::resource('library',BookController::class);
    Route::get('download_file/{filename}', [BookController::class,'download'])->name('downloadAttachment');
    // Livewire
    Livewire::component('calendar', Calendar::class);



});









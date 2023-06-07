<?php

namespace App\Http\Controllers\Prents\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Degree;
use App\Models\Teacher;
use App\Models\Attendance;

class MychildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Students=Student::where("parent_id",auth()->user()->id)->get();
        return view("Pages.parents.parent_pages.children",compact("Students"));
    }

    public function attendances()
    {
        $Students=Student::where("parent_id",auth()->user()->id)->get();
        return view("Pages.parents.parent_pages.attendances",compact("Students"));
    }

    public function show($id)
    {
        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error('يوجد خطا في كود الطالب');
            return redirect()->route('mychildren.index');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error('لا توجد نتائج لهذا الطالب');
            return redirect()->route('mychildren.index');
        }
        return view('Pages.parents.parent_pages.result', compact('degrees'));
    }

    public function attendanceSearch(Request $request){

        $request->validate([
            'from'  =>'required|date|date_format:Y-m-d',
            'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
        ],[
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        $Students=Student::where("parent_id",auth()->user()->id)->get();
        $ids=Student::where("parent_id",auth()->user()->id)->pluck("id");
        // $Students = Student::whereIn('parent', $ids)->get();

        if ($request->student_id == 0) {
            $Attendances = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->whereIn('student_id', $ids)
                ->get();
            return view('Pages.parents.parent_pages.attendances', compact('Students', 'Attendances'));
        } else {
            $Attendances = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('Pages.parents.parent_pages.attendances', compact('Students', 'Attendances'));
        }
    }
}

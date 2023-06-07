<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Section;
use App\Models\Attendance;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $Students = Student::whereIn('section_id',$ids)->get();
        $Students = Student::whereIn('section_id', function ($query) {
            $query->select('section_id')
                ->from('teachers_sections')
                ->whereIn('teacher_id', function ($query) {
                    $query->select('id')
                        ->from('teachers')
                        ->where('id', auth()->user()->id);
                });
        })->get();


        // $teacherId = auth()->user()->id;

        // $Students = Student::whereHas('sections.teachers', function ($query) use ($teacherId) {
        //     $query->where('teachers.id', $teacherId);
        // })->get();


        return view('Pages.teachers.teacher_pages.student',compact('Students'));
    }




    public function sections()
    {
        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $Sections = Section::whereIn('id', $ids)->get();
        return view('Pages.teachers.teacher_pages.section', compact('Sections'));
    }


    public function attendance(Request $request)
    {
        try {
        $attenddate = date('Y-m-d');
        foreach ($request->attendences as $studentid => $attendence) {

            if( $attendence == 'presence' ) {
                $attendence_status = true;
            } else if( $attendence == 'absent' ){
                $attendence_status = false;
            }

            Attendance::updateorCreate(
                [
                    'student_id'=> $studentid,
                    'attendence_date' => $attenddate
                ],[
                'student_id'=> $studentid,
                'grade_id'=> $request->grade_id,
                'classe_id'=> $request->classe_id,
                'section_id'=> $request->section_id,
                'teacher_id'=> 1,
                'attendence_date'=> date('Y-m-d'),
                'attendence_status'=> $attendence_status
            ]);
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route("student.index");

        }

        catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function editAttendance(Request $request){

    try{
            $date = date('Y-m-d');
            $student_id = Attendance::where('attendence_date',$date)->where('student_id',$request->id)->first();
            if( $request->attendences == 'presence' ) {
                $attendence_status = true;
            } else if( $request->attendences == 'absent' ){
                $attendence_status = false;
            }
            $student_id->update([
                'attendence_status'=> $attendence_status
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function attendanceReport()
    {
        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $Students = Student::whereIn('section_id',$ids)->get();
        return view('Pages.teachers.teacher_pages.attendanceReport',compact('Students'));
    }


    // public function attendanceSearch(Request $request){

    //     // $request->validate([
    //     //     'from'  =>'required|date|date_format:Y-m-d',
    //     //     'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
    //     // ],[
    //     //     'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
    //     //     'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
    //     //     'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
    //     // ]);

    //     $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
    //     $Students = Student::whereIn('section_id',$ids)->get();

    //     if($request->student_id == 0){
    //         $Attendances = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
    //         // return view('Pages.teachers.teacher_pages.attendanceReport',compact('Students','Attendances'));
    //         return $Attendances;
    //     }else{
    //         $Attendances = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
    //         ->where('student_id',$request->student_id)->get();
    //         return view('Pages.teachers.teacher_pages.attendanceReport',compact('Students','Attendances'));
    //     }
    // }


    public function attendanceSearch(Request $request){

            $request->validate([
                'from'  =>'required|date|date_format:Y-m-d',
                'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
            ],[
                'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
                'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
                'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            ]);

            $ids = Teacher::findOrFail(auth()->user()->id)->Sections()->pluck('section_id');
            $Students = Student::whereIn('section_id', $ids)->get();

            if ($request->student_id == 0) {

                $Attendances = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
                return view('Pages.teachers.teacher_pages.attendanceReport', compact('Students', 'Attendances'));
            } else {
                $Attendances = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                    ->where('student_id', $request->student_id)->get();
                return view('Pages.teachers.teacher_pages.attendanceReport', compact('Students', 'Attendances'));
            }
}












    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

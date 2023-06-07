<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Section;
use App\Models\Grade;
use App\Models\Classe;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $Grade=Grade::with(["Sections"])->get();
        $Grade_list=Grade::all();
        $teachers=Teacher::all();
        return view("Pages.Attendance.Section",compact("Grade","Grade_list","teachers"));
    }

    public function store(Request $request)
    {
        try {

        foreach ($request->attendences as $studentid => $attendence) {

            if( $attendence == 'presence' ) {
                $attendence_status = true;
            } else if( $attendence == 'absent' ){
                $attendence_status = false;
            }

            Attendance::create([
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
        return redirect()->route("attendances.index");

        }

        catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $Students = Student::with('Attendances')->where('section_id',$id)->get();
        return view("Pages.Attendance.attendance_student",compact("Students"));
    }

    public function edit(Attendance $attendance)
    {
        //
    }

    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    public function destroy(Attendance $attendance)
    {
        //
    }
}

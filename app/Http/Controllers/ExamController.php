<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    public function index()
    {
        $Exams = Exam::all();
        $grades = Grade::all();
        $Teachers = Teacher::all();
        $Subjects = Subject::all();
        return view('Pages.Exams.exam', compact('Exams','grades','Teachers','Subjects'));
    }

    public function store(Request $request)
    {
        try {
            $exams = new Exam();
            $exams->exam_name_en = $request->exam_name_en;
            $exams->exam_name_ar = $request->exam_name_ar;
            $exams->subject_id = $request->subject_id;
            $exams->grade_id = $request->grade_id;
            $exams->classe_id = $request->classe_id;
            $exams->section_id = $request->section_id;
            $exams->teacher_id = $request->teacher_id;
            $exams->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('exams.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $exam = Exam::findorFail($id);
            $exam->exam_name_en = $request->exam_name_en;
            $exam->exam_name_ar = $request->exam_name_ar;
            $exam->subject_id = $request->subject_id;
            $exam->grade_id = $request->grade_id;
            $exam->classe_id = $request->classe_id;
            $exam->section_id = $request->section_id;
            $exam->teacher_id = $request->teacher_id;
            $exam->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('exams.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Exam::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

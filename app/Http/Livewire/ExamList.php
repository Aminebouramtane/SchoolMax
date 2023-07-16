<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExamList extends Component
{
    public function index()
    {
        $Exams = Exam::where('teacher_id',auth()->user()->id)->get();
        $grades = Grade::all();
        $Teachers = Teacher::all();
        $Subjects = Subject::all();
        return view('Pages.teachers.teacher_pages.exam.quizze', compact('Exams','grades','Teachers','Subjects'));
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
            $exams->teacher_id = auth()->user()->id;
            $exams->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('quizes.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $Questions = Question::where('exam_id',$id)->get();
        $Exams = Exam::findorFail($id);
        return view('Pages.teachers.teacher_pages.exam.question',compact('Questions','Exams'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $exam = Exam::findorFail($id);
            $exam->exam_name_en = $request->exam_name_en;
            $exam->exam_name_ar = $request->exam_name_ar;
            $exam->subject_id = $request->subject_id;
            $exam->grade_id = $request->grade_id;
            $exam->classe_id = $request->classe_id;
            $exam->section_id = $request->section_id;
            $exam->teacher_id = auth()->user()->id;
            $exam->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('quizes.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            Exam::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getClassrooms($id)
    {
            $list_classes = Classe::where("grade_id", $id)->pluck("classe_name_en","id");
            return $list_classes;
    }

    public function Get_Sections($id){
            $list_sections = Section::where("classe_id", $id)->pluck("section_name_en", "id");
            return $list_sections;
    }

    public function getClassroomsar($id)
    {
            $list_classes = Classe::where("grade_id", $id)->pluck("classe_name_ar","id");
            return $list_classes;
    }

    public function Get_Sectionsar($id){
            $list_sections = Section::where("classe_id", $id)->pluck("section_name_ar", "id");
            return $list_sections;
    }



    public function getNotes($exam_id)
    {
        $degrees = Degree::where('exam_id', $exam_id)->get();
        return view('Pages.teachers.teacher_pages.exam.notes', compact('degrees'));
    }

    public function repeat_quizze(Request $request)
    {
        Degree::where('student_id', $request->student_id)->where('exam_id', $request->exam_id)->delete();
        toastr()->success('is open again');
        return redirect()->back();
    }

    
    public function Get_ssections($id){

        $list_sections = Section::where("classe_id", $id)->pluck("section_name_en", "id");
        return $list_sections;
    }
    public function render()
    {
        return view('livewire.exam-list');
    }
}

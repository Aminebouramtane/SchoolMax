<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Grade;



class GraduatRepository implements GraduatRepositoryInterface
{

    public function getGraduat(){
        $Students = Student::onlyTrashed()->get();
        return view("Pages.students.graduats.list_graduat",compact("Students"));
    }
    public function createGraduat(){
        $grades = Grade::all();
        return view("Pages.students.graduats.add_graduat",compact("grades"));
    }

    public function SoftDelete($request)
    {
        $students = Student::where('grade_id',$request->grade_id)->where('classe_id',$request->classe_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            Student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route('graduats.index');
    }

    public function Restore($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->restore();
        toastr()->success(trans('data return successfully'));
        return redirect()->back();
    }
    public function RestoreAll()
    {
        Student::onlyTrashed()->restore();
        toastr()->success(trans('All deleted students have been restored successfully.'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        student::onlyTrashed()->where('id', $id)->first()->forceDelete();
        toastr()->error(trans('data deleted sucessfully'));
        return redirect()->back();
    }


}
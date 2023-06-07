<?php

namespace App\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Add_parent;

class StudentRepository implements StudentRepositoryInterface
{

    public function getAllStudents(){
        $Students = Student::all();
        return view("Pages.students.students",compact("Students"));
    }

    public function CreateStudents(){
        $data['grades'] = Grade::all();
        $data['parents'] = Add_parent::all();
        return view("Pages.students.add_students",$data);
    }

    public function Get_classrooms($id){

        $list_classes = Classe::where("grade_id", $id)->pluck("classe_name_en", "id");
        return $list_classes;

    }

    //Get Sections
    public function Get_Sections($id){

        $list_sections = Section::where("classe_id", $id)->pluck("section_name_en", "id");
        return $list_sections;
    }


    public function StoreStudent($request){
        try {
                $photoName = null;
                $validated = $request->validate([
                    "photo"=>"image|mimes:png,jpg,jpeg",
                ]);


                if(isset($request->photo)){
                    $photoName = time().'.'.$request->photo->extension();
                    $request->photo->storeAs('photos', $photoName);
                }

                $students=new Student ;
                $students->student_name_en=$request->student_name_en;
                $students->student_name_ar=$request->student_name_ar;
                $students->email=$request->email;
                $students->password=Hash::make($request->password);
                $students->birthday=$request->birthday;
                $students->phone=$request->phone;
                $students->adress_en=$request->adress_en;
                $students->adress_ar=$request->adress_ar;
                $students->cin=$request->cin;
                $students->sexe=$request->sexe;
                $students->season=$request->season;

                $students->parent_id=$request->parent_id;
                $students->grade_id=$request->grade_id;
                $students->classe_id=$request->classe_id;
                $students->section_id=$request->section_id;

                $students->photo=$photoName;
                $students->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->route("students.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }
    }

    public function DeleteStudent($id){
        try{
            $students=Student::find($id);
            $students->delete();
            toastr()->error('Data has been Deleted successfully!');
            return redirect()->route("students.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }


    public function UpdateStudent($request,$id){
            try {
                $students = Student::findOrFail($id);
                $photoName = $students->photo;
                $validated = $request->validate([
                    "photo"=>"image|mimes:png,jpg,jpeg",
                    "email"=>"required|email"
                ]);
                if ($request->hasFile('photo')) {
                    // Delete old photo if it exists
                    if ($students->photo) {
                        Storage::delete('photos/' . $students->photo);
                    }
                // Store new photo
                $photoName = time() . '.' . $request->photo->extension();
                $request->photo->storeAs('photos', $photoName);
                }
                $students->student_name_en=$request->student_name_en;
                $students->student_name_ar=$request->student_name_ar;
                $students->email=$request->email;
                $students->password=Hash::make($request->password);
                $students->birthday=$request->birthday;
                $students->phone=$request->phone;
                $students->adress_en=$request->adress_en;
                $students->adress_ar=$request->adress_ar;
                $students->cin=$request->cin;
                $students->sexe=$request->sexe;
                $students->season=$request->season;
                $students->parent_id=$request->parent_id;
                $students->grade_id=$request->grade_id;
                $students->classe_id=$request->classe_id;
                $students->section_id=$request->section_id;

                $students->photo=$photoName;
                $students->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->route("students.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }
    }


    public function EditTeacher($id){
        $data['Students'] =  Student::find($id);
        $data['grades'] = Grade::all();
        $data['parents'] = Add_parent::all();
        return view("Pages.students.edit_student",$data);
    }
}

<?php

namespace App\Repository;
use App\Models\Teacher;
use App\Models\Specialit;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeachers(){
        return Teacher::all();
    }
    public function CreateTeacher(){
        return Specialit::all();
    }
    public function StoreTeacher($request){
        try {
                $photoName = null;
                $validated = $request->validate([
                    "photo"=>"image|mimes:png,jpg,jpeg",
                ]);


                if(isset($request->photo)){
                    $photoName = time().'.'.$request->photo->extension();
                    $request->photo->storeAs('photos', $photoName);
                }

                $teachers=new Teacher ;
                $teachers->teacher_name_en=$request->teacher_name_en;
                $teachers->teacher_name_ar=$request->teacher_name_ar;
                $teachers->email=$request->email;
                $teachers->password=Hash::make($request->password);
                $teachers->birthday=$request->birthday;
                $teachers->phone=$request->phone;
                $teachers->adress_en=$request->adress_en;
                $teachers->adress_ar=$request->adress_ar;
                $teachers->cin=$request->cin;
                $teachers->specialit_id=$request->specialit;
                $teachers->sexe=$request->sexe;
                $teachers->photo=$photoName;
                $teachers->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->route("teachers.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }        
    }


    public function UpdateTeacher($request,$id){
            try {
                $teachers = Teacher::findOrFail($id);
                $photoName = $teachers->photo;
                $validated = $request->validate([
                    "photo"=>"image|mimes:png,jpg,jpeg",
                    "email"=>"required|email"
                ]);
                if ($request->hasFile('photo')) {
                    // Delete old photo if it exists
                    if ($teachers->photo) {
                        Storage::delete('photos/' . $teachers->photo);
                    }
                // Store new photo
                $photoName = time() . '.' . $request->photo->extension();
                $request->photo->storeAs('photos', $photoName);
                }
                $teachers->teacher_name_en=$request->teacher_name_en;
                $teachers->teacher_name_ar=$request->teacher_name_ar;
                $teachers->email=$request->email;
                $teachers->password=Hash::make($request->password);
                $teachers->birthday=$request->birthday;
                $teachers->phone=$request->phone;
                $teachers->adress_en=$request->adress_en;
                $teachers->adress_ar=$request->adress_ar;
                $teachers->cin=$request->cin;
                $teachers->specialit_id=$request->specialit;
                $teachers->sexe=$request->sexe;
                $teachers->photo=$photoName;
                $teachers->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->route("teachers.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }        
    }


    public function EditTeacher($id){
        return Teacher::find($id);
    }


    public function DestroyTeacher($id){
        try{
            $teachers=Teacher::find($id);
            $teachers->delete();
            toastr()->error('Data has been Deleted successfully!'); 
            return redirect()->route("teachers.index");        
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}

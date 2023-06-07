<?php

namespace App\Http\Controllers;


use App\Models\Grade;
use App\Models\Classe;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        $grade= Grade::all();
        return view("Pages.grades.grades",compact("grade"));            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
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
        if (Grade::WHERE("grade_name_en",$request->grade_name_en)->orWhere("grade_name_ar",$request->grade_name_ar)->exists()) {
            return redirect()->back()->withErrors("This Grade is already Exists");
        }else{
            try {
                $validated = $request->validate([
                'grade_name_en' => 'required|max:255',
                'grade_name_ar' => 'required|max:255',
                'grade_note' => 'max:255',
                ]);
                $Grade=new grade ;
                $Grade->grade_name_en=$request->grade_name_en;
                $Grade->grade_name_ar=$request->grade_name_ar;
                $Grade->grade_note=$request->grade_note;
                $Grade->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->route("grades.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {

        try {
            // $validated = $request->validate([
            // 'grade_name_ar' => 'required|unique:grades|max:255',
            // 'grade_name_en' => 'required|unique:grades|max:255',
            // 'grade_note' => 'max:255',
            // ]);
        $grade->grade_name_ar=$request->grade_name_ar ;
        $grade->grade_name_en=$request->grade_name_en ;
        $grade->grade_note=$request->grade_note ;
        $grade->save();
        toastr()->info('Data has been updated successfully!');
        return redirect()->route('grades.index');            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $My_grade_has_classes=classe::where('grade_id',$grade->id)->pluck('grade_id');
        if ($My_grade_has_classes->count()==0) {
            try {
            $grade->delete();
            toastr()->error('Data has been Deleted successfully!');
            return redirect()->route("grades.index");            
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }
        }else{
                toastr()->error("This Grade has Classes!! make shoure to delete classes first");
                return redirect()->route("grades.index");
            }
    }
}

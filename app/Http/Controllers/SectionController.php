<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Grade;
use App\Models\Classe;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $Sections=Section::all();
        $Grade=Grade::with(["Sections"])->get();
        $Grade_list=Grade::all();
        $teachers=Teacher::all();
        return view("Pages.sections.sections",compact("Grade","Grade_list","teachers"));
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
        try {
                $Section=new Section ;
                $Section->section_name_en=$request->section_name_en;
                $Section->section_name_ar=$request->section_name_ar;
                $Section->grade_id=$request->grade_id;
                $Section->classe_id=$request->classe_id;
                if ($request->has('active')) {
                    $Section->active=1;
                } else {
                    $Section->active=0;
                }
                $Section->save();
                $Section->Teachers()->attach($request->teacher_id);

                toastr()->success('Data has been saved successfully!');
                return redirect()->route("sections.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }



    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        try {
            $section->section_name_en = $request->section_name_en;
            $section->section_name_ar = $request->section_name_ar;
            $section->grade_id=$request->grade_id;
            $section->classe_id=$request->classe_id;
            if ($request->has('active')) {
                $section->active=1;
            } else {
                $section->active=0;
            }
            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $section->teachers()->sync($request->teacher_id);
            } else {
                $section->teachers()->sync(array());
            }
            $section->save();
            toastr()->success('Data has been saved successfully!');
            return redirect()->route("sections.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        try {
        $section->delete();
        return redirect()->route("sections.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }







////////////////////////////////////////////////////////////////////////////////////////////
    public function Get_classes($id)
    {
        $list_classes = Classe::where("grade_id", $id)->pluck("classe_name_en", "id");
        return $list_classes;
    }

    public function Get_sections($id)
    {
        $list_sections = Section::where("classe_id", $id)->pluck("section_name_en", "id");
        return $list_sections;
    }

////////////////////////////////////////////////////////////////////////////////////////////
    public function Get_classes_ar($id){
        $list_classes = Classe::where("grade_id", $id)->pluck("classe_name_ar", "id");
        return $list_classes;
    }

    public function Get_sections_ar($id){
        $list_sections = Section::where("classe_id", $id)->pluck("section_name_ar", "id");
        return $list_sections;
    }




////////////////////////////////////////////////////////////////////////////////////////////
public function new_classes($id)
    {
        $list_classes = Classe::where("grade_id", $id)->pluck("classe_name_en", "id");
        return $list_classes;
    }

    public function new_sections($id)
    {
        $list_sections = Section::where("classe_id", $id)->pluck("section_name_en", "id");
        return $list_sections;
    }

////////////////////////////////////////////////////////////////////////////////////////////
    public function new_classes_ar($id){
        $list_classes = Classe::where("grade_id", $id)->pluck("classe_name_ar", "id");
        return $list_classes;
    }

    public function new_sections_ar($id){
        $list_sections = Section::where("classe_id", $id)->pluck("section_name_ar", "id");
        return $list_sections;
    }
}

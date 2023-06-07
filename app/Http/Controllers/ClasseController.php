<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Classes= Classe::all();
        $Grades= Grade::all();
        return view("Pages.classes.classes",compact("Classes","Grades"));
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
            $List_Classes = $request->List_Classes;
            // $validated = $request->validate([
            //     "List_Classes.*.classe_name"=> 'required|max:255',
            //     "List_Classes.*.classe_name_en"=> 'required|max:255',
            // // 'classe_name' => 'required|max:255',
            // // 'classe_name_en' => 'required|max:255',
            // ]);
            foreach ($List_Classes as $List_Class) {

                    $My_Classes = new Classe ;
                    $My_Classes->classe_name_en = $List_Class['classe_name_en'];
                    $My_Classes->classe_name_ar = $List_Class['classe_name_ar'];
                    $My_Classes->grade_id = $List_Class['grade_id'];
                    $My_Classes->save();

            }
            toastr()->success('Data has been saved successfully!');
            return redirect()->route("classes.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        try {
            $classe->classe_name_en = $request->classe_name_en;
            $classe->classe_name_ar = $request->classe_name_ar;
            $classe->grade_id = $request->grade_id;
            $classe->save();
            toastr()->success('Data has been saved successfully!');
            return redirect()->route("classes.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        try {
        $classe->delete();
        return redirect()->route("classes.index");            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }

    }
    public function supp(Request $request)
    {
        $Classes= Classe::find($request->id);
        $Classes->delete();
        toastr()->error('Data has been Deleted successfully!');
        return redirect()->route("classes.index");
    }
    public function updatee(Request $request)
    {
        try {
            
            $Classes= Classe::find($request->id);
            $Classes->classe_name_en=$request->classe_name_en;
            $Classes->classe_name_ar=$request->classe_name_ar;
            $Classes->grade_id=$request->grade_id;
            $Classes->save();
            toastr()->success('Data has been updated successfully!');
            return redirect()->route("classes.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    public function delete_all(Request $request)
    {
        try {
        $selectAll=explode(",",$request->delete_all_id);
            $Classes= Classe::whereIn("id",$selectAll);
            $Classes->delete();
            toastr()->success('Data has been deleted successfully!');
            return redirect()->route("classes.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
        // return $selectAll;
    }
}

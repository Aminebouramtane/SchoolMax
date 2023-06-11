<?php

namespace App\Http\Controllers;

use App\Models\Specialit;
use Illuminate\Http\Request;

class SpecialitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Specility = Specialit::all();
        return view("Pages.teachers.speciality",compact("Specility"));
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
            $Specialist = New Specialit;
            $Specialist->specialit_name_en=$request->specialit_name_en;
            $Specialist->specialit_name_ar=$request->specialit_name_ar;
            $Specialist->save();
            return redirect()->route("specilits.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Specialit $specialit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialit $specialit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $Specalist=Specialit::find($id);
            $Specalist->specialit_name_en = $request->specialit_name_en;
            $Specalist->specialit_name_ar = $request->specialit_name_ar;
            $Specalist->save();
            toastr()->success('Data has been saved successfully!');
            return redirect()->route("specilits.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $Specialist = Specialit::find($id);
            $Specialist->delete();
            toastr()->error('Data has been deleted successfully!');
            return redirect()->route("specilits.index");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}

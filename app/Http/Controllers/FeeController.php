<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use App\Models\Grade;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grade_list = Grade::all();
        $Fees = Fee::all();
        return view("Pages.fees.list_fees",compact("Grade_list","Fees"));
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

                $fees=new Fee ;
                $fees->fees_name_en=$request->fees_name_en;
                $fees->fees_name_ar=$request->fees_name_ar;
                $fees->amount=$request->amount;
                $fees->grade_id=$request->Grade_id;
                $fees->classe_id=$request->Class_id;
                $fees->season=$request->season;
                $fees->note=$request->note;
                $fees->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->route("fees.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fee $fee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $fee=Fee::find($id);
            $fee->fees_name_en=$request->fees_name_en;
            $fee->fees_name_ar=$request->fees_name_ar;
            $fee->amount=$request->amount;
            $fee->grade_id=$request->Grade_id;
            $fee->classe_id=$request->Class_id;
            $fee->season=$request->season;
            $fee->note=$request->note;
            $fee->save();
        toastr()->info('Data has been updated successfully!');
        return redirect()->route('fees.index');           
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
        // return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee)
    {
        try{
            // $fee=Teacher::find($id);
            $fee->delete();
            toastr()->error('Data has been Deleted successfully!'); 
            return redirect()->route("fees.index");        
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}

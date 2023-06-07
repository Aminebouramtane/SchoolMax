<?php

namespace App\Http\Controllers;

use App\Models\Add_parent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AddParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Parents=Add_parent::all();
        return view("Pages.parents.parents",compact("Parents"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
         return view("Pages.parents.add_parent");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $photoName = null; // define $photoName here

            $validated = $request->validate([
                "photo"=>"image|mimes:png,jpg,jpeg"
            ]);

            if(isset($request->photo)){
                $photoName = time().'.'.$request->photo->extension();
                $request->photo->storeAs('photos', $photoName);
            }

                $Parent=new Add_parent ;
                $Parent->parent_name_en=$request->parent_name_en;
                $Parent->parent_name_ar=$request->parent_name_ar;
                $Parent->email=$request->email;
                $Parent->password=Hash::make($request->password);
                $Parent->birthday=$request->birthday;
                $Parent->phone=$request->phone;
                $Parent->adress_en=$request->adress_en;
                $Parent->adress_ar=$request->adress_ar;
                $Parent->cin=$request->cin;
                $Parent->jobe_en=$request->jobe_en;
                $Parent->jobe_ar=$request->jobe_ar;
                $Parent->sexe=$request->sexe;
                $Parent->photo=$photoName;
                $Parent->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->route("addparents.index");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["error" => $e->getMessage()]);
            }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Add_parent $add_parent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $add_parent=Add_parent::find($id);
        return view("Pages.parents.edit_parent",compact("add_parent"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                    "photo"=>"image|mimes:png,jpg,jpeg",
                    "email"=>"required|email"
                ]);
            $add_parent = Add_parent::findOrFail($id);

            $photoName = $add_parent->photo; // define $photoName here

            if ($request->hasFile('photo')) {
                // Delete old photo if it exists
                if ($add_parent->photo) {
                    Storage::delete('photos/' . $add_parent->photo);
                }
            // Store new photo
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('photos', $photoName);
            }
            $add_parent->parent_name_en=$request->parent_name_en;
            $add_parent->parent_name_ar=$request->parent_name_ar;
            $add_parent->email=$request->email;
            $add_parent->password=Hash::make($request->password);
            $add_parent->birthday=$request->birthday;
            $add_parent->phone=$request->phone;
            $add_parent->adress_en=$request->adress_en;
            $add_parent->adress_ar=$request->adress_ar;
            $add_parent->cin=$request->cin;
            $add_parent->jobe_en=$request->jobe_en;
            $add_parent->jobe_ar=$request->jobe_ar;
            $add_parent->sexe=$request->sexe;
            $add_parent->photo=$photoName;
            $add_parent->save();
            return redirect()->route('addparents.index');            
        } catch (\Exception $e) {
            return redirect()->route('addparents.index')->withErrors(["error" => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        $add_parent = Add_parent::findOrFail($id);
        $add_parent->delete();
        return redirect()->route("addparents.index");            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}

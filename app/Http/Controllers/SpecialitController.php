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
        //
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
    public function update(Request $request, Specialit $specialit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialit $specialit)
    {
        //
    }
}

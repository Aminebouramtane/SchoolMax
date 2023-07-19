<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Online_classe;

class OnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student =Student::where("id",auth()->user()->id)->first();
        $online_classes = Online_classe::where('grade_id', $student->grade_id)
        ->where('classe_id', $student->classe_id)
        ->where('section_id', $student->section_id)
        ->get();
        return view('Pages.students.students_pages.online_classes.online',compact('online_classes'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

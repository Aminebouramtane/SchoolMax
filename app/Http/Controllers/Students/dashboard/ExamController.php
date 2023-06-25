<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Teacher;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher =Teacher::find(auth()->user()->id);
        $Exams = Exam::where('grade_id', $teacher->grade_id)
            ->where('classe_id', $teacher->classe_id)
            ->where('section_id', $teacher->section_id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('Pages.students.students_pages.exams.index', compact('Exams'));
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
    public function show($exam_id)
    {
        $student_id=auth()->user()->id;
        return view('Pages.students.students_pages.exams.show',compact("exam_id","student_id"));
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

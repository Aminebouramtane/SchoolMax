<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    private $teacher;
    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Teachers=$this->teacher->getAllTeachers();
        return view("Pages.teachers.list_teachers",compact("Teachers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Specialits=$this->teacher->CreateTeacher();
        return view("Pages.teachers.add_teachers",compact('Specialits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->teacher->StoreTeacher($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teachers=$this->teacher->EditTeacher($id);
        $Specialits=$this->teacher->CreateTeacher();
        return view("Pages.teachers.edit_teachers",compact("teachers","Specialits"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->teacher->UpdateTeacher($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->teacher->DestroyTeacher($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Repository\StudentRepositoryInterface;

class StudentController extends Controller
{
    private $student;
    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }


    public function index()
    {
        return $this->student->getAllStudents();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->student->CreateStudents();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->student->StoreStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->student->EditTeacher($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->student->UpdateStudent($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->student->DeleteStudent($id);
    }


    public function Get_classrooms($id)
    {
        return $this->student->Get_classrooms($id);
    }
    public function Get_Sections($id)
    {
        return $this->student->Get_Sections($id);
    }
}

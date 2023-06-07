<?php

namespace App\Repository;


interface StudentRepositoryInterface {

    public function getAllStudents();
    public function CreateStudents();
    public function Get_classrooms($id);
    public function Get_Sections($id);
    public function StoreStudent($request);
    public function DeleteStudent($id);
    public function UpdateStudent($request,$id);
    public function EditTeacher($id);
}
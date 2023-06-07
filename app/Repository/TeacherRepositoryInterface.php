<?php

namespace App\Repository;


interface TeacherRepositoryInterface {

    public function getAllTeachers();
    public function CreateTeacher();
    public function StoreTeacher($request);
    public function DestroyTeacher($id);
    public function EditTeacher($id);
    public function UpdateTeacher($request,$id);
}
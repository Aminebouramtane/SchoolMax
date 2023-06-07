<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function Exam()
    {
        return $this->belongsTo('App\Models\Exam', 'exam_id');
    }
}

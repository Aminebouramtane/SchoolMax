<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    public function Classes()
    {
        return $this->belongsTo('App\Models\Classe', 'classe_id');
    }

    public function Sections()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }
    public function Teachers()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }

    public function Subjects()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    public function degree()
    {
        return $this->hasMany('App\Models\Degree');
    }
}

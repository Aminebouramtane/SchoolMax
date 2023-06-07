<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function Classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function Grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function Sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}

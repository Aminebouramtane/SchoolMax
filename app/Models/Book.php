<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
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
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}

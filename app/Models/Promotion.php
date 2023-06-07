<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function f_Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'from_grade');
    }

    public function f_Classes()
    {
        return $this->belongsTo('App\Models\Classe', 'from_classe');
    }

    public function f_Sections()
    {
        return $this->belongsTo('App\Models\Section', 'from_section');
    }
    public function t_Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade');
    }

    public function t_Classes()
    {
        return $this->belongsTo('App\Models\Classe', 'to_classe');
    }

    public function t_Sections()
    {
        return $this->belongsTo('App\Models\Section', 'to_section');
    }
    
    public function Students()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}

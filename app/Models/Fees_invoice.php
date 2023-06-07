<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees_invoice extends Model
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
    public function Students()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function Fees()
    {
        return $this->belongsTo('App\Models\Fee', 'fees_id');
    }
}

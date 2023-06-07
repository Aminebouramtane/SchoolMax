<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_student extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}

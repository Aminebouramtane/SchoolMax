<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $table = 'classes';
    public $timestamps = true;
    protected $fillable= [
    'classe_name_ar',
    'classe_name_en',
    'grade_id',
    ];

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }
}

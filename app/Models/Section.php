<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable= [
    'section_name_ar',
    'section_name_en',
    'active',
    'grade_id',
    'classe_id',
    ];
    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    public function Classes()
    {
        return $this->belongsTo('App\Models\Classe', 'classe_id');
    }

    public function Teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teachers_sections');
    }
}

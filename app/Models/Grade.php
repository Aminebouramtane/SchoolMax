<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'grades';
    public $timestamps = true;
    protected $fillable= [
    'grade_name_ar',
    'grade_name_en',
    'grade_note',
    ];

    public function Sections(){
        return $this->hasMany("App\Models\Section","grade_id");
    }
    public function Classes(){
        return $this->hasMany("App\Models\Classe","grade_id");
    }

    public function teachers()
{
    return $this->hasManyThrough(
        'App\Models\Teacher',
        'App\Models\Section',
        'grade_id',
        'id',
        'id',
        'teacher_id'
    );
}

}

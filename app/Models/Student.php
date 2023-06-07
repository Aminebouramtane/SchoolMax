<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;

class Student extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    // Rest of the Student model code...

    // Implement the required methods from the Authenticatable interface
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    // ======================================================
    use HasFactory;
    use SoftDeletes;
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

    public function Parents()
    {
        return $this->belongsTo('App\Models\Add_parent', 'parent_id');
    }

    public function student_account()
    {
        return $this->hasMany('App\Models\Students_acound', 'student_id');
    }

    public function Attendances()
    {
        return $this->hasMany('App\Models\Attendance', 'student_id');
    }
}

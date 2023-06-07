<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Teacher extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    
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

    protected $guarded = [];

    public function Specialits()
    {
        return $this->belongsTo('App\Models\Specialit', 'specialit_id');
    }
    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section','teachers_sections');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Add_parent;
use App\Models\Section;

class HomeController extends Controller
{

    public function index()
    {
        return view('auth.selection');
    }
    public function dashboard()
    {
        return view('index');
    }
//====================================

    // public function index()
    // {
    //     return view('landing');
    // }
//====================================

    // public function index()
    // {
    //     return view('landing');
    // }
//====================================

    // public function index()
    // {
    //     return view('landing');
    // }
//====================================

    // public function index()
    // {
    //     return view('landing');
    // }
}

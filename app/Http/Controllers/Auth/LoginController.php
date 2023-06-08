<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function loginForm($type)
    {
        return view('auth.login',compact("type"));
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function chekGuard($request){

        if($request->type == 'student'){
            $guardName= 'student';
        }
        elseif ($request->type == 'parent'){
            $guardName= 'add_parent';
        }
        elseif ($request->type == 'teacher'){
            $guardName= 'teacher';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }

    public function redirect(Request $request){

        if($request->type == 'student'){
            return redirect()->intended(RouteServiceProvider::STUDENT);
        }
        elseif ($request->type == 'parent'){
            return redirect()->intended(RouteServiceProvider::ADDPARENT);
        }
        elseif ($request->type == 'teacher'){
            return redirect()->intended(RouteServiceProvider::TEACHER);
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    // protected function authenticated(Request $request)
    // {
    //     if (Auth::guard('student')->check()) {
    //         return redirect(RouteServiceProvider::STUDENT);
    //     }

    //     if (Auth::guard('teacher')->check()) {
    //         return redirect(RouteServiceProvider::TEACHER);
    //     }

    //     // Modify the guard name and the corresponding redirect route
    //     if (Auth::guard('add_parent')->check()) {
    //         return redirect(RouteServiceProvider::ADDPARENT);
    //     }

    //     return redirect(RouteServiceProvider::HOME);
    // }



    public function login(Request $request){
        $guardName = $this->chekGuard($request);
        if (Auth::guard($guardName)->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }else{
            return view('404');
        }
        // return $request;

    }
    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
        // return $type;
    }

}

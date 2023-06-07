<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (!$request->expectsJson()) {

            $requestInstance = new Request();

            if ($requestInstance->is(app()->getLocale() . '/student/dashboard')) {
                return route('selection');
            }
            elseif ($requestInstance->is(app()->getLocale() . '/teacher/dashboard')) {
                return route('selection');
            }
            elseif ($requestInstance->is(app()->getLocale() . '/parent/dashboard')) {
                return route('selection');
            }
            else {
                return route('selection');
            }
        }
    }
}

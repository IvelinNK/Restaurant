<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class FrontUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Session::has('frontUserLogin'))){
            return redirect('/users-login-register');
        }
        return $next($request);
    }
}

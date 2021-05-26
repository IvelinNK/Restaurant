<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class FrontFirmLogin
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
        if(empty(Session::has('frontFirmLogin'))){
            return redirect('/firms-login-register');
        }
        return $next($request);
    }
}

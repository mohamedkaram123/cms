<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OtpRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->otp == 0) {

            return "dsds";
        }
        return $next($request);
    }
}

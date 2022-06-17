<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Hash;

class CheckPassword
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
        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            return $next($request);
        }
        session(['link_staff' => url()->current()]);

        return redirect()->route("staffs.check_old_password_get");
    }
}

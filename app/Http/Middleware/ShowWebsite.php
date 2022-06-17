<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\MyClasses\Roles;
use Closure;
use Illuminate\Http\Request;

class ShowWebsite
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
        $user_type = null;
        if (!empty(auth()->user())) {
            $user_type = auth()->user()->user_type;
        }
        if (!empty($user_type) && $user_type  == "staff" && !Roles::Check(341)) {
            return redirect()->route("error.role");
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\MyClasses\Roles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolePermission
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


        if (!empty($request->role_id)) {
            if ($request->has("react")) {
                if (Roles::Check(customDecrypt($request->role_id))) {
                    return $next($request);
                }
            }
            if (Roles::Check(decrypt($request->role_id))) {
                return $next($request);
            }
            return redirect()->route("error.role");
        }
        return $next($request);
    }
}

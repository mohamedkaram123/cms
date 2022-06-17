<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Auth;

class IsUser
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

        if (url()->current() == url("/purchase_history")) {
            if ($request->has("user_id")) {
                $user = User::find(decrypt($request->user_id));

                auth()->login($user);
            }
        }
        if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller')) {
            return $next($request);
        } else {
            session(['link' => url()->current()]);
            return redirect()->route('user.login');
        }
    }
}

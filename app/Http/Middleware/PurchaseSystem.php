<?php

namespace App\Http\Middleware;

use App\MyClasses\EncryptSystem;
use Closure;
use Illuminate\Http\Request;

class PurchaseSystem
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

        $EncryptSystem = new EncryptSystem();
        if (!$EncryptSystem->Check_Date_Purchase_Id_Code_Decrypt()) {

            return redirect()->route("purchase.code");
        }
        return $next($request);
    }
}

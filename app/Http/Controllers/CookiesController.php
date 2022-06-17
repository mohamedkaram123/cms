<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookiesController extends Controller
{
    //

    public function setCookie(Request $request)
    {

        // return dd($request->minutes);
        Cookie::queue(Cookie::make($request->key, $request->value, $request->minutes));

        return "done";
    }
    public function getCookie(Request $request)
    {
        if (Cookie::has($request->key)) {
            $value = Cookie::get($request->key);
            return $value;
        }

        return null;
    }
}

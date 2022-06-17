<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebasController extends Controller
{
    //

    public function index(Request $request)
    {
        return view("backend.firebase.firebase");
    }
}

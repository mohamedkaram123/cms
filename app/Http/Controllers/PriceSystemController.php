<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceSystemController extends Controller
{
    //

    public function all_curruncies(Request $request)
    {

        $defualt_currency = currency_symbol();
        $all_curruncies = DB::select('SELECT concat(name," ",symbol) AS label , id AS value FROM currencies ORDER BY symbol = ' . $defualt_currency . ' DESC');

        return response()->json([
            "all_curruncies" => $all_curruncies
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GeneralTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class GeneralTransController extends Controller
{
    //

    public function index(Request $request, $table_name, $row_id)
    {
        $lang = $request->has("lang") ? $request->lang : Session::get('locale', Config::get('app.locale'));

        $general_trans
            = GeneralTranslation::where("row_id", $row_id)
            ->where("table_name", $table_name)
            ->where("lang", $lang)
            ->get();
        if (count($general_trans) == 0) {
            flash(translate('the row is not exist'))->warning();
            return back();
        }

        return view("backend.general_trans.index", [
            "general_trans" => $general_trans,
            "lang" => $lang
        ]);
    }

    public function update(Request $request)
    {
        foreach ($request->trans_ids as $key => $id) {
            $general_trans = GeneralTranslation::find($id);
            $general_trans->trans = $request->trans[$key];
            $general_trans->save();
        }
        flash(translate('trans is successfully'))->success();
        return back();
    }
}

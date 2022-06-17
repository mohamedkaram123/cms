<?php

namespace App\MyClasses;

use App\Models\RefurbishedDegree as RefurbishedDegreeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefurbishedDegree
{

    public  function create(Request $req)
    {

        $refurbished = new RefurbishedDegreeModel();
        $refurbished->name = $req->name;
        $refurbished->logo = $req->logo;
        $refurbished->desc = $req->desc;

        $refurbished->save();


        return $refurbished;
    }


    public  function update(Request $req)
    {
        $refurbished =  RefurbishedDegreeModel::find($req->id);
        $refurbished->name = $req->name;
        $refurbished->logo = $req->logo;
        $refurbished->desc = $req->desc;

        $refurbished->save();
        return $refurbished;
    }


    public  function delete(Request $req)
    {
        $refurbished =  RefurbishedDegreeModel::find($req->id);

        $refurbished->delete();
    }

    public function all()
    {
        $refurbisheds = DB::table("refurbished_degree")
            ->select("name as label", "id as value")
            ->get();


        return $refurbisheds;
    }
}

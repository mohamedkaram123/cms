<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GovernorateController extends Controller
{
    //

    public function index(Request $request)
    {
        return view("backend.governorates.governorate_table");
    }


    public function governorate_data(Request $request)
    {



        $query  = DB::table('governorates')
            ->join('countries', function ($join) {
                $join->on('countries.id', '=', 'governorates.country_id');
            });


        if ($request->id != 0 && $request->id != null) {
            $query =    $query->where("governorates.id", 'like', "%$request->id%");
        }

        if ($request->name != "") {
            if ($request->name != "") {
                $query =    $query->where("governorates.name", 'like', "%$request->name%");
            }
        }

        if ($request->country_name != "") {
            $query =    $query->where("countries.name", 'like', "%$request->country_name%");
        }

        $counter =   $query->select(DB::raw("COUNT(governorates.id) / $request->limit as counter"), DB::raw("COUNT(governorates.id) as rowss"))->get();

        $queryCounter = $query;
        $query = $query->select('governorates.*', 'countries.name as country_name');
        $sellers =  $query
            ->offset($request->skip)
            ->limit($request->limit)
            ->orderBy('id', 'desc')
            ->get();



        // $counter =  $counter_query->get();
        //  }

        return response()->json([
            "governorates" => $sellers,
            "counter" => round(empty((int)$counter[0]->counter) ? 0 : (int)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss)

        ]);
    }


    public function countries()
    {
        $countries = Country::all();

        return response()->json([
            "countries" => $countries,
        ]);
    }

    public function sendData(Request $request)
    {

        $governorate = Governorate::where("name", $request->name)->where("country_id", $request->country_id)->first();

        if (empty($governorate)) {
            $governorate = new Governorate();
            $governorate->name = $request->name;
            $governorate->country_id = $request->country_id;
            $governorate->save();
        }


        return $this->governorate_data(new Request([
            "skip" => 0,
            "limit" => 10
        ]));
    }

    public function destroy($id)
    {

        $governorates = Governorate::find($id);
        if (count($governorates->cities) != 0) {

            foreach ($governorates->cities as $item) {
                $item->delete();
            }
        }
        $governorates->delete();

        return response()->json([
            "msg" => "done"
        ]);
    }
}

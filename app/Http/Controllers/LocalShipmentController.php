<?php

namespace App\Http\Controllers;

use App\City;
use App\Models\Governorate;
use App\Models\LocalSipmentAddress;
use App\myTraits\CgcData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalShipmentController extends Controller
{
    //
    use CgcData;

    public function index(Request $request)
    {
        return view('backend.local_shipment.local_shipment');
    }

    public function local_shipment_data(Request $request)
    {

        $query  = DB::table('local_shipment_addresses')
            ->join('cities', function ($join) {
                $join->on('cities.id', '=', 'local_shipment_addresses.city_id');
            });


        if ($request->id != 0 && $request->id != null) {
            $query =    $query->where("local_shipment_addresses.id", 'like', "%$request->id%");
        }

        if ($request->address != "") {
            if ($request->address != "") {
                $query =    $query->where("local_shipment_addresses.address", 'like', "%$request->address%");
            }
        }

        if ($request->city_name != "") {
            $query =    $query->where("cities.name", 'like', "%$request->city_name%");
        }
        if ($request->cost != "") {
            $query =    $query->where("local_shipment_addresses.cost", 'like', "%$request->cost%");
        }

        if ($request->shipping_days != "") {
            $query =    $query->where("local_shipment_addresses.shipping_days", 'like', "%$request->shipping_days%");
        }

        $counter =   $query->select(DB::raw("COUNT(local_shipment_addresses.id) / $request->limit as counter"), DB::raw("COUNT(local_shipment_addresses.id) as rowss"))->get();

        $queryCounter = $query;
        $query = $query->select('local_shipment_addresses.*', 'cities.name as city_name');
        $addresses =  $query
            ->offset($request->skip)
            ->limit($request->limit)
            ->orderBy('id', 'desc')
            ->get();



        // $counter =  $counter_query->get();
        //  }

        return response()->json([
            "addresses" => $addresses,
            "counter" => round(empty((int)$counter[0]->counter) ? 0 : (int)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss)

        ]);
    }

    public function get_governorates($id)
    {
        $governorates = $this->governorate($id);
        return response()->json([
            "governorates" => $governorates
        ]);
    }

    public function get_cities($id)
    {
        $cities = $this->cities($id);
        return response()->json([
            "cities" => $cities
        ]);
    }


    public function send_data(Request $request)
    {

        $data = $request->except("_token");

        $local_shipping = LocalSipmentAddress::create($request->all());

        return response()->json([
            "msg" => "done"
        ]);
    }

    public function edit_Address($id)
    {
        $address = LocalSipmentAddress::find($id);
        $governorates = Governorate::where("country_id", $address->country_id)->get();
        $cities = City::where("governorate_id", $address->governorate_id)->get();

        return response()->json([
            "address" => $address,
            "countries" => $this->countries(),
            "governorates" => $governorates,
            "cities" => $cities
        ]);
    }

    public function update_Address(Request $request)
    {
        $address = LocalSipmentAddress::where("id", $request->id)->update($request->except("_token"));

        return response()->json([
            "msg" => "done"
        ]);
    }

    public function get_countries()
    {

        return response()->json([
            "countries" => $this->countries()
        ]);
    }


    public function delete_address($id)
    {
        $address =    LocalSipmentAddress::find($id);
        if (!empty($address)) {
            $address->delete();
        }

        return response()->json([
            "msg" => "done"
        ]);
    }
}

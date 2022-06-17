<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\Country;
use App\Models\Governorate;
use App\Models\LocalSipmentAddress;
use App\myTraits\CgcData;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\LinesOfCode\Counter;

class ShippingCostController extends Controller
{
    //

    use CgcData;


    public function shipping_address(Request $request)
    {

        $address = DB::table('addresses')
            ->join('countries', function ($join) {
                $join->on('countries.id', '=', 'addresses.country_id');
            })
            ->join('governorates', function ($join) {
                $join->on('governorates.id', '=', 'addresses.governorate_id');
            })
            ->join('cities', function ($join) {
                $join->on('cities.id', '=', 'addresses.city_id');
            })
            ->where("addresses.user_id", auth()->user()->id)
            ->select("countries.name as country", "governorates.name as governorate", "cities.name as city", "addresses.*")
            ->get();

        return response()->json([
            "address" => $address
        ]);
    }

    public function get_countries()
    {

        return response()->json([
            "countries" => $this->countries()
        ]);
    }

    public function get_governorates($id)
    {
        $postal_code = Country::find($id)->tel;
        return response()->json([
            "governorates" => $this->governorate($id),
            "postal_code" => $postal_code
        ]);
    }

    public function get_cities($id)
    {
        return response()->json([
            "cities" => $this->cities($id)
        ]);
    }


    public function add_address(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'country_id' => 'required',
            'governorate_id' => 'required',

            'city_id' => 'required',
            'phone' => 'required|min:11',
            'adress_type' => 'required',

        ], [
            'address.required' => translate("please enter address"),
            'country_id.required' => translate("please enter country"),
            'governorate_id.required' => translate("please enter governorate"),

            'city_id.required' => translate("please enter city"),
            'phone.required' => translate("please enter phone"),
            'phone.min' => translate("Please enter at least 11 numbers"),

            'adress_type.required' => translate("please enter address type"),

        ]);


        if ($validator->fails()) {

            return response()->json(['status' => 0, 'msg' => $validator->errors()]);
        }


        $data =  $request->except(["_token"]);
        $data["user_id"] =  auth()->user()->id;

        Address::create($data);


        return response()->json([
            "msg" => "done",
            "status" => 1
        ]);
    }


    public function edit_address($id)
    {
        $address = Address::find($id);
        $countries = Country::all();
        $governorates = Governorate::where("country_id", $address->country_id)->get();

        $cities = City::where("governorate_id", $address->governorate_id)->get();

        return response()->json([
            "address" => $address,
            "countries" => $countries,
            "governorates" => $governorates,
            "cities" => $cities
        ]);
    }

    public function update_adress(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'country_id' => 'required',
            'governorate_id' => 'required',

            'city_id' => 'required',
            'phone' => 'required|min:11',
            'adress_type' => 'required',

        ], [
            'address.required' => translate("please enter address"),
            'country_id.required' => translate("please enter country"),
            'governorate_id.required' => translate("please enter governorate"),

            'city_id.required' => translate("please enter city"),
            'phone.required' => translate("please enter phone"),
            'phone.min' => translate("Please enter at least 11 numbers"),

            'adress_type.required' => translate("please enter address type"),

        ]);


        if ($validator->fails()) {

            return response()->json(['status' => 0, 'msg' => $validator->errors()]);
        }



        $data =  $request->except(["_token", "id"]);
        $data["user_id"] =  auth()->user()->id;

        Address::where('id', $request->id)->update($data);


        return response()->json([
            "msg" => "done",
            "status" => 1

        ]);
    }

    public function delete_address($id)
    {
        $address =    Address::find($id);
        if (!empty($address)) {
            $address->delete();
        }

        return response()->json([
            "msg" => "done"
        ]);
    }

    public function data_country(Request $request)
    {

        $country = Country::find($this->country_ip()->id);
        $governorates = $this->governorate($country->id);


        return response()->json([
            "country" => $country,
            "governorates" => $governorates
        ]);
    }

    public function get_addresses(Request $request)
    {
        $addresses = DB::table('local_shipment_addresses')
            ->where("city_id", $request->city_id)
            ->join('cities', 'cities.id', '=', 'local_shipment_addresses.city_id')
            ->select("local_shipment_addresses.*", "cities.name as city_name")
            ->get();
        // LocalSipmentAddress::where("city_id", $request->city_id)->get();

        return response()->json([
            "addresses" => $addresses,
        ]);
    }

    public function set_address(Request $request)
    {
        // return $request->address["type"];
        if ($request->address["type"] == "shipping_home") {

            $data = $request->address;
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data["cost"] = City::find($request->address["city_id"])->cost;
            $data["shipping_days"] = City::find($request->address["city_id"])->shipping_days;

            session()->put("address", $data);
        } else {
            $data = $request->address;
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data["cost"] = City::find($request->address["city_id"])->cost;
            $data["shipping_days"] = City::find($request->address["city_id"])->shipping_days;
            $city = City::find($request->address["city_id"]);
            $data["city"] = City::find($request->address["city_id"])->name;
            $data["country"] = $city->governorate->country->name;

            session()->put("address", $data);
        }

        return response()->json([
            "msg" => "done",
            "data" => session()->get("address")
        ]);
    }
}

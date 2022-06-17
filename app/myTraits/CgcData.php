<?php

namespace App\myTraits;

use App\City;
use App\Models\Country;
use App\Models\Governorate;

trait CgcData
{


    public function countries()
    {
        $countries = Country::all();

        return $countries;
    }

    public function governorate($id = null)
    {

        if ($id != null) {
            $country = Country::find($id);

            return $country->governorates;
        } else {
            $governorates = Governorate::all();
            return $governorates;
        }
    }


    public function cities($id = null)
    {
        if ($id != null) {
            $governorates = Governorate::find($id);
                    return $governorates->cities;

        } else {
            $cities = City::all();
            return $cities;
        }
    }

    public function country_ip()
    {
        $country_code =  ip_info("156.223.13.112", "Country Code");
        $country = Country::where("code", $country_code)->first();
        if (empty($country)) {
            $country = Country::where("code", "SA")->first();
        }
        return $country;
    }
}

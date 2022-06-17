<?php

namespace App\Imports;

use App\City;
use App\Country;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Auth;

class CityImport implements ToModel, WithHeadingRow, WithValidation
{

    public $num_row_create = 0;
    public function model(array $row)
    {

        try {


            $city = City::where("governorate_id", $row["governorate_id"])->where("name", "like", "%" . $row["name"] . "%")->first();

            if (empty($city)) {

                $this->num_row_create += 1;
                $new_city = new City();
                $new_city->governorate_id = $row["governorate_id"];
                $new_city->name = $row["name"];
                $new_city->cost = $row["cost"];
                $new_city->shipping_days = $row["shipping_days"];

                $new_city->save();
            } else {
                $city->governorate_id = $row["governorate_id"];
                $city->name = $row["name"];
                $city->cost = $row["cost"];
                $city->shipping_days = $row["shipping_days"];

                $city->save();
            }
        } catch (\Throwable $th) {
            flash(translate('Please check your file data '))->error();
        }
    }

    public function rules(): array
    {
        return [
            // Can also use callback validation rules
            //  'lang_key' => function($attribute, $value, $onFailure) {


            //       if (!is_numeric($value)) {
            //            $onFailure('Unit price is not numeric');
            //       }
            //   }
        ];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
        "address",
        "country_id",
        "city_id",
        "governorate_id",
        "user_id",
        "phone",
        "postal_code",
        "adress_type"

    ];
}

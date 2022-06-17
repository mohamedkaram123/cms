<?php

namespace App\Models;

use App\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    //


    // /**
    //  * Get all of the cities funtry
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function cities()
    // {
    //     return $this->hasMany(City::class, 'country_id');
    // }


    public function governorates()
    {
        return $this->hasMany(Governorate::class, 'country_id');
    }
}

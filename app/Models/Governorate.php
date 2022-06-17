<?php

namespace App\Models;

use App\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $table = "governorates";

    public function cities()
    {
        return $this->hasMany(City::class, 'governorate_id');
    }


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class City extends Model
{

    use HasFactory;

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $city_translation = $this->hasMany(CityTranslation::class)->where('lang', $lang)->first();
        return $city_translation != null ? $city_translation->$field : $this->$field;
    }

    public function city_translations()
    {
        return $this->hasMany(CityTranslation::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}

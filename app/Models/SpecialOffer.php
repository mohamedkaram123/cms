<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{

    protected $table = "special_offers";


    public function specialOfferProduct()
    {
        return $this->hasMany(SpecialOfferProduct::class, "special_offers_id");
    }


    public function specialOfferCustomerPurches()
    {
        return $this->hasOne(SpecialOfferCustomerPurchase::class, "special_offers_id");
    }


    public function specialOfferXtoY()
    {
        return $this->hasOne(SpecialOfferXY::class, "special_offers_id");
    }
}

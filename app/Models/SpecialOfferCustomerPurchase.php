<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOfferCustomerPurchase extends Model
{
    protected $table = "special_offers_customer_purchase";

    protected $append = "end_date";
    /**
     * Get the user that owns the SpecialOfferCustomerPurchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specialOffer()
    {
        return $this->belongsTo(SpecialOffer::class, 'special_offers_id');
    }

    // public function getEndDateAttribute($value)
    // {
    //     return $this->specialOffer->end_date;
    // }
}

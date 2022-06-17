<?php

namespace App\Models;

use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $fillable = ['address_id', 'price', 'tax', 'shipping_cost', 'shipping_type', 'discount', 'coupon_code', 'coupon_applied', 'quantity', 'user_id', 'owner_id', 'product_id', 'variation'];
    protected $append = ["max_qty"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Product::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalSipmentAddress extends Model
{
    use HasFactory;

    protected $table = "local_shipment_addresses";
    protected $fillable = ["address", "city_id", "governorate_id", "cost", "shipping_days", "country_id"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentFawryToken extends Model
{
    use HasFactory;

    protected $table='payment_card_fawry_token_users';

    protected $fillable  = ['payment_card_fawry_token','user_id'];

}

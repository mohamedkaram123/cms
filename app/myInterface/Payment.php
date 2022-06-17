<?php

namespace App\myInterface;

use Illuminate\Http\Request;

interface  Payment
{

    public function post_request($data = []);


    public function callback($payment_type);


    public function callbackpost(Request $request, $payment_type, $pay_id, $user_id);
}

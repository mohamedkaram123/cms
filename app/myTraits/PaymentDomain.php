<?php


namespace App\myTraits;

trait PaymentDomain
{

    public function paymentDoamin()
    {
        return env("APP_URL");
    }
}

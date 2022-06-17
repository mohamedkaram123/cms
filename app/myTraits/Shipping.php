<?php


namespace App\myTraits;

trait Shipping
{

    public function shipping_cost()
    {
        $shipping_info = session()->get("address");

        $cost = $shipping_info["cost"];

        return $cost;
    }

    public function shipping_days()
    {
        $shipping_info = session()->get("address");

        $shipping_days = $shipping_info["shipping_days"];

        return $shipping_days;
    }


    public function shipping_data()
    {
        $shipping_info = session()->get("address");


        return $shipping_info;
    }
}

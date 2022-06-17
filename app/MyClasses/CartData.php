<?php

namespace App\MyClasses;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartData
{

    public static function get_total($products)
    {
        $owners = [];
        $total_qty = 0;
        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        $product_shipping_cost = 0;
        $products = json_decode($products);
        $carts = [];
        foreach ($products as $item) {
            $carts[] = Cart::where("user_id", auth()->user()->id)->where("owner_id", $item->owner_id)->where("product_id", $item->product_id)->first();
        }


        foreach ($carts as $key => $cartItem) {


            $total_qty += $cartItem['quantity'];
            $product = \App\Product::find($cartItem['product_id']);
            $subtotal += $cartItem['price'] * $cartItem['quantity'];
            $tax += $cartItem['tax'] * $cartItem['quantity'];
            $categories[] = $product->category_id;

            $product_shipping_cost = session()->get("address")["cost"];


            if (!in_array($cartItem['owner_id'], $owners)) {
                $owners[] = $cartItem['owner_id'];
                $shipping = $product_shipping_cost;
            }
        }

        $total = $subtotal + $tax + $shipping;

        $total = $subtotal + $tax + $shipping;


        $tempDiscount = new TempDiscount();

        $temp_discount = $tempDiscount->temp_discount_check();
        if (!empty($temp_discount)) {
            $discount = $temp_discount["discount"];
            $discount_type = $temp_discount["discount_type"];

            if ($discount_type == "percent") {
                $discount_percent = $total *  ($discount / 100);
                $total -= $discount_percent;
            } else {
                $total -= $discount;
            }
            if ($temp_discount["free_shipping"] == 1) {
                $total -= $shipping;
                $shipping =  0;
            }
        }

        if (Session::has('coupon_discount')) {
            $total -= Session::get('coupon_discount');
        }


        $spcial_offer_controller = new SpcialOffer();
        $spcial_offer_discount = $spcial_offer_controller->show_special_offer_cart($total, $total_qty);

        if (!empty($spcial_offer_discount)) {
            $total -= $spcial_offer_discount;
        } else {
            $spcial_offer_discount_category = $spcial_offer_controller->show_special_offer_categories($total, $total_qty, $categories);

            if (!empty($spcial_offer_discount_category)) {
                $total -= $spcial_offer_discount_category;
            }
        }


        return $total;
    }
}

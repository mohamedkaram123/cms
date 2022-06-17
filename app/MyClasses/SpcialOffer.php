<?php

namespace App\MyClasses;

use App\Models\SpecialOffer;
use Illuminate\Support\Facades\DB;

class SpcialOffer
{

    public function show_special_offer_cart($total_cart, $product_qty)
    {
        $spcial_offers = DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers_customer_purchase.special_offers_id', '=', 'special_offers.id');
            })
            ->where("special_offers.end_date", ">", now())
            ->where("special_offers_customer_purchase.offer_applies_type", 1)
            ->select("special_offers.*", "special_offers_customer_purchase.*")
            ->orderBy('special_offers.id', 'desc')
            ->first();


        if (!empty($spcial_offers)) {
            if ($spcial_offers->min_type == "price") {
                if ($spcial_offers->min_price < $total_cart) {

                    $discount = $this->discount_spcial_offer($spcial_offers, $total_cart);
                    return $discount;
                } else {
                    return null;
                }
            } else {
                if ($spcial_offers->min_qty < $product_qty) {

                    $discount = $this->discount_spcial_offer($spcial_offers, $total_cart);
                    return $discount;
                } else {
                    return null;
                }
            }
        }

        return null;
    }



    public function show_special_offer_product($product_id, $price)
    {
        $spcial_offers = DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers_customer_purchase.special_offers_id', '=', 'special_offers.id');
            })
            ->join('special_offers_product', function ($join) {
                $join->on('special_offers_product.special_offers_id', '=', 'special_offers.id');
            })
            ->where("special_offers_product.type", "product")
            ->where("special_offers_product.object_id", $product_id)

            ->where("special_offers.end_date", ">", now())
            ->where("special_offers_customer_purchase.offer_applies_type", 2)
            ->select("special_offers.*", "special_offers_customer_purchase.*", "special_offers_product.*")
            ->groupBy("special_offers_product.id")
            ->orderBy("special_offers_product.id", "desc")
            ->first();


        if (!empty($spcial_offers)) {

            $discount = $this->discount_spcial_offer($spcial_offers, $price);
            return $discount;
        }

        return null;
    }




    public function discount_spcial_offer($spcial_offer, $price)
    {
        if ($spcial_offer->type_discount == "percent") {
            $discount = $price * ($spcial_offer->discount / 100);
            if ($spcial_offer->maximum_discount < $discount) {
                return null;
            }
        } else {
            $discount = $spcial_offer->discount;
        }

        return $discount;
    }



    public function show_special_offer_categories($total_cart, $product_qty, $categories)
    {
        $spcial_offers = DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers_customer_purchase.special_offers_id', '=', 'special_offers.id');
            })
            ->join('special_offers_product', function ($join) {
                $join->on('special_offers_product.special_offers_id', '=', 'special_offers.id');
            })
            ->where("special_offers_product.type", "category")
            // ->where("special_offers_product.object_id", $category_id)
            ->whereIn('special_offers_product.object_id', $categories)

            ->where("special_offers.end_date", ">", now())
            ->where("special_offers_customer_purchase.offer_applies_type", 3)
            ->select("special_offers.*", "special_offers_customer_purchase.*", "special_offers_product.*")
            ->orderBy("special_offers_product.id", "desc")
            ->first();

        if (!empty($spcial_offers)) {
            if ($spcial_offers->min_type == "price") {
                if ($spcial_offers->min_price < $total_cart) {

                    $discount = $this->discount_spcial_offer($spcial_offers, $total_cart);
                    return $discount;
                } else {
                    return null;
                }
            } else {
                if ($spcial_offers->min_qty < $product_qty) {

                    $discount = $this->discount_spcial_offer($spcial_offers, $total_cart);
                    return $discount;
                } else {
                    return null;
                }
            }
        }

        return null;
    }

    public function show_special_offer_payments($total_cart, $product_qty, $method_payment)
    {
        $spcial_offers = DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers_customer_purchase.special_offers_id', '=', 'special_offers.id');
            })
            ->join('special_offers_product', function ($join) {
                $join->on('special_offers_product.special_offers_id', '=', 'special_offers.id');
            })
            ->where("special_offers.end_date", ">", now())
            ->where("special_offers_customer_purchase.offer_applies_type", 4)
            ->where("special_offers_product.object_name", $method_payment)

            ->select("special_offers.*", "special_offers_customer_purchase.*")
            ->orderBy('special_offers.id', 'desc')
            ->first();


        if (!empty($spcial_offers)) {
            if ($spcial_offers->min_type == "price") {
                if ($spcial_offers->min_price < $total_cart) {

                    $discount = $this->discount_spcial_offer($spcial_offers, $total_cart);
                    return $discount;
                } else {
                    return null;
                }
            } else {
                if ($spcial_offers->min_qty < $product_qty) {

                    $discount = $this->discount_spcial_offer($spcial_offers, $total_cart);
                    return $discount;
                } else {
                    return null;
                }
            }
        }

        return null;
    }


    public function show_special_offer_products_data()
    {
        $spcial_offers = DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers_customer_purchase.special_offers_id', '=', 'special_offers.id');
            })
            ->join('special_offers_product', function ($join) {
                $join->on('special_offers_product.special_offers_id', '=', 'special_offers.id');
            })
            ->join('products', function ($join) {
                $join->on('products.id', '=', 'special_offers_product.object_id');
            })
            ->where("special_offers_product.type", "product")
            ->where("special_offers.end_date", ">", now())
            ->where("special_offers_customer_purchase.offer_applies_type", 2)
            ->select("products.*", "special_offers.end_date")
            ->groupBy("products.id")
            ->orderBy("special_offers.id", "desc")
            ->get();


        if (count($spcial_offers) != 0) {

            return ["products" => $spcial_offers, "end_date" => $spcial_offers[0]->end_date];
        }

        return [];
    }

    public  function show_offer_cat_data()
    {
        $spcial_offers = SpecialOffer::where("special_offers.end_date", ">", now())->get();



        $offers = [];
        if (count($spcial_offers) > 0) {
            foreach ($spcial_offers as $offer) {
                if ($offer->specialOfferCustomerPurches->offer_applies_type == 3) {
                    $offers[] = $this->prepare_offer($offer);
                }
            }
        }


        return $offers;
    }

    public  function prepare_offer($offer)
    {
        $cats = [];
        foreach ($offer->specialOfferProduct as $item) {
            $cats[] = $item->category;
        }
        return [
            "offer" => $offer,
            "cats" => $cats,
            "msg_offer" => $this->offer_msg($offer)
        ];
    }

    public  function offer_msg($offer): string
    {

        $customer_special_offer = $offer->specialOfferCustomerPurches;
        $offer_type = $customer_special_offer->offer_applies_type;
        $discount_type = $customer_special_offer->type_discount;
        $min_type = $customer_special_offer->min_type;


        $msg = "";
        switch ($offer_type) {
            case 1:
                break;
            case 2:
                break;
            case 3:

                $var_categories = "";
                $i = 0;
                $cats = $offer->specialOfferProduct;
                foreach ($cats as $item) {
                    $i++;

                    $category = $item->category;
                    $cat_name = $category->getTranslation('name');
                    $var_categories .= "$cat_name";
                    if ($i < count($cats)) {
                        $var_categories .= ", ";
                    }
                }

                if ($discount_type == "percent" && $min_type == "quantity") {
                    $var_discount = $customer_special_offer->discount;
                    $var_quantity = $customer_special_offer->min_qty;
                    $var_max_dis_price = single_price($customer_special_offer->maximum_discount);


                    $msg_str = "If you buy from one of these categories var_categories " .
                        "You will get a var_discount % discount, provided that " .
                        "the minimum purchase quantity is var_quantity, " .
                        "provided that the discount does not exceed var_max_dis_price";
                    $msg_trans =  translate($msg_str);
                    $msg = str_replace("var_categories", $var_categories, $msg_trans);
                    $msg = str_replace("var_discount", $var_discount, $msg);
                    $msg = str_replace("var_quantity", $var_quantity, $msg);
                    $msg = str_replace("var_max_dis_price", $var_max_dis_price, $msg);
                } elseif ($discount_type == "percent" && $min_type == "price") {
                    $var_max_dis_price = single_price($customer_special_offer->maximum_discount);
                    $var_min_dis_price = single_price($customer_special_offer->min_price);
                    $var_discount = $customer_special_offer->discount;

                    $msg_str = "If you buy from one of these categories var_categories " .
                        "You will get a var_discount %, " .
                        "provided that the minimum purchase amount is var_min_dis_price, " .
                        "and the discount does not exceed var_max_dis_price";
                    $msg_trans =  translate($msg_str);
                    $msg = str_replace("var_categories", $var_categories, $msg_trans);
                    $msg = str_replace("var_discount", $var_discount, $msg);
                    $msg = str_replace("var_min_dis_price", $var_min_dis_price, $msg);
                    $msg = str_replace("var_max_dis_price", $var_max_dis_price, $msg);
                } elseif ($discount_type == "amount" && $min_type == "quantity") {
                    $var_discount_price = single_price($customer_special_offer->discount);
                    $var_quantity = $customer_special_offer->min_qty;
                    $var_max_dis_price = single_price($customer_special_offer->maximum_discount);

                    $msg_str = "If you buy from one of these categories var_categories " .
                        "You will get a var_discount_price discount, provided that " .
                        "the minimum purchase quantity is var_quantity, " .
                        "provided that the discount does not exceed var_max_dis_price";

                    $msg_trans =  translate($msg_str);
                    $msg = str_replace("var_categories", $var_categories, $msg_trans);
                    $msg = str_replace("var_discount_price", $var_discount_price, $msg);
                    $msg = str_replace("var_quantity", $var_quantity, $msg);
                    $msg = str_replace("var_max_dis_price", $var_max_dis_price, $msg);
                } elseif ($discount_type == "amount" && $min_type == "price") {

                    $var_max_dis_price = single_price($customer_special_offer->maximum_discount);
                    $var_min_dis_price = single_price($customer_special_offer->min_price);
                    $var_discount_price = single_price($customer_special_offer->discount);

                    $msg_str = "If you buy from one of these categories var_categories " .
                        "You will get a var_discount_price discount, " .
                        "provided that the minimum purchase amount is var_min_dis_price, " .
                        "and the discount does not exceed var_max_dis_price";


                    $msg_trans =  translate($msg_str);
                    $msg = str_replace("var_categories", $var_categories, $msg_trans);
                    $msg = str_replace("var_discount_price", $var_discount_price, $msg);
                    $msg = str_replace("var_min_dis_price", $var_min_dis_price, $msg);
                    $msg = str_replace("var_max_dis_price", $var_max_dis_price, $msg);
                }
                break;
            default:;
        }
        return $msg;
    }
}

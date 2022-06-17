<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\SpecialOffer;
use App\Models\SpecialOfferCustomerPurchase;
use App\Models\SpecialOfferProduct;
use App\Models\SpecialOfferXY;
use App\MyClasses\SpcialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialOfferController extends Controller
{
    //

    public function index(Request $request)
    {

        return view('backend.special_offers.index');
    }

    public function storeXtoY(Request $request)
    {
        $specialOffer = new SpecialOffer();
        $specialOffer->offer_title    = $request->title_offer;
        $specialOffer->end_date    = $request->endDate;
        $specialOffer->offer_type    = "x_to_y";
        $specialOffer->save();

        if ($request->product_or_category1 == "product") {

            foreach ($request->products1 as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["id"];
                $specialProduct->type     = "product";
                $specialProduct->type_x_to_y     = "from";

                $specialProduct->save();
            }
        } else {
            foreach ($request->categories1 as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["value"];
                $specialProduct->type     = "category";
                $specialProduct->type_x_to_y     = "from";

                $specialProduct->save();
            }
        }


        if ($request->product_or_category2 == "product") {

            foreach ($request->products2 as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["id"];
                $specialProduct->type     = "product";
                $specialProduct->type_x_to_y     = "to";

                $specialProduct->save();
            }
        } else {
            foreach ($request->categories2 as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["value"];
                $specialProduct->type     = "category";
                $specialProduct->type_x_to_y     = "to";

                $specialProduct->save();
            }
        }
        $specialXtoY = new SpecialOfferXY();
        $specialXtoY->special_offers_id = $specialOffer->id;
        $specialXtoY->customer_qty_buy = $request->quantify1;
        $specialXtoY->customer_qty_get = $request->quantify2;
        if ($request->discount_type == "discount") {
            $specialXtoY->discount = $request->discount;
        }
        $specialXtoY->save();

        return response()->json([
            "result" => "done"
        ]);
    }


    public function customerFixedPurches(Request $request)
    {


        $type_coupon = "cart";
        switch ($request->offer_applies) {
            case 1:
                $type_coupon = "cart";
                break;
            case 2:
                $type_coupon = "product";
                break;

            case 3:
                $type_coupon = "category";
                break;

            default:
                $type_coupon = "payment";
                break;
        }
        //   $coupon = new Coupon();
        $rand = substr(md5(microtime()), rand(0, 26), 5);

        // $coupon->type =  $type_coupon;
        // $coupon->code = $rand;
        // $coupon->discount = $request->discount;
        // if ($request->minimum_amount_of_purchases != "") {
        //     $coupon->minimum_amount_of_purchases = $request->max_discount;
        // }
        // $coupon->total_usage_for_all = 10000000;

        // if ($request->free_shipping != "") {
        //     $coupon->free_shipping = $request->free_shipping;
        // }
        // $coupon->total_usage_for_one_user = 1;

        // $coupon->discount_type = "amount";
        // $coupon->special_offers = 1;

        // // $date_var                 = explode(" - ", $request->date_range);
        // $coupon->start_date       = strtotime(now());
        // $coupon->end_date         = strtotime($request->endDate);
        // $coupon->save();



        $specialOffer = new SpecialOffer();
        $specialOffer->offer_title    = $request->title_offer;
        $specialOffer->end_date    = $request->endDate;
        // $specialOffer->coupon_id    = $coupon->id;

        $specialOffer->offer_type    = "amount";
        $specialOffer->save();


        if ($request->offer_applies == 2) {
            foreach ($request->products as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["id"];
                $specialProduct->type     = "product";
                $specialProduct->save();
            }
        } else if ($request->offer_applies == 3) {
            foreach ($request->categories as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["value"];
                $specialProduct->type     = "category";
                $specialProduct->save();
            }
        } else if ($request->offer_applies == 4) {
            foreach ($request->payments as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_name     = $item["value"];
                $specialProduct->type     = "payment";
                $specialProduct->save();
            }
        }


        $specialCustomerFixed = new SpecialOfferCustomerPurchase();
        $specialCustomerFixed->special_offers_id = $specialOffer->id;
        $specialCustomerFixed->type_discount = "amount";
        $specialCustomerFixed->discount = $request->discount;
        $specialCustomerFixed->with_coupon = $request->with_coupon;
        $specialCustomerFixed->min_type = $request->limit_price_or_product;
        $specialCustomerFixed->offer_applies_type = $request->offer_applies;

        if ($request->limit_price_or_product == "quantity") {
            $specialCustomerFixed->min_qty = $request->quantity;
        } else {
            $specialCustomerFixed->min_price = $request->price;
        }


        $specialCustomerFixed->save();

        return response()->json([
            "result" => "done"
        ]);
    }


    public function customerPercentPurches(Request $request)
    {


        $type_coupon = "cart";
        switch ($request->offer_applies) {
            case 1:
                $type_coupon = "cart";
                break;
            case 2:
                $type_coupon = "product";
                break;

            case 3:
                $type_coupon = "category";
                break;

            default:
                $type_coupon = "payment";
                break;
        }
        // $coupon = new Coupon();
        $rand = substr(md5(microtime()), rand(0, 26), 5);

        // $coupon->type =  $type_coupon;
        // $coupon->code = $rand;
        // $coupon->discount = $request->discount;
        // if ($request->minimum_amount_of_purchases != "") {
        //     $coupon->minimum_amount_of_purchases = $request->max_discount;
        // }
        // $coupon->total_usage_for_all = 10000000;

        // if ($request->free_shipping != "") {
        //     $coupon->free_shipping = $request->free_shipping;
        // }
        // $coupon->total_usage_for_one_user = 1;

        // $coupon->discount_type = "percent";
        // $coupon->special_offers = 1;

        // // $date_var                 = explode(" - ", $request->date_range);
        // $coupon->start_date       = strtotime(now());
        // $coupon->end_date         = strtotime($request->endDate);
        // $coupon->save();

        $specialOffer = new SpecialOffer();
        $specialOffer->offer_title    = $request->title_offer;
        $specialOffer->end_date    = $request->endDate;
        // $specialOffer->coupon_id    = $coupon->id;

        $specialOffer->offer_type    = "percent";
        $specialOffer->save();

        if ($request->offer_applies == 2) {
            foreach ($request->products as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["id"];
                $specialProduct->type     = "product";
                $specialProduct->save();
            }
        } else if ($request->offer_applies == 3) {
            foreach ($request->categories as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["value"];
                $specialProduct->type     = "category";
                $specialProduct->save();
            }
        } else if ($request->offer_applies == 4) {
            foreach ($request->categories as $item) {
                $specialProduct = new SpecialOfferProduct();
                $specialProduct->special_offers_id = $specialOffer->id;
                $specialProduct->object_id     = $item["value"];
                $specialProduct->type     = "payment";
                $specialProduct->save();
            }
        }


        $specialCustomerFixed = new SpecialOfferCustomerPurchase();
        $specialCustomerFixed->special_offers_id = $specialOffer->id;
        $specialCustomerFixed->type_discount = "percent";
        $specialCustomerFixed->discount = $request->discount_percent;
        // $specialCustomerFixed->with_coupon = $request->with_coupon;
        $specialCustomerFixed->maximum_discount = $request->max_discount;
        $specialCustomerFixed->min_type = $request->limit_price_or_product;
        $specialCustomerFixed->offer_applies_type = $request->offer_applies;


        if ($request->limit_price_or_product == "quantity") {
            $specialCustomerFixed->min_qty = $request->quantity;
        } else {
            $specialCustomerFixed->min_price = $request->price;
        }

        $specialCustomerFixed->save();
        return response()->json([
            "result" => "done"
        ]);
    }


    public function getSpecialOffers(Request $request)
    {
        // $pagination = $request->paginate != -1 ? "limit 10 offset $request->paginate" : "limit 100000";
        $specialOffers = SpecialOffer::all();


        foreach ($specialOffers as $specialOffer) {


            if ($specialOffer->offer_type == "x_to_y") {
                $specialOffer->specialOfferXtoY->discount = $specialOffer->specialOfferXtoY->discount . "%";
                $specialOffer->specialOfferXtoY;
            } else {


                if ($specialOffer->specialOfferCustomerPurches->type_discount != "percent") {
                    $specialOffer->specialOfferCustomerPurches->discount = single_price($specialOffer->specialOfferCustomerPurches->discount);
                } else {
                    $specialOffer->specialOfferCustomerPurches->discount = $specialOffer->specialOfferCustomerPurches->discount . "%";
                }
                $specialOffer->specialOfferCustomerPurches->min_price = single_price($specialOffer->specialOfferCustomerPurches->min_price);
                $specialOffer->specialOfferCustomerPurches->maximum_discount = single_price($specialOffer->specialOfferCustomerPurches->maximum_discount);


                $specialOffer->specialOfferCustomerPurches;
            }
            $specialOffer->specialOfferProduct;
        }


        return response()->json([
            "specialOffers" => $specialOffers
        ]);
    }

    public function new_spcial_offers(Request $request)
    {
        return view("backend.special_offers.new_sprcial_offer");
    }



    public function special_offer_cart(Request $request)
    {

        //  return dd("Dsds");
        $special_offer_cart =   DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers.id', '=', 'special_offers_customer_purchase.special_offers_id');
            })
            // ->join('coupons', function ($join) {
            //     $join->on('coupons.id', '=', 'special_offers.coupon_id');
            // })
            ->where("special_offers_customer_purchase.offer_applies_type", 1)
            ->where("special_offers.end_date", ">", now())

            ->select("special_offers_customer_purchase.*", "special_offers.*", "coupons.id as coupon_id", "coupons.code")
            ->first();

        // $coupon_usage = 1;
        // if (!empty($special_offer_cart)) {
        //     $coupon_usage = CouponUsage::where("coupon_id", $special_offer_cart->coupon_id)->where("user_id", auth()->user()->id)->count();
        // }


        return response()->json([
            "special_offer_cart" => $special_offer_cart,
            // "coupon_usage" => $coupon_usage
        ]);
    }

    public function spcial_offer_destroy($id)
    {
        $spcial_offer = SpecialOffer::find($id);

        if (!empty($spcial_offer)) {
            if (count($spcial_offer->specialOfferProduct) != 0) {
                foreach ($spcial_offer->specialOfferProduct as $item) {
                    $item->delete();
                }
            }
            if (!empty($spcial_offer->specialOfferCustomerPurches)) {
                $spcial_offer->specialOfferCustomerPurches->delete();
            }
            if (!empty($spcial_offer->specialOfferXtoY)) {
                $spcial_offer->specialOfferXtoY->delete();
            }

            $spcial_offer->delete();
        }

        return response()->json([
            "msg" => "done",
        ]);
    }

    public  function get_categories_offer()
    {
        $special_offer = new SpcialOffer();

        $cat_offers = $special_offer->show_offer_cat_data();
        return response()->json([
            "status" => "1",
            "cat_offers" => $cat_offers
        ]);
    }
}

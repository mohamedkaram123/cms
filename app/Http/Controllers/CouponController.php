<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\Coupon;
use App\Product;
use Schema;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('backend.marketing.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.marketing.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->product_ids = json_decode($request->product_ids);


        if (count(Coupon::where('code', $request->coupon_code)->get()) > 0) {
            flash(translate('Coupon already exist for this coupon code'))->error();
            return back();
        }
        $coupon = new Coupon;
        if ($request->coupon_type == "product_base") {
            $coupon->type = $request->coupon_type;
            $coupon->code = $request->coupon_code;
            $coupon->discount = $request->discount;
            if ($request->minimum_amount_of_purchases != "") {
                $coupon->minimum_amount_of_purchases = $request->minimum_amount_of_purchases;
            }
            if ($request->total_usage_for_all != "") {
                $coupon->total_usage_for_all = $request->total_usage_for_all;
            }

            if ($request->total_usage_for_one_user != "") {
                $coupon->total_usage_for_one_user = $request->total_usage_for_one_user;
            }
            $coupon->discount_type = $request->discount_type;
            $date_var                 = explode(" - ", $request->date_range);
            $coupon->start_date       = strtotime($date_var[0]);
            $coupon->end_date         = strtotime($date_var[1]);
            $cupon_details = array();
            foreach ($request->product_ids as $product_id) {
                $data['product_id'] = $product_id;
                array_push($cupon_details, $data);
            }
            $coupon->details = json_encode($cupon_details);
            if ($coupon->save()) {
                flash(translate('Coupon has been saved successfully'))->success();
                return redirect()->route('coupon.index');
            } else {
                flash(translate('Something went wrong'))->danger();
                return back();
            }
        } elseif ($request->coupon_type == "cart_base") {
            $coupon->type             = $request->coupon_type;
            $coupon->code             = $request->coupon_code;
            $coupon->discount         = $request->discount;
            $coupon->discount_type    = $request->discount_type;
            if ($request->total_usage_for_one_user != "") {
                $coupon->total_usage_for_one_user = $request->total_usage_for_one_user;
            }
            if ($request->total_usage_for_all != "") {
                $coupon->total_usage_for_all = $request->total_usage_for_all;
            }
            if ($request->free_shipping != "") {
                $coupon->free_shipping = $request->free_shipping;
            }
            $date_var                 = explode(" - ", $request->date_range);
            $coupon->start_date       = strtotime($date_var[0]);
            $coupon->end_date         = strtotime($date_var[1]);
            $data                     = array();
            $data['min_buy']          = $request->min_buy;
            $data['max_discount']     = $request->max_discount;
            $coupon->details          = json_encode($data);
            if ($coupon->save()) {
                flash(translate('Coupon has been saved successfully'))->success();
                return redirect()->route('coupon.index');
            } else {
                flash(translate('Something went wrong'))->danger();
                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail(decrypt($id));
        return view('backend.marketing.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->product_ids = json_decode($request->product_ids);

        if (count(Coupon::where('id', '!=', $id)->where('code', $request->coupon_code)->get()) > 0) {
            flash(translate('Coupon already exist for this coupon code'))->error();
            return back();
        }

        $coupon = Coupon::findOrFail($id);
        if ($request->coupon_type == "product_base") {
            $coupon->type = $request->coupon_type;
            $coupon->code = $request->coupon_code;
            $coupon->discount = $request->discount;
            if ($request->total_usage_for_one_user != "") {
                $coupon->total_usage_for_one_user = $request->total_usage_for_one_user;
            }
            if ($request->minimum_amount_of_purchases != "") {
                $coupon->minimum_amount_of_purchases = $request->minimum_amount_of_purchases;
            }
            if ($request->total_usage_for_all != "") {
                $coupon->total_usage_for_all = $request->total_usage_for_all;
            }

            $coupon->discount_type  = $request->discount_type;
            $date_var                 = explode(" - ", $request->date_range);
            $coupon->start_date       = strtotime($date_var[0]);
            $coupon->end_date         = strtotime($date_var[1]);
            $cupon_details = array();
            foreach ($request->product_ids as $product_id) {
                $data['product_id'] = $product_id;
                array_push($cupon_details, $data);
            }
            $coupon->details = json_encode($cupon_details);
            if ($coupon->save()) {
                flash(translate('Coupon has been saved successfully'))->success();
                return redirect()->route('coupon.index');
            } else {
                flash(translate('Something went wrong'))->danger();
                return back();
            }
        } elseif ($request->coupon_type == "cart_base") {
            $coupon->type           = $request->coupon_type;
            $coupon->code           = $request->coupon_code;
            $coupon->discount       = $request->discount;
            $coupon->discount_type  = $request->discount_type;
            if ($request->total_usage_for_one_user != "") {
                $coupon->total_usage_for_one_user = $request->total_usage_for_one_user;
            }

            if ($request->total_usage_for_all != "") {
                $coupon->total_usage_for_all = $request->total_usage_for_all;
            }
            if ($request->free_shipping != "") {
                $coupon->free_shipping = $request->free_shipping;
            }
            $date_var               = explode(" - ", $request->date_range);
            $coupon->start_date     = strtotime($date_var[0]);
            $coupon->end_date       = strtotime($date_var[1]);
            $data                   = array();
            $data['min_buy']        = $request->min_buy;
            $data['max_discount']   = $request->max_discount;
            $coupon->details        = json_encode($data);
            if ($coupon->save()) {
                flash(translate('Coupon has been saved successfully'))->success();
                return redirect()->route('coupon.index');
            } else {
                flash(translate('Something went wrong'))->danger();
                return back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        if (Coupon::destroy($id)) {
            flash(translate('Coupon has been deleted successfully'))->success();
            return redirect()->route('coupon.index');
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function get_coupon_form(Request $request)
    {
        if ($request->coupon_type == "product_base") {
            return view('backend.marketing.coupons.product_base_coupon');
        } elseif ($request->coupon_type == "cart_base") {
            return view('backend.marketing.coupons.cart_base_coupon');
        }
    }

    public function get_coupon_form_edit(Request $request)
    {
        if ($request->coupon_type == "product_base") {
            $coupon = Coupon::findOrFail($request->id);
            return view('backend.marketing.coupons.product_base_coupon_edit', compact('coupon'));
        } elseif ($request->coupon_type == "cart_base") {
            $coupon = Coupon::findOrFail($request->id);
            return view('backend.marketing.coupons.cart_base_coupon_edit', compact('coupon'));
        }
    }

    public function search_product(Request $request)
    {


        $product = Product::query();

        if ($request->name != "") {
            $product->where("name", $request->name);
        }
        if ($request->discount != "") {
            $product->where("discount", $request->discount);
        }
        if ($request->unit_price != "") {
            $product->where("unit_price", $request->unit_price);
        }
        if ($request->brand_id != "") {
            $product->where("brand_id", $request->brand_id);
        }
        if ($request->category_id != "") {
            $product->where("category_id", $request->category_id);
        }
        if ($request->current_stock != "") {
            $product->where("current_stock", $request->current_stock);
        }
        if ($request->purchase_price != "") {
            $product->where("purchase_price", $request->purchase_price);
        }
        if ($request->shipping_cost != "") {
            $product->where("shipping_cost", $request->shipping_cost);
        }


        $products = $product->offset($request->offset)->limit($request->limit)->get();

        if ($request->offset == 0) {
            $view = $request->list_type == "flashDeal" ? view("backend.marketing.flash_deals.product_list", ["products" => $products])->render() : view("backend.marketing.coupons.product_list", ["products" => $products])->render();
            return  response()->json([
                "view" => $view
            ]);
        } else {

            $views = [];
            foreach ($products as $product) {
                $views[] =  view("backend.marketing.coupons.one_product_list", ["product" => $product])->render();
            }
            return  response()->json([
                "views" => $views
            ]);
        }
    }
}

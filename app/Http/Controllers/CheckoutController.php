<?php

namespace App\Http\Controllers;

use App\Utility\PayfastUtility;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\InstamojoController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\PaytmController;
use App\Order;
use App\CommissionHistory;
use App\BusinessSetting;
use App\Coupon;
use App\CouponUsage;
use App\User;
use App\Address;
use App\Models\Cart;
use App\myTraits\Shipping;
use Session;
use App\Utility\PayhereUtility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\MyClasses\GetPaymentMethod;
use App\MyClasses\OrdersNotes;

class CheckoutController extends Controller
{

    use Shipping;

    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly


    // public function createCeckoutOrder(Request $request)
    // {
    //     // return dd($request->all());

    //     // Session::put('owner_id',$request->cart["id"]);
    //     Session::put('owner_id', $request->owner_id);

    //     Session::put('shipping_info', $request->shippingData);
    //     $request["order_admin"] = auth()->user()->id;
    //     $request["customer_id"] = $request->customer_id;
    //     $request["carts"] = $request->carts;
    //     //        $request["customer_id"] = $request->customer["id"];

    //     return $this->checkout($request);
    // }


    public function createCeckoutOrder(Request $request)
    {

        Session::put('owner_id', $request->cart["id"]);
        Session::put('shipping_info', $request->shippingData);
        $request["order_admin"] = auth()->user()->id;
        $request["customer_id"] = $request->customer["id"];

        return $this->checkout($request);
    }


    public function checkout(Request $request)
    {
        // return dd($request->all());


        session()->put("products", $request->products);
        session()->put("payment_option", $request->payment_option);

        // return $request->payment_option;
        if ($request->payment_option != null) {


            // if (!empty($request->order_admin)) {
            //     // return "dsdsds";

            //     $orderController = new OrderController;
            //     $orderController->store($request, $request->order_admin ? $request->order_admin : 0);

            //     session()->put("admin_order_id", session()->get("order_id"));
            // } else {


            //     $orderController = new OrderController;
            //     $orderController->store($request, $request->order_admin ? $request->order_admin : 0);

            //     // }
            //     //  session()->put("page", 1);
            // }


            //            return dd($orderController);
            $request->session()->put('payment_type', 'cart_payment');

            if ($request->payment_option == 'paytabsaudi' || $request->payment_option == 'paytabegypt') {


                // session()->put('payment_option', $request->payment_option);

                $paytab = new PayTabController($request->payment_option);
                return $paytab->pay();
            } else if ($request->payment_option == 'tappayment') {


                $paytab = new TabpaymentController();

                // if ($request->order_admin) {

                //     session()->put('order_admin', $request->order_admin);
                //     return response()->json([
                //         "url" => route('new_order.view_tappayment')
                //     ]);
                // }
                return $paytab->view_card_page();
            } else if ($request->payment_option == 'fekra_pay') {

                if ($request->pay_method != "") {
                    $fekra_pay = new FekraPayController(null, $request->pay_method);


                    return  $fekra_pay->pay();
                }
                flash(translate("please select payment from fekra pay"))->error();
                return back();
            } elseif ($request->payment_option == 'cash_on_delivery') {

                // $request->session()->put('cart', Session::get('cart')->where('owner_id', '!=', Session::get('owner_id')));

                // $carts = Cart::where("owner_id",Session::get('owner_id'))->where("admin_order",$request->admin_order?$request->admin_order:0)->where("user_id",$request->customer_id?$request->customer_id:auth()->user()->id)->get();

                // foreach ($carts as $item ) {
                //     $item->delete();
                // }
                $orderController = new OrderController;

                $orderController->store($request, 0);
                $request->session()->forget('owner_id');
                $request->session()->forget('delivery_info');

                $request->session()->forget('coupon_id');
                $request->session()->forget('coupon_discount');
                $request->session()->forget('club_point');
                session()->forget('address');
                session()->forget('products');
                session()->forget('pay_id');

                flash(translate("Your order has been placed successfully"))->success();

                if ($request->order_admin) {

                    return response()->json([
                        "url" => route('admin.new_order')
                    ]);
                }
                return redirect()->route('order_confirmed');
            } elseif ($request->payment_option == 'wallet') {
                $user = Auth::user();
                $orderController = new OrderController;

                $orderController->store($request, 0);
                $orders = session()->get("orders");
                // $order = Order::findOrFail($request->session()->get('order_id'));
                $grand_total = 0;
                foreach ($orders as $order) {
                    $grand_total += $order->grand_total;
                }
                if ($user->balance >= $grand_total) {
                    $user->balance -= $grand_total;
                    $user->save();
                    return $this->checkout_done(null, $orders);
                }
            } else {
                $order = Order::findOrFail($request->session()->get('order_id'));
                $order->manual_payment = 1;
                $order->save();

                $request->session()->put('cart', Session::get('cart')->where('owner_id', '!=', Session::get('owner_id')));
                $request->session()->forget('owner_id');
                $request->session()->forget('delivery_info');
                $request->session()->forget('coupon_id');
                $request->session()->forget('coupon_discount');
                $request->session()->forget('club_point');
                session()->forget('address');
                session()->forget('products');
                session()->forget('pay_id');

                flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
                return redirect()->route('order_confirmed');
            }
        } else {
            flash(translate('Select Payment Option.'))->warning();
            return back();
        }
    }

    //after payment fawry
    public function checkout_done_fawry($payment, $user_id, $products)
    {

        $request = new Request([

            "payment_option" => "fawry",
            "user" => $user_id,
            "products" => $products

        ]);
        //  dd(session()->all());
        //   session()->put('payment_type', 'cart_payment');

        $orderController = new OrderController;
        $orderController->store($request);



        /// return dd($payment);

        $orders = session()->get("orders");

        $orderController = new OrderController();


        /// return dd($payment);
        foreach ($orders as $order) {
            $order = Order::findOrFail($order->id);
            if (empty($order->payment_details)) {
                $order->payment_details =  $payment;
            }
            $order->save();


            $request = new Request([
                "order_id" => $order->id,
                "status" => "paid"
            ]);



            $orderController->update_payments_elc($request);
        }


        Session::forget('owner_id');
        Session::forget('payment_type');
        Session::forget('delivery_info');
        Session::forget('coupon_id');
        Session::forget('coupon_discount');
        Session::forget('club_point');
        Session::forget('address');

        session()->forget('products');
        session()->forget('pay_id');


        flash(translate('Payment completed'))->success();
        return view('frontend.order_confirmed', compact('orders'));
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($payment, $orders)
    {



        $orderController = new OrderController();


        /// return dd($payment);
        foreach ($orders as $order) {
            $order = Order::findOrFail($order->id);
            if (empty($order->payment_details)) {
                $order->payment_details =  $payment;
            }
            $order->save();


            $request = new Request([
                "order_id" => $order->id,
                "status" => "paid"
            ]);



            $orderController->update_payments_elc($request);
        }


        Session::forget('owner_id');
        Session::forget('payment_type');
        Session::forget('delivery_info');
        Session::forget('coupon_id');
        Session::forget('coupon_discount');
        Session::forget('club_point');
        Session::forget('address');
        session()->forget('products');
        session()->forget('pay_id');




        flash(translate('Payment completed'))->success();


        return view('frontend.order_confirmed', compact('orders'));
    }

    public function choose_products(Request $request)
    {


        if (count(auth()->user()->carts) > 0) {
            // $categories = Category::all();
            return view('frontend.choose_products');

            //return view('frontend.shipping_info', compact('categories'));
        }
        flash(translate('Your cart is empty'))->success();
        return back();
    }

    public function get_shipping_info(Request $request)
    {
        OrdersNotes::put_session_photos($request);

        $products = [];

        if ($request->products != null) {
            $products = json_decode($request->products);
        }



        if (count($products) == 0) {
            flash(translate('please choose products'))->warning();
            return back();
        }
        foreach ($products as $item) {
            $seller_id = $item->owner_id;
        }
        if (count(auth()->user()->carts) > 0) {
            $categories = Category::all();
            return view('frontend.delivery_info', [
                "products" => $request->products,
                "seller_id" => $seller_id
            ]);

            //return view('frontend.shipping_info', compact('categories'));
        }
        flash(translate('Your cart is empty'))->success();
        return back();
    }

    public function store_shipping_info(Request $request)
    {

        if (session()->has("shipping_info")) {
            $request->request->add(session()->get("shipping_info"));
        }


        if (Auth::check()) {
            if ($request->address_id == null) {
                flash(translate("Please add shipping address"))->warning();
                return back();
            }
            $address = Address::findOrFail($request->address_id);
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data['address'] = $address->address;
            $data['country'] = $address->country;
            $data['city'] = $address->city;
            $data['postal_code'] = $address->postal_code;
            $data['phone'] = $address->phone;
            $data['checkout_type'] = $request->checkout_type;
            $data['address_id'] = $address->id;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['country'] = $request->country;
            $data['city'] = $request->city;
            $data['postal_code'] = $request->postal_code;
            $data['phone'] = $request->phone;
            $data['checkout_type'] = $request->checkout_type;
        }

        $shipping_info = $data;
        // $request->session()->put('shipping_info', $shipping_info);

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        // $city =  \App\City::where("name", $shipping_info['city'])->first();

        foreach (auth()->user()->carts as $key => $cartItem) {
            $subtotal += $cartItem['price'] * $cartItem['quantity'];
            $tax += $cartItem['tax'] * $cartItem['quantity'];
            $shipping += $this->shipping_cost;
            // if (isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
            //     foreach (json_decode($cartItem['shipping'], true) as $shipping_region => $val) {
            //         if ($shipping_info['city'] == $shipping_region) {
            //             $shipping += (float)($val) * $cartItem['quantity'];
            //         }
            //     }
            // } else {
            //     if (!$cartItem['shipping']) {

            //         $shipping += !empty($city) ? (float)$city->cost : 0;
            //     }
            //     //                $shipping += $cartItem['shipping'] * $cartItem['quantity'];

            // }
        }

        $total = $subtotal + $tax + $shipping;

        if (Session::has('coupon_discount')) {
            $total -= Session::get('coupon_discount');
        }

        return view('frontend.delivery_info');
        // return view('frontend.payment_select', compact('total'));
    }

    public function store_delivery_info(Request $request)
    {



        // return dd(session()->get("address"));


        // session()->forget('page');
        // $request->session()->put('owner_id', $request->owner_id);

        $products = json_decode($request->productss);

        $carts = collect();
        foreach ($products as $item) {
            $carts[] = Cart::where("user_id", auth()->user()->id)->where("owner_id", $item->owner_id)->where("product_id", $item->product_id)->first();
        }

        //dd($carts);



        //dd(session()->get("cart"));
        if (session()->has("address")) {
            if (count($carts) > 0 && $carts[0] != null) {

                $carts = $carts->map(function ($object, $key) use ($request) {

                    if (\App\Product::find($object['product_id'])->user_id == $object->owner_id) {

                        if ($request['shipping_type_' . $request->owner_id] == 'pickup_point') {
                            $object->shipping_type = 'pickup_point';

                            // $object['pickup_point'] = $request['pickup_point_id_' . $request->owner_id];
                        } else {

                            $object->shipping_type = 'home_delivery';
                        }
                    }
                    // $object->shipping_type = $object['shipping_type'];

                    return $object;
                });

                // $request->session()->put('cart', $cart);

                // $cart = $cart->map(function ($object, $key) use ($request) {
                //     if (\App\Product::find($object['product_id'])->user_id == $request->owner_id) {
                //         if ($object['shipping_type'] == 'home_delivery') {
                //             $object['shipping'] = getShippingCost($key);
                //         } else {
                //             $object['shipping'] = 0;
                //         }
                //     } else {
                //         $object['shipping'] = 0;
                //     }
                //     return $object;
                // });

                // $request->session()->put('cart', $cart);
                //                $shipping_info = $request->session()->get('shipping_info');
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;
                // $city =  \App\City::where("name", $shipping_info['city'])->first();

                // dd("Dsds");
                //   dd(session()->get("cart"));


                foreach ($carts as $key => $cartItem) {
                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                    $tax += $cartItem['tax'] * $cartItem['quantity'];
                    // if (isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
                    //     foreach (json_decode($cartItem['shipping'], true) as $shipping_region => $val) {

                    //         if ($shipping_info['city'] == $shipping_region) {
                    //             $shipping += (float)($val) * $cartItem['quantity'];
                    //         }
                    //     }
                    // } else {
                    if (session()->has("address")) {

                        //return
                        $shipping_info = session()->get("address");
                        // return dd($shipping_info);
                        $shipping += $shipping_info["cost"];
                        //}
                    }
                }


                //$cart->update();

                foreach ($carts as $item) {

                    $item->update();
                    //  return dd($item);
                };

                $total = $subtotal + $tax + $shipping;

                if (Session::has('coupon_discount')) {
                    $total -= Session::get('coupon_discount');
                }

                session()->put("products", json_encode($products));
                return view('frontend.payment_select', compact('total', 'shipping_info', 'products'));
            } else {
                flash(translate('Your Cart was empty'))->warning();
                return redirect()->route('home');
            }
        } else {
            flash(translate('Please Enter adress'))->warning();
            return redirect()->route("cart");
        }
    }

    public function get_payment_info(Request $request)
    {

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        $shipping_info = $this->shipping_data();
        // $shipping_info = $request->session()->get('shipping_info');
        // $city =  \App\City::where("name", $shipping_info['city'])->first();

        foreach (Session::get('cart') as $key => $cartItem) {

            $subtotal += $cartItem['price'] * $cartItem['quantity'];
            $tax += $cartItem['tax'] * $cartItem['quantity'];
            // if (isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
            //     foreach (json_decode($cartItem['shipping'], true) as $shipping_region => $val) {
            //         if ($shipping_info['city'] == $shipping_region) {
            //             $shipping += (float)($val) * $cartItem['quantity'];
            //         }
            //     }
            // } else {
            //     if (!$cartItem['shipping']) {
            //         $shipping += !empty($city) ? (float)$city->cost : 0;
            //     }
            // }

            $shipping += $this->shipping_cost();
        }

        // return dd($shipping_info);
        $total = $subtotal + $tax + $shipping;

        if (Session::has('coupon_discount')) {
            $total -= Session::get('coupon_discount');
        }
        $products =  json_decode(session()->get("products"));


        return view('frontend.payment_select', compact('total', 'shipping_info', 'products'));
    }

    public function apply_coupon_code(Request $request)
    {


        $products = json_decode($request->products);


        $coupon = Coupon::where('code', $request->code)->first();
        $carts = [];
        foreach ($products as $item) {
            $carts[] = Cart::where("owner_id", $item->owner_id)->where("user_id", auth()->user()->id)->where("product_id", $item->product_id)->first();
        }



        //  return dd($carts);
        if ($coupon != null) {

            if ($coupon->special_offers == 1) {

                if ($coupon->type == "cart") {
                    $special_offer_cart =   DB::table('special_offers')
                        ->join('special_offers_customer_purchase', function ($join) {
                            $join->on('special_offers.id', '=', 'special_offers_customer_purchase.special_offers_id');
                        })
                        ->join('coupons', function ($join) {
                            $join->on('coupons.id', '=', 'special_offers.coupon_id');
                        })
                        ->where("special_offers_customer_purchase.offer_applies_type", 1)
                        ->where("special_offers.end_date", ">", now())

                        ->select("special_offers_customer_purchase.*", "special_offers_customer_purchase.discount as spcial_discount", "special_offers.*", "coupons.id as coupon_id", "coupons.*")
                        ->first();

                    $coupon_usage = CouponUsage::where("coupon_id", $special_offer_cart->coupon_id)->where("user_id", auth()->user()->id)->count();

                    // return dd($coupon_usage);
                    if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                        if ($coupon_usage < 1) {

                            // $carts = DB::table('carts')
                            //     ->where("user_id", auth()->user()->id)
                            //          ->select(DB::raw("sum('tax') + sum('price') + sum('shipping_cost') * sum('quantity')"))
                            $subtotal = 0;
                            $tax = 0;
                            $shipping = 0;
                            $quantity = 0;
                            foreach ($carts as $key => $cartItem) {
                                $quantity += $cartItem['quantity'];
                                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                                $tax += $cartItem['tax'] * $cartItem['quantity'];
                                $shipping += $cartItem['shipping_cost'] * $cartItem['quantity'];
                            }
                            $sum = $subtotal + $tax + $shipping;
                            if ($special_offer_cart->min_type == "price" &&  $special_offer_cart->min_price < $sum || $special_offer_cart->min_type == "quantity" &&  $special_offer_cart->min_qty < $quantity) {
                                if ($special_offer_cart->type_discount == "amount") {
                                    $coupon_discount = $special_offer_cart->spcial_discount;
                                } elseif ($special_offer_cart->type_discount == "percent") {
                                    $coupon_discount = ($sum * $special_offer_cart->spcial_discount) / 100;
                                    if ($coupon_discount > $special_offer_cart->maximum_discount) {
                                        $coupon_discount = $special_offer_cart->maximum_discount;
                                    }
                                }

                                $request->session()->put('coupon_id', $coupon->id);
                                $request->session()->put('coupon_discount', $coupon_discount);
                                flash(translate('Coupon has been applied'))->success();
                            } else {
                                flash(translate('Minimum Amount of Purchases Not Enough or number of products not enough'))->warning();
                            }
                        } else {
                            flash(translate('You already used this coupon!'))->warning();
                        }
                    } else {
                        flash(translate('Coupon expired!'))->warning();
                    }
                }
            } else {
                if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date && count(CouponUsage::where('coupon_id', $coupon->id)->get()) < $coupon->total_usage_for_all) {
                    if (count(CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->get())  < $coupon->total_usage_for_one_user) {
                        $coupon_details = json_decode($coupon->details);

                        if ($coupon->type == 'cart_base') {
                            $subtotal = 0;
                            $tax = 0;
                            $shipping = 0;
                            $coupon_discount = 0;

                            foreach ($carts as $key => $cartItem) {
                                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                                $tax += $cartItem['tax'] * $cartItem['quantity'];
                                $shipping += $cartItem['shipping'] * $cartItem['quantity'];
                            }
                            $sum = $subtotal + $tax + $shipping;


                            if ($sum >= $coupon_details->min_buy) {
                                if ($coupon->discount_type == 'percent') {
                                    $coupon_discount = ($sum * $coupon->discount) / 100;
                                    if ($coupon_discount > $coupon_details->max_discount) {
                                        $coupon_discount = $coupon_details->max_discount;
                                    } else {
                                        flash(translate('You have exceeded the maximum discount'))->warning();
                                    }
                                } elseif ($coupon->discount_type == 'amount') {
                                    $coupon_discount = $coupon->discount;
                                }

                                $request->session()->put('coupon_id', $coupon->id);
                                $request->session()->put('coupon_discount', $coupon_discount);
                                flash(translate('Coupon has been applied'))->success();
                            } else {
                                flash(translate('Minimum Amount of Purchases Not Enough'))->warning();
                            }
                        } elseif ($coupon->type == 'product_base') {
                            $coupon_discount = 0;
                            foreach ($carts as $key => $cartItem) {
                                if ($cartItem['price'] < $coupon->minimum_amount_of_purchases) {
                                    flash(translate('Minimum Amount of Purchases Not Enough'))->warning();
                                    return back();
                                }
                                foreach ($coupon_details as $key => $coupon_detail) {
                                    if ($coupon_detail->product_id == $cartItem['product_id']) {
                                        if ($coupon->discount_type == 'percent') {
                                            $coupon_discount += $cartItem['price'] * $coupon->discount / 100;
                                        } elseif ($coupon->discount_type == 'amount') {
                                            $coupon_discount += $coupon->discount;
                                        }
                                    }
                                }
                            }
                            if ($coupon_discount != 0) {
                                $request->session()->put('coupon_id', $coupon->id);
                                $request->session()->put('coupon_discount', $coupon_discount);
                                flash(translate('Coupon has been applied'))->success();
                            } else {
                                flash(translate('The product in your order is not included in the coupon'))->warning();
                            }
                        }
                    } else {
                        flash(translate('You already used this coupon!'))->warning();
                    }
                } else {
                    flash(translate('Coupon expired!'))->warning();
                }
            }
        } else {
            flash(translate('Invalid coupon!'))->warning();
        }
        return back();
    }

    public function remove_coupon_code(Request $request)
    {
        $request->session()->forget('coupon_id');
        $request->session()->forget('coupon_discount');
        return back();
    }

    public function apply_club_point(Request $request)
    {
        if (
            \App\Addon::where('unique_identifier', 'club_point')->first() != null &&
            \App\Addon::where('unique_identifier', 'club_point')->first()->activated
        ) {

            $point = $request->point;

            //            if(Auth::user()->club_point->points >= $point) {
            if (Auth::user()->point_balance >= $point) {
                $request->session()->put('club_point', $point);
                flash(translate('Point has been redeemed'))->success();
            } else {
                flash(translate('Invalid point!'))->warning();
            }
        }
        return back();
    }

    public function remove_club_point(Request $request)
    {
        $request->session()->forget('club_point');
        return back();
    }

    public function order_confirmed()
    {

        // return dd(Session::get('orders'));
        $orders = Session::get('orders');
        $order = Order::findOrFail(Session::get('order_id'));
        return view('frontend.order_confirmed', compact('orders'));
    }

    public function select_pay_fekra()
    {

        $data =  (new GetPaymentMethod())->pay();

        if ($data->status == "success") {
            $pays =   $data->PaymentMethods;

            $view = view("frontend.body_select_pay", [
                "pays" => $pays
            ])->render();
            return response()->json([
                "view" => $view
            ]);
        }
    }
}

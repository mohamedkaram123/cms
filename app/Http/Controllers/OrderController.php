<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\Order;
use App\Product;
use App\ProductStock;
use App\CommissionHistory;
use App\Color;
use App\OrderDetail;
use App\CouponUsage;
use App\OtpConfiguration;
use App\User;
use App\BusinessSetting;
use Auth;
use Session;
use DB;
use Mail;
use App\Mail\InvoiceEmailManager;
use App\Models\Cart;
use App\Coupon;
use App\Mail\SupportMailManager;
use App\Models\OrdersLogStatus;
use App\Models\RefundRequest;
use App\Models\TemporaryDiscountUsage;
use App\MyClasses\CoreComponentRepository;
use App\MyClasses\OrderData;
use App\MyClasses\OrdersNotes;
use App\MyClasses\SpcialOffer;
use App\MyClasses\TempDiscount;
use App\Support\Collection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $orders = DB::table('orders')

            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->orderBy('code', 'desc')
            //                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('order_details.seller_id', Auth::user()->id)

            ->select('orders.id')
            ->distinct();

        if ($request->payment_status != null) {
            $orders = $orders->where('payment_status', $request->payment_status);
            $payment_status = $request->payment_status;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }

        $orders = $orders->paginate(15);

        foreach ($orders as $key => $value) {
            $order = \App\Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('frontend.user.seller.orders', compact('orders', 'payment_status', 'delivery_status', 'sort_search'));
    }

    // All Orders
    public function all_orders(Request $request, $type = null)
    {

        //   CoreComponentRepository::instantiateShopRepository();
        $orders = Order::orderBy('code', 'desc');

        if ($type != null) {

            $date = null;
            $sort_search = null;

            if ($request->has("search")) {

                $orders_data = [];

                if (is_numeric($request->search)) {

                    $orders = $orders
                        ->where('code', 'like', '%' . $request->search . '%')
                        ->orWhere('id', 'like', '%' . $request->search . '%')
                        ->get();

                    $orders_data = $orders;
                } else if (preg_match('/\d{8}-\d{8}/', $request->search)) {

                    $orders = $orders
                        ->where('code', 'like', '%' . $request->search . '%')
                        ->get();

                    $orders_data = $orders;
                } else {

                    $orders = $orders->get();

                    foreach ($orders as $item) {

                        if ($item->user != null) {

                            if (preg_match("/{$request->search}/i", $item->user->name)) {

                                $orders_data[] =  $item;
                            }
                        }
                    }
                }
            }

            $orders =  (new Collection($orders_data))->paginate(15);
            return view('backend.sales.all_orders.index', compact('orders', 'sort_search', 'date'));
        }

        $date = $request->date;
        $sort_search = null;
        $orders = Order::orderBy('code', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }
        if ($date != null) {
            $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }
        $orders = $orders->paginate(15);
        return view('backend.sales.all_orders.index', compact('orders', 'sort_search', 'date'));
    }

    public function customDecrypt($vWord)
    {
        $newEncrypter = new \Illuminate\Encryption\Encrypter(env("ENCRYPT_KEY"), "AES-256-CBC");
        return $newEncrypter->decryptString($vWord);
    }

    public function all_orders_show($id)
    {
        $order = Order::findOrFail($this->customDecrypt($id));
        return view('backend.sales.all_orders.show', compact('order'));
    }

    // Inhouse Orders
    public function admin_orders(Request $request)
    {
        // CoreComponentRepository::instantiateShopRepository();

        $date = $request->date;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;


        $orders = DB::table('orders')
            ->orderBy('code', 'desc')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where("order_details.seller_id", $admin_user_id)
            // ->where('seller_id', $admin_user_id)
            ->select('orders.id')
            ->distinct();

        if ($request->payment_type != null) {
            $orders = $orders->where('payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }
        if ($date != null) {
            $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }

        $orders = $orders->paginate(15);
        return view('backend.sales.inhouse_orders.index', compact('orders', 'payment_status', 'delivery_status', 'sort_search', 'admin_user_id', 'date'));
    }

    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('backend.sales.inhouse_orders.show', compact('order'));
    }

    // Seller Orders
    public function seller_orders(Request $request)
    {
        //  CoreComponentRepository::instantiateShopRepository();

        $date = $request->date;
        $seller_id = $request->seller_id;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;

        $orders = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where("order_details.seller_id", "!=", $admin_user_id)
            ->orderBy('code', 'desc')
            ->select('orders.id')
            ->distinct();

        if ($request->payment_type != null) {
            $orders = $orders->where('orders.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }
        if ($date != null) {
            $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }
        // if ($seller_id) {
        //     $orders = $orders->where('seller_id', $seller_id);
        // }

        $orders = $orders->paginate(15);

        // return dd($orders);

        return view('backend.sales.seller_orders.index', compact('orders', 'payment_status', 'delivery_status', 'sort_search', 'admin_user_id', 'seller_id', 'date'));
    }

    public function seller_orders_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('backend.sales.seller_orders.show', compact('order'));
    }


    // Pickup point orders
    public function pickup_point_order_index(Request $request)
    {
        $date = $request->date;
        $sort_search = null;

        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->pick_up_point != null) {
            //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
            $orders = DB::table('orders')
                ->orderBy('code', 'desc')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
                ->select('orders.id')
                ->distinct();

            if ($request->has('search')) {
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
            }
            if ($date != null) {
                $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders'));
        } else {
            //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
            $orders = DB::table('orders')
                ->orderBy('code', 'desc')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.shipping_type', 'pickup_point')
                ->select('orders.id')
                ->distinct();

            if ($request->has('search')) {
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
            }
            if ($date != null) {
                $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders', 'sort_search', 'date'));
        }
    }

    public function pickup_point_order_sales_show($id)
    {
        if (Auth::user()->user_type == 'staff') {
            $order = Order::findOrFail(decrypt($id));
            return view('backend.sales.pickup_point_orders.show', compact('order'));
        } else {
            $order = Order::findOrFail(decrypt($id));
            return view('backend.sales.pickup_point_orders.show', compact('order'));
        }
    }

    /**
     * Display a single sale to admin.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $order_admin = 0, $user_id = null)
    {

        $products = json_decode($request->products);

        //    return dd($products);
        $owners = [];
        $orders = [];
        foreach ($products as $product) {

            $owners[] = $product->owner_id;
        }

        $owners = array_unique($owners);

        // foreach ($owners as $owner_id) {

        // return   dd($request->all());
        $user_id = !empty($user_id) ? $user_id : Auth::user()->id;

        $order = new Order;
        //    if (Auth::check() || $user_id != null) {
        //         $order->user_id = $user_id;
        //     } else {
        //         $order->guest_id = mt_rand(100000, 999999);
        //     }
        $order->user_id = $user_id;

        //$order->seller_id = $owner_id;

        $order->shipping_address = json_encode(session()->get('address'));

        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = $order_admin != 0 ? $request->order_number : date('Ymd-His') . rand(10, 99);
        $order->date = strtotime('now');

        if ($order->save()) {
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            $total_qty = 0;
            //calculate shipping is to get shipping costs of different types
            $admin_products = array();
            $seller_products = array();


            $carts = collect();
            foreach ($products as $item) {
                $carts[] = Cart::where("owner_id", $item->owner_id)->where("user_id", $user_id)->where("product_id", $item->product_id)->first();
            }


            //Order Details Storing



            $owners_cart = [];
            $categories = [];
            foreach ($carts as $key => $cartItem) {


                // return dd($cartItem);
                $total_qty += $cartItem['quantity'];
                $product = Product::find($cartItem['product_id']);

                $categories[] = $product->category_id;
                $shipping_days = [];
                if (!empty($product->est_shipping_days)) {
                    $shipping_days[] =  $product->est_shipping_days;
                }


                if ($product->added_by == 'admin') {
                    array_push($admin_products, $cartItem['product_id']);
                } else {
                    $product_ids = array();
                    if (array_key_exists($product->user_id, $seller_products)) {
                        $product_ids = $seller_products[$product->user_id];
                    }
                    array_push($product_ids, $cartItem['product_id']);
                    $seller_products[$product->user_id] = $product_ids;
                }

                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];

                $product_variation = $cartItem['variation'];

                if ($product_variation != null) {
                    $product_stock = $product->stocks->where('variant', $product_variation)->first();

                    if ($product->digital != 1 &&  $cartItem['quantity'] > $product_stock->qty) {
                        flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                        $order->delete();
                        return redirect()->route('cart')->send();
                    } else {
                        $product_stock->qty -= $cartItem['quantity'];
                        $product_stock->save();
                    }
                } else {

                    if ($product->digital != 1 && $cartItem['quantity'] > $product->current_stock) {

                        flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                        $order->delete();
                        return redirect()->route('cart')->send();
                    } else {
                        $product->current_stock -= $cartItem['quantity'];
                        $product->save();
                        //                        $product_stock->qty -= $cartItem['quantity'];
                        //                        $product_stock->save();
                    }
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id  = $order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = $cartItem['shipping_type'];
                $order_detail->product_referral_code = $cartItem['product_referral_code'];



                //Dividing Shipping Costs
                $shipping_info = session()->get('address');
                //   return dd($shipping_info);
                // $city =  \App\City::where("name", $shipping_info['city'])->first();

                if ($order_admin != 0 && $request->free_shipping) {

                    $order_detail->shipping_cost = 0;
                } else {
                    // if ($cartItem['shipping_type'] == 'home_delivery') {

                    //     //$order_detail->shipping_cost = getShippingCost($key);
                    //     // return dd("dsds");

                    //     if (isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {

                    //         foreach (json_decode($cartItem['shipping'], true) as $shipping_region => $val) {
                    //             if ($shipping_info['city'] == $shipping_region) {
                    //                 $order_detail->shipping_cost = (float) ($val);
                    //             } else {
                    //                 $order_detail->shipping_cost = 0;
                    //             }
                    //         }
                    //     } else {

                    //         if (!$cartItem['shipping']) {
                    //             $order_detail->shipping_cost =  !empty($city) ? (!in_array($cartItem['owner_id'], $owners_cart) ? (float)$city->cost : 0) : 0;
                    //         }
                    //     }
                    // } else {
                    //     $order_detail->shipping_cost = 0;
                    // }

                }

                if (!in_array($cartItem['owner_id'], $owners_cart)) {
                    $owners_cart[] = $cartItem['owner_id'];
                }
                // if ($product->is_quantity_multiplied == 1 && get_setting('shipping_type') == 'product_wise_shipping') {
                //     $order_detail->shipping_cost = $order_detail->shipping_cost * $cartItem['quantity'];
                // }
                //    $shipping = $order_detail->shipping_cost;

                // if ($cartItem['shipping_type'] == 'pickup_point') {
                //     $order_detail->pickup_point_id = $cartItem['pickup_point'];
                // }
                //End of storing shipping cost

                $order_detail->quantity = $cartItem['quantity'];

                $order_detail->save();



                $product->num_of_sale++;
                $product->save();

                if (
                    \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                    \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated
                ) {
                    if ($order_detail->product_referral_code) {
                        $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();

                        $affiliateController = new AffiliateController;
                        $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);
                    }
                }
            }
            $order->shipping_cost = $shipping_info["cost"];
            $shipping = $shipping_info["cost"];

            $order->grand_total = $subtotal + $tax + $shipping;
            $number_shipping_days = 0;
            if (count($shipping_days) != 0) {
                $number_shipping_days = max($shipping_days);
            }

            //return dd(session()->get("address"));
            $order->shipping_days = $number_shipping_days + (int)session()->get("address")["shipping_days"];
            if (Session::has('club_point')) {
                $order->grand_total -= Session::get('club_point');
                $clubpointController = new ClubPointController;
                $clubpointController->deductClubPoints($order->user_id, Session::get('club_point'));

                $order->club_point = Session::get('club_point');
            }

            if (Session::has('coupon_discount')) {

                $coupon = Coupon::find(Session::get('coupon_id'));
                if (!empty($coupon)) {
                    $order->shipping_cost = ($coupon->free_shipping == 1 ? 0 : $shipping_info["cost"]);
                }

                $order->grand_total -= Session::get('coupon_discount');
                $order->grand_total -= ($coupon->free_shipping == 1 ? $shipping_info["cost"] : 0);

                $order->coupon_discount = Session::get('coupon_discount');

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = $user_id;
                $coupon_usage->coupon_id = Session::get('coupon_id');
                $coupon_usage->save();
            }

            $tempDiscount = new TempDiscount();

            $temp_discount = $tempDiscount->temp_discount_check();
            if (!empty($temp_discount)) {
                $order->shipping_cost = $temp_discount["free_shipping"] == 1 ? 0 : $shipping_info["cost"];

                $discount_number = 0;
                $discount = $temp_discount["discount"];
                $discount_type = $temp_discount["discount_type"];

                if ($discount_type == "percent") {
                    $discount_percent = $order->grand_total *  ($discount / 100);
                    $order->grand_total -= $discount_percent;
                    $discount_number = $discount_percent;
                } else {
                    $order->grand_total -= $discount;
                    $discount_number = $discount;
                }
                $order->grand_total -= ($temp_discount["free_shipping"] == 1 ? $shipping_info["cost"] : 0);

                $order->temp_discount = $discount_number;


                $temp_discount_usage = new TemporaryDiscountUsage();
                $temp_discount_usage->temporary_discount_id     = $temp_discount["discount_id"];
                $temp_discount_usage->user_id     = $user_id;

                $temp_discount_usage->save();
            }


            $spcial_offer_controller = new SpcialOffer();
            $spcial_offer_discount = $spcial_offer_controller->show_special_offer_cart($order->grand_total, $total_qty);

            if (!empty($spcial_offer_discount)) {
                $order->grand_total -= $spcial_offer_discount;
                $order->special_offer_cart = $spcial_offer_discount;
            } else {
                $spcial_offer_discount = $spcial_offer_controller->show_special_offer_categories($order->grand_total, $total_qty, $categories);

                if (!empty($spcial_offer_discount)) {
                    $order->grand_total -= $spcial_offer_discount;
                    $order->special_offer_categories = $spcial_offer_discount;
                }
            }
            // if (session()->has("payment_option")) {
            //     $spcial_offer_discount_pay = $spcial_offer_controller->show_special_offer_payments($order->grand_total, $total_qty, session()->get("payment_option"));
            //     if (!empty($spcial_offer_discount_pay)) {
            //         $order->grand_total -= $spcial_offer_discount;
            //         $order->special_offer_payments = $spcial_offer_discount;
            //     }
            // }




            $order->save();

            OrdersNotes::save_note_and_photos_order($order->id);
            OrdersNotes::save_oreder_type_pharmacy($order->id);

            if (!empty($temp_discount)) {
                $temp_discount_usage->order_id     = $order->id;

                $temp_discount_usage->save();
            }


            $orders[] = $order;

            $array['view'] = 'emails.mail_design.invoice';
            $array['subject'] = translate('Your order has been placed') . ' - ' . $order->code;
            $array['from'] = env('MAIL_USERNAME');
            $array['order'] = $order;


            foreach ($seller_products as $key => $seller_product) {
                try {
                    if (env("MAIL_HOST") != get_setting("smtp_host")) {
                        overWriteEnvFile("MAIL_HOST", get_setting("smtp_host"));
                        overWriteEnvFile("MAIL_PORT", get_setting("smtp_port"));
                        overWriteEnvFile("MAIL_USERNAME", get_setting("smtp_username"));
                        overWriteEnvFile("MAIL_PASSWORD", get_setting("smtp_password"));
                        overWriteEnvFile("MAIL_ENCRYPTION", get_setting("smtp_encryption"));
                    }


                    Mail::to(\App\User::find($key)->email)->send(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }

            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value) {
                try {
                    $otpController = new OTPVerificationController;
                    $otpController->send_order_code($order);
                } catch (\Exception $e) {
                }
            }

            //sends email to customer with the invoice pdf attached
            if (env('MAIL_USERNAME') != null) {
                try {
                    Mail::to(session()->get('address')['email'])->send(new InvoiceEmailManager($array));
                    Mail::to(User::where('user_type', 'admin')->first()->email)->send(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }


            session()->put('order_id', $order->id);


            session()->put('orders', $orders);

            foreach ($carts as $item) {
                $item->delete();
            }
        }
        //}
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order_response = $order;
        if ($order != null) {
            foreach ($order->orderDetails as $key => $orderDetail) {
                try {
                    if ($orderDetail->variation != null) {
                        $product_stock = ProductStock::where('product_id', $orderDetail->product_id)->where('variant', $orderDetail->variation)->first();
                        if ($product_stock != null) {
                            $product_stock->qty += $orderDetail->quantity;
                            $product_stock->save();
                        }
                    } else {
                        $product = $orderDetail->product;
                        $product->current_stock += $orderDetail->quantity;
                        $product->save();
                    }
                } catch (\Exception $e) {
                }

                $orderDetail->delete();
            }
            $order->delete();
            return response()->json([
                "order" => $order_response
            ]);
            //            flash(translate('Order has been deleted successfully'))->success();
        } else {
            return response()->json([
                "error" => translate("something wrong")
            ]);
        }
        //   return back();
    }

    public function order_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->save();
        return view('frontend.user.seller.order_details_seller', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        $order->delivery_status = $request->status;
        $order->save();

        $log_order = new OrdersLogStatus();
        $log_order->order_id = $request->order_id;
        $log_order->status = $request->status;
        $log_order->user_id = auth()->user()->id;
        $log_order->save();

        OrderData::change_dliver_msg_mail($order);


        if (Auth::user()->user_type == 'seller') {
            foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                if ($request->status == 'cancelled') {
                    if ($orderDetail->variation != null) {
                        $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                            ->where('variant', $orderDetail->variation)
                            ->first();
                        if ($product_stock != null) {
                            $product_stock->qty += $orderDetail->quantity;
                            $product_stock->save();
                        }
                    } else {
                        $product = Product::find($orderDetail->product_id);
                        $product->current_stock += $orderDetail->quantity;
                        $product->save();
                    }
                } else if ($request->status == 'refund') {
                    if ($orderDetail->variation != null) {
                        $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                            ->where('variant', $orderDetail->variation)
                            ->first();
                        if ($product_stock != null) {
                            $product_stock->qty += $orderDetail->quantity;
                            $product_stock->save();
                        }
                    } else {
                        $product = Product::find($orderDetail->product_id);
                        $product->current_stock += $orderDetail->quantity;
                        $product->save();
                    }
                }
            }
        } else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                if ($request->status == 'cancelled') {
                    if ($orderDetail->variation != null) {
                        $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                            ->where('variant', $orderDetail->variation)
                            ->first();
                        if ($product_stock != null) {
                            $product_stock->qty += $orderDetail->quantity;
                            $product_stock->save();
                        }
                    } else {
                        $product = Product::find($orderDetail->product_id);
                        $product->current_stock += $orderDetail->quantity;
                        $product->save();
                    }
                } else if ($request->status == 'refund') {
                    if ($orderDetail->variation != null) {
                        $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                            ->where('variant', $orderDetail->variation)
                            ->first();
                        if ($product_stock != null) {
                            $product_stock->qty += $orderDetail->quantity;
                            $product_stock->save();
                        }
                    } else {
                        $product = Product::find($orderDetail->product_id);
                        $product->current_stock += $orderDetail->quantity;
                        $product->save();
                    }


                    OrderData::refundBalance($order);

                    if ($request->has("refund_id")) {
                        $refund = RefundRequest::find($request->refund_id);
                        $refund->status = "approval";
                        $refund->save();
                    }
                }

                if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                    if (($request->status == 'delivered' || $request->status == 'cancelled') &&
                        $orderDetail->product_referral_code
                    ) {

                        $no_of_delivered = 0;
                        $no_of_canceled = 0;

                        if ($request->status == 'delivered') {
                            $no_of_delivered = $orderDetail->quantity;
                        }
                        if ($request->status == 'cancelled') {
                            $no_of_canceled = $orderDetail->quantity;
                        }

                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();

                        $affiliateController = new AffiliateController;
                        $affiliateController->processAffiliateStats($referred_by_user->id, 0, 0, $no_of_delivered, $no_of_canceled);
                    }
                }
            }
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value) {
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            } catch (\Exception $e) {
            }
        }

        return  translate(ucfirst(str_replace('_', ' ', $request->status)));
    }


    public function update_payments_elc(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $user = auth()->check() ? auth()->user() : User::find($order->orderDetails->first()->seller_id);

        $order->payment_status_viewed = '0';
        $order->save();

        foreach ($order->orderDetails as $key => $orderDetail) {
            $orderDetail->payment_status = $request->status;
            $orderDetail->save();
        }

        $status = 'paid';
        foreach ($order->orderDetails as $key => $orderDetail) {
            if ($orderDetail->payment_status != 'paid') {
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();

        OrderData::change_pay_msg_mail($order);

        $once_shipping_cost = false;
        foreach ($order->orderDetails as $key => $orderDetail) {
            $orderDetail->payment_status = 'paid';
            $orderDetail->save();
            $commission_percentage = 0;
            if (get_setting('category_wise_commission') != 1) {
                $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
            } else if ($orderDetail->product->user->user_type == 'seller') {
                $commission_percentage = $orderDetail->product->category->commision_rate;
            }
            if ($orderDetail->product->user->user_type == 'seller') {
                $seller = $orderDetail->product->user->seller;
                $admin_commission = ($orderDetail->price * $commission_percentage) / 100;

                if (get_setting('product_manage_by_admin') == 1) {
                    $seller_earning = ($orderDetail->tax + $orderDetail->price) - $admin_commission;
                    $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax;
                } else {
                    $shipping_cost = (!$once_shipping_cost ? $order->shipping_cost : 0);
                    $seller_earning = $orderDetail->tax + $shipping_cost + $orderDetail->price - $admin_commission;
                    $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $shipping_cost;
                    $once_shipping_cost = true;
                }

                $seller->save();

                $commission_history = new CommissionHistory;
                $commission_history->order_id = $order->id;
                $commission_history->order_detail_id = $orderDetail->id;
                $commission_history->seller_id = $orderDetail->seller_id;
                $commission_history->admin_commission = $admin_commission;
                $commission_history->seller_earning = $seller_earning;

                $commission_history->save();
            }
        }
    }

    public function update_payment_status(Request $request)
    {


        $order = Order::findOrFail($request->order_id);
        $user = auth()->check() ? auth()->user() : User::find($order->orderDetails->first()->seller_id);

        $order->payment_status_viewed = '0';
        $order->save();

        if ($user->user_type == 'seller') {
            foreach ($order->orderDetails->where('seller_id', $user->id) as $key => $orderDetail) {
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        } else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }

        $status = 'paid';
        foreach ($order->orderDetails as $key => $orderDetail) {
            if ($orderDetail->payment_status != 'paid') {
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();


        if ($order->payment_status == 'paid' && $order->commission_calculated == 0) {
            if (
                \App\Addon::where('unique_identifier', 'seller_subscription')->first() == null ||
                !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated
            ) {

                if ($order->payment_type == 'cash_on_delivery') {
                    $once_shipping_cost = false;

                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        $commission_percentage = 0;
                        if (get_setting('category_wise_commission') != 1) {
                            $commission_percentage = get_setting('vendor_commission');
                        } else if ($orderDetail->product->user->user_type == 'seller') {
                            $commission_percentage = $orderDetail->product->category->commision_rate;
                        }
                        if ($orderDetail->product->user->user_type == 'seller') {
                            $seller = $orderDetail->product->user->seller;
                            $admin_commission = ($orderDetail->price * $commission_percentage) / 100;

                            if (get_setting('product_manage_by_admin') == 1) {
                                $seller_earning = ($orderDetail->tax + $orderDetail->price) - $admin_commission;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->tax + $orderDetail->price) - $admin_commission;
                            } else {
                                $shipping_cost = (!$once_shipping_cost ? $order->shipping_cost : 0);

                                $seller_earning = $orderDetail->tax + $shipping_cost + $orderDetail->price - $admin_commission;
                                $seller->admin_to_pay = $seller->admin_to_pay - $admin_commission;
                                $once_shipping_cost = true;
                            }

                            $seller->save();

                            $commission_history = new CommissionHistory;
                            $commission_history->order_id = $order->id;
                            $commission_history->order_detail_id = $orderDetail->id;
                            $commission_history->seller_id = $orderDetail->seller_id;
                            $commission_history->admin_commission = $admin_commission;
                            $commission_history->seller_earning = $seller_earning;

                            $commission_history->save();
                        }
                    }
                } elseif ($order->manual_payment) {
                    $once_shipping_cost = false;

                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        $commission_percentage = 0;
                        if (get_setting('category_wise_commission') != 1) {
                            $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        } else if ($orderDetail->product->user->user_type == 'seller') {
                            $commission_percentage = $orderDetail->product->category->commision_rate;
                        }
                        if ($orderDetail->product->user->user_type == 'seller') {
                            $seller = $orderDetail->product->user->seller;
                            $admin_commission = ($orderDetail->price * $commission_percentage) / 100;

                            if (get_setting('product_manage_by_admin') == 1) {
                                $seller_earning = ($orderDetail->tax + $orderDetail->price) - $admin_commission;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax;
                            } else {
                                $shipping_cost = (!$once_shipping_cost ? $order->shipping_cost : 0);

                                $seller_earning = $orderDetail->tax + $shipping_cost + $orderDetail->price - $admin_commission;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $shipping_cost;
                                $once_shipping_cost = true;
                            }

                            $seller->save();

                            $commission_history = new CommissionHistory;
                            $commission_history->order_id = $order->id;
                            $commission_history->order_detail_id = $orderDetail->id;
                            $commission_history->seller_id = $orderDetail->seller_id;
                            $commission_history->admin_commission = $admin_commission;
                            $commission_history->seller_earning = $seller_earning;

                            $commission_history->save();
                        }
                    }
                }
            }

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                if ($order->user != null) {
                    $clubpointController = new ClubPointController;
                    $clubpointController->processClubPoints($order);
                }
            }

            $order->commission_calculated = 1;
            $order->save();
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value) {
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_payment_status($order);
            } catch (\Exception $e) {
            }
        }
        return 1;
    }

    public function add_note(Request $request)
    {
        OrdersNotes::save_order_note($request);
        flash(translate('The Notes Is Added'))->success();
        return back();
    }
}

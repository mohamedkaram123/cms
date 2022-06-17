<?php

namespace App\Http\Controllers;

use App\BusinessSetting;
use App\Models\PayData;
use App\MyClasses\CartData;
use App\myInterface\Payment;
use App\myTraits\PaymentDomain;
use App\Order;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class TabpaymentController extends Controller implements Payment
{
    //

    use PaymentDomain;



    public function post_request($data = [])
    {



        $secret_key = get_setting('TapPayment_Secret_Key');
        $headers = array(
            "Authorization: Bearer $secret_key",
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.tap.company/v2/authorize');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function view_card_page()
    {
        // $order = Order::findOrFail(Session::get('order_id'));


        if (Session::has('payment_type')) {

            if (Session::get('payment_type') == 'cart_payment') {


                $products1 =
                    session()->get("products");

                $grand_total = CartData::get_total($products1);

                if (Session::has('currency_code')) {
                    $currency_code = Session::get('currency_code');
                } else {
                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                }
                $shipping_address = Session::get('address');
                // dd($order->id);

                $payment_type = Session::get('payment_type');

                // return dd([
                //     "orders" => $orders,
                //     "currency_code" => $currency_code,
                //     "shipping_address" => $shipping_address,
                //     "payment_type" => $payment_type,
                //     "status" => "order",
                //     "grand_total" => $grand_total

                // ]);
                return view("backend.tabpayment.tapcard", [
                    "currency_code" => $currency_code,
                    "shipping_address" => $shipping_address,
                    "payment_type" => $payment_type,
                    "status" => "order",
                    "grand_total" => $grand_total


                ]);
            } elseif (session()->get('payment_type') == 'wallet_payment') {
                $amount = round(session()->get('payment_data')['amount']);


                $payment_type = Session::get('payment_type');
                if (Session::has('currency_code')) {
                    $currency_code = Session::get('currency_code');
                } else {
                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                }
                return view("backend.tabpayment.tapcard", [
                    "order" => "",
                    "currency_code" => $currency_code,
                    "shipping_address" => "",
                    "payment_type" => $payment_type,
                    "amount" => convert_price_code($amount, $currency_code),
                    "status" => "wallet"

                ]);
            }
        }
    }



    public function auth_tappayment($id)
    {


        $pay = new  PayData();
        $pay->payment_method =  "tappayment";

        $pay->save();
        session()->put("pay_id", $pay->id);
        $user_id = auth()->user()->id;

        if (Session::has('payment_type')) {

            if (Session::get('payment_type') == 'cart_payment') {
                $products1 =
                    session()->get("products");

                $total = CartData::get_total($products1);

                if (Session::has('currency_code')) {
                    $currency_code = Session::get('currency_code');
                } else {
                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                }
                //   $shipping_address = json_decode($order->shipping_address);
                // dd($order->id);
                $shipping_address = session()->get("address");
                $payment_type = Session::get('payment_type');

                // $orders_ids = [];
                // foreach ($orders as $item) {
                //     $orders_ids[] = $item->id;
                // }
                // $orders_ids = json_encode($orders_ids);

                $temp_request = [

                    "amount" => $total,
                    "currency" => $currency_code,
                    "threeDSecure" => true,
                    "save_card" => false,
                    "description" => "test description",
                    "statement_descriptor" => "sample",
                    "metadata" => [
                        "udf1" => "test"
                    ],
                    "reference" => [
                        "transaction" => "txn_0001",
                        "order" => "ord_0001"
                    ],
                    "receipt" => [
                        "email" => false,
                        "sms" => true
                    ],
                    "customer" => [
                        "first_name" => $shipping_address["name"],
                        "middle_name" => "test",
                        "last_name" => "test",
                        "email" => $shipping_address["email"],
                        "phone" => [
                            "country_code" => $shipping_address["postal_code"],
                            "number" => $shipping_address["phone"]
                        ]
                    ],
                    "source" => [
                        "id" => $id
                    ],
                    "auto" => [
                        "type" => "VOID",
                        "time" => 100
                    ],
                    "post" => [
                        "url" => $this->paymentDoamin() . "/tappayment/callback/$payment_type/$pay->id/$user_id",
                    ],
                    "redirect" => [
                        "url" => route("tappayment.callback", [
                            "payment_type" => $payment_type,
                        ]),
                    ]

                ];

                //return get_setting('TapPayment_Secret_Key');
                //return $temp_request["post"];
                $check_out_redirection = $this->post_request($temp_request);

                $res =  json_decode($check_out_redirection);

                //  return dd($res);
                return response()->json([
                    "url" => $res->transaction->url
                ]);
                // dd($res->redirect_url);
                //return redirect($res->redirect_url);
            } elseif (session()->get('payment_type') == 'wallet_payment') {


                $amount = round(session()->get('payment_data')['amount']);

                if (Session::has('currency_code')) {
                    $currency_code = Session::get('currency_code');
                } else {
                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                }
                $user_id = auth()->user()->id;

                $payment_type = Session::get('payment_type');


                $temp_request = [

                    "amount" => convert_price_code($amount, $currency_code),
                    "currency" => $currency_code,
                    "threeDSecure" => true,
                    "save_card" => false,
                    "description" => "test description",
                    "statement_descriptor" => "sample",
                    "metadata" => [
                        "udf1" => "test"
                    ],
                    "reference" => [
                        "transaction" => "txn_0001",
                        "order" => "ord_0001"
                    ],
                    "receipt" => [
                        "email" => false,
                        "sms" => true
                    ],
                    "customer" => [
                        "first_name" => auth()->user()->name,
                        "middle_name" => "test",
                        "last_name" => "test",
                        "email" => auth()->user()->email,
                        "phone" => [
                            "country_code" => auth()->user()->postal_code,
                            "number" => auth()->user()->phone
                        ]
                    ],
                    "source" => [
                        "id" => $id
                    ],
                    "auto" => [
                        "type" => "VOID",
                        "time" => 100
                    ],
                    "post" => [
                        "url" =>  $this->paymentDoamin() . "/tappayment/callback/$payment_type/$pay->id/$user_id",
                    ],
                    "redirect" => [
                        "url" => route("tappayment.callback", [
                            "payment_type" => $payment_type,
                        ]),
                    ]

                ];


                $check_out_redirection = $this->post_request($temp_request);


                $check_out_redirection;
                $res =  json_decode($check_out_redirection);

                // $order = Order::find($id);
                // $order->payment_details = json_encode($res);
                // $order->save();
                return response()->json([
                    "url" => $res->transaction->url
                ]);
                // dd($res->redirect_url);
                //return redirect($res->redirect_url);



            }
        } else {
            flash(translate('Opps! Something went wrong.'))->warning();
            return redirect()->route('cart');
        }
    }



    public function callback($payment_type)
    {


        sleep(10);



        // $busniss = new BusinessSetting();
        // $busniss->type = "orders";
        // $busniss->value = json_encode($orders);
        // $busniss->save();
        // $payment_details = json_decode($orders[0]->payment_details);

        //   return dd(json_decode($payment_details));
        if ($payment_type == 'cart_payment') {
            $products = session()->get("products");
            $pay_id = session()->get("pay_id");
            $pay = PayData::find($pay_id);
            $payment_details = json_decode($pay->pay_details);

            if (!empty($payment_details)) {
                if ($payment_details->status == "AUTHORIZED") {
                    $orderController = new OrderController;

                    $req = new Request([
                        "products" => $products,
                        "payment_option" => "paytab",
                        "free_shipping" => 0
                    ]);


                    $orderController->store($req, 0);
                    $orders = session()->get("orders");
                    $checkoutController = new CheckoutController;
                    return $checkoutController->checkout_done($pay->pay_details, $orders);
                }
            } else {
                flash(translate('Opps! Something went wrong.'))->warning();
                return redirect()->route('cart');
            }
        } else if ($payment_type == 'wallet_payment') {



            $payment_data = session()->get('payment_data');

            $user = Auth::user();
            $user->balance = $user->balance + $payment_data['amount'];
            $user->save();



            Session::forget('payment_data');
            Session::forget('payment_type');

            flash(translate('Payment completed'))->success();
            return redirect()->route('wallet.index');
        }



        flash(translate('Opps! Something went wrong.'))->warning();
        return redirect()->route('cart');
    }


    public function callbackpost(Request $request, $payment_type, $pay_id, $user_id)
    {




        if ($request->status == "AUTHORIZED") {

            $payment = ["status" => "Success"];


            //   return $payment_type;
            if ($payment_type == 'cart_payment') {
                $pay = PayData::find($pay_id);
                $pay->pay_details = json_encode($request->all());
                $pay->save();
            }
            if ($payment_type == 'wallet_payment') {

                $pay = PayData::find($pay_id);
                $pay->payment_type = "wallet_payment";
                $pay->pay_details = json_encode($request->all());
                $pay->save();

                $wallet = new Wallet;
                $wallet->user_id = $user_id;
                $wallet->amount = $request->amount;
                $wallet->payment_method = 'tappayment';
                $wallet->payment_details = json_encode($request->all());
                $wallet->save();

                return null;
            }
        }
    }
}

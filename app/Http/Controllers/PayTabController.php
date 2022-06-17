<?php

namespace App\Http\Controllers;

use App\BusinessSetting;
use App\Models\PayData;
use App\Models\Role;
use App\MyClasses\CartData;
use App\myInterface\Payment;
use App\myTraits\PaymentDomain;
use App\Order;
use App\Payment as AppPayment;
use App\Wallet;
use Auth;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class PayTabController extends Controller implements Payment
{
    //

    use PaymentDomain;


    public $PAYTAB_SERVER_KEY;
    public $PAYTAB_PROFILE_ID;
    public $base_url;
    public $currency_code;
    public $payment_option;


    function __construct($payment_option = null)
    {

        $order_admin = session()->get('order_admin');

        // // if(!empty($order_admin)){
        // $payment_option  =  session()->get('payment_option');

        // // }
        $this->payment_option = $payment_option;

        if (get_setting("pay_tab_defualt") == "sa") {

            $this->PAYTAB_SERVER_KEY = get_setting('PAYTAB_SERVER_KEY_saudi');
            $this->PAYTAB_PROFILE_ID = get_setting('PAYTAB_PROFILE_ID_saudi');
            $this->base_url = "https://secure.paytabs.sa/payment/request";
            $this->currency_code = "SAR";
        } else {

            $this->PAYTAB_SERVER_KEY = get_setting('PAYTAB_SERVER_KEY');
            $this->PAYTAB_PROFILE_ID = get_setting('PAYTAB_PROFILE_ID');
            $this->base_url = "https://secure-egypt.paytabs.com/payment/request";
            $this->currency_code = "EGP";
        }
    }

    public function post_request($data = [])
    {



        $secret_key =  $this->PAYTAB_SERVER_KEY;
        $headers = array(
            "Authorization: $secret_key",
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function pay()
    {
        $order_admin = session()->get('order_admin');


        $products1 =
            session()->get("products");

        $pay = new  PayData();
        $pay->payment_method =  "paytab";
        $pay->save();
        session()->put("pay_id", $pay->id);
        if (Session::has('payment_type')) {

            if (Session::get('payment_type') == 'cart_payment') {
                $total = CartData::get_total($products1);


                if (Session::has('currency_code')) {
                    $currency_code = Session::get('currency_code');
                } else {
                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                }
                $shipping_address = session()->get("address");
                // dd($order->id);
                $user_id = auth()->user()->id;
                //    $payment_data =json_encode([
                //     "payment_type"=>Session::get('payment_type'),
                //     "user_id"=>$user_id
                // ]);
                $payment_type = Session::get('payment_type');
                $temp_request = [
                    "profile_id" => $this->PAYTAB_PROFILE_ID,
                    "tran_type" => "sale",
                    "tran_class" => "ecom",
                    "cart_id" => "100",
                    "cart_description" => "Dummy Order 35925502061445345",
                    "cart_currency" => $this->currency_code,
                    "cart_amount" => convert_price_code(round($total), $this->currency_code),
                    "callback" => $this->paymentDoamin() . "/paytab/callback/$payment_type/$pay->id/$user_id",
                    "return" => route("paytab.callback", [
                        "payment_type" => $payment_type,
                    ]),
                    "hide_shipping" => true,
                    // "shipping_details" => [
                    //     "name" => $shipping_address["name"],
                    //     "email" => $shipping_address["email"],
                    //     "street1" => $shipping_address["address"],
                    //     "city" => $shipping_address["city"],
                    //     "country" => $shipping_address["country"],
                    // ],
                    "customer_details" => [
                        "name" => $shipping_address["name"],
                        "email" => $shipping_address["email"],
                        "street1" => $shipping_address["address"],
                        "city" => $shipping_address["city"],
                        "country" => $this->payment_option == "paytabsaudi" ? "SA" : "EG",
                        "state" =>  $this->payment_option == "paytabsaudi" ? "SA" : "EG",
                    ]

                ];
                $check_out_redirection = $this->post_request($temp_request);

                $res =  json_decode($check_out_redirection);
                // dd($res->redirect_url);

                if (!empty($order_admin)) {

                    return response()->json([
                        "url" => $res->redirect_url
                    ]);
                }
                return redirect($res->redirect_url);
            } elseif (session()->get('payment_type') == 'wallet_payment') {
                $amount = round(session()->get('payment_data')['amount']);


                $user_id = auth()->user()->id;

                $payment_type = Session::get('payment_type');

                $temp_request = [
                    "profile_id" => $this->PAYTAB_PROFILE_ID,
                    "tran_type" => "auth",
                    "tran_class" => "ecom",
                    "cart_id" => "100",
                    "cart_description" => "Dummy Order 35925502061445345",
                    "cart_currency" => $this->currency_code,
                    "cart_amount" => convert_price_code($amount, $this->currency_code),
                    "callback" => $this->paymentDoamin() . "/paytab/callback/$payment_type/$pay->id/$user_id",
                    "return" => route("paytab.callback", [
                        "payment_type" => $payment_type,

                    ]),
                    "hide_shipping" => true,

                    // "shipping_details" => [
                    //     "name" => auth()->user()->name,
                    //     "email" => auth()->user()->email,
                    //     "street1" => auth()->user()->address,
                    //     "city" => auth()->user()->city,
                    //     "postal_code" => auth()->user()->postal_code,

                    //     "country" => auth()->user()->country,
                    // ],
                    "customer_details" => [


                        "name" => auth()->user()->name,
                        "email" => auth()->user()->email,
                        "street1" => auth()->user()->address,
                        "city" => auth()->user()->city,
                        "postal_code" => auth()->user()->postal_code,

                        "country" => auth()->user()->country,
                        "state" => $this->payment_option == "paytabsaudi" ? "SA" : "EG",
                    ]

                ];
                $check_out_redirection = $this->post_request($temp_request);

                $res =  json_decode($check_out_redirection);
                return redirect($res->redirect_url);
            }
        } else {
            flash(translate('Opps! Something went wrong.'))->warning();
            return redirect()->route('cart');
        }
    }



    public function callback($payment_type)
    {


        sleep(10);

        if ($payment_type == 'cart_payment') {
            $products = session()->get("products");
            $pay_id = session()->get("pay_id");
            $pay = PayData::find($pay_id);
            $payment_details = json_decode($pay->pay_details);

            if ($payment_details->payment_result->response_status == "A") {
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
            } else {
                flash(translate('Opps! Something went wrong.'))->warning();
                return redirect()->route('cart');
            }
        } else if ($payment_type == 'wallet_payment') {



            $payment_data = session()->get('payment_data');

            $user = Auth::user();
            $user->balance = $user->balance + return_price_code($payment_data['amount'], $this->currency_code);
            $user->save();



            Session::forget('payment_data');
            Session::forget('payment_type');

            flash(translate('Payment completed'))->success();
            return redirect()->route('wallet.index');
        }
    }


    public function callbackpost(Request $request, $payment_type, $pay_id, $user_id)
    {
        // $products = session()->get("products");
        // $products = session()->get("products");

        // put_setting("dsd", $products);
        if ($request->payment_result["response_status"] == "A") {


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
                $wallet->amount = return_price_code($request->cart_amount, $this->currency_code);
                $wallet->payment_method = 'paytab';
                $wallet->payment_details = json_encode($request->all());
                $wallet->save();

                return null;

                //  return $walletController->wallet_payment_done($payment_data, json_encode($request->all()),"pay_tab");
            }
        }
    }
}

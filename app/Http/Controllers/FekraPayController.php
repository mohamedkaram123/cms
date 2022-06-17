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

class FekraPayController extends Controller
{
    //

    use PaymentDomain;


    public $Fekra_SERVER_KEY;
    public $base_url;
    public $currency_code;
    public $payment_option;
    public $MODE_Fekra_Pay;
    public $pay_data;

    function __construct($payment_option = null, $pay_data = null)
    {
        $this->pay_data = $pay_data != null ? $pay_data : 2;

        $this->payment_option = $payment_option;
        $this->Fekra_SERVER_KEY = get_setting('fekra_pay_key');
        $this->base_url = "https://convertapi.net/api/payment/execute";
        $this->MODE_Fekra_Pay = get_setting("fekra_pay_mode");

        if (Session::has('currency_code')) {
            $currency_code = Session::get('currency_code');
        } else {
            $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        }
        $this->currency_code = $currency_code;
    }
    public function callbackpost(Request $request, $payment_type, $pay_id, $user_id)
    {
    }

    public function post_request($data = [])
    {



        $secret_key =  $this->Fekra_SERVER_KEY;
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
        $pay->payment_method =  "fekrapay";
        $pay->save();
        session()->put("pay_id", $pay->id);
        if (Session::has('payment_type')) {

            if (Session::get('payment_type') == 'cart_payment') {
                $total = CartData::get_total($products1);


                $shipping_address = session()->get("address");
                $user_id = auth()->user()->id;

                $payment_type = Session::get('payment_type');
                $temp_request = [

                    "key" => $this->Fekra_SERVER_KEY,
                    "mode" => $this->MODE_Fekra_Pay,
                    "PaymentMethodId" => $this->pay_data,
                    "InvoiceValue" => $total,
                    "DisplayCurrencyIso" => $this->currency_code,
                    "CustomerName" => $shipping_address["name"],
                    "CustomerEmail" => $shipping_address["email"],
                    "CustomerReference" => "1234",
                    "CallBackUrl" => $this->paymentDoamin()  . "/fekraPay/success/cart_payment",
                    "ErrorUrl" => $this->paymentDoamin()  . "/fekraPay/error",
                    "Language" => "AR",
                    "InvoiceItems" => null
                ];

                $check_out_redirection = $this->post_request($temp_request);

                $res =  json_decode($check_out_redirection);
                // dd($res->redirect_url);

                if (!empty($order_admin)) {

                    return response()->json([
                        "url" => $res->PaymentURL
                    ]);
                }


                session()->put("Invoice_data", json_encode($res));
                return redirect($res->PaymentURL);
            } elseif (session()->get('payment_type') == 'wallet_payment') {
                $amount = round(session()->get('payment_data')['amount']);


                $user_id = auth()->user()->id;

                $payment_type = Session::get('payment_type');

                $temp_request = [

                    "key" => $this->Fekra_SERVER_KEY,
                    "mode" => $this->MODE_Fekra_Pay,
                    "PaymentMethodId" => 2,
                    "InvoiceValue" =>  convert_price_code($amount, $this->currency_code),
                    "DisplayCurrencyIso" => $this->currency_code,
                    "CustomerName" => auth()->user()->name,
                    "CustomerEmail" => auth()->user()->email,
                    "CustomerReference" => "1234",
                    "CallBackUrl" => $this->paymentDoamin()  . "/fekraPay/success/wallet_payment",
                    "ErrorUrl" => $this->paymentDoamin()  . "/fekraPay/error",
                    "Language" => "AR",
                    "InvoiceItems" => null
                ];

                $check_out_redirection = $this->post_request($temp_request);

                $res =  json_decode($check_out_redirection);
                session()->put("Invoice_data", [
                    "data" => json_encode($res),
                    "user_id" => $user_id,
                    "amount" => $amount
                ]);

                return redirect($res->PaymentURL);
            }
        } else {
            flash(translate('Opps! Something went wrong.'))->warning();
            return redirect()->route('cart');
        }
    }



    public function callback($payment_type)
    {

        $Invoice_data =   session()->get("Invoice_data");
        $pay_id = session()->get("pay_id");

        if ($payment_type == 'cart_payment') {
            $products = session()->get("products");

            $pay = PayData::find($pay_id);
            $pay->pay_details = json_encode($Invoice_data);
            $pay->save();

            $orderController = new OrderController;

            $req = new Request([
                "products" => $products,
                "payment_option" => "fekraPay",
                "free_shipping" => 0
            ]);


            $orderController->store($req, 0);
            $orders = session()->get("orders");
            $checkoutController = new CheckoutController;
            return $checkoutController->checkout_done($pay->pay_details, $orders);
        } else if ($payment_type == 'wallet_payment') {



            $payment_data = session()->get('payment_data');

            $user = Auth::user();
            $user->balance = $user->balance + return_price_code($payment_data['amount'], $this->currency_code);
            $user->save();


            $pay = PayData::find($pay_id);
            $pay->payment_type = "wallet_payment";
            $pay->pay_details = json_encode($Invoice_data["data"]);
            $pay->save();

            $wallet = new Wallet;
            $wallet->user_id = $Invoice_data["user_id"];
            $wallet->amount = return_price_code($Invoice_data["amount"], $this->currency_code);
            $wallet->payment_method = 'fekrapay';
            $wallet->payment_details = json_encode($Invoice_data["data"]);
            $wallet->save();

            Session::forget('payment_data');
            Session::forget('payment_type');

            flash(translate('Payment completed'))->success();
            return redirect()->route('wallet.index');
        }
    }


    public function errorCallback()
    {
        flash(translate('Opps! Something went wrong.'))->warning();
        return redirect()->route('cart');
    }
}

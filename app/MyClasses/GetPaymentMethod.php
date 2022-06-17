<?php

namespace App\MyClasses;

use Illuminate\Support\Facades\Session;

class GetPaymentMethod
{



    public $Fekra_SERVER_KEY;
    public $base_url;
    public $currency_code;
    public $payment_option;
    public $MODE_Fekra_Pay;


    function __construct($payment_option = null)
    {

        $this->payment_option = $payment_option;
        $this->Fekra_SERVER_KEY = get_setting('fekra_pay_key');
        $this->base_url = "https://convertapi.net/api/payment/initiate";
        $this->MODE_Fekra_Pay = get_setting("fekra_pay_mode");

        if (Session::has('currency_code')) {
            $currency_code = Session::get('currency_code');
        } else {
            $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        }
        $this->currency_code = $currency_code;
    }

    public function post_request($data = [])
    {



        $secret_key = $this->Fekra_SERVER_KEY;
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
        // $products1 =
        //     session()->get("products");

        // $total = CartData::get_total($products1);

        $temp_request = [

            "key" => $this->Fekra_SERVER_KEY,
            "mode" => $this->MODE_Fekra_Pay,
            "InvoiceAmount" => 3500,
            "CurrencyIso" => $this->currency_code,

        ];

        $check_out_redirection = $this->post_request($temp_request);

        $res =  json_decode($check_out_redirection);



        return $res;
    }
}

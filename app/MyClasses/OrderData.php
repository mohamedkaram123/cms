<?php

namespace App\MyClasses;

use App\Mail\SupportMailManager;
use App\User;
use Illuminate\Support\Facades\Mail;

class OrderData
{

    public static function trans_order_status($delivery_status)
    {

        if ($delivery_status == "pending") {
            return translate('Pending');
        } else if ($delivery_status == "confirmed") {
            return translate('Confirmed');
        } else  if ($delivery_status == "on_delivery") {
            return translate('On delivery');
        } else if ($delivery_status == "delivered") {
            return translate('Delivered');
        } else if ($delivery_status == "cancelled") {
            return translate('Cancel');
        }
    }


    public static function next_status_order($delivery_status)
    {

        if ($delivery_status == "pending") {
            return "confirmed";
        } else if ($delivery_status == "confirmed") {
            return "on_delivery";
        } else  if ($delivery_status == "on_delivery") {
            return "delivered";
        }
    }

    public static function change_dliver_msg_mail($order)
    {

        try {
            $array['view'] = "emails.mail_design.mail1";
            $array['from'] = get_setting("smtp_from_address");

            $array['subject'] = translate("change status order");
            $user = User::find($order->user_id);
            $array['data'] = [
                "link_view_order" => url("") . "/purchase_history?order_id=$order->id&user_id={" . encrypt($user->id) . "}",
                "desc_msg" => translate("the order is changed delivery status to :") . self::trans_order_status($order->delivery_status),
                "welcome_msg" => translate("Welcome") . " ", $user->name,
                "main_title" => translate("Order Changed Status"),
                "link_shop" => url("/")
            ];

            Mail::to($user->email)->send(new SupportMailManager($array));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public static function refundBalance($order)
    {

        $user = User::find($order->user_id);
        $user->balance =  $user->balance +  ($order->grand_total - $order->shipping_cost);
        $user->save();


        $wallet = new Wallet();
        $wallet->user_id = $order->user_id;
        $wallet->amount = ($order->grand_total - $order->shipping_cost);
        $wallet->payment_method = "refund";
        // $wallet->payment_details = $payment_details;
        $wallet->save();
    }

    public static function change_pay_msg_mail($order)
    {

        // try {
        $array['view'] = "emails.mail_design.mail1";
        $array['from'] = get_setting("smtp_from_address");

        $array['subject'] = translate("change status order");
        $user = User::find($order->user_id);
        $array['data'] = [
            "link_view_order" => url("") . "/purchase_history?order_id=$order->id&user_id=" . encrypt($user->id),
            "desc_msg" => translate("the order is changed Payment status to :") . self::trans_order_status($order->payment_status),
            "welcome_msg" => translate("Welcome") . " ", $user->name,
            "main_title" => translate("Order Changed Status"),
            "link_shop" => url("/")
        ];

        Mail::to($user->email)->send(new SupportMailManager($array));
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

    public static function order_check($delivery_status)
    {

        $flag = false;
        if (
            $delivery_status == "pending" ||
            $delivery_status == "confirmed" ||
            $delivery_status == "on_delivery" ||
            $delivery_status == "delivered" ||
            $delivery_status == "cancelled" ||
            $delivery_status == "refund"
        ) {
            $flag = true;
        }
        return $flag;
    }
}

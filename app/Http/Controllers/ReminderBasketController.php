<?php

namespace App\Http\Controllers;

use App\Mail\SupportMailManager;
use App\Models\ReminderBasket;
use App\Models\ReminderCustomer;
use App\Models\TemporaryDiscount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReminderBasketController extends Controller
{
    //

    public function saveDataReminder(Request $request)
    {

        $symbol = currency_symbol();

        if ($request->date_send_type == "now") {


            $channel_msg = $request->channel_msg;

            $reminderBasket = new ReminderBasket();
            $reminderBasket->date_send_reminder     =  $request->date_send_offer;
            $reminderBasket->channel_msg         =  $request->channel_msg;
            $reminderBasket->msg     =  $request->msg;
            $reminderBasket->title_mail         =  $request->title_mail;
            $reminderBasket->status         =  "send";
            $reminderBasket->save();


            if ($request->discountBasket) {
                $temporaryDiscount = new TemporaryDiscount();
                $temporaryDiscount->discount_type     =  $request->discounttype;
                $temporaryDiscount->expire_discount_date =  $request->date_expire_offer;
                $temporaryDiscount->shipping_free        =  $request->shippingFree ? 1 : 0;
                $temporaryDiscount->reminder_id          =  $reminderBasket->id;
                $temporaryDiscount->discount             =  $request->discount;
                $temporaryDiscount->total_usage_for_all  =  $request->total_usage_for_all;
                $temporaryDiscount->total_usage_for_one_user  =  $request->total_usage_for_one_user;

                $temporaryDiscount->save();
            }


            foreach ($request->users as $user) {

                $userData = User::find($user["id"]);

                $reminderCustomers = new ReminderCustomer();
                $reminderCustomers->user_id = $userData->id;
                $reminderCustomers->reminder_id     = $reminderBasket->id;
                if ($request->discountBasket) {
                    $reminderCustomers->temporary_discount_id = $temporaryDiscount->id;
                }
                $reminderCustomers->save();

                $str1 = str_replace("{var_name}", $userData->name, $request->msg);
                $str2 = str_replace("{var_discount_amount}", $request->discount . ($request->discounttype == "percent" ? " % " : " " . translate($symbol)), $str1);
                $msg_offer = str_replace("{var_date}", substr($request->date_expire_offer, 0, 10), $str2);

                if (!empty($userData)) {
                    if ($userData->email != "" && $userData->email != null) {
                        if ($channel_msg == "all" || $channel_msg == "email") {

                            try {
                                $array = [];
                                $array['view'] = "emails.mail_design.mail2";
                                $array['subject'] = $request->title_mail;
                                $array['from'] = get_setting("smtp_from_address");
                                $array['content'] = $msg_offer;
                                $array['sender'] = auth()->user()->name;
                                $array['link'] = "";
                                $array['text_btn'] = "";
                                $array['details'] = "";
                                Mail::to($userData->email)->send(new SupportMailManager($array));
                            } catch (\Throwable $th) {
                            }
                        }
                    }


                    if ($userData->phone != "" && $userData->phone != null) {
                        if ($channel_msg == "all" || $channel_msg == "sms") {

                            $phone = fullPhoneUser($userData);
                            $msg =  SMS_Send($phone, $msg_offer);
                        }
                    }
                }
            }

            return response()->json([
                "msg" => "done"
            ]);
        } else {

            $reminderBasket = new ReminderBasket();
            $reminderBasket->date_send_reminder     =  $request->date_send_offer;
            $reminderBasket->channel_msg         =  $request->channel_msg;
            $reminderBasket->msg     =  $request->msg;
            $reminderBasket->title_mail         =  $request->title_mail;
            $reminderBasket->status         =  "pending";
            $reminderBasket->save();


            if ($request->discountBasket) {
                $temporaryDiscount = new TemporaryDiscount();
                $temporaryDiscount->discount_type     =  $request->discounttype;
                $temporaryDiscount->expire_discount_date =  $request->date_expire_offer;
                $temporaryDiscount->shipping_free        =  $request->shippingFree ? 1 : 0;
                $temporaryDiscount->reminder_id          =  $reminderBasket->id;
                $temporaryDiscount->discount             =  $request->discount;
                $temporaryDiscount->total_usage_for_all  =  $request->total_usage_for_all;
                $temporaryDiscount->total_usage_for_one_user  =  $request->total_usage_for_one_user;

                $temporaryDiscount->save();
            }


            foreach ($request->users as $user) {


                $reminderCustomers = new ReminderCustomer();
                $reminderCustomers->user_id = $user["id"];
                $reminderCustomers->reminder_id     = $reminderBasket->id;
                if ($request->discountBasket) {
                    $reminderCustomers->temporary_discount_id = $temporaryDiscount->id;
                }
                $reminderCustomers->save();
            }

            return response()->json([
                "msg" => "done"
            ]);
        }
    }







    public function saveDataReminderPublic(Request $request)
    {

        $symbol = currency_symbol();


        $reminderBasket = new ReminderBasket();
        $reminderBasket->date_send_reminder     =  $request->date_send_offer;
        $reminderBasket->channel_msg         =  $request->channel_msg;
        $reminderBasket->msg     =  $request->msg;
        $reminderBasket->duration_discount_hour     =  $request->duration_discount_hour;
        $reminderBasket->minmum_amount_basket     =  $request->minmum_amount_basket;
        $reminderBasket->public         =  1;

        $reminderBasket->title_mail         =  $request->title_mail;
        $reminderBasket->status         =  "pending";
        $reminderBasket->save();


        if ($request->discountBasket) {
            $temporaryDiscount = new TemporaryDiscount();
            $temporaryDiscount->discount_type     =  $request->discounttype;
            $temporaryDiscount->expire_discount_date =  $request->date_expire_offer;
            $temporaryDiscount->shipping_free        =  $request->shippingFree ? 1 : 0;
            $temporaryDiscount->reminder_id          =  $reminderBasket->id;
            $temporaryDiscount->discount             =  $request->discount;
            $temporaryDiscount->total_usage_for_all  =  $request->total_usage_for_all;
            $temporaryDiscount->total_usage_for_one_user  =  $request->total_usage_for_one_user;

            $temporaryDiscount->save();
        }



        return response()->json([
            "msg" => "done"
        ]);
    }





    public function reminders(Request $request)
    {

        $reminders = DB::table('reminder_baskets')
            ->select("reminder_baskets.*")
            ->get();

        return response()->json([
            "reminders" => $reminders,
        ]);
    }


    public function reminders_cron_job_not_public()
    {
        $symbol = currency_symbol();

        $reminders = ReminderBasket::where("status", "pending")
            ->where("date_send_reminder", ">=", now())
            ->where("public", 0)
            ->get();

        foreach ($reminders as $reminder) {
            foreach ($reminder->reminderCustomers as $item) {

                $user = $item->user;
                $discount = $reminder->discount;
                $channel_msg = $reminder->channel_msg;
                $str1 = str_replace("{var_name}", $user->name, $reminder->msg);

                $str2 = str_replace("{var_discount_amount}", $discount->discount . ($discount->discount_type == "percent" ? "%" : "$symbol"), $str1);
                $msg_offer = str_replace("{var_date}", $discount->date_expire_offer, $str2);

                if (!empty($user)) {
                    if ($user->email != "" && $user->email != null) {

                        if ($channel_msg == "all" || $channel_msg == "email") {
                            try {
                                $array = [];
                                $array['view'] = "emails.newsletter";
                                $array['subject'] = $reminder->title_mail;
                                $array['from'] = get_setting("smtp_from_address");
                                $array['content'] = $msg_offer;
                                $array['sender'] = auth()->user()->name;
                                $array['link'] = "";
                                $array['text_btn'] = "";
                                $array['details'] = "";
                                Mail::to($user->email)->send(new SupportMailManager($array));
                            } catch (\Throwable $th) {
                            }
                        }
                    }


                    if ($user->phone != "" || $user->phone != null) {
                        if ($channel_msg == "all" || $channel_msg == "sms") {
                            $phone = fullPhoneUser($user);

                            $msg =  SMS_Send($phone, $msg_offer);
                        }
                    }
                }
            }

            $reminder->status = "send";
            $reminder->save();
            // return $item->user;
        }
    }


    public function reminders_cron_job_public()
    {
        $symbol = currency_symbol();

        $reminders = ReminderBasket::where("status", "pending")
            ->where("date_send_reminder", ">=", now())
            ->where("public", 1)
            ->get();



        foreach ($reminders as $reminder) {

            $up_to_date =  now()->addHours($reminder->duration_discount_hour);

            $minmum_amount_basket =  $reminder->minmum_amount_basket;
            $users  = DB::select("SELECT users.* ,sum(carts.price) as total_price_cart , min(carts.created_at) as date_created_cart
                                       FROM carts
                                        INNER JOIN users ON users.id = carts.user_id

                                       GROUP BY users.id
                                       ");

            foreach ($users as $item) {

                if ($up_to_date > $item->date_created_cart && $minmum_amount_basket < $item->total_price_cart) {

                    $user = $item;
                    $discount = $reminder->discount;
                    $channel_msg = $reminder->channel_msg;
                    $str1 = str_replace("{var_name}", $user->name, $reminder->msg);

                    $str2 = str_replace("{var_discount_amount}", $discount->discount . ($discount->discount_type == "percent" ? "%" : "$symbol"), $str1);
                    $msg_offer = str_replace("{var_date}", $discount->date_expire_offer, $str2);

                    if (!empty($user)) {
                        if ($user->email != "" && $user->email != null) {

                            if ($channel_msg == "all" || $channel_msg == "email") {
                                try {
                                    $array = [];
                                    $array['view'] = "emails.newsletter";
                                    $array['subject'] = $reminder->title_mail;
                                    $array['from'] = get_setting("smtp_from_address");
                                    $array['content'] = $msg_offer;
                                    $array['sender'] = auth()->user()->name;
                                    $array['link'] = "";
                                    $array['text_btn'] = "";
                                    $array['details'] = "";
                                    Mail::to($user->email)->send(new SupportMailManager($array));
                                } catch (\Throwable $th) {
                                }
                            }
                        }


                        if ($user->phone != "" || $user->phone != null) {
                            if ($channel_msg == "all" || $channel_msg == "sms") {
                                $phone = fullPhoneUser($user);

                                $msg =  SMS_Send($phone, $msg_offer);
                            }
                        }
                    }
                }

                $reminder->status = "send";
                $reminder->save();
            }
            // return $item->user;
        }
    }
}

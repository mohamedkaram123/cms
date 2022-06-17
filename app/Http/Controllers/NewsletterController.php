<?php

namespace App\Http\Controllers;

use App\Jobs\SendMails;
use App\Jobs\SendSms;
use Illuminate\Http\Request;
use App\User;
use App\Subscriber;
use Mail;
use App\Mail\EmailManager;
use App\Mail\SupportMailManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $users =  []; //User::all();
        $subscribers =  []; //Subscriber::all();
        return view('backend.marketing.newsletters.index', compact('users', 'subscribers'));
    }

    public function send(Request $request)
    {
        if (env('MAIL_USERNAME') != null) {
            //sends newsletter to selected users
            if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_USERNAME');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
                }
            }

            //sends newsletter to subscribers
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_USERNAME');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
                }
            }
        } else {
            flash(translate('Please configure SMTP first'))->error();
            return back();
        }

        flash(translate('Newsletter has been send'))->success();
        return redirect()->route('admin.dashboard');
    }

    public function testEmail(Request $request)
    {
        // $array['view'] = 'emails.newsletter';
        // $array['subject'] = "SMTP Test";
        // $array['from'] = ;
        // $array['content'] = "This is a test email.";



        $this->overWriteEnvFile("MAIL_HOST", get_setting($request->mail_driver . "_host"));
        $this->overWriteEnvFile("MAIL_PORT", get_setting($request->mail_driver . "_port"));
        $this->overWriteEnvFile("MAIL_USERNAME", get_setting($request->mail_driver . "_username"));
        $this->overWriteEnvFile("MAIL_PASSWORD", get_setting($request->mail_driver . "_password"));
        $this->overWriteEnvFile("MAIL_ENCRYPTION", get_setting($request->mail_driver . "_encryption"));

        // \Artisan::call('config:cache');
        // \Artisan::call('config:clear');
        //  return env("MAIL_USERNAME");
        $array = [];
        $array['view'] = 'emails.mail1';
        $array['subject'] = "SMTP Test";
        $array['from'] = get_setting($request->mail_driver . "_from_address");
        $array['content'] = "This is a test email.";
        $array['sender'] = "mohamedkarma";
        $array['link'] = "https://mkaram.fekrait.net/projects/FekraSHOP/demo/20-06-2021/";
        $array['text_btn'] = "open";
        $array['details'] = "";


        // Mail::to($request->email)->queue(new SupportMailManager($array));



        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            flash(translate('please check mail or driver'))->error();
            return back();
        }

        flash(translate('An email has been sent.'))->success();
        return back();
    }



    public function sendMails(Request $request)
    {


        $array = [];
        $array['view'] = $request->data["view"];
        $array['subject'] = $request->data["subject"];
        $array['from'] = get_setting("smtp_from_address");
        $array['content'] = $request->data["content"];
        $array['link'] = $request->data["link"];
        $array['text_btn'] = $request->data["text_btn"];
        $array['details'] = $request->data;
        //  Mail::to("momokaram223@gmail.com")->queue(new SupportMailManager($array));

        $delivery_status = $request->data["delivery_status"];
        $start_date = $request->data["start_date"];
        $end_date = $request->data["end_date"];
        $msg = $request->data["content"];
        $msg_type = $request->data["msg_type"];
        $users = DB::table('users')
            ->leftJoin("orders", function ($join) {
                $join->on("users.id", "=", "orders.user_id");
            });

        if (!empty($request->data["user_type"])) {
            $user_type = $request->data["user_type"];
            $users =   $users->where("users.user_type", $user_type);
        }

        if ($delivery_status != "") {
            $users =   $users->where("orders.delivery_status", $delivery_status);
        }

        // ->where("orders.delivery_status", $delivery_status)
        $users =   $users->where("orders.created_at", ">", $start_date)
            ->where("orders.created_at", "<", $end_date)
            ->groupBy("users.id")
            ->select("users.email", "users.phone")
            ->get()->toArray();

        if (count($users) > 0) {

            if (count($users) > 20) {
                $chunks =  array_chunk($users, 100);
                foreach ($chunks as $item) {

                    if ($msg_type == "mail") {

                        dispatch(new SendMails($item, $array))->onQueue("email");
                    } else {
                        dispatch(new SendSms($item, $msg))->onQueue("sms");
                    }
                }

                return response()->json([
                    "status" => 1,
                    "send_type" => "queue"
                ]);
            } else {
                foreach ($users as $user) {
                    if ($msg_type == "mail") {

                        Mail::to($user->email)->send(new SupportMailManager($array));
                    } else {
                        $phone = fullPhoneUser($user);
                        $msg =  SMS_Send($phone, $msg);
                    }
                }

                return response()->json([
                    "status" => 1,
                    "send_type" => "msg"
                ]);
            }
        } else {
            return response()->json([
                "status" => 0,
                "error_msg" => translate("the users is empty")
            ]);
        }
    }

    public function sendMainMails(Request $request)
    {
        $msg_type = $request->data["msg_type"];

        if ($msg_type == "mail") {
            $validator = Validator::make($request->data, [
                'content' => 'required',
                'subject' => 'required',


            ], [
                'content.required' => translate("please enter content mail"),
                'subject.required' => translate("please enter  subject mail"),


            ]);
            if ($validator->fails()) {

                return response()->json(['status' => 0, 'msg' => $validator->errors()]);
            }
        }


        $array = [];
        $array['view'] = $request->data["view"];
        $array['subject'] = $request->data["subject"];
        $array['from'] = get_setting("smtp_from_address");
        $array['content'] = $request->data["content"];
        $array['link'] = $request->data["link"];
        $array['text_btn'] = $request->data["text_btn"];
        $array['details'] = $request->data;

        $users = DB::table('users')
            ->select("users.email", "users.phone")
            ->get()->toArray();
        $msg = $request->data["content"];
        $msg_type = $request->data["msg_type"];
        if (count($users) > 20) {
            $chunks =  array_chunk($users, 100);
            foreach ($chunks as $item) {

                if ($msg_type == "mail") {

                    dispatch(new SendMails($item, $array))->onQueue("email");
                } else {
                    dispatch(new SendSms($item, $msg))->onQueue("sms");
                }
            }

            return response()->json([
                "status" => 1,
                "send_type" => "queue"
            ]);
        } else {
            foreach ($users as $user) {
                if ($msg_type == "mail") {

                    Mail::to($user->email)->send(new SupportMailManager($array));
                } else {
                    $phone = fullPhoneUser($user);
                    $msg =  SMS_Send($phone, $msg);
                }
            }
            return response()->json([
                "status" => 1,
                "send_type" => "msg"
            ]);
        }
    }

    public function overWriteEnvFile($type, $val)
    {
        if (env('DEMO_MODE') != 'On') {

            $path = base_path('.env');

            if (file_exists($path)) {


                $val = '"' . trim($val) . '"';

                if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, str_replace(
                        $type . '="' . env($type) . '"',
                        $type . '=' . $val,
                        file_get_contents($path)
                    ));

                    $env_val = env($type);
                    if ($env_val != $val) {
                        file_put_contents($path, str_replace(
                            $type . '=' . env($type),
                            $type . '=' . $val,
                            file_get_contents($path)
                        ));
                    }
                } else {
                    file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
                }
            }
        }
    }
}

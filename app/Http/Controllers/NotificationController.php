<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    //

    public function index()
    {
        return view("backend.pusher.pusher");
    }


    public function get_notifications()
    {

        $user_id = auth()->user()->id;
        $notifications = DB::select("SELECT  *  from notifications where 'show' = 0 AND user_id = " . $user_id . " ORDER BY id DESC");


        foreach ($notifications as $notify) {

            $data = json_decode($notify->data);
            $notify->data = $data;
            $notify->title = str_replace("var", $data->product_name, translate($notify->title));
            $notify->body = str_replace("var_price", $data->price, translate($notify->body));
            $notify->body = str_replace("var_user", $data->user_name, translate($notify->body));
        }


        return response()->json([
            "notifications" => $notifications
        ]);
    }

    public function delete_notify(Request $request)
    {


        $notify = Notification::find($request->notify["id"]);
        $notify->delete();

        return response()->json([
            "status" => "done"
        ]);
    }

    public function delete_all_notify()
    {
        $user_id = auth()->user()->id;
        DB::table('notifications')->where('user_id', '=', $user_id)->delete();

        return response()->json([
            "status" => "done"
        ]);
    }
}

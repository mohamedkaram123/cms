<?php

namespace App\MyClasses;

use App\Models\Notification;
use App\User;
use Pusher\Pusher;


class Notify
{

    public $Pusher;

    function __construct()
    {

        $this->Pusher = new Pusher(
            get_setting('PUSHER_APP_KEY'),
            get_setting('PUSHER_APP_SECRET'),
            get_setting('PUSHER_APP_ID'),
            [
                'cluster' => get_setting('PUSHER_APP_CLUSTER'),

            ]

        );
    }


    public  function add_cart_notify($datas)
    {



        //  $user = auth()->user();
        $users = User::where("user_type", "admin")->get();

        foreach ($users as $user) {


            $notify = new  Notification();
            $notify->user_id = $user->id;
            $notify->title = "Add New Product var In baskets";
            $notify->body = "the Customer var_user Add New Product In Baskets a Price var_price";
            $notify->data = json_encode($datas);
            $notify->type = 1;
            $notify->save();

            $this->Pusher->trigger('CartChannel.' . $user->id, 'CartEvent', ['data' => $datas]);
            $this->Pusher->trigger('CartChannel.' . $user->id, 'CartNotificationEvent', ['data' => $notify]);
        }
    }
}

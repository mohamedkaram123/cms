<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersLogController extends Controller
{
    //

    public function index()
    {
        return view("backend.ordersLog.orderLog");
    }

    public function orders_data(Request $request)
    {

        $query  = DB::table('order_log_status')
            ->join("users", function ($join) {
                $join->on("users.id", "=", "order_log_status.user_id");
            })

            ->join("orders", function ($join) {
                $join->on("orders.id", "=", "order_log_status.order_id");
            });


        if ($request->user_name != "") {
            $query =    $query->where("users.name", 'like', "%$request->user_name%");
        }

        if ($request->delivery_status != "") {
            $query =    $query->where("order_log_status.status", 'like', "%$request->delivery_status%");
        }


        if ($request->order_code != "") {
            $query =    $query->where("orders.code", 'like', "%$request->order_code%");
        }



        $counter =   $query->select(DB::raw("COUNT(order_log_status.id) / $request->limit as counter"), DB::raw("COUNT(order_log_status.id) as rowss"))->get();

        $queryCounter = $query;
        $query = $query->select(
            'users.name as user_name',
            'orders.code as order_code',
            'order_log_status.*'
        );
        $order_log_status =  $query
            ->groupBy("order_log_status.id")
            ->offset($request->skip)
            ->limit($request->limit)
            ->get();



        // $counter =  $counter_query->get();
        //  }

        return response()->json([
            "order_log_status" => $order_log_status,
            "counter" => round(empty((int)$counter[0]->counter) ? 0 : (int)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss),
            "request" => $request->all()

        ]);
    }
}

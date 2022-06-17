<?php

namespace App\Http\Controllers;

use App\Models\RefundRequest;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use PhpParser\Node\Expr\Cast\Double;

class RefundRequestController extends Controller
{
    //

    public function index()
    {
        $refunds = RefundRequest::where("viewed", 0)->get();
        foreach ($refunds as $item) {
            $item->viewed = 1;
            $item->save();
        };
        return view("backend.refund_request.index");
    }


    public function refund_requests_data(Request $request)
    {
        $symbol = translate(currency_symbol());

        $query  = DB::table('refund_requests')
            ->join("orders", function ($join) {
                $join->on("orders.id", "=", "refund_requests.order_id");
            })
            ->join("users", function ($join) {
                $join->on("users.id", "=", "refund_requests.user_id");
            })
                ->whereDate("refund_requests.created_at", ">=", $request->startDate)
            ->whereDate("refund_requests.created_at", "<=", $request->endDate);





        if ($request->status != "") {
            $query =    $query->where("refund_requests.status", 'like', "%$request->status%");
        }


        if ($request->order_code != "") {
            $query =    $query->where("orders.code", 'like', "%$request->order_code%");
        }

        if ($request->user_name != "") {
            $query =    $query->where("users.name", 'like', "%$request->user_name%");
        }


        $counter =   $query->select(DB::raw("COUNT(refund_requests.id) / $request->limit as counter"), DB::raw("COUNT(refund_requests.id) as rowss"))->get();

        $query = $query->select(
            'refund_requests.*',
            DB::raw("CONCAT(refund_requests.amount,' $symbol ') AS amount"),
            'users.name as user_name',

            "orders.code as order_code"
        );
        $refund_requests =  $query
            ->groupBy("refund_requests.id")
            ->orderByDesc("refund_requests.id")
            ->offset($request->skip)
            ->limit($request->limit)
            ->get();



        // $counter =  $counter_query->get();
        //  }

        return response()->json([
            "refund_requests" => $refund_requests,
            "counter" => ceil(empty((float)$counter[0]->counter) ? 0 : (float)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss),
            "request" => $request->all()

        ]);
    }


    public function refund_requests_cancel(Request $request)
    {
        $refund_requests = RefundRequest::find($request->id);
        $refund_requests->status = "cancelled";
        $refund_requests->save();

        return response()->json([
            "status" => 1,
            "msg" => "done"
        ]);
    }

    public function refund_requests_store(Request $request)
    {
        $order = Order::find($request->order_id);
        $refund_request = new RefundRequest();
        $refund_request->order_id = $order->id;
        $refund_request->user_id = auth()->user()->id;
        $refund_request->amount = $order->grand_total;
        $refund_request->reason = $request->reason;
        $refund_request->save();
        flash(translate('the refund request is sanding'))->success();
        return back();
    }
}

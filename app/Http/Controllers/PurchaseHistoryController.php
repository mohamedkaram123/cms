<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use Auth;
use DB;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_cancelled = Order::where('user_id', Auth::user()->id)->where("delivery_status", "cancelled")->orderBy('code', 'desc')->paginate(9);
        $order_confirmed = Order::where('user_id', Auth::user()->id)->where("delivery_status", "confirmed")->orderBy('code', 'desc')->paginate(9);
        $order_pendding = Order::where('user_id', Auth::user()->id)->where("delivery_status", "pending")->orderBy('code', 'desc')->paginate(9);
        $order_delivered = Order::where('user_id', Auth::user()->id)->where("delivery_status", "delivered")->orderBy('code', 'desc')->paginate(9);
        $order_on_delivery = Order::where('user_id', Auth::user()->id)->where("delivery_status", "on_delivery")->orderBy('code', 'desc')->paginate(9);
        $order_refund = Order::where('user_id', Auth::user()->id)->where("delivery_status", "refund")->orderBy('code', 'desc')->paginate(9);
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(9);

        return view('frontend.user.purchase_history', compact(
            'order_cancelled',
            'order_confirmed',
            'order_pendding',
            'order_delivered',
            'order_on_delivery',
            "order_refund",
            "orders"
        ));
    }

    public function digital_index()
    {
        $orders = DB::table('orders')
            ->orderBy('code', 'desc')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('orders.user_id', Auth::user()->id)
            ->where('products.digital', '1')
            ->where('order_details.payment_status', 'paid')
            ->select('order_details.id')
            ->paginate(15);
        return view('frontend.user.digital_purchase_history', compact('orders'));
    }

    public function purchase_history_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        return view('frontend.user.order_details_customer', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\BusinessSetting;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderSettingController extends Controller
{
    //
    public function index()
    {
        $order_status = OrderStatus::all();
        return view("backend.setup_configurations.order_setting.index", [
            "order_status" => $order_status
        ]);
    }

    public function store_status_order(Request $request)
    {
        OrderStatus::create($request->except("_token"));
        flash(translate('the status order is saved'))->success();
        return back();
    }

    public function update_status_order(Request $request)
    {
        OrderStatus::find($request->id)->update($request->except("_token"));
        flash(translate('the status order is updated'))->success();
        return back();
    }
    public function destroy_order_status($id)
    {
        $order_status =  OrderStatus::find($id);
        $order_status->delete();
        flash(translate('the status order is deleted'))->success();
        return back();
    }


    public function refund_days(Request $request)
    {
        $bussniss_setting  = BusinessSetting::where("type", "refund_days")->first();
        $bussniss_setting->value = $request->value;
        $bussniss_setting->save();
        flash(translate('the data is saved'))->success();
        return back();
    }
}

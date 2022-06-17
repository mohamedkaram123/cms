<?php

namespace App\Http\Controllers;

use App\Models\PayData;
use App\Models\PaymentFawryToken;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FawryController extends Controller
{


    public function callbackpost(Request $request, $payment_type, $user_id)
    {

        // return dd("dssd");
        if ($request->statusCode == 200) {
            $pay = new  PayData();
            $pay->payment_method =  "fawry";
            $pay->pay_details = json_encode($request->all());

            if ($payment_type == 'cart_payment') {
                $pay->save();

                $products = session()->get("products");
                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done_fawry(json_encode($request->all()), $user_id, $products);
            }


            if ($payment_type == 'wallet_payment') {
                $pay->payment_type = "wallet_payment";
                $pay->save();

                $user = User::find($user_id);
                $user->balance = $user->balance + $request->paymentAmount;
                $user->save();



                $wallet = new Wallet;
                $wallet->user_id = $user_id;
                $wallet->amount = $request->paymentAmount;
                $wallet->payment_method = 'fawry';
                $wallet->payment_details = json_encode($request->all());
                $wallet->save();





                Session::forget('payment_data');
                Session::forget('payment_type');

                flash(translate('Payment completed'))->success();
                return redirect()->route('wallet.index');

                // return null;

                // return $walletController->wallet_payment_done($payment_data, json_encode($request->all()),"pay_tab");

            }
        } else {
            flash(translate('There Error In Payment Process Not Finished'))->warning();

            return back();
        }
    }
}

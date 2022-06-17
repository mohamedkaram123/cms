<?php

namespace App\MyClasses;

use App\Models\TemporaryDiscountUsage;

class TempDiscount
{

    public function temp_discount_check()
    {

        $user = auth()->user();
        if (!empty($user)) {
            $reminderCustomer = $user->reminderCustomer;
            if (count($reminderCustomer) != 0) {
                $end_customer = $reminderCustomer[count($reminderCustomer) - 1];
                $reminder = $end_customer->reminder;
                $discount = $reminder->discount;

                if ($discount->expire_discount_date > now()) {
                    $usage_user_count = TemporaryDiscountUsage::where("user_id", $user->id)->where("temporary_discount_id", $discount->id)->get()->count();
                    $total_usage_users_count = TemporaryDiscountUsage::where("temporary_discount_id", $discount->id)->get()->count();
                    $total_usage_for_all = $discount->total_usage_for_all;
                    $total_usage_for_one_user = $discount->total_usage_for_one_user;

                    if ($total_usage_users_count < $total_usage_for_all && $usage_user_count < $total_usage_for_one_user) {
                        return [
                            "discount_type" => $discount->discount_type,
                            "discount" => $discount->discount,
                            "discount_id" => $discount->id,
                            "free_shipping" => $discount->shipping_free
                        ];
                    }
                }
            }
            return null;
        }

        return null;
    }
}

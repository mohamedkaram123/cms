<div class="card border-0 shadow-sm rounded">
    <div class="card-header">
        <h3 class="fs-16 fw-600 mb-0">{{translate('Summary')}}</h3>
        <div class="text-right">
            <span class="badge badge-inline badge-primary">{{ count($products) }} {{translate('Items')}}</span>
        </div>
    </div>

    <div class="card-body">
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @php
                $total_point = 0;
    $carts = collect();
        foreach ($products as $item) {
            $carts[] = Cart::where("user_id", auth()->user()->id)->where("owner_id", $item->owner_id)->where("product_id", $item->product_id)->first();
        }
        $categories = [];
                    @endphp
            @foreach ($carts as $key => $cartItem)
                @php
                    $product = \App\Product::find($cartItem['product_id']);
                    $total_point += $product->earn_point*$cartItem['quantity'];
                    $categories[] = $product->category_id;
                @endphp
            @endforeach
            <div class="rounded px-2 mb-2 bg-soft-primary border-soft-primary border">
                {{ translate("Total Club point") }}:
                <span class="fw-700 float-right">{{ $total_point }}</span>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th class="product-name">{{translate('Product')}}</th>
                    <th class="product-total text-right">{{translate('Total')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                $owners = [];
                $total_qty = 0;
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;
                    $product_shipping_cost = 0;
                    // $shipping_region = Session::get('shipping_info')['city'];
                    $carts = collect();
                    foreach ($products as $item) {
                        $carts[] = \App\Models\Cart::where("user_id", auth()->user()->id)->where("owner_id", $item->owner_id)->where("product_id", $item->product_id)->first();
                    }
                //    $city =  \App\City::where("name",$shipping_region)->first()
                        $categories = [];

                @endphp

                @foreach ($carts as $key => $cartItem)
                    @php

                    $total_qty +=$cartItem['quantity'];
                        $product = \App\Product::find($cartItem['product_id']);
                        $subtotal += $cartItem['price']*$cartItem['quantity'];
                        $tax += $cartItem['tax']*$cartItem['quantity'];
                    $categories [] = $product->category_id;



                        // if(isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
                        //     foreach(json_decode($cartItem['shipping'], true) as $shipping_info => $val) {
                        //         if($shipping_region == $shipping_info) {
                        //             $product_shipping_cost = (double) $val;
                        //         }
                        //     }
                        // } else {
                        //     $product_shipping_cost =!empty($city)?(double)$city->cost:(double) $cartItem['shipping'];
                        // }

                        // if($product->is_quantity_multiplied == 1 && get_setting('shipping_type') == 'product_wise_shipping') {
                        //     $product_shipping_cost = $product_shipping_cost * $cartItem['quantity'];
                        // }
                        $product_shipping_cost = session()->get("address")["cost"];


                        // dump($owners);
                        if(!in_array($cartItem['owner_id'],$owners)){
                                                    $owners[] = $cartItem['owner_id'];
                        $shipping = $product_shipping_cost;

                        }

                        $product_name_with_choice = $product->getTranslation('name');
                        if ($cartItem['variation'] != null) {
                            $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                        }
                    @endphp
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ $product_name_with_choice }}
                            <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table">

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{translate('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="fw-600">{{ single_price($subtotal) }}</span>
                    </td>
                </tr>

                <tr class="cart-shipping">
                    <th>{{translate('Tax')}}</th>
                    <td class="text-right">
                        <span class="font-italic">{{ single_price($tax) }}</span>
                    </td>
                </tr>

@php
                    $total = $subtotal+$tax+$shipping;


                          $tempDiscount = new TempDiscount();

                              $temp_discount = $tempDiscount->temp_discount_check();
                                if(!empty($temp_discount)){
                        $discount = $temp_discount["discount"];
                        $discount_type = $temp_discount["discount_type"];

                        if($discount_type == "percent"){
                            $discount_percent = $total *  ($discount / 100);
                            $total -=$discount_percent;
                        }else{
                            $total -=$discount;
                        }
                        if($temp_discount["free_shipping"] == 1){
                            $total -=$shipping;
                            $shipping =  0;
                        }
                    //    $total -=$shipping;
                    //     $shipping =  $temp_discount["free_shipping"] == 1 ? 0 : $shipping;

                        //$total -=$discount;
                    }

                    if(Session::has('club_point')) {
                        $total -= Session::get('club_point');
                    }
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }


                     $spcial_offer_controller = new SpcialOffer();
                     $spcial_offer_discount = $spcial_offer_controller->show_special_offer_cart($total,$total_qty);

                     if(!empty($spcial_offer_discount)){
                            $total -= $spcial_offer_discount;
                     }else{
                         $spcial_offer_discount_category = $spcial_offer_controller->show_special_offer_categories($total, $total_qty, $categories);

                if (!empty($spcial_offer_discount_category)) {
                    $total -= $spcial_offer_discount_category;
                }
                     }


                    // $total_spcial_offer_discount_product = 0;
                    // foreach ($products as $item) {
                    //        $spcial_offer_discount_product = $spcial_offer_controller->show_special_offer_product($total,$total_qty,$item->product_id);
                    //         if(!empty($spcial_offer_discount)){
                    //         $total_spcial_offer_discount_product += $spcial_offer_discount_product;
                    //            $total -= $spcial_offer_discount_product;
                    //                 };
                    //    }
                @endphp
                <tr class="cart-shipping">
                    <th>{{translate('Total Shipping')}}</th>
                    <td class="text-right">
                        <span class="font-italic">{{ single_price($shipping) }}</span>
                    </td>
                </tr>

                @if (Session::has('club_point'))
                    <tr class="cart-shipping">
                        <th>{{translate('Redeem point')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ single_price(Session::get('club_point')) }}</span>
                        </td>
                    </tr>
                @endif

                @if (Session::has('coupon_discount'))
                    <tr class="cart-shipping">
                        <th>{{translate('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ single_price(Session::get('coupon_discount')) }}</span>
                        </td>
                    </tr>
                @endif

                @if (!empty($temp_discount))
                    <tr class="cart-shipping">
                        <th>{{translate('Temporary Discount')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ $discount_type == "percent"? single_price($discount_percent) : single_price($discount) }}</span>
                        </td>
                    </tr>
                @endif

                @if (!empty($spcial_offer_discount))
                    <tr class="cart-shipping">
                        <th>{{translate('Spcial Discount Cart')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ single_price($spcial_offer_discount) }}</span>
                        </td>
                    </tr>
                @endif
                @if (!empty($spcial_offer_discount_category))
                    <tr class="cart-shipping">
                        <th>{{translate('Spcial Discount Category')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ single_price($spcial_offer_discount_category) }}</span>
                        </td>
                    </tr>
                @endif
               {{-- @if ($total_spcial_offer_discount_product != 0)
                    <tr class="cart-shipping">
                        <th>{{translate('Spcial Discount Product')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ $total_spcial_offer_discount_product }}</span>
                        </td>
                    </tr>
               @endif --}}

                <tr class="cart-total">
                    <th><span class="strong-600">{{translate('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span>{{ single_price(CartData::get_total(json_encode($products))) }}</span></strong>
                    </td>
                </tr>
            </tfoot>
        </table>

        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @if (Session::has('club_point'))
                <div class="mt-3">
                    <form class="" action="{{ route('checkout.remove_club_point') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="form-control">{{ Session::get('club_point')}}</div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{translate('Remove Redeem Point')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                @if(Auth::user()->point_balance > 0)
                    <div class="mt-3">
                        <p>
                            {{translate('Your club point is')}}:
                            @if(isset(Auth::user()->point_balance))
                                {{ Auth::user()->point_balance }}
                            @endif
                        </p>
                        <form class="" action="{{ route('checkout.apply_club_point') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="point" placeholder="{{translate('Enter club point here')}}" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">{{translate('Redeem')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        @endif

        @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
            @if (Session::has('coupon_discount'))
                <div class="mt-3">
                    <form class="" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="form-control">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{translate('Change Coupon')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="products" value="{{ json_encode($products) }}" />
                        <div class="input-group">

                            <input type="text" class="form-control" name="code" placeholder="{{translate('Have coupon code? Enter here')}}" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{translate('Apply')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endif

    </div>
</div>

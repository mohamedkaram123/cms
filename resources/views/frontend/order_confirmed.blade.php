@extends('frontend.layouts.app')

@section('content')

    <section class="pt-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row aiz-steps arrow-divider">
                        <div class="col done">
                            <div class="text-center text-success">
                                <i class="la-3x mb-2 las la-shopping-cart"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('1. My Cart')}}</h3>
                            </div>
                        </div>
                        {{-- <div class="col done">
                        <div class="text-center text-success">

                            <i class="la-3x mb-2 las la-shopping-bag"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Choose Products')}}</h3>

                        </div>
                    </div> --}}
                        <div class="col done">
                            <div class="text-center text-success">
                                <i class="la-3x mb-2 las la-truck"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Delivery info')}}</h3>
                            </div>
                        </div>
                        <div class="col done">
                            <div class="text-center text-success">
                                <i class="la-3x mb-2 las la-credit-card"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('3. Payment')}}</h3>
                            </div>
                        </div>
                        {{-- <div class="col active">
                            <div class="text-center text-primary">
                                <i class="la-3x mb-2 las la-check-circle"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('5. Confirmation')}}</h3>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
      //  dd($orders);
    @endphp
    @foreach ($orders as $order)
                @php

    // return dd($order->orderDetails->first());
        $status = $order->orderDetails->first()->delivery_status;
    @endphp
    <section class="py-4">
        <div class="container text-left">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body">
                            <div class="text-center py-4 mb-4">
                                <i class="la la-check-circle la-3x text-success mb-3"></i>
                                <h1 class="h3 mb-3 fw-600">{{ translate('Thank You for Your Order!')}}</h1>
                                <h2 class="h5">{{ translate('Order Code:')}} <span class="fw-700 text-primary">{{ $order->code }}</span></h2>
                                <p class="opacity-70 font-italic">{{  translate('A copy or your order summary has been sent to') }} {{ json_decode($order->shipping_address)->email }}</p>
                                <a href="{{route("purchase_history.index",[
                                    "order_id"=>$order->id
                                ])}}" class="btn btn-primary">{{translate("Please track your order")}}</a>
                            </div>
                            <div class="mb-4">
                                <h5 class="fw-600 mb-3 fs-17 pb-2">{{ translate('Order Summary')}}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Order Code')}}:</td>
                                                <td>{{ $order->code }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Name')}}:</td>
                                                <td>{{ json_decode($order->shipping_address)->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                                                <td>{{ json_decode($order->shipping_address)->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                                                <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Order date')}}:</td>
                                                <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Order status')}}:</td>
                                                <td>{{ translate(ucfirst(str_replace('_', ' ', $status))) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Total order amount')}}:</td>
                                                <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Shipping')}}:</td>
                                                <td>{{ translate('Flat shipping rate')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', translate($order->payment_type))) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-600 mb-3 fs-17 pb-2">{{ translate('Order Details')}}</h5>
                                <div>
                                    @php
                                    $owner_ids = [];
                                       foreach ($order->orderDetails as $item) {
                                       //    return dd($item);
                                           $owner_ids [] = $item->seller_id;
                                       }
                                       $owner_ids = array_unique($owner_ids);
                                    @endphp
                                     @foreach ($owner_ids as $owner_id )
                                     <div class="card">
                                         <div class="card-header">
                                            <h5 class="fs-16 fw-600 mb-0">{{ $owner_id ==1? get_setting('site_name'):\App\Shop::where('user_id', $owner_id)->first()->name }} {{ translate('Products') }}</h5>
                                         </div>
                                            <table class="table table-responsive-md">
                                            <thead>
                                                <tr>
                                                    <th>#</th>

                                                    <th width="30%">{{ translate('Product')}}</th>
                                                    <th>{{ translate('Variation')}}</th>
                                                    <th>{{ translate('Quantity')}}</th>
                                                    <th>{{ translate('Delivery Type')}}</th>
                                                    <th class="text-right">{{ translate('Price')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderDetails->where("seller_id",$owner_id) as $key => $orderDetail)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                            @if ($orderDetail->product != null)
                                                                <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="text-reset">
                                                                    {{ $orderDetail->product->getTranslation('name') }}
                                                                </a>
                                                            @else
                                                                <strong>{{  translate('Product Unavailable') }}</strong>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $orderDetail->variation }}
                                                        </td>
                                                        <td>
                                                            {{ $orderDetail->quantity }}
                                                        </td>
                                                        <td>
                                                            @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                                                {{  translate('Home Delivery') }}
                                                            @elseif ($orderDetail->shipping_type == 'pickup_point')
                                                                @if ($orderDetail->pickup_point != null)
                                                                    {{ $orderDetail->pickup_point->getTranslation('name') }} ({{ translate('Pickip Point') }})
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{ single_price($orderDetail->price) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                     </div>

                                    @endforeach

                                </div>
                                <div class="row">
                                    <div class="col-xl-5 col-md-6 ml-auto mr-0">
                                        <table class="table ">
                                            <tbody>
                                                <tr>
                                                    <th>{{ translate('Subtotal')}}</th>
                                                    <td class="text-right">
                                                        <span class="fw-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ translate('Shipping')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ single_price($order->shipping_cost) }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ translate('Shipping Days')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ $order->shipping_days }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ translate('Tax')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ translate('Coupon Discount')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ single_price($order->coupon_discount) }}</span>
                                                    </td>
                                                </tr>
                                                @if(!empty($order->special_offer_cart))
                                                <tr>
                                                    <th>{{ translate('Special Cart')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ single_price($order->special_offer_cart) }}</span>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if(!empty($order->special_offer_categories))
                                                <tr>
                                                    <th>{{ translate('Special Category')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ single_price($order->special_offer_categories) }}</span>
                                                    </td>
                                                </tr>
                                                @endif
                                                {{-- @if(!empty($order->special_offer_product) && $order->special_offer_product != 0)
                                                <tr>
                                                    <th>{{ translate('Temporary Discount')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ single_price($order->special_offer_product) }}</span>
                                                    </td>
                                                </tr>
                                                @endif --}}
                                                @if(!empty($order->temp_discount))
                                                <tr>
                                                    <th>{{ translate('Temporary Discount')}}</th>
                                                    <td class="text-right">
                                                        <span class="font-italic">{{ single_price($order->temp_discount) }}</span>
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <th><span class="fw-600">{{ translate('Total')}}</span></th>
                                                    <td class="text-right">
                                                        <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach

@endsection
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Order id')}}: {{ $order->code }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>

@php
    $status = $order->orderDetails->first()->delivery_status;
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();



@endphp
   <div class="row m-3">
        <div class="col-12">
     @if ($status == 'delivered')
            @if (!empty($order->refund_request))
                <span style="width: auto;font-size: 18px;font-weight:200 " class="badge badge-{{$order->refund_request->status == "pending"?"warning":"danger"}} p-3">
                    @if ($order->refund_request->status == "pending")
                            @if ($order->refund_request->viewed == 1)
                                                        {{translate("Your refunded request has been seen and reviewed")}}
                            @else
                                                        {{translate("Your refunded request not viewed yet")}}

                            @endif
                        @else
                        {{translate("Refund Request is Not Accepted")}}
                    @endif
                </span>

            @endif
        @endif


        </div>

    </div>
<div class="modal-body gry-bg px-3 pt-3">
        @if ($status == "cancelled")
            @include("frontend.user.purchase_histories_orders.headers_details_orders.header_cancelled")
            @elseif($status == "refund")
                        @include("frontend.user.purchase_histories_orders.headers_details_orders.header_refund")

            @else
            @include("frontend.user.purchase_histories_orders.headers_details_orders.header_main")

        @endif

    <div class="card mt-4">
        <div class="card-header">
          <b class="fs-15">{{ translate('Order Summary') }}</b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-borderless">
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order Code')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Customer')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->postal_code }}, {{ json_decode($order->shipping_address)->country }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table table-borderless">
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
                        {{-- <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping method')}}:</td>
                            <td>{{ translate('Flat shipping rate')}}</td>
                        </tr> --}}
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header">
                  <b class="fs-15">{{ translate('Order Details') }}</b>
                </div>
                <div class="card-body pb-0">
                    <table class="table table-borderless table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="30%">{{ translate('Product')}}</th>
                                <th>{{ translate('Variation')}}</th>
                                <th>{{ translate('Quantity')}}</th>
                                <th>{{ translate('Delivery Type')}}</th>
                                <th>{{ translate('Price')}}</th>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <th>{{ translate('Refund')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->getTranslation('name') }}</a>
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
                                                {{ $orderDetail->pickup_point->name }} ({{  translate('Pickip Point') }})
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ single_price($orderDetail->price) }}</td>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        @php
                                            $no_of_max_day = \App\BusinessSetting::where('type', 'refund_request_time')->first()->value;
                                            $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                            $today_date = Carbon\Carbon::now();
                                        @endphp
                                        <td>
                                            @if ($orderDetail->product != null &&
                                            $orderDetail->product->refundable != 0 &&
                                            $orderDetail->refund_request == null &&
                                            $today_date <= $last_refund_date &&
                                            $orderDetail->payment_status == 'paid' &&
                                            $orderDetail->delivery_status == 'delivered')
                                                <a href="{{route('refund_request_send_page', $orderDetail->id)}}" class="btn btn-primary btn-sm">{{  translate('Send') }}</a>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                <b class="text-info">{{  translate('Pending') }}</b>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 2)
                                                <b class="text-success">{{  translate('Rejected') }}</b>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                <b class="text-success">{{  translate('Approved') }}</b>
                                            @elseif ($orderDetail->product->refundable != 0)
                                                <b>{{  translate('N/A') }}</b>
                                            @else
                                                <b>{{  translate('Non-refundable') }}</b>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header">
                  <b class="fs-15">{{ translate('Order Ammount') }}</b>
                </div>
                <div class="card-body pb-0">
                    <table class="table table-borderless">
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
            @if ($order->manual_payment && $order->manual_payment_data == null)
                <button onclick="show_make_payment_modal({{ $order->id }})" class="btn btn-block btn-primary">{{ translate('Make Payment')}}</button>
            @endif
        </div>
    </div>
</div>

<script type="text/javascript">
    function show_make_payment_modal(order_id){
        $.post('{{ route('checkout.make_payment') }}', {_token:'{{ csrf_token() }}', order_id : order_id}, function(data){
            $('#payment_modal_body').html(data);
            $('#payment_modal').modal('show');
            $('input[name=order_id]').val(order_id);
        });
    }
</script>

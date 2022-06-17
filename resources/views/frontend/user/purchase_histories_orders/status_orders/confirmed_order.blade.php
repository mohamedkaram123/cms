        @if (count($order_confirmed) > 0)

            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Code') }}</th>
                            <th data-breakpoints="md">{{ translate('Date') }}</th>
                            <th>{{ translate('Amount') }}</th>
                            <th data-breakpoints="md">{{ translate('Delivery Status') }}</th>
                            <th data-breakpoints="md">{{ translate('Payment Status') }}</th>
                            <th class="text-right">{{ translate('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_confirmed as $key => $order)
                            @if (count($order->orderDetails) > 0)
                                <tr>
                                    <td>
                                        <a href="#{{ $order->code }}"
                                            onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                    </td>
                                    <td>{{ date('d-m-Y', $order->date) }}</td>
                                    <td>
                                        {{ single_price($order->grand_total) }}
                                    </td>
                                    <td>
                                        {{ translate(ucfirst(str_replace('_', ' ', $order->orderDetails->first()->delivery_status))) }}
                                        @if ($order->delivery_viewed == 0)
                                            <span class="ml-2" style="color:green"><strong>*</strong></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->payment_status == 'paid')
                                            <span
                                                class="badge badge-inline badge-success">{{ translate('Paid') }}</span>
                                        @else
                                            <span
                                                class="badge badge-inline badge-danger">{{ translate('Unpaid') }}</span>
                                        @endif
                                        @if ($order->payment_status_viewed == 0)
                                            <span class="ml-2" style="color:green"><strong>*</strong></span>
                                        @endif
                                    </td>
                                    @php
                                        $delivery_status = $order->orderDetails->first()->delivery_status;
                                        $payment_status = $order->orderDetails->first()->payment_status;

                                    @endphp
                                    <td class="text-right">
                                        @if (\App\MyClasses\OrdersNotes::check_order_note($order->id) && $delivery_status != 'refund')
                                            <button onclick="open_modal_mote({{ $order->id }})"
                                                class="btn btn-soft-info  btn-icon btn-circle btn-sm note_order"
                                                data-order_id="{{ $order->id }}"
                                                title="{{ translate('Put Notes') }}">
                                                <i class="las la-sticky-note"></i>
                                            </button>
                                        @endif

                                        @if ($delivery_status != 'delivered' && $delivery_status != 'cancelled')
                                            <button onclick="update_dliever({{ $order->id }})"
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm update_delivery_status"
                                                data-order_id="{{ $order->id }}"
                                                title="{{ translate('Cancel Order') }}">
                                                <i class="las la-times-circle"></i>
                                            </button>
                                        @endif
                                        <a href="javascript:void(0)"
                                            class="btn btn-soft-info btn-icon btn-circle btn-sm"
                                            onclick="show_purchase_history_details({{ $order->id }})"
                                            title="{{ translate('Order Details') }}">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a class="btn btn-soft-warning btn-icon btn-circle btn-sm"
                                            href="{{ route('invoice.download', $order->id) }}"
                                            title="{{ translate('Download Invoice') }}">
                                            <i class="las la-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $order_confirmed->links() }}
                </div>
            </div>
        @else
            <div class="card-body">
                <div class="text-center">
                    <h5 style="font-weight: 200;color: rgb(121, 118, 118)">{{ translate('Not Found Orders') }}</h5>
                </div>
            </div>
        @endif

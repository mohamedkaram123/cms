@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="h2 fs-16 mb-0">{{ translate('Order Details') }}</h1>
        </div>
        <div class="card-body">
            <div class="row gutters-5">
                <div class="col text-center text-md-left">
                </div>
                @php
                    $delivery_status = $order->orderDetails->first()->delivery_status;
                    $payment_status = $order->orderDetails->first()->payment_status;
                @endphp
                <div class="col-md-3 ml-auto">
                    <label for=update_payment_status"">{{ translate('Payment Status') }}</label>
                    <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"
                        id="update_payment_status">
                        <option value="paid" @if ($payment_status == 'paid') selected @endif>{{ translate('Paid') }}
                        </option>
                        <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{ translate('Unpaid') }}
                        </option>
                    </select>
                </div>
                <div class="col-md-3 ml-auto">
                    <label for=update_delivery_status"">{{ translate('Delivery Status') }}</label>
                    <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"
                        id="update_delivery_status">
                        @foreach (App\Models\OrderStatus::where('show', 1)->orderBy('arrange', 'asc')->get()
        as $status)
                            <option value="{{ $status->status }}" @if ($delivery_status == $status->status) selected @endif>
                                {{ translate($status->status) }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="row gutters-5">
                <div class="col text-center text-md-left">
                    <address>
                        <strong class="text-main">{{ json_decode($order->shipping_address)->name }}</strong><br>
                        {{ json_decode($order->shipping_address)->email }}<br>
                        {{ json_decode($order->shipping_address)->phone }}<br>
                        {{ json_decode($order->shipping_address)->address }},
                        {{ json_decode($order->shipping_address)->city }},
                        {{ json_decode($order->shipping_address)->postal_code }}<br>
                        {{ json_decode($order->shipping_address)->country }}
                    </address>
                    @if ($order->manual_payment && is_array(json_decode($order->manual_payment_data, true)))
                        <br>
                        <strong class="text-main">{{ translate('Payment Information') }}</strong><br>
                        {{ translate('Name') }}: {{ json_decode($order->manual_payment_data)->name }},
                        {{ translate('Amount') }}:
                        {{ single_price(json_decode($order->manual_payment_data)->amount) }},
                        {{ translate('TRX ID') }}: {{ json_decode($order->manual_payment_data)->trx_id }}
                        <br>
                        <a href="{{ uploaded_asset(json_decode($order->manual_payment_data)->photo) }}"
                            target="_blank"><img
                                src="{{ uploaded_asset(json_decode($order->manual_payment_data)->photo) }}" alt=""
                                height="100"></a>
                    @endif
                </div>
                <div class="col-md-4 ml-auto">
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-main text-bold">{{ translate('Order #') }}</td>
                                <td class="text-right text-info text-bold"> {{ $order->code }}</td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">{{ translate('Order Status') }}</td>
                                @php
                                    $status = $order->orderDetails->first()->delivery_status;
                                @endphp
                                <td class="text-right">
                                    @if ($status == 'delivered')
                                        <span id="badge_order"
                                            class="badge badge-inline badge-success">{{ translate(ucfirst(str_replace('_', ' ', $status))) }}</span>
                                    @else
                                        <span id="badge_order"
                                            class="badge badge-inline badge-info">{{ translate(ucfirst(str_replace('_', ' ', $status))) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">{{ translate('Order Date') }} </td>
                                <td class="text-right">{{ date('d-m-Y h:i A', $order->date) }}</td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">
                                    {{ translate('Total amount') }}
                                </td>
                                <td class="text-right">
                                    {{ single_price($order->grand_total) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">{{ translate('Payment method') }}</td>
                                <td class="text-right">{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="new-section-sm bord-no">
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-bordered aiz-table invoice-summary">
                        <thead>
                            <tr class="bg-trans-dark">
                                <th data-breakpoints="lg" class="min-col">#</th>
                                <th width="10%">{{ translate('Photo') }}</th>
                                <th class="text-uppercase">{{ translate('Description') }}</th>
                                <th data-breakpoints="lg" class="text-uppercase">{{ translate('Delivery Type') }}</th>
                                <th data-breakpoints="lg" class="min-col text-center text-uppercase">
                                    {{ translate('Qty') }}
                                </th>
                                <th data-breakpoints="lg" class="min-col text-center text-uppercase">
                                    {{ translate('Price') }}</th>
                                <th data-breakpoints="lg" class="min-col text-right text-uppercase">
                                    {{ translate('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}"
                                                target="_blank"><img height="50"
                                                    src="{{ uploaded_asset($orderDetail->product->thumbnail_img) }}"></a>
                                        @else
                                            <strong>{{ translate('N/A') }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <strong><a href="{{ route('product', $orderDetail->product->slug) }}"
                                                    target="_blank"
                                                    class="text-muted">{{ $orderDetail->product->getTranslation('name') }}</a></strong>
                                            <small>{{ $orderDetail->variation }}</small>
                                        @else
                                            <strong>{{ translate('Product Unavailable') }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                            {{ translate('Home Delivery') }}
                                        @elseif ($orderDetail->shipping_type == 'pickup_point')
                                            @if ($orderDetail->pickup_point != null)
                                                {{ $orderDetail->pickup_point->getTranslation('name') }}
                                                ({{ translate('Pickup Point') }})
                                            @else
                                                {{ translate('Pickup Point') }}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $orderDetail->quantity }}</td>
                                    <td class="text-center">
                                        {{ single_price($orderDetail->price / $orderDetail->quantity) }}</td>
                                    <td class="text-center">{{ single_price($orderDetail->price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">

                <div class="clearfix float-right col-md-4 col-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <strong class="text-muted">{{ translate('Sub Total') }} :</strong>
                                </td>
                                <td>
                                    {{ single_price($order->orderDetails->sum('price')) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">{{ translate('Tax') }} :</strong>
                                </td>
                                <td>
                                    {{ single_price($order->orderDetails->sum('tax')) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">{{ translate('Shipping') }} :</strong>
                                </td>
                                <td>
                                    {{ single_price($order->shipping_cost) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">{{ translate('Coupon') }} :</strong>
                                </td>
                                <td>
                                    {{ single_price($order->coupon_discount) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">{{ translate('TOTAL') }} :</strong>
                                </td>
                                <td class="text-muted h5">
                                    {{ single_price($order->grand_total) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right no-print">
                        <a href="{{ route('invoice.download', $order->id) }}" type="button"
                            class="btn btn-icon btn-light"><i class="las la-print"></i></a>
                    </div>
                </div>



                @if (\App\MyClasses\OrdersNotes::check_order_note($order->id))
                    @php
                        $OrderNotes = \App\MyClasses\OrdersNotes::get_order_notes($order->id);
                    @endphp
                    @if (count($OrderNotes->files) > 0)
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ translate('Order Notes Files') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($OrderNotes->files as $key => $file)
                                            @php
                                                if ($file->file_original_name == null) {
                                                    $file_name = translate('Unknown');
                                                } else {
                                                    $file_name = $file->file_original_name;
                                                }
                                            @endphp
                                            <div class="col-auto w-140px w-lg-200px">
                                                <div class="aiz-file-box">
                                                    <div class="dropdown-file">
                                                        <a class="dropdown-link" data-toggle="dropdown">
                                                            <i class="la la-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                onclick="detailsInfo(this)" data-id="{{ $file->id }}">
                                                                <i class="las la-info-circle mr-2"></i>
                                                                <span>{{ translate('Details Info') }}</span>
                                                            </a>
                                                            <a href="{{ my_asset($file->file_name) }}" target="_blank"
                                                                download="{{ $file_name }}.{{ $file->extension }}"
                                                                class="dropdown-item">
                                                                <i class="la la-download mr-2"></i>
                                                                <span>{{ translate('Download') }}</span>
                                                            </a>
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                onclick="copyUrl(this)"
                                                                data-url="{{ my_asset($file->file_name) }}">
                                                                <i class="las la-clipboard mr-2"></i>
                                                                <span>{{ translate('Copy Link') }}</span>
                                                            </a>
                                                            <a href="javascript:void(0)" class="dropdown-item confirm-alert"
                                                                data-href="{{ route('uploaded-files.destroy', $file->id) }}"
                                                                data-target="#delete-modal">
                                                                <i class="las la-trash mr-2"></i>
                                                                <span>{{ translate('Delete') }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="card card-file aiz-uploader-select c-default"
                                                        title="{{ $file_name }}.{{ $file->extension }}">
                                                        <div class="card-file-thumb">
                                                            @if ($file->type == 'image')
                                                                <img src="{{ my_asset($file->file_name) }}"
                                                                    class="img-fit">
                                                            @elseif($file->type == 'video')
                                                                <i class="las la-file-video"></i>
                                                            @else
                                                                <i class="las la-file"></i>
                                                            @endif
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="d-flex">
                                                                <span
                                                                    class="text-truncate title">{{ $file_name }}</span>
                                                                <span
                                                                    class="ext">.{{ $file->extension }}</span>
                                                            </h6>
                                                            <p>{{ formatBytes($file->file_size) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($OrderNotes->note != '')
                        <div class="col-md-4 col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ translate('Order Note') }}</h3>
                                </div>
                                <div class="card-body">
                                    <textarea disabled="true" rows="4" class="form-control">{{ $OrderNotes->note }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif

                @endif



            </div>


        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#update_delivery_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {

                $("#badge_order").text(data)
                AIZ.plugins.notify('success', '{{ translate('Delivery status has been updated') }}');
            });
        });

        $('#update_payment_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {

                console.log({
                    data
                });
                AIZ.plugins.notify('success', '{{ translate('Payment status has been updated') }}');
            });
        });
    </script>
@endsection

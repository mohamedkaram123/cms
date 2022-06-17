@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">


                <li class="nav-item">
                    <a class="nav-link active" id="all_orders-tab" data-toggle="pill" href="#pending" role="tab"
                        aria-controls="all_orders" aria-selected="false">{{ translate('All Orders') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="pending-tab" data-toggle="pill" href="#pending" role="tab"
                        aria-controls="pending" aria-selected="false">{{ translate('Pending') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="confirmed-tab" data-toggle="pill" href="#confirmed" role="tab"
                        aria-controls="confirmed" aria-selected="true">{{ translate('Confirmed') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="on_delivery-tab" data-toggle="pill" href="#on_delivery" role="tab"
                        aria-controls="on_delivery" aria-selected="false">{{ translate('On delivery') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="delivered-tab" data-toggle="pill" href="#delivered" role="tab"
                        aria-controls="delivered" aria-selected="false">{{ translate('Delivered') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-tab" data-toggle="pill" href="#cancelled" role="tab"
                        aria-controls="cancelled" aria-selected="false">{{ translate('Cancel') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="refund-tab" data-toggle="pill" href="#refund" role="tab"
                        aria-controls="refund" aria-selected="false">{{ translate('Refund') }}</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="all_orders" role="tabpanel" aria-labelledby="all_orders-tab">
                @include(
                    'frontend.user.purchase_histories_orders.status_orders.all_orders'
                )
            </div>
            <div class="tab-pane fade " id="pending" role="tabpanel" aria-labelledby="pending-tab">
                @include(
                    'frontend.user.purchase_histories_orders.status_orders.pending_order'
                )
            </div>
            <div class="tab-pane fade " id="confirmed" role="tabpanel" aria-labelledby="confirmed-tab">
                @include(
                    'frontend.user.purchase_histories_orders.status_orders.confirmed_order'
                )
            </div>
            <div class="tab-pane fade" id="on_delivery" role="tabpanel" aria-labelledby="on_delivery-tab">
                @include(
                    'frontend.user.purchase_histories_orders.status_orders.on_delivery_order'
                )
            </div>
            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                @include(
                    'frontend.user.purchase_histories_orders.status_orders.delivered_order'
                )
            </div>
            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                @include(
                    'frontend.user.purchase_histories_orders.status_orders.cancelled_order'
                )
            </div>
            <div class="tab-pane fade" id="refund" role="tabpanel" aria-labelledby="refund-tab">
                @include(
                    'frontend.user.purchase_histories_orders.status_orders.refund_order'
                )
            </div>
        </div>

    </div>
@endsection

@section('modal')
    @include(
        'frontend.user.purchase_histories_orders.purchase_history_modals.modal_refund'
    )


    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="note_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div>

                    <div class="card">
                        <div class="card-header">
                            <h3>{{ translate('Add Note') }}</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-default row " action="{{ route('order.add_note') }}" role="form"
                                method="POST">
                                @csrf
                                <input type="hidden" name="order_id" id="note_order_id" />
                                <div class="col-12">
                                    <div id="choose_file" style="margin-block: 20px" class="form ">
                                        <label>{{ translate('add files') }}</label>
                                        <div>
                                            <div class="input-group" data-toggle="aizuploader" data-multiple="true">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                        {{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">
                                                    {{ translate('Choose File') }}
                                                </div>
                                                <input type="hidden" name="photos" class="selected-files">

                                            </div>
                                            <div class="file-preview box sm">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="text_notes" class="form-group  ">
                                        <label>{{ translate('Add Notes') }}</label>
                                        <div>
                                            <textarea id="text_note" class="form-control" name="note" style="width: 100%" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-left">
                                    <button class="btn btn-primary" type="submit">{{ translate('Save') }}</button>
                                </div>

                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        @if (request()->has('order_id'))
            show_purchase_history_details("{{ request('order_id') }}")
        @endif

        function open_modal_refund(order_id) {
            console.log("ssssssss");

            $("#refund_order_id").val(order_id)
            $("#refund_request_modal").modal()
        }

        function open_modal_mote(order_id) {
            $("#note_order_id").val(order_id)
            $("#note_modal").modal()

        };

        function update_dliever(order_id) {

            Swal.fire({
                title: "{{ translate('Are you sure want cancel your order?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ translate('Yes') }}",
                cancelButtonText: "{{ translate('cancel') }}",

            }).then((result) => {
                if (result.isConfirmed) {

                    // var order_id = $(this).data("order_id");
                    var status = "cancelled";

                    console.log({
                        order_id,
                        status
                    });
                    btn = $(this);
                    $.post('{{ route('orders.update_delivery_status') }}', {
                        _token: '{{ @csrf_token() }}',
                        order_id: order_id,
                        status: status
                    }, function(data) {

                        window.location.reload(true)
                    });
                }
            })

        };

        $('#order_details').on('hidden.bs.modal', function() {
            @if (!request()->has('order_id'))
                location.reload();
            @endif
        })
    </script>
@endsection

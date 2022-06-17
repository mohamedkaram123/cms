@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
    	<div class="row align-items-center">
    		<div class="col-md-12">
    			<h1 class="h3">{{translate('Order Setting')}}</h1>
    		</div>
    	</div>
    </div>
    <div class="row">


        <div class="col-md-7">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Order Status') }}</h5>
                    </div>
                    {{-- <div class="col-md-4">
                        <form class="" id="sort_cities" action="" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                            </div>
                        </form>
                    </div> --}}
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th data-breakpoints="lg">#</th>
                                <th>{{translate('Status')}}</th>
                                <th>{{translate('Show')}}</th>
                                <th>{{translate('Show User')}}</th>
                               <th>{{translate('Arrange')}}</th>

                                <th data-breakpoints="lg" class="text-right">{{translate('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_status as $key => $item)
                                <tr>
                                    <td >{{ ($key+1) }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->show == 1?translate("active"):translate("not active") }}</td>
                                    <td>{{ $item->show_user == 1?translate("active"):translate("not active") }}</td>
                                    <td>{{ $item->arrange }}</td>

                                @if ( ! \App\MyClasses\OrderData::order_check($item->status) )
                                    <td class="text-right">
                                        <a onclick="edit_order('{{$item->id}}')" class="btn btn-soft-primary btn-icon btn-circle btn-sm"  title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        @section('modal')
                                                <div class="modal fade" id="order_status_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div id="order-details-modal-body">
                                                                	<div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="mb-0 h6">{{ translate('Add New Status Order') }}</h5>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form action="{{ route('order.status.update') }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" value="{{$item->id}}" name="id" />
                                                                                    <div class="form-group mb-3">
                                                                                        <label for="name">{{translate('Status Name')}}</label>
                                                                                        <input value="{{$item->status}}" type="text" placeholder="{{translate('Status Name')}}" name="status" class="form-control" required>
                                                                                    </div>

                                                                            <div class="form-group  mb-3">
                                                                                    <label class="col-sm-3 col-from-label">{{translate('Show')}}</label>
                                                                                    <div class="col-sm-3">
                                                                                        <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">
                                                                                            <input  {{$item->show == 1?"checked":""}} value="1"  type="checkbox" name="show">
                                                                                            <span class="slider round"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group  mb-3">
                                                                                    <label class="col-sm-3 col-from-label">{{translate('Show User')}}</label>
                                                                                    <div class="col-sm-3">
                                                                                        <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">
                                                                                            <input {{$item->show_user == 1?"checked":""}} value="1"  type="checkbox" name="show_user">
                                                                                            <span class="slider round"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>


                                                                                    <div class="form-group mb-3">
                                                                                        <label for="name">{{translate('Status Arrange')}}</label>
                                                                                        <input value="{{$item->arrange}}" type="number" min="0"  placeholder="{{translate('Status Arrange')}}" name="arrange" class="form-control" required>
                                                                                    </div>



                                                                                    <div class="form-group mb-3 text-right">
                                                                                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endsection
                                        <a href="#" onclick="delete_order('{{$item->id}}')" class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_status" data-order_id="{{$item->id}}"  title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{-- {{ $order_status->appends(request()->input())->links() }} --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
    		<div class="card">
    			<div class="card-header">
    				<h5 class="mb-0 h6">{{ translate('Add New Status Order') }}</h5>
    			</div>
    			<div class="card-body">
    				<form action="{{ route('order.status.store') }}" method="POST">
    					@csrf
    					<div class="form-group mb-3">
    						<label for="name">{{translate('Status Name')}}</label>
    						<input type="text" placeholder="{{translate('Status Name')}}" name="status" class="form-control" required>
    					</div>

                 <div class="form-group  mb-3">
                        <label class="col-sm-3 col-from-label">{{translate('Show')}}</label>
                        <div class="col-sm-3">
                            <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">
                        		<input checked value="1"  type="checkbox" name="show">
                        		<span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group  mb-3">
                        <label class="col-sm-3 col-from-label">{{translate('Show User')}}</label>
                        <div class="col-sm-3">
                            <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">
                        		<input value="1"  type="checkbox" name="show_user">
                        		<span class="slider round"></span>
                            </label>
                        </div>
                    </div>


                        <div class="form-group mb-3">
    						<label for="name">{{translate('Status Arrange')}}</label>
    						<input type="number" min="0"  placeholder="{{translate('Status Arrange')}}" name="arrange" class="form-control" required>
    					</div>



    					<div class="form-group mb-3 text-right">
    						<button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-7">
            <div class="card">
                <form class="" action="{{ route('order.refund_days.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    <div class="card-header">
                        {{translate("order refund days")}}
                    </div>

                    <div class="card-body">

                            <input type="hidden" id="refund_order_id" name="order_id" >
                            <div class="modal-body gry-bg px-3 pt-3">

                                <div class="form-group">
                                    <input type="number" class="form-control" value="{{get_setting("refund_days")}}" name="value" required placeholder="{{ translate('Refun Number Days') }}" />
                                </div>
                            </div>

                    </div>
                    <div class="card-footer">
                                <button type="submit" class="btn btn-primary fw-600">{{ translate('Save')}}</button>

                    </div>
                </form>
        </div>
        </div>

    </div>

@endsection



@section('script')
    <script type="text/javascript">
var edit_order = (status_id)=>{

    $("#order_status_edit").modal();
};

var delete_order = (status_id)=>{
console.log({status_id});

         Swal.fire({
  title: "{{translate("Are you sure want delete order status?")}}",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: "{{translate("Yes")}}",
    cancelButtonText: "{{translate("cancel")}}",

      showLoaderOnConfirm: true,
}).then((result) => {
    if(result.isConfirmed){


        $.get('{{ url("/admin/order/setting/status/destroy/") }}' + "/"+status_id , function(data){

                window.location.reload(true)
            });
    }
})
};

    </script>
@endsection

@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h1 class="h3">{{ translate('Product Setting') }}</h1>
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-md-7">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Product Refurbished') }}</h5>
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
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Logo') }}</th>
                                <th>{{ translate('Descreption') }}</th>

                                <th data-breakpoints="lg" class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($refurbished_degrees as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img src="{{ uploaded_asset($item->logo) }}" alt="{{ $item->name }}"
                                            style="width: 30px;height: 30px" /></td>
                                    <td>{{ $item->desc }}</td>

                                    <td class="text-right">
                                        {{-- <a onclick="edit_order('{{$item->id}}')" class="btn btn-soft-primary btn-icon btn-circle btn-sm"  title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        @section('modal')
                                                <div class="modal fade" id="order_status_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div id="order-details-modal-body">
                                                                	<div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="mb-0 h6">{{ translate('Edit Product Refurbished Degree') }}</h5>
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

                                            @endsection --}}
                                        <a href="#" onclick="delete_refurbished_degree('{{ $item->id }}')"
                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_status"
                                            data-refurbished_degree_id="{{ $item->id }}"
                                            title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>

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
                    <h5 class="mb-0 h6">{{ translate('Add New Product Refurbished Degree') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('refurbished.degree') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Degree Name') }}</label>
                            <input type="text" placeholder="{{ translate('Degree Name') }}" name="name"
                                class="form-control" required>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Degree Logo') }}
                                <small>(300x300)</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-size="90000" data-toggle="aizuploader" data-type="image"
                                    data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="logo" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="desc">{{ translate('Degree Descreption') }}</label>
                            <textarea class="form-control" required name="desc"
                                placeholder="{{ translate('Degree Descreption') }}">

                                                                        </textarea>
                        </div>

                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script type="text/javascript">
        var edit_refurbished_degree = (refurbished_degree_id) => {

            $("#order_status_edit").modal();
        };

        var delete_refurbished_degree = (refurbished_degree_id) => {
            console.log({
                refurbished_degree_id
            });

            Swal.fire({
                title: "{{ translate('Are you sure want delete refurbished product degree?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ translate('Yes') }}",
                cancelButtonText: "{{ translate('cancel') }}",

                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {


                    $.get('{{ url('/admin/delete_degree/') }}' + "/" + refurbished_degree_id, function(
                        data) {

                        window.location.reload(true)
                    });
                }
            })
        };
    </script>
@endsection

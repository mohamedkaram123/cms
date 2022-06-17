@extends('backend.layouts.app')

@section('content')
    <div id="products" data-search={{ request('search') }}>

    </div>

    {{-- <div class="card m-4">
    <form class="" id="sort_products" action="{{route("products.all")}}" method="GET">
        <div class="card-header row gutters-5">

            <div class="col-3 ">
                <div class="form-group">
                    <label>{{translate("product name")}}</label>
                    <input value="{{request()->has("product_name")?request("product_name"):""}}" class="form-control" type="text" name="product_name" />
                </div>
            </div>

                 <div class="col-3 ">
                <div class="form-group">
                    <label>{{translate("product brand")}}</label>
                    <select class="form-control" name="brand_id">
                                            <option value="">{{translate("all")}}</option>

                        @foreach (App\Brand::all() as $brand)
                        <option {{request()->has("brand_id") && request("brand_id") == $brand->id?"selected":""}} value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="col-3 ">
                <div class="form-group">
                    <label>{{translate("product category")}}</label>
                    <select class="form-control" name="category_id">
                                            <option value="">{{translate("all")}}</option>
                        @foreach (App\Category::all() as $cat)
                        <option {{request()->has("category_id") && request("category_id") == $cat->id?"selected":"" }}  value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                   <div class="form-group">
                    <label>{{translate("product price")}}</label>
                    <input value="{{request()->has("product_name")?request("product_price"):""}}" class="form-control" type="text" name="product_price" />
                </div>
            </div>


            <div class="col-2 ">
                   <button type="submit" style="color: #fff" class="btn btn-primary form-control">{{translate("search")}}</button>
            </div>

        </div>
    </form>
        <div class="card-body table-responsive" >
            <table class="table  mb-0">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th style="width: 30%" >{{translate('Name')}}</th>
                        @if ($type == 'Seller' || $type == 'All')
                            <th data-breakpoints="lg">{{translate('Added By')}}</th>
                        @endif
                        <th data-breakpoints="lg">{{translate('Info')}}</th>
                        <th data-breakpoints="lg">{{translate('Total Stock')}}</th>
                        <th data-breakpoints="lg">{{translate('Todays Deal')}}</th>
                        <th data-breakpoints="lg">{{translate('Published')}}</th>
                        <th data-breakpoints="lg">{{translate('Featured')}}</th>
                        <th data-breakpoints="lg" class="text-right">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $key => $item)
                    @php

                        $product = App\Models\Product::find($item->id);


                    @endphp
                    <tr>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                        <td>
                            <div class="row gutters-5">
                                <div class="col-auto">
                                    <img src="{{ uploaded_asset($product->thumbnail_img)}}" alt="Image" class="size-50px img-fit">
                                </div>
                                <div class="col">
                                    <span class="text-muted text-truncate-2">{{ getTranslation($product->id) == null?$product->name:getTranslation($product->id) }}</span>
                                </div>
                            </div>
                        </td>
                        @if ($type == 'Seller' || $type == 'All')
                            <td>{{ $product->user_name }}</td>
                        @endif
                        <td>
                            <strong>Num of Sale:</strong> {{ $product->num_of_sale }} {{translate('times')}} </br>
                            <strong>Base Price:</strong> {{ single_price($product->unit_price) }} </br>
                            <strong>Rating:</strong> {{ $product->rating }} </br>
                        </td>
                        <td>
                            @php
                                $qty = 0;
                                if($product->variant_product) {
                                    foreach ($product->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                        echo $stock->variant.' - '.$stock->qty.'<br>';
                                    }
                                }
                                else {
                                    $qty = $product->current_stock;
                                    echo $qty;
                                }
                            @endphp
                            @if ($qty <= $product->low_stock_quantity)
                                <span class="badge badge-inline badge-danger">Low</span>
                            @endif
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->todays_deal == 1) {
    echo 'checked';
} ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->published == 1) {
    echo 'checked';
} ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->featured == 1) {
    echo 'checked';
} ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-success btn-icon btn-circle btn-sm"  href="{{ route('product', $product->slug) }}" target="_blank" title="{{ translate('View') }}">
                                <i class="las la-eye"></i>
                            </a>
                            @if ($type == 'Seller')
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('products.seller.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            @else
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('products.admin.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            @endif
                            <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{route('products.duplicate', ['id'=>$product->id, 'type'=>$type]  )}}" title="{{ translate('Duplicate') }}">
                                <i class="las la-copy"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('products.destroy', $product->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
</div> --}}
@endsection

{{-- @section('modal')
    @include('modals.delete_modal')
@endsection --}}


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el, product_id) {

            console.log({
                product_id
            });
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {
                _token: '{{ csrf_token() }}',
                id: product_id,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Todays Deal updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }


        function update_published(el, product_id) {

            if (el.target.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: product_id,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_featured(el, product_id) {
            if (el.target.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: product_id,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_exclusiveToWebsite(el, product_id) {
            if (el.target.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.exclusive') }}', {
                _token: '{{ csrf_token() }}',
                id: product_id,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Exclusive products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }


        function update_force_file(el, product_id) {
            if (el.target.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.force_file') }}', {
                _token: '{{ csrf_token() }}',
                id: product_id,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Force File products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function sort_products(el) {
            $('#sort_products').submit();
        }
    </script>
@endsection

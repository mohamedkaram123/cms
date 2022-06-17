
<section class="py-4 gry-bg">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">

            <div class="col-xxl-8 col-xl-10 mx-auto text-left">
                @php
                    $admin_products = array();
                    $seller_products = array();
                    foreach (auth()->user()->carts as $key => $cartItem){
                        if(\App\Product::find($cartItem['product_id'])->added_by == 'admin'){
                            array_push($admin_products, $cartItem['product_id']);
                        }
                        else{
                            $product_ids = array();
                            if(array_key_exists(\App\Product::find($cartItem['product_id'])->user_id, $seller_products)){
                                $product_ids = $seller_products[\App\Product::find($cartItem['product_id'])->user_id];
                            }
                            array_push($product_ids, $cartItem['product_id']);
                            $seller_products[\App\Product::find($cartItem['product_id'])->user_id] = $product_ids;
                        }
                    }
                @endphp

                @if (!empty($admin_products))
                <form class="form-default" action="{{ route('checkout.shipping_info') }}" role="form" method="POST">
                    @csrf
                    <div class="card mb-3 shadow-sm border-0 rounded">
                        <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">{{ get_setting('site_name') }} {{ translate('Products') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($admin_products as $key => $cartItem)
                                @php
                                    $product = \App\Product::find($cartItem);
                                @endphp
                                <li class="list-group-item">
                                            <div class="d-flex flex-row">
                                                <div class="form-check">
                                                    <input data-product_id="{{ $cartItem }}" data-owner_id="{{ 1 }}" class="form-check-input check_product check_product_1" type="checkbox" value="" id="flexCheckChecked">
                                                </div>
                                                <span class="mr-2">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-60px rounded"
                                                        alt="{{  $product->getTranslation('name')  }}"
                                                    >
                                                </span>
                                                <span class="fs-14 opacity-60">{{ $product->getTranslation('name') }}</span>
                                            </div>
                                        </li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="card-footer " style="display: flex;justify-content: end">

                                    <button type="submit" name="products" id="products_btn_1" data-seller_id="1" class="btn fw-600 btn-primary products_btn">{{ translate('Continue to Shipping')}}</a>

                        </div>
                    </div>
                </form>
                @endif
                <form class="form-default" id="form_products"  action="{{ route('checkout.shipping_info') }}" role="form" method="POST">
                    @csrf
                    @if (!empty($seller_products))

                        @foreach ($seller_products as $key => $seller_product)

                            <div class="card mb-3 shadow-sm border-0 rounded">
                                <div class="card-header p-3">
                                    <h5 class="fs-16 fw-600 mb-0">{{ \App\Shop::where('user_id', $key)->first()->name }} {{ translate('Products') }}</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($seller_product as $cartItem)
                                        @php
                                            $product = \App\Product::find($cartItem);
                                        @endphp
                                        <li class="list-group-item">
                                            <div class="d-flex flex-row">
                                                <div class="form-check">
                                                    <input data-product_id="{{ $cartItem }}" data-owner_id="{{ $key }}" class="form-check-input check_product check_product_{{$key}}" type="checkbox" value="" id="flexCheckChecked">
                                                </div>
                                                <span class="mr-2">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-60px rounded"
                                                        alt="{{  $product->getTranslation('name')  }}"
                                                    >
                                                </span>
                                                <span class="fs-14 opacity-60">{{ $product->getTranslation('name') }}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>

                                </div>

                        <div class="card-footer" style="display: flex;justify-content: end">

                            <button type="submit" name="products" id="products_btn_{{$key}}" data-seller_id={{$key}} class="btn fw-600 btn-primary products_btn">{{ translate('Continue to Shipping')}}</a>

                        </div>
                            </div>


                        @endforeach

                    @endif
                </form>

            </div>
        </div>

        <div class="pt-4">
                    <a href="{{ route('home') }}" >
                        <i class="la la-angle-left"></i>
                        {{ translate('Return to shop')}}
                    </a>
                </div>

    </div>
</section>

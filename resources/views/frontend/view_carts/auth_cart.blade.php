<section class="mb-4" id="cart-summary">
    <div class="container">



        @if (auth()->check())

            @if (count(auth()->user()->carts) > 0)

                @include('frontend.view_carts.bar')
                <div class="row cols-xs-space cols-sm-space cols-md-space">

                    <div class="col-xxl-8 col-xl-10 mx-auto text-left">
                        @php
                            $admin_products = [];
                            $seller_products = [];
                            foreach (auth()->user()->carts as $key => $cartItem) {
                                if (\App\Product::find($cartItem['product_id'])->added_by == 'admin') {
                                    array_push($admin_products, $cartItem['product_id']);
                                } else {
                                    $product_ids = [];
                                    if (array_key_exists(\App\Product::find($cartItem['product_id'])->user_id, $seller_products)) {
                                        $product_ids = $seller_products[\App\Product::find($cartItem['product_id'])->user_id];
                                    }
                                    array_push($product_ids, $cartItem['product_id']);
                                    $seller_products[\App\Product::find($cartItem['product_id'])->user_id] = $product_ids;
                                }
                            }
                        @endphp

                        @if (!empty($admin_products))
                            <form class="form-default" action="{{ route('checkout.shipping_info') }}" role="form"
                                method="POST">
                                <div class="card mb-3 shadow-sm border-0 rounded">
                                    <div class="card-header p-3">
                                        <h5 class="fs-16 fw-600 mb-0"> {{ translate('Products') }}
                                            {{ get_setting('site_name') }}</h5>
                                        <button onclick="removeAllCarts()" class="btn btn-icon btn-primary "
                                            data-toggle="tooltip" data-placement="bottom"
                                            title="{{ translate('remove all carts') }}"><i
                                                class="lab la-bitbucket"></i></button>
                                    </div>
                                    @csrf
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <ul class="list-group list-group-flush">
                                                @php
                                                    $total = 0;
                                                @endphp
                                                <input type="hidden" name="products" id="products_btn" />
                                                @foreach (auth()->user()->carts->where('owner_id', 1)
    as $key => $cartItem)
                                                    @php

                                                        $product = \App\Product::find($cartItem['product_id']);

                                                        //  $price = home_discounted_price($cartItem['product_id'])
                                                        $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                                                        $product_name_with_choice = $product->getTranslation('name');
                                                        if ($cartItem['variation'] != null) {
                                                            $product_name_with_choice = $product->getTranslation('name') . ' - ' . $cartItem['variation'];
                                                        }
                                                        $variant = 'variation';
                                                        $check_max = max_cart_product($product, $cartItem, $variant);
                                                    @endphp
                                                    {{-- <input type="hidden" name="product_id" value="{{$cartItem["product_id"]}}"> --}}
                                                    <li class="list-group-item px-0 px-lg-3">
                                                        <div class="row gutters-5">
                                                            <div class="col-lg col-2 order-1 order-lg-0 my-3 my-lg-0">
                                                                <div class="form-check">
                                                                    <input
                                                                        data-product_id="{{ $cartItem['product_id'] }}"
                                                                        data-owner_id="{{ 1 }}"
                                                                        data-digital="{{ $product->digital }}"
                                                                        data-variant="{{ !empty($cartItem['variation']) ? $cartItem['variation'] : 'variant' }}"
                                                                        class="form-check-input check_product"
                                                                        type="checkbox" value=""
                                                                        id="flexCheckChecked" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-10 d-flex">
                                                                <span class="mr-2 ml-0">
                                                                    <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                        class="img-fit size-60px rounded"
                                                                        alt="{{ $product->getTranslation('name') }}">
                                                                </span>
                                                                <span
                                                                    class="fs-14 opacity-60">{{ $product_name_with_choice }}</span>
                                                            </div>

                                                            <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                                                <span
                                                                    class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price') }}</span>
                                                                <span
                                                                    class="fw-600 fs-16">{{ single_price($cartItem['price']) }}</span>
                                                            </div>
                                                            <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0">
                                                                <span
                                                                    class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Tax') }}</span>
                                                                <span
                                                                    class="fw-600 fs-16">{{ single_price($cartItem['tax']) }}</span>
                                                            </div>

                                                            <div class="col-lg col-6 order-4 order-lg-0">
                                                                @if ($cartItem['digital'] != 1)
                                                                    <div
                                                                        class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0">
                                                                        <button
                                                                            {{ $cartItem['quantity'] == 1 ? 'disabled' : '' }}
                                                                            id="{{ "btn_minus_$key" }}"
                                                                            class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                            type="button" data-type="minus"
                                                                            data-field="quantity[{{ $key }}]">
                                                                            <i class="las la-minus"></i>
                                                                        </button>
                                                                        <input type="text"
                                                                            name="quantity[{{ $key }}]"
                                                                            class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                                            placeholder="1"
                                                                            data-cart_id="{{ $cartItem['id'] }}"
                                                                            value="{{ $cartItem['quantity'] }}"
                                                                            min="1" max="10" readonly
                                                                            onchange="updateQuantity({{ $key }}, this)" />
                                                                        <button id="{{ "btn_plus_$key" }}"
                                                                            {{ $check_max == 1 ? 'disabled' : '' }}
                                                                            class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                            type="button" data-type="plus"
                                                                            data-field="quantity[{{ $key }}]">
                                                                            <i class="las la-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                                                <span
                                                                    class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Total') }}</span>
                                                                <span id="{{ "total_price_$key" }}"
                                                                    class="fw-600 fs-16 text-primary">{{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}</span>
                                                            </div>
                                                            <div
                                                                class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                                                <a href="javascript:void(0)"
                                                                    onclick="removeFromCartView(event, {{ $key }}, {{ $cartItem['id'] }})"
                                                                    class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                                    <i class="las la-trash"></i>
                                                                </a>
                                                            </div>
                                                            {{-- <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                                                <button id="add_files" class="btn btn-icon btn-sm btn-soft-success btn-circle">
                                                                    <i class="las la-plus"></i>
                                                                </button>
                                                            </div>

                                                            <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                                                <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $key }})" class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                                    <i class="las la-trash"></i>
                                                                </a>
                                                            </div> --}}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="d-flex flex-row mt-2" style="justify-content: space-between">
                                            <button id="btn_show_file" onclick="addFilesShow()" type="button"
                                                class="btn btn-soft-success  fw-600">
                                                <i class="la la-plus"></i>
                                                {{ translate('Add Files') }}
                                            </button>
                                            <button id="btn_show_note" onclick="addNotes()" type="button"
                                                class="btn btn-soft-info  fw-600">
                                                <i class="las la-sticky-note"></i>
                                                {{ translate('Add Notes') }}
                                            </button>

                                        </div>
                                        <div class="d-flex flex-row mt-2" style="justify-content: space-between">
                                            <div id="choose_file" style="margin-block: 20px" class="form d-none">
                                                <label>{{ translate('add files') }}</label>
                                                <div>
                                                    <div class="input-group" data-toggle="aizuploader"
                                                        data-multiple="true">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
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
                                            <div id="text_notes" class="form-group  d-none">
                                                <label>{{ translate('Add Notes') }}</label>
                                                <div>
                                                    <textarea id="text_note" class="form-control" name="note" style="width: 100%" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between">
                                            <span class="opacity-60 fs-15">{{ translate('Subtotal') }}</span>
                                            <span class="fw-600 fs-17">{{ single_price($total) }}</span>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                                                <a href="{{ route('home') }}" class="btn btn-link">
                                                    <i class="las la-arrow-left"></i>
                                                    {{ translate('Return to shop') }}
                                                </a>
                                            </div>
                                            <div class="col-md-6 text-center text-md-right">
                                                @if (Auth::check())
                                                    <button type="submit"
                                                        class="btn btn-primary fw-600">{{ translate('Continue to Shipping') }}</button>
                                                @else
                                                    <button class="btn btn-primary fw-600"
                                                        onclick="showCheckoutModal()">{{ translate('Continue to Shipping') }}</button>
                                                @endif
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="shadow-sm bg-white p-4 rounded">
                            <div class="text-center p-3">
                                <i class="las la-frown la-3x opacity-60 mb-3"></i>
                                <h3 class="h4 fw-700">{{ translate('Your Cart is empty') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
        @endif

    </div>

</section>

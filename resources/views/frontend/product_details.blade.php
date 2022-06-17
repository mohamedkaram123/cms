@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency"
        content="{{ \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')
    <style>
        @import url("{{ url('/public/') }}/fonts/Tajawal-Bold.ttf");

        .selectize-dropdown,
        .selectize-input {
            padding: 10px;

        }



        .jssocials-share {
            border: 1px solid #eee;
            padding: 50px;
        }

        .jssocials-share:last-child {
            margin-right: 6px;

        }



        .btn-login {
            display: inline-block;
            position: relative;
            background: #fff;
            border: none;
            color: #333;
            font-size: 14px;
            margin-inline-end: 10px;
            /* margin-block-end: 10px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            margin-top: 30px; */
            cursor: pointer;
            padding: 7px 9px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .span-login {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px !important;
            font-weight: 700;
            line-height: 32px;


        }

        .btn-login::before,
        .btn-login::after {
            content: "";
            width: 0;
            height: 2px;
            position: absolute;
            transition: all 0.2s linear;
            background: var(--primary);
        }

        .span-login::before,
        .span-login::after {
            content: "";
            width: 2px;
            height: 0;
            position: absolute;
            transition: all 0.2s linear;
            background: var(--primary);
        }

        .btn-login:hover::before,
        .btn-login:hover::after {
            width: 100%;
        }

        .btn-login:hover .span-login::before,
        .btn-login:hover .span-login::after {
            height: 100%;
        }

        .btn-6::before {
            left: 50%;
            top: 0;
            transition-duration: 0.4s;
        }

        .btn-6::after {
            left: 50%;
            bottom: 0;
            transition-duration: 0.4s;
        }

        .btn-6 .span-login::before {
            left: 0;
            top: 50%;
            transition-duration: 0.4s;
        }

        .btn-6 .span-login::after {
            right: 0;
            top: 50%;
            transition-duration: 0.4s;
        }

        .btn-6:hover::before,
        .btn-6:hover::after {
            left: 0;
        }

        .btn-6:hover .span-login::before,
        .btn-6:hover .span-login::after {
            top: 0;
        }

        .btn-login:hover {
            color: var(--primary);
        }

        .btn-login:focus {
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        @media (max-width: 1200px) {
            .span-login {
                font-size: 14px !important;
                font-weight: bold
            }

            .page__section {
                border: none;
                box-shadow: none !important;
                -webkit-box-shadow: none !important;
            }
        }

        .page__section {
            background-color: #fff;
            padding: 16px;
            -webkit-box-shadow: 0 1px 3px 0 rgb(0 0 0 / 20%), 0 2px 1px -1px rgb(0 0 0 / 12%), 0 1px 1px 0 rgb(0 0 0 / 14%);
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 20%), 0 2px 1px -1px rgb(0 0 0 / 12%), 0 1px 1px 0 rgb(0 0 0 / 14%);
            border-radius: 4px;
        }
    </style>

    @php

    $home_base_price = home_base_price($detailedProduct->id);

    $home_discounted_base_price = home_discounted_base_price($detailedProduct->id);
    $product = $detailedProduct;

    @endphp
    <section class="mb-4 pt-3">
        <div class="container">
            <div class="bg-white shadow-sm rounded p-3">
                <div class="row">
                    <div class="col-md-4 col-12 mb-4">
                        <div class="page__section">
                            <div class="sticky-top z-3 d-flex flex-column gutters-10">
                                @php
                                    $photos = explode(',', $detailedProduct->photos);
                                @endphp
                                <div class="col order-1 ">
                                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb'
                                        data-fade='true' data-auto-height='true'>
                                        @foreach ($detailedProduct->stocks as $key => $stock)
                                            @if ($stock->image != null)
                                                <div class="carousel-box img-zoom rounded">
                                                    <img class="img-fluid lazyload" style="width: 80%;height: 80%;"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($stock->image) }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    >
                                                </div>
                                            @endif
                                        @endforeach
                                        @foreach ($photos as $key => $photo)
                                            <div class="carousel-box img-zoom rounded">
                                                <img class="img-fluid lazyload"
                                                    style="width: 80%;height: 80%;max-height: 700px;"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($photo) }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto order-2  mt-6 mt-md-0">
                                    <div class="aiz-carousel product-gallery-thumb" data-items='5'
                                        data-nav-for='.product-gallery' data-vertical='false' data-vertical-sm='false'
                                        data-focus-select='true' data-arrows='true'>
                                        @foreach ($detailedProduct->stocks as $key => $stock)
                                            @if ($stock->image != null)
                                                <div class="carousel-box  c-pointer border p-1 rounded"
                                                    data-variation="{{ $stock->variant }}">
                                                    <img class="lazyload mw-100 size-50px mx-auto"
                                                        style="width: 80%;height: 50px;"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($stock->image) }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </div>
                                            @endif
                                        @endforeach
                                        @foreach ($photos as $key => $photo)
                                            <div class="carousel-box c-pointer border p-1 rounded">
                                                <img class="lazyload mw-100 size-50px mx-auto"
                                                    style="width: 80%;height: 50px;"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($photo) }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4 col-12">

                        <div class="d-flex flex-row mb-4" style="justify-content: space-between">
                            <div>
                                @if ($detailedProduct->brand != null)
                                    <div class="col-auto">
                                        <a href="{{ route('products.brand', $detailedProduct->brand->slug) }}">
                                            <img src="{{ uploaded_asset($detailedProduct->brand->logo) }}"
                                                alt="{{ $detailedProduct->brand->getTranslation('name') }}" height="50">
                                        </a>
                                    </div>
                                @else
                                    <div class="col-auto">
                                        <span>{{ translate('public') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                @php
                                    $qty = 0;
                                    // dd($detailedProduct->id);
                                    if ($detailedProduct->variant_product) {
                                        foreach ($detailedProduct->stocks as $key => $stock) {
                                            $qty += $stock->qty;
                                        }
                                    } else {
                                        $qty = $detailedProduct->current_stock;
                                    }
                                @endphp
                                @if ($qty > 0)


                                    @if ($detailedProduct->low_stock_quantity >= $qty)
                                        <span style="font-size: 20px;"
                                            class="badge badge-md badge-inline badge-pill badge-danger">{{ translate('Stock is about to run out') }}</span>
                                    @else
                                        <span style="font-size: 16px;padding: 15px"
                                            class="badge badge-md badge-inline badge-pill badge-success">
                                            @if ($detailedProduct->stock_visibility_state != 'text')
                                                (
                                                {{ translate('available') }}
                                                <span id="available-quantity "
                                                    style="margin-inline: 10px;">{{ $qty . ' ' . $detailedProduct->unit }}</span>
                                                )
                                            @elseif ($detailedProduct->stock_visibility_state != 'quantity')
                                                (
                                                <span id="available-quantity "
                                                    style="margin-inline: 10px;">{{ $qty }}</span>
                                                )
                                            @else
                                                <span style="font-size: 20px"
                                                    class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock') }}</span>
                                            @endif
                                        </span>
                                    @endif
                                @else
                                    <span style="font-size: 20px;"
                                        class="badge badge-md badge-inline badge-pill badge-danger">{{ translate('Out of stock') }}</span>
                                @endif

                                @if ($detailedProduct->spcial_product)
                                    @if ($detailedProduct->spcial_product->specialOffers->end_date > now())
                                        <span
                                            class="badge badge-md badge-inline badge-pill badge-primary">{{ translate('Special Offer') }}</span>
                                    @endif
                                @endif
                            </div>


                        </div>
                        {{-- <div class="text-right">

                        </div>
                        <div class="text-right mb-4">
                            @php
                                $qty = 0;
                                // dd($detailedProduct->id);
                                if ($detailedProduct->variant_product) {
                                    foreach ($detailedProduct->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                    }
                                } else {
                                    $qty = $detailedProduct->current_stock;
                                }
                            @endphp
                            @if ($qty > 0)
                                <span style="font-size: 20px"
                                    class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock') }}</span>
                            @else
                                <span style="font-size: 20px;"
                                    class="badge badge-md badge-inline badge-pill badge-danger">{{ translate('Out of stock') }}</span>
                            @endif

                            @if ($detailedProduct->spcial_product)
                                @if ($detailedProduct->spcial_product->specialOffers->end_date > now())
                                    <span
                                        class="badge badge-md badge-inline badge-pill badge-primary">{{ translate('Special Offer') }}</span>
                                @endif
                            @endif

                        </div> --}}
                        <div class="text-left">

                            <h1 class="mb-2 fs-20 fw-600">
                                @if (home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id))
                                    @php
                                        $product_Modal = \App\Product::find($detailedProduct->id);
                                        $product_discount = show_product_discount($product_Modal);
                                    @endphp
                                    <span
                                        style="width: auto;color:var(--danger)">{{ $product_discount['discount_percent'] . '%   ' . translate('Discount') }}</span>
                                @endif
                                {{ $detailedProduct->getTranslation('name') }}
                            </h1>

                            @php
                                $shipping_country = get_shipping_country();
                                $text = '';
                                // return dd($shipping_country["status"]);
                                if ($shipping_country['status'] == 1) {
                                    $data = $shipping_country['data'];
                                    $from = translate('from');
                                    $to = translate('to');
                                    $shipping_cost = translate('Shipping Cost');
                                    $min_cost = $data['min_cost'];
                                    $max_cost = $data['max_cost'];
                                    if ($min_cost == $max_cost) {
                                        $text = "$shipping_cost : $max_cost";
                                    } else {
                                        $text = "$shipping_cost $from : $min_cost - $to : $max_cost";
                                    }
                                } else {
                                    $msg = $shipping_country['msg'];
                                    $text = $msg;
                                }
                            @endphp
                            <div class="col-auto">
                                {{-- <small class="mr-2 opacity-50">{{ translate('Estimate Shipping Time') }}: </small> --}}
                                <small class="text-shipping">{{ $text }}</small>
                            </div>
                        </div>


                        <hr />
                        <div class="p-md-3 p-2 text-left" style="height: 160px">
                            <div class="fs-15 d-flex flex-column">
                                <div>
                                    <span id="chosen_price"
                                        style="font-family: 'Tajawal', sans-serif; font-size:26px;font-weight: 900"
                                        class="fw-bold text-primary">{{ $home_discounted_base_price }}</span>
                                    @if ($home_base_price != $home_discounted_base_price)
                                        @php
                                            $product_discount = show_product_discount($product_Modal);
                                        @endphp
                                        <span class="badge badge-pill badge-primary fw-bold"
                                            style="width: auto;font-size: 22px font-weight: bold !important">{{ $product_discount['discount_percent'] . '%' }}</span>
                                    @endif

                                </div>
                                <div>

                                    <small>{{ translate('Taxes included') }}</small>
                                    @if ($home_base_price != $home_discounted_base_price)
                                        <del class="fw-bold opacity-50 mr-1"
                                            style="{{ get_setting('style_price_del') }} font-size:22px">{{ $home_base_price }}</del>
                                    @endif
                                </div>


                            </div>
                        </div>
                        {{-- @php
                            $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                            $refund_sticker = \App\BusinessSetting::where('type', 'refund_sticker')->first();
                        @endphp
                        @if ($refund_request_addon != null && $refund_request_addon->activated == 1 && $detailedProduct->refundable)
                            <div class="row no-gutters mt-4">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Refund') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <a href="{{ route('returnpolicy') }}" target="_blank">
                                        @if ($refund_sticker != null && $refund_sticker->value != null)
                                            <img src="{{ uploaded_asset($refund_sticker->value) }}" height="36">
                                        @else
                                            <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">
                                        @endif
                                    </a>
                                    <a href="{{ route('returnpolicy') }}" class="ml-2"
                                        target="_blank">{{ translate('View Policy') }}</a>
                                </div>
                            </div>
                        @endif --}}

                    </div>

                    <div class="col-md-4 col-12 ">
                        @if ($home_base_price != $home_discounted_base_price)
                            @php
                                $product_discount = show_product_discount($detailedProduct);
                            @endphp
                            <div class="d-flex mb-2 flex-row tag-price"
                                style="background: #e4faef; border-inline-start: 4px solid var(--success);font-size:20px;font-weight:bold">
                                <i style="margin-inline: 5px" class="las la-tag"></i>
                                <small style="margin-inline-end: 5px;font-weight:bold">{{ translate('put by') }}</small>
                                <small
                                    class="fw-bold">{{ format_price(convert_price($product_discount['discount_amount'])) }}</small>
                            </div>
                        @endif
                        <div class="page__section">
                            <div class="row ">
                                <div class="col-12">
                                    @if ($detailedProduct->num_of_sale > 5)
                                        <span
                                            class="ml-1 opacity-50">{{ translate('Bought') . ' ' . $detailedProduct->num_of_sale }}</span>
                                    @endif
                                    @php
                                        $total = 0;
                                        $total += $detailedProduct->reviews->count();
                                    @endphp
                                    <span class="ml-1 opacity-50">({{ $total }}
                                        {{ translate('reviews') }})</span>
                                    <span class="rating">
                                        {{ renderStarRating($detailedProduct->rating) }}
                                    </span>

                                </div>

                            </div>

                            <hr>
                            {{-- <div class="row">
                                <small class="mr-2 opacity-50">{{ translate('Brand') }}: </small><br>
                                @if ($detailedProduct->brand != null)
                                    <div class="col-auto">
                                        <a href="{{ route('products.brand', $detailedProduct->brand->slug) }}">
                                            <img src="{{ uploaded_asset($detailedProduct->brand->logo) }}"
                                                alt="{{ $detailedProduct->brand->getTranslation('name') }}" height="30">
                                        </a>
                                    </div>
                                @else
                                    <div class="col-auto">
                                        <span>{{ translate('public') }}</span>
                                    </div>
                                @endif
                            </div>
                            <hr> --}}

                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <small class="mr-2 opacity-50">{{ translate('Sold by') }}: </small><br>
                                    @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                                            class="text-reset">{{ $detailedProduct->user->shop->name }}</a>
                                    @else
                                        {{ translate('Inhouse product') }}
                                    @endif
                                </div>
                                @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-soft-primary"
                                            onclick="show_chat_modal()">{{ translate('Message Seller') }}</button>
                                    </div>
                                @endif



                            </div>

                            <hr>


                            {{-- @if (home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id))

                            <div class="row no-gutters mt-3">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Price') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="fs-20 opacity-60">
                                        <del style="{{ get_setting('style_price_del') }}">
                                            {{ home_price($detailedProduct->id) }}
                                            @if ($detailedProduct->unit != null)
                                                <span>/{{ $detailedProduct->getTranslation('unit') }}</span>
                                            @endif
                                        </del>

                                        @php
                                            $product_Modal = \App\Product::find($detailedProduct->id);
                                            $product_discount = show_product_discount($product_Modal);
                                        @endphp
                                        <span class="badge badge-pill badge-primary"
                                            style="width: auto">{{ $product_discount['discount_percent'] . '%' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row no-gutters my-2">
                                <div class="col-sm-2">
                                    <div class="opacity-50">{{ translate('Discount Price') }}:</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="h3">

                                        <strong style="{{ get_setting('style_price') }}" class="h2 fw-600 text-primary">
                                            {{ home_discounted_price($detailedProduct->id) }}
                                        </strong>
                                        @if ($detailedProduct->unit != null)
                                            <span
                                                class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        @else
                            <div class="row no-gutters mt-3">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Price') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="h3">
                                        <strong style="{{ get_setting('style_price') }}" class="h2 fw-600 text-primary">
                                            {{ home_discounted_price($detailedProduct->id) }}
                                        </strong>
                                        @if ($detailedProduct->unit != null)
                                            <span
                                                class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif


                        <hr> --}}

                            <form id="option-choice-form">
                                @csrf
                                <input type="hidden" id="product_id" name="id" value="{{ $detailedProduct->id }}" />

                                @if ($detailedProduct->choice_options != null)
                                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                        <div class="row no-gutters">
                                            <div class="col-sm-2">
                                                <div class="opacity-50 my-2">
                                                    {{ \App\Attribute::find($choice->attribute_id)->getTranslation('name') }}:
                                                </div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="aiz-radio-inline">
                                                    @foreach ($choice->values as $key => $value)
                                                        <label class="aiz-megabox pl-0 mr-2">
                                                            <input type="radio"
                                                                name="attribute_id_{{ $choice->attribute_id }}"
                                                                value="{{ $value }}"
                                                                @if ($key == 0) checked @endif />
                                                            <span
                                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2">
                                                                {{ $value }}
                                                            </span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-sm-2">
                                            <div class="opacity-50 my-2">{{ translate('Color') }}:</div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="aiz-radio-inline">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                    <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                                        data-title="{{ \App\Color::where('code', $color)->first()->name }}">
                                                        <input type="radio" name="color"
                                                            value="{{ \App\Color::where('code', $color)->first()->name }}"
                                                            @if ($key == 0) checked @endif />
                                                        <span
                                                            class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                            <span class="size-30px d-inline-block rounded"
                                                                style="background: {{ $color }};"></span>
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                @endif

                                <!-- Quantity + Add to cart -->
                                <div class="row no-gutters">
                                    <div class="col-3">
                                        <select class="select2  form-control aiz-selectpicker quantity" name="quantity"
                                            data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                            @for ($i = $detailedProduct->min_qty; $i < $qty; $i++)
                                                <option style="color:#333;font-weight: bold" value="{{ $i }}">
                                                    {{ $i }}</option>
                                            @endfor


                                        </select>
                                    </div>
                                    <div class="col-9">
                                        @if ($qty > 0)
                                            <button type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600"
                                                onclick="addToCart()">
                                                <i class="las la-shopping-bag"></i>
                                                <span class="d-none d-md-inline-block">
                                                    {{ translate('Add to cart') }}</span>
                                            </button>
                                            <button type="button" class="btn btn-primary buy-now fw-600" onclick="buyNow()">
                                                <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                                            </button>
                                            {{-- <button id="btn_show_file" onclick="addFilesShow()" type="button"
                                        class="btn btn-soft-success  fw-600">
                                        <i class="la la-plus"></i> {{ translate('Add Files') }}
                                    </button>
                                    <button id="btn_show_note" onclick="addNotes()" type="button"
                                        class="btn btn-soft-info  fw-600">
                                        <i class="las la-sticky-note"></i> {{ translate('Add Notes') }}
                                    </button> --}}
                                        @else
                                            <button type="button" class="btn btn-secondary fw-600" disabled>
                                                <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}
                                            </button>
                                        @endif
                                    </div>

                                    {{-- <div class="col-sm-2">
                                        <div class="opacity-50 my-2">{{ translate('Quantity') }}:</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="row no-gutters align-items-center aiz-plus-minus mr-3"
                                                style="width: 130px;">
                                                <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                    type="button" data-type="minus" data-field="quantity" disabled="">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="text" name="quantity"
                                                    class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                    placeholder="1" value="{{ $detailedProduct->min_qty }}"
                                                    min="{{ $detailedProduct->min_qty }}" max="10" readonly />
                                                <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                    type="button" data-type="plus" data-field="quantity">
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                            <div class="avialable-amount opacity-60">
                                                @if ($detailedProduct->stock_visibility_state != 'hide')
                                                    (<span id="available-quantity">{{ $qty }}</span>
                                                    {{ translate('available') }})
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                @if ($detailedProduct->show_file == 1)
                                    <hr />
                                    <div class="d-flex flex-row mt-2 " style="justify-content: space-between">

                                        <input type="radio" class="radio-input" name="recipe" id="size_1"
                                            value="insurance_recipe" />
                                        <label class="label-radio" for="size_1">
                                            <div class="d-flex flex-column label-data">
                                                <i class="las la-feather"></i>
                                                {{ translate('insurance recipe') }}
                                            </div>
                                        </label>

                                        <input type="radio" class="radio-input" name="recipe" id="size_2"
                                            value="cash_recipe" checked />
                                        <label class="label-radio" for="size_2">
                                            <div class="d-flex flex-column label-data">
                                                <i class="las la-feather"></i>
                                                {{ translate('cash recipe') }}
                                            </div>
                                        </label>

                                    </div>
                                    <hr />
                                    <div class="d-flex flex-column" style="justify-content: space-around">
                                        <div class="d-flex flex-row mt-2" style="justify-content: space-around">
                                            <button id="btn_show_file" style="border:1px solid rgb(211, 210, 210)"
                                                onclick="addFilesShow()" type="button" class="btn  fw-600">
                                                <i class="la la-plus"></i>
                                                {{ translate('Add Files') }}
                                            </button>
                                            <button id="btn_show_note" style="border:1px solid rgb(211, 210, 210)"
                                                onclick="addNotes()" type="button" class="btn   fw-600">
                                                <i class="las la-sticky-note"></i>
                                                {{ translate('Add Notes') }}
                                            </button>

                                        </div>
                                        <div class="d-flex flex-column mt-2" style="justify-content: space-around">
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
                                                        <input type="hidden" name="photos2" class="selected-files">

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
                                    </div>
                                @endif

                                <hr />
                                <div class="row"
                                    style="background: #eee;margin:4px 4px;padding:10px 10px;border-radius: 2px">
                                    <div class="col-6" style="padding: 10px">
                                        <div class="d-flex flex-row" style="align-items: center">
                                            <i class="las la-lock"></i>
                                            <span class="mx-2">{{ translate('secure markting') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6" style="padding: 10px">
                                        <div class="d-flex flex-row" style="align-items: center">
                                            <i class="las la-sync-alt"></i>
                                            <span class="mx-2">{{ translate('easy replacing') }}</span>
                                        </div>

                                    </div>
                                    <div class="col-6" style="padding: 10px">
                                        <div class="d-flex flex-row" style="align-items: center">
                                            <i class="las la-shield-alt"></i>
                                            <span
                                                class="mx-2">{{ translate('original and guaranteed') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding: 10px">
                                        <div class="d-flex flex-row" style="align-items: center">
                                            <i class="las la-truck"></i>
                                            <span
                                                class="mx-2">{{ translate('fast and free shipping') }}</span>
                                        </div>

                                    </div>
                                </div>

                                <hr>
                                {{-- <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Shipping Cost') }}:</div>
                                </div>
                                @php
                                    $shipping_country = get_shipping_country();
                                    $text = '';
                                    // return dd($shipping_country["status"]);
                                    if ($shipping_country['status'] == 1) {
                                        $data = $shipping_country['data'];
                                        $from = translate('from');
                                        $to = translate('to');
                                        $shipping_cost = translate('Shipping Cost');
                                        $min_cost = $data['min_cost'];
                                        $max_cost = $data['max_cost'];
                                        if ($min_cost == $max_cost) {
                                            $text = "$shipping_cost : $max_cost";
                                        } else {
                                            $text = "$from : $min_cost - $to : $max_cost";
                                        }
                                    } else {
                                        $msg = $shipping_country['msg'];
                                        $text = $msg;
                                    }
                                @endphp
                                <div class="col-sm-10">
                                    <div class=" d-flex align-items-center">
                                        <div class="row no-gutters align-items-center aiz-plus-minus mr-3">
                                            <span class="text-shipping">{{ $text }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Total Price') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="product-price">
                                        <strong style="{{ get_setting('style_price') }}" id="chosen_price"
                                            class="h4 fw-600 text-primary">

                                        </strong>
                                    </div>
                                </div>
                            </div> --}}





                                <div class="d-table  mt-3" style="width: 100%">
                                    <div class="d-table-cell">
                                        <div id="choose_file" style="margin-block: 20px" class="row d-none">
                                            <label class="col-md-3 col-form-label">{{ translate('add files') }}</label>
                                            <div class="col-md-8">
                                                <div class="input-group" data-toggle="aizuploader" data-multiple="true">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                            {{ translate('Browse') }}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}
                                                    </div>
                                                    <input type="hidden" name="photos" class="selected-files">

                                                </div>
                                                <div class="file-preview box sm">
                                                </div>

                                            </div>
                                        </div>
                                        <div id="text_notes" class="form-group row d-none">
                                            <label class="col-md-3 col-from-label">{{ translate('Add Notes') }}</label>
                                            <div class="col-md-8">
                                                <textarea id="text_note" name="note" style="width: 100%" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <!-- Add to wishlist button -->


                                        @if (Auth::check() && \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && (\App\AffiliateOption::where('type', 'product_sharing')->first()->status || \App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                                            @php
                                                if (Auth::check()) {
                                                    if (Auth::user()->referral_code == null) {
                                                        Auth::user()->referral_code = substr(Auth::user()->id . Str::random(10), 0, 10);
                                                        Auth::user()->save();
                                                    }
                                                    $referral_code = Auth::user()->referral_code;
                                                    $referral_code_url = URL::to('/product') . '/' . $detailedProduct->slug . "?product_referral_code=$referral_code";
                                                }
                                            @endphp
                                            <div>
                                                <button type=button id="ref-cpurl-btn" class="btn btn-sm btn-secondary"
                                                    data-attrcpy="{{ translate('Copied') }}"
                                                    onclick="CopyToClipboard(this)"
                                                    data-url="{{ $referral_code_url }}">{{ translate('Copy the Promote Link') }}</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </form>

                            <div class="d-flex flex-row" style="justify-content: center">

                                <button tabindex="1" type="button" class="btn-login btn-6" onclick=" show_share_modal()">
                                    <div class="span-login">
                                        <i class="la la-share opacity-80 "></i>
                                        {{ translate('Share') }}

                                    </div>
                                </button>
                                <button tabindex="1" type="button" class="btn-login btn-6"
                                    onclick="addToWishList({{ $detailedProduct->id }})">
                                    <div class="span-login">
                                        <i class="la la-heart-o  opacity-80"></i>

                                        {{ translate('wishlist') }}

                                    </div>

                                </button>
                                <!-- Add to compare button -->
                                <button tabindex="1" type="button" class="btn-login btn-6"
                                    onclick=" addToCompare({{ $detailedProduct->id }})">
                                    <div class="span-login">
                                        <i class="la la-refresh  opacity-80"></i>

                                        {{ translate('compare') }}

                                    </div>
                                </button>


                            </div>

                        </div>
                    </div>

                    @if ($detailedProduct->refurbished == 1 && !empty($detailedProduct->refurbished_product))
                        <div class="col-md-8 offset-md-1 col-12 mt-2 ">
                            <div class="d-flex flex-column">
                                <img class="my-4" style="width: 100px;height: 100px"
                                    src="{{ uploaded_asset($detailedProduct->refurbished_product->degree->logo) }}"
                                    alt="{{ $detailedProduct->refurbished_product->degree->name }}" />

                                <p style="font-size: 20px">{{ $detailedProduct->refurbished_product->degree->desc }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="row ">
                <div class="col-xl-3 order-1 order-xl-0">
                    <div class="bg-white shadow-sm mb-3">
                        <div class="position-relative p-3 text-left">
                            @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1 && $detailedProduct->user->seller->verification_status == 1)
                                <div class="absolute-top-right p-2 bg-white z-1">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve"
                                        viewBox="0 0 287.5 442.2" width="22" height="34">
                                        <polygon style="fill:#F8B517;"
                                            points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 " />
                                        <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8" />
                                        <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6" />
                                        <polygon style="fill:#FCFCFD;"
                                            points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            60,116.6 124.1,116.6 " />
                                    </svg>
                                </div>
                            @endif
                            <div class="opacity-50 fs-12 border-bottom">{{ translate('Sold By') }}</div>
                            @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                                    class="text-reset d-block fw-600">
                                    {{ $detailedProduct->user->shop->name }}
                                    @if ($detailedProduct->user->seller->verification_status == 1)
                                        <span class="ml-2"><i class="fa fa-check-circle"
                                                style="color:green"></i></span>
                                    @else
                                        <span class="ml-2"><i class="fa fa-times-circle"
                                                style="color:red"></i></span>
                                    @endif
                                </a>
                                <div class="location opacity-70">{{ $detailedProduct->user->shop->address }}</div>
                            @else
                                <div class="fw-600">{{ env('APP_NAME') }}</div>
                            @endif

                            <div data-details="{{ $detailedProduct }}" id="rating_shop">

                            </div>

                        </div>
                        @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                            <div class="row no-gutters align-items-center border-top">
                                <div class="col">
                                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                                        class="d-block btn btn-soft-primary rounded-0">{{ translate('Visit Store') }}</a>
                                </div>
                                <div class="col">
                                    <ul class="social list-inline mb-0">
                                        <li class="list-inline-item mr-0">
                                            <a href="{{ $detailedProduct->user->shop->facebook }}"
                                                class="facebook" target="_blank">
                                                <i class="lab la-facebook-f opacity-60"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item mr-0">
                                            <a href="{{ $detailedProduct->user->shop->google }}" class="google"
                                                target="_blank">
                                                <i class="lab la-google opacity-60"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item mr-0">
                                            <a href="{{ $detailedProduct->user->shop->twitter }}"
                                                class="twitter" target="_blank">
                                                <i class="lab la-twitter opacity-60"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ $detailedProduct->user->shop->youtube }}"
                                                class="youtube" target="_blank">
                                                <i class="lab la-youtube opacity-60"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div data-details="{{ $detailedProduct }}" id="top_selling_product">

                    </div>

                </div>
                <div class="col-xl-9 order-0 order-xl-1">
                    <div class="bg-white mb-3 shadow-sm rounded">
                        <div class="nav border-bottom aiz-nav-tabs">
                            <a href="#tab_default_1" data-toggle="tab"
                                class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description') }}</a>
                            @if ($detailedProduct->video_link != null)
                                <a href="#tab_default_2" data-toggle="tab"
                                    class="p-3 fs-16 fw-600 text-reset">{{ translate('Video') }}</a>
                            @endif
                            @if ($detailedProduct->pdf != null)
                                <a href="#tab_default_3" data-toggle="tab"
                                    class="p-3 fs-16 fw-600 text-reset">{{ translate('Downloads') }}</a>
                            @endif
                            <a href="#tab_default_4" data-toggle="tab"
                                class="p-3 fs-16 fw-600 text-reset">{{ translate('Reviews') }}</a>
                        </div>

                        <div class="tab-content pt-0">
                            <div class="tab-pane fade active show" id="tab_default_1">
                                <div class="p-4">
                                    <div class="mw-100 overflow-hidden text-left">
                                        @if ($detailedProduct->getTranslation('description') != '')
                                            <?php echo $detailedProduct->getTranslation('description'); ?>
                                        @else
                                            {{ translate('Not Found Description') }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab_default_2">
                                <div class="p-4">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item"
                                                src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item"
                                                src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                            <iframe
                                                src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}"
                                                width="500" height="281" frameborder="0" webkitallowfullscreen
                                                mozallowfullscreen allowfullscreen></iframe>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_default_3">
                                <div class="p-4 text-center ">
                                    <a href="{{ uploaded_asset($detailedProduct->pdf) }}"
                                        class="btn btn-primary">{{ translate('Download') }}</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_default_4">
                                <div class="p-4">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($detailedProduct->reviews as $key => $review)
                                            @if ($review->user != null)
                                                <li class="media list-group-item d-flex">
                                                    <span class="avatar avatar-md mr-3">
                                                        <img class="lazyload"
                                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            @if ($review->user->avatar_original != null) data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                        @else
                                                            data-src="{{ static_asset('assets/img/placeholder.jpg') }}" @endif>
                                                    </span>
                                                    <div class="media-body text-left">
                                                        <div class="d-flex justify-content-between">
                                                            <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}
                                                            </h3>
                                                            <span class="rating rating-sm">
                                                                @for ($i = 0; $i < $review->rating; $i++)
                                                                    <i class="las la-star active"></i>
                                                                @endfor
                                                                @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                                    <i class="las la-star"></i>
                                                                @endfor
                                                            </span>
                                                        </div>
                                                        <div class="opacity-60 mb-2">
                                                            {{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                                        <p class="comment-text">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    @if (count($detailedProduct->reviews) <= 0)
                                        <div class="text-center fs-18 opacity-70">
                                            {{ translate('There have been no reviews for this product yet.') }}
                                        </div>
                                    @endif

                                    @if (Auth::check())
                                        @php
                                            $commentable = false;
                                            $orderd_user = DB::table('orders')
                                                ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                                                ->where('order_details.product_id', $detailedProduct->id)
                                                ->where('orders.delivery_status', 'delivered')
                                                ->where('orders.user_id', auth()->user()->id)
                                                ->count();

                                            $orderd = DB::table('orders')
                                                ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                                                ->where('order_details.product_id', $detailedProduct->id)
                                                ->where('orders.delivery_status', 'delivered')
                                                ->count();
                                            $viewd = App\Review::where('user_id', Auth::user()->id)
                                                ->where('product_id', $detailedProduct->id)
                                                ->count();
                                            if (get_setting('rate_before_dlivered_order') == 1) {
                                                if ($orderd > 0 && $viewd == 0) {
                                                    $commentable = true;
                                                }
                                            } else {
                                                if ($orderd_user > 0 && $viewd == 0) {
                                                    $commentable = true;
                                                }
                                            }

                                        @endphp

                                        @if ($commentable)
                                            <div class="pt-4">
                                                <div class="border-bottom mb-4">
                                                    <h3 class="fs-17 fw-600">
                                                        {{ translate('Write a review') }}
                                                    </h3>
                                                </div>
                                                <form class="form-default" role="form"
                                                    action="{{ route('reviews.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $detailedProduct->id }}" />
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="text-uppercase c-gray-light">{{ translate('Your name') }}</label>
                                                                <input type="text" name="name"
                                                                    value="{{ Auth::user()->name }}"
                                                                    class="form-control" disabled required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="text-uppercase c-gray-light">{{ translate('Email') }}</label>
                                                                <input type="text" name="email"
                                                                    value="{{ Auth::user()->email }}"
                                                                    class="form-control" required disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="opacity-60">{{ translate('Rating') }}</label>
                                                        <div class="rating rating-input">
                                                            <label>
                                                                <input type="radio" name="rating" value="1" />
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="2" />
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="3" />
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="4" />
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="5" />
                                                                <i class="las la-star"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label
                                                            class="opacity-60">{{ translate('Comment') }}</label>
                                                        <textarea class="form-control" rows="4" name="comment" placeholder="{{ translate('Your review') }}" required></textarea>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary mt-3">
                                                            {{ translate('Submit review') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="related_product" id="related_product">

                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}" />
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input disabled type="text" class="form-control mb-3" name="title"
                                value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}"
                                required />
                        </div>
                        <div id="choose_file" style="margin-block: 20px" class="row ">
                            <label class="col-md-2 col-form-label">{{ translate('add files') }}</label>
                            <div class="col-md-10">
                                <div class="input-group" data-toggle="aizuploader" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="photos" class="selected-files" />

                                </div>
                                <div class="file-preview box sm">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {


            getVariantPrice();
        });
        $.post('{{ route('section.related_product') }}', {
            _token: '{{ csrf_token() }}',
            id: "{{ $detailedProduct->id }}",
            category_id: "{{ $detailedProduct->category_id }}"
        }, function(data) {
            $('.related_product').html(data.data);
            AIZ.plugins.slickCarousel();

        });

        function show_share_modal() {
            $('#ModalShare').modal('show');

        }

        $('.countries').selectize({
            searchField: 'search-text',
            render: {
                option: function(data, escape) {
                    return '<div class="form-control">' +
                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                        '<span class="title">' + escape(data.text) + '</span>' +
                        '<span class="code">' + escape(data.code) + '</span>' +
                        '</div>';
                },
                item: function(data, escape) {
                    return '<div>' +
                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                        escape(data.text) +
                        escape(data.code) +
                        '</div>';
                }
            }
        });




        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input />");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }

        function show_chat_modal() {
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                location.href = "{{ url('/users/login') }}"
            @endif
        }

        // function addPhotosAndNotes(){
        //    var data = {
        //   "_token": '{{ csrf_token() }}',
        //   "photos":$(".selected-files").val(),
        //   "photos":$("#text_note").val(),

        //     }
        //      $.ajax({
        //             type: "post",
        //             url: "{{ route('addNotesPhotos') }}",
        //             data: data,
        //             success: function(res) {
        //                 console.log({res});
        //             }
        //         });
        // }


        function addPhotosAndNotes() {
            var datas = {
                "_token": '{{ csrf_token() }}',
                "photos": $(".selected-files").val(),
                "note": $("#text_note").val(),

            }

            $.ajax({
                type: "post",
                url: "{{ route('addNotesPhotos') }}",
                data: datas,
                success: function(res) {

                }
            });
        }

        function addFilesShow() {
            @if (!Auth::check())
                console.log("dss");
                location.href = route("register")
            @else
                if ($("#choose_file").hasClass("d-none")) {
                    $("#btn_show_file").html("<i class='la la-minus' ></i> {{ translate('Add Files') }}");
                    $("#choose_file").removeClass("d-none");
                } else {
                    $("#btn_show_file").html("<i class='la la-plus' ></i> {{ translate('Add Files') }}");
                    $("#choose_file").addClass("d-none");
                }
            @endif

        }


        $("#btn_phone").click(function(e) {
            e.preventDefault();

            $("#choose_methd").addClass("d-none")

            $("#phone").removeClass("d-none")
            $("#btn_submit").removeClass("d-none")

        });

        $("#btn_email").click(function(e) {
            e.preventDefault();

            $("#choose_methd").addClass("d-none")


            $("#email").removeClass("d-none")
            $("#btn_submit").removeClass("d-none")

        });

        var count = 30;
        var counter;


        function handleLoginPhone() {
            $("#require_phone").text("")
            $("#require_email").text("")
            $("#require_code").text("")
            $("#choose_methd").removeClass("d-none")
            $("#email").addClass("d-none")
            $("#phone").addClass("d-none")
            $("#btn_submit").addClass("d-none")
            $("#code").addClass("d-none")
            $("#btn_code").addClass("d-none")
            $("#btn_counter").addClass("d-none")

            $("#country_tel").removeAttr("disabled")
            $("#email_input").removeAttr("disabled")
            $("#phone_input").removeAttr("disabled")

            $("#btn_counter_data").attr("disabled", "disabled");

            clearInterval(counter);
            count = 30;
            handleBtn($("#btn_submit_data"), "{{ translate('Login') }}")

        }


        function handleBtnLoad(btn, text) {
            btn.html(text +
                "<img src='{{ url('/public/assets/img/loading.gif') }}' style='height:20px;margin-inline:20px'    /> "
            )
            btn.attr("disabled", "disabled")

        }


        function handleBtn(btn, text) {
            btn.html(text)
            btn.removeAttr("disabled")

        }


        function timer() {
            count = count - 1;
            if (count <= 0) {
                clearInterval(counter);
                $("#btn_counter_data").removeAttr("disabled");
                $("#btn_counter_data").text("{{ translate('Re-transmitter') }}")
                //counter ended, do something here
                return;
            }
            $("#btn_counter_data").text("{{ translate('Re-transmitter') }}" + " " + count)

            //Do code for showing the number of seconds here
        }

        function orderTypePharmacy(val) {
            @if (!Auth::check())
                console.log("dss");
                location.href = "{{ route('user.login') }}"
            @else
                data = {
                    "_token": '{{ csrf_token() }}',
                    "oreder_type_pharmacy": val,

                }

                $.ajax({
                    type: "post",
                    url: "{{ route('addOrderTypePharmacy') }}",
                    data: data,
                    success: function(res) {
                        AIZ.plugins.notify('success',
                            "{{ translate('the order type Pharmacy is saved') }}");

                    }
                });
            @endif
        }

        function addVerficationCode() {
            $("#btn_submit").addClass("d-none");
            $("#code").removeClass("d-none")
            $("#btn_code").removeClass("d-none")
            $("#btn_counter").removeClass("d-none")
            counter = setInterval(timer, 1000); //1000 will  run it every 1 second

            timer()


        }

        $("#btn_submit_data").click(function(e) {
            e.preventDefault();

            var btn = $(this);
            handleBtnLoad($(this), "{{ translate('Login') }}")


            var check_require = true
            if ($("#email").hasClass("d-none")) {
                if ($("#phone_input").val() == "") {
                    check_require = false
                    $("#require_phone").text("{{ translate('please enter your phone') }}")
                    handleBtn($(this), "{{ translate('Login') }}")

                }
            } else {
                if ($("#email_input").val() == "") {
                    check_require = false

                    $("#require_email").text("{{ translate('please enter your email') }}")
                    handleBtn($(this), "{{ translate('Login') }}")

                }
            }

            if (check_require) {
                data = {
                    "_token": '{{ csrf_token() }}',
                    "email": $("#email_input").val(),
                    "phone": $("#phone_input").val(),
                    "country_tel": $("#country_tel").val()
                }

                $.ajax({
                    type: "post",
                    url: "{{ route('cart.login.submition') }}",
                    data: data,
                    success: function(res) {
                        if (res.status == 0) {
                            if ($("#email").hasClass("d-none")) {
                                $("#require_phone").text(res.msg)
                            } else {
                                $("#require_email").text(res.msg)
                            }
                            handleBtn(btn, "{{ translate('Login') }}")

                        } else if (res.status == 1) {
                            if ($("#email").hasClass("d-none")) {
                                $("#phone_input").attr("disabled", "disabled")
                                $("#country_tel").attr("disabled", "disabled")
                                $("#require_phone").text("")
                            } else {
                                $("#email_input").attr("disabled", "disabled")
                                $("#require_email").text("")

                            }
                            addVerficationCode()


                        }
                    }
                });
            }


        });


        $("#btn_code_data").click(function(e) {
            e.preventDefault();

            var btn = $(this);
            handleBtnLoad(btn, "{{ translate('Verification') }}")

            var check_require = true
            if ($("#code_input").val() == "") {
                check_require = false
                $("#require_code").text("{{ translate('please enter verfication code') }}")
                handleBtn($(this), "{{ translate('Verification') }}")

            }



            if (check_require) {

            }
            data = {
                "_token": '{{ csrf_token() }}',
                "email": $("#email_input").val(),
                "phone": $("#phone_input").val(),
                "code": $("#code_input").val(),
                "country_tel": $("#country_tel").val()

            }

            $.ajax({
                type: "post",
                url: "{{ route('cart.login.submit.code') }}",
                data: data,
                success: function(res) {
                    if (res.status == 0) {

                        $("#require_code").text(res.msg)

                        handleBtn(btn, "{{ translate('Verification') }}")

                    } else if (res.status == 1) {
                        window.location.reload();
                    }
                }
            });

        });

        $("#btn_counter_data").click(function(e) {
            e.preventDefault();

            $("#btn_counter_data").attr("disabled", "disabled");

            clearInterval(counter);
            count = 30;



            data = {
                "_token": '{{ csrf_token() }}',
                "email": $("#email_input").val(),
                "phone": $("#phone_input").val(),
                "country_tel": $("#country_tel").val()

            }

            $.ajax({
                type: "post",
                url: "{{ route('cart.login.submition') }}",
                data: data,
                success: function(res) {
                    counter = setInterval(timer, 1000); //1000 will  run it every 1 second
                    timer()

                }
            });

        });

        function addFilesShow() {
            @if (!Auth::check())
                console.log("dss");
                location.href = "{{ route('user.login') }}"
            @else
                if ($("#choose_file").hasClass("d-none")) {
                    $("#btn_show_file").html("<i class='la la-minus' ></i> {{ translate('Add Files') }}");
                    $("#choose_file").removeClass("d-none");
                } else {
                    $("#btn_show_file").html("<i class='la la-plus' ></i> {{ translate('Add Files') }}");
                    $("#choose_file").addClass("d-none");
                }
            @endif
        }

        function addNotes() {
            @if (!Auth::check())
                console.log("dss");
                location.href = "{{ route('user.login') }}"
            @else
                if ($("#text_notes").hasClass("d-none")) {
                    $("#text_notes").removeClass("d-none");
                } else {
                    $("#text_notes").addClass("d-none");
                }
            @endif
        }
        // $("#text_note").keyup(function (e) {
        //    $("#note").val(e.target.value);
        // });
    </script>
@endsection

@extends('frontend.layouts.app')

@section('content')
                {{-- @php
                    //    $rand = substr(md5(microtime()), rand(0, 26), 5);
                    return dd(strtotime(now()));
            @endphp --}}


                {{-- Categories , Sliders . Today's deal --}}


    <div class="home-banner-area pt-3">

        <div class="container">
            <div class="row gutters-10 position-relative">
                @if (get_setting('theme_cat') == 0)
                    <div class="col-lg-2 position-static d-none d-lg-block">
                        @include('frontend.partials.category_menu')
                    </div>
                @endif
                @php

                    // $tempDiscount = new TempDiscount();

                    // $temp_discount = $tempDiscount->temp_discount_check();

                    // return dd($temp_discount);

                    //$num_todays_deal = count(filter_products(\App\Product::where('published', 1)->where('todays_deal', 1 ))->get());
                    // $num_todays_deal = 0;
                    $featured_categories = \App\Category::where('featured', 1)->get();
                    header('Access-Control-Allow-Origin: *');

                @endphp

                {{-- {{dd(json_decode(get_setting('home_slider_images'), true))}} --}}
                <div class="col-lg-{{ get_setting('theme_cat') == 0 ? '10' : '12' }} ">
                    @if (get_setting('home_slider_images') != null)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner mb-md-4 mb-2">
                                @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp


                                <div class="aiz-carousel mx-3 dots-inside-bottom mobile-img-auto-height"
                                    id="slide_bar_carousel" data-arrows="true" data-dots="true" data-mob_arrows="false"
                                    data-mob="active" data-mob_dots="false" data-autoplay="true" data-infinite="true">
                                    @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                                    @foreach ($slider_images as $key => $value)
                                        <div class="carousel-box">
                                            <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                                <img class="d-block mw-100 img-fit rounded shadow-sm"
                                                    src="{{ uploaded_asset($slider_images[$key]) }}"
                                                    alt="{{ env('APP_NAME') }} promo"
                                                    @if (count($featured_categories) == 0 && get_setting('theme_cat') == 0) height="457"
                                            @else
                                            height="340" @endif
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                    @endif
                    @if (count($featured_categories) > 0)
                        @include('frontend.partials.featured_categories')
                    @endif
                </div>

                {{-- @if ($num_todays_deal > 0)
                <div class="col-lg-2 order-3 mt-3 mt-lg-0">
                    <div class="bg-white rounded shadow-sm">
                        <div class="bg-soft-primary rounded-top p-3 d-flex align-items-center justify-content-center">
                            <span class="fw-600 fs-16 mr-2 text-truncate">
                                {{ translate('Todays Deal') }}
                            </span>
                            <span class="badge badge-primary badge-inline">{{ translate('Hot') }}</span>
                        </div>
                        <div class="c-scrollbar-light overflow-auto h-lg-400px p-2 bg-primary rounded-bottom">
                            <div class="gutters-5 lg-no-gutters row row-cols-2 row-cols-lg-1">
                            @foreach (filter_products(\App\Product::where('published', 1)->where('todays_deal', '1'))->get() as $key => $product)
                                @if ($product != null)
                                <div class="col mb-2">
                                    <a href="{{ route('product', $product->slug) }}" class="d-block p-2 text-reset bg-white h-100 rounded">
                                        <div class="row gutters-5 align-items-center">
                                            <div class="col-lg">
                                                <div class="img">
                                                    <img
                                                        class="lazyload img-fit h-140px h-lg-80px"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="{{ $product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="fs-16">
                                                    <span class="d-block text-primary fw-600">{{ home_discounted_base_price($product->id) }}</span>
                                                    @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="d-block opacity-70">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif --}}

            </div>
        </div>
    </div>

    {{-- Banner section 1 --}}
    @if (count(json_decode(get_setting('home_banner1_images'))) == count(json_decode(get_setting('home_banner1_links'))))
        @if (get_setting('home_banner1_images') != null)
            <div class="mb-2 mb-md-4">
                <div class="container">
                    <div class="row gutters-10">
                        @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                        @foreach ($banner_1_imags as $key => $value)
                            <div class="col-xl col-md-6">
                                <div class="mb-md-3 mb-2 mb-lg-0">
                                    <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}"
                                        class="d-block text-reset">
                                        <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                            data-src="{{ uploaded_asset($banner_1_imags[$key]) }}"
                                            alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif

    {{-- Flash Deal --}}
    @php
    $flash_deal = \App\FlashDeal::where('status', 1)
        ->where('featured', 1)
        ->first();
    @endphp
    @if ($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
        <section class="mb-md-4 mb-2">
            <div class="container">
                <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                    <div class="d-flex flex-wrap mb-3 justify-content-sm-center align-items-baseline border-bottom">
                        <div class=" mb-2 d-flex flex-row "
                            style="justify-content: center;font-size: 14px;font-weight: 600">
                            <span
                                class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') . ': ' . $flash_deal->title }}</span>
                            <span
                                class="border-bottom border-primary border-width-2 pb-3 d-inline-block ml-4">{{ translate('Offer valid until') . ' ' . date('Y-m-d', $flash_deal->end_date) }}</span>

                        </div>
                        <div class="aiz-count-down mb-2 ml-auto ml-lg-3 align-items-center"
                            data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                        <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                            class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
                    </div>

                    <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5"
                        data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'
                        data-infinite='true'>
                        @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                            @php
                                $product = \App\Product::find($flash_deal_product->product_id);
                            @endphp
                            @if ($product != null && $product->published != 0)
                                @include('frontend.product_view')

                                {{-- <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                        <div class="position-relative">
                                            <a href="{{ route('product', $product->slug) }}" class="d-block">
                                                <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                    alt="{{ $product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </a>
                                            <div class="absolute-top-right aiz-p-hov-icon">
                                                <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"
                                                    data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}"
                                                    data-placement="left">
                                                    <i class="la la-heart-o"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})"
                                                    data-toggle="tooltip" data-title="{{ translate('Add to compare') }}"
                                                    data-placement="left">
                                                    <i class="las la-sync"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="showAddToCartModal({{ $product->id }})"
                                                    data-toggle="tooltip" data-title="{{ translate('Add to cart') }}"
                                                    data-placement="left">
                                                    <i class="las la-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del
                                                        class="fw-600 opacity-50 mr-1">{{ home_base_price($product->id) }}</del>
                                                @endif
                                                <span
                                                    class="fw-700 text-primary">{{ home_discounted_base_price($product->id) }}</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                {{ renderStarRating($product->rating) }}
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                <a href="{{ route('product', $product->slug) }}"
                                                    class="d-block text-reset">{{ $product->getTranslation('name') }}</a>
                                            </h3>
                                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                                    {{ translate('Club Point') }}:
                                                    <span class="fw-700 float-right">{{ $product->earn_point }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif




    @php
    $spcial_offers = (new SpcialOffer())->show_special_offer_products_data();

    @endphp

    @if (count($spcial_offers) != 0)
        <section class="mb-md-4 mb-2">
            <div class="container">
                <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                    <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                        <h3 class="h5 fw-700 mb-0">
                            <span
                                class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Special Offer Products') }}</span>
                        </h3>
                        <div class="aiz-count-down ml-auto ml-lg-3 align-items-center"
                            data-date="{{ $spcial_offers['end_date'] }}"></div>
                    </div>

                    <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5"
                        data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'
                        data-infinite='true'>
                        @foreach ($spcial_offers['products'] as $key => $product)
                            @if ($product != null && $product->published != 0)
                                @include('frontend.product_view')

                                {{-- <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                        <div class="position-relative">
                                            <a href="{{ route('product', $product->slug) }}" class="d-block">
                                                <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                    alt="{{ getTranslation($product->id) }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </a>
                                            <div class="absolute-top-right aiz-p-hov-icon">
                                                <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"
                                                    data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}"
                                                    data-placement="left">
                                                    <i class="la la-heart-o"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})"
                                                    data-toggle="tooltip" data-title="{{ translate('Add to compare') }}"
                                                    data-placement="left">
                                                    <i class="las la-sync"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="showAddToCartModal({{ $product->id }})"
                                                    data-toggle="tooltip" data-title="{{ translate('Add to cart') }}"
                                                    data-placement="left">
                                                    <i class="las la-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del
                                                        class="fw-600 opacity-50 mr-1">{{ home_base_price($product->id) }}</del>
                                                @endif
                                                <span
                                                    class="fw-700 text-primary">{{ home_discounted_base_price($product->id) }}</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                {{ renderStarRating($product->rating) }}
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                <a href="{{ route('product', $product->slug) }}"
                                                    class="d-block text-reset">{{ getTranslation($product->id) }}</a>
                                            </h3>
                                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                                    {{ translate('Club Point') }}:
                                                    <span class="fw-700 float-right">{{ $product->earn_point }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    {{-- Featured Section --}}
    <div class="text-center" id="section_featured">
        <img style="width: 100px;height:100px;" src="{{ url('/public/assets/img/loader.gif') }}" />
    </div>

    {{-- Best spcial Offes --}}
    {{-- <div id="section_specialoffers">

    </div> --}}
    {{-- Best Selling --}}
    <div id="section_best_selling">

    </div>


    {{-- Banner Section 2 --}}
    @if (count(json_decode(get_setting('home_banner2_images'))) == count(json_decode(get_setting('home_banner2_links'))))
        @if (get_setting('home_banner2_images') != null)
            <div class="mb-md-4 mb-2">
                <div class="container">
                    <div class="row gutters-10">
                        @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                        @foreach ($banner_2_imags as $key => $value)
                            <div class="col-xl col-md-6">
                                <div class="mb-mb-3 mb-2 mb-lg-0">
                                    <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}"
                                        class="d-block text-reset">
                                        <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                            data-src="{{ uploaded_asset($banner_2_imags[$key]) }}"
                                            alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif

    <div id="section_last_products">

    </div>

    {{-- Category wise Products --}}
    <div id="section_home_categories">

    </div>

    {{-- Classified Product --}}
    @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
        @php
            $classified_products = \App\CustomerProduct::where('status', '1')
                ->where('published', '1')
                ->take(10)
                ->get();
        @endphp
        @if (count($classified_products) > 0)
            <section class="mb-md-4 mb-2">
                <div class="container">
                    <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span
                                    class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Classified Ads') }}</span>
                            </h3>
                            <a href="{{ route('customer.products') }}"
                                class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                        </div>
                        <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5"
                            data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'
                            data-infinite='true'>
                            @foreach ($classified_products as $key => $classified_product)
                                @include('frontend.product_view')

                                {{-- <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                        <div class="position-relative">
                                            <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                class="d-block">
                                                <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($classified_product->thumbnail_img) }}"
                                                    alt="{{ $classified_product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </a>
                                            <div class="absolute-top-left pt-2 pl-2">
                                                @if ($classified_product->conditon == 'new')
                                                    <span
                                                        class="badge badge-inline badge-success">{{ translate('new') }}</span>
                                                @elseif($classified_product->conditon == 'used')
                                                    <span
                                                        class="badge badge-inline badge-danger">{{ translate('Used') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15 mb-1">
                                                <span
                                                    class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                    class="d-block text-reset">{{ $classified_product->getTranslation('name') }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    {{-- Banner Section 2 --}}
    @if (count(json_decode(get_setting('home_banner3_images'))) == count(json_decode(get_setting('home_banner3_links'))))

        @if (get_setting('home_banner3_images') != null)
            <div class="mb-4">
                <div class="container">
                    <div class="row gutters-10">
                        @php $banner_3_imags = json_decode(get_setting('home_banner3_images')); @endphp
                        @foreach ($banner_3_imags as $key => $value)
                            <div class="col-xl col-md-6 col-sm-12">
                                <div class="mb-3 mb-lg-0">
                                    <div class="card">
                                        <div class="card-header">
                                            @php
                                                $home_banner3_header_imgs_trans = get_general_trans('business_settings_home_banner3', $key, 'home_banner3_header_imgs');
                                                $home_banner3_links_trans = get_general_trans('business_settings_home_banner3', $key, 'home_banner3_txt_link');
                                                // return dd($home_banner3_links_trans);
                                            @endphp
                                            <h4>{{ !empty($home_banner3_header_imgs_trans)? $home_banner3_header_imgs_trans: json_decode(get_setting('home_banner3_header_imgs'), true)[$key] }}
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}"
                                                class="d-block text-reset">
                                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                                    data-src="{{ uploaded_asset($banner_3_imags[$key]) }}"
                                                    alt="{{ env('APP_NAME') }} promo" style="width:100%"
                                                    class="img-fluid lazyload">
                                            </a>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}">
                                                <h5>{{ !empty($home_banner3_links_trans)? $home_banner3_links_trans: json_decode(get_setting('home_banner3_txt_link'), true)[$key] }}
                                                </h5>
                                            </a>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif

    {{-- Best Seller --}}
    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
        <div id="section_best_sellers">

        </div>
    @endif
    <div id="section_categories_offer">

    </div>
    {{-- Top 10 categories and Brands --}}
    <section class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @if (get_setting('top10_categories') != null && count(json_decode(get_setting('top10_categories'))) != 0)
                    <div class="col-lg-6">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span
                                    class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Categories') }}</span>
                            </h3>
                            <a href="{{ route('categories.all') }}"
                                class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Categories') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp
                            @foreach ($top10_categories as $key => $value)
                                @php $category = \App\Category::find($value); @endphp
                                @if ($category != null)
                                    <div class="col-sm-6">
                                        <a href="{{ route('products.category', $category->slug) }}"
                                            class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-3 text-center">
                                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($category->icon) }}"
                                                        alt="{{ $category->getTranslation('name') }}"
                                                        class="img-fluid img lazyload h-60px "
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                                </div>
                                                <div class="col-7">
                                                    <div class="text-truncat-2 pl-3 fs-14 fw-600 text-left">
                                                        {{ $category->getTranslation('name') }}</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <i class="la la-angle-right text-primary"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (get_setting('top10_brands') != null && count(json_decode(get_setting('top10_brands'))) != 0)
                    <div class="col-lg-6">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span
                                    class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Brands') }}</span>
                            </h3>
                            <a href="{{ route('brands.all') }}"
                                class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Brands') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                            @foreach ($top10_brands as $key => $value)
                                @php $brand = \App\Brand::find($value); @endphp
                                @if ($brand != null)
                                    <div class="col-sm-6">
                                        <a href="{{ route('products.brand', $brand->slug) }}"
                                            class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-4 text-center">
                                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($brand->logo) }}"
                                                        alt="{{ $brand->getTranslation('name') }}"
                                                        class="img-fluid img lazyload h-60px"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-truncate-2 pl-3 fs-14 fw-600 text-left">
                                                        {{ $brand->getTranslation('name') }}</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <i class="la la-angle-right text-primary"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class=" scroll_btn_up d-none">
            <button id="scroll_up" class="slick-arrow btn btn-sm-circle"><i class="las la-angle-up"></i></button>
        </div>

        <!-- FawryPay Checkout Button -->


    </section>

@endsection

@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Import FawryPay Staging JavaScript Library-->
<script type="text/javascript" src="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script> --}}

    <script>
        $(document).ready(function() {




            $("#scroll_up").click(function(e) {
                e.preventDefault();
                window.scroll({
                    top: 0,
                    behavior: "smooth"
                })


            });
            if ($(window).scrollTop() < 500) {

            } else {

                $(".scroll_btn_up").removeClass("d-none")
                $("#scroll_up").addClass("shadow-lg");



            }

            $(window).scroll(function(e) {
                if ($(window).scrollTop() < 500) {
                    console.log("up");
                    $("#scroll_up").fadeOut(200)

                    $("#scroll_up").removeClass("shadow-lg");
                } else {
                    console.log("down");

                    $(".scroll_btn_up").removeClass("d-none")
                    $("#scroll_up").addClass("shadow-lg");
                    $("#scroll_up").fadeIn(200)


                }
            });

            $.post('{{ route('home.section.featured') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });

            //   $.post('{{ route('home.section.specialoffers') }}', {_token:'{{ csrf_token() }}'}, function(data){
            //     $('#section_specialoffers').html(data);
            //     AIZ.plugins.slickCarousel();
            // });
            $.post('{{ route('home.section.best_selling') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.last_products') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#section_last_products').html(data);
                AIZ.plugins.slickCarousel();
            });

            $.post('{{ route('home.section.home_categories') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
                });
            @endif
        });
    </script>
@endsection

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

                {{-- {{dd(json_decode(get_setting('back_to_school_slider_images'), true))}} --}}
                <div class="col-lg-{{ get_setting('theme_cat') == 0 ? '10' : '12' }} ">
                    @if (get_setting('back_to_school_slider_images') != null)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner mb-4">
                                @php $slider_images = json_decode(get_setting('back_to_school_slider_images'), true);  @endphp


                                <div class="aiz-carousel mx-3 dots-inside-bottom mobile-img-auto-height" data-arrows="true"
                                    data-dots="true" data-autoplay="true" data-infinite="true">
                                    @php $slider_images = json_decode(get_setting('back_to_school_slider_images'), true);  @endphp
                                    @foreach ($slider_images as $key => $value)
                                        <div class="carousel-box">
                                            <a
                                                href="{{ json_decode(get_setting('back_to_school_slider_links'), true)[$key] }}">
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
    @if (get_setting('back_to_school_banner1_images') != null)
        <div class="mb-4">
            <div class="container">
                <div class="row gutters-10">
                    @php $banner_1_imags = json_decode(get_setting('back_to_school_banner1_images')); @endphp
                    @foreach ($banner_1_imags as $key => $value)
                        <div class="col-xl col-md-6">
                            <div class="mb-3 mb-lg-0">
                                <a href="{{ json_decode(get_setting('back_to_school_banner1_links'), true)[$key] }}"
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









    {{-- Banner Section 2 --}}
    @if (get_setting('back_to_school_banner2_images') != null)
        <div class="mb-4">
            <div class="container">
                <div class="row gutters-10">
                    @php $banner_2_imags = json_decode(get_setting('back_to_school_banner2_images')); @endphp
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="col-xl col-md-6">
                            <div class="mb-3 mb-lg-0">
                                <a href="{{ json_decode(get_setting('back_to_school_banner2_links'), true)[$key] }}"
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

    {{-- Category wise Products --}}
    <div id="section_home_categories">

    </div>

    {{-- Banner Section 2 --}}
    @if (get_setting('back_to_school_banner3_images') != null)
        <div class="mb-4">
            <div class="container">
                <div class="row gutters-10">
                    @php $banner_3_imags = json_decode(get_setting('back_to_school_banner3_images')); @endphp
                    @foreach ($banner_3_imags as $key => $value)
                        <div class="col-xl col-md-6 col-sm-12">
                            <div class="mb-3 mb-lg-0">
                                <div class="card">
                                    <div class="card-header">

                                        <h4>{{ json_decode(get_setting('back_to_school_banner3_header_imgs'), true)[$key] }}
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
                                            <h5>{{ json_decode(get_setting('back_to_school_banner3_txt_link'), true)[$key] }}
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

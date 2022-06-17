<!DOCTYPE html>
@if (\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>

    @php
        $version = env('Version');
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <meta name="no-referrer" content="origin">


    <title>@yield('meta_title', get_setting('website_name') . ' | ' . get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description'))" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords'))">

    @yield('meta')

    @if (!isset($detailedProduct) && !isset($customer_product) && !isset($shop) && !isset($page) && !isset($blog))
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ get_setting('meta_title') }}">
        <meta itemprop="description" content="{{ get_setting('meta_description') }}">
        <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="{{ get_setting('meta_title') }}">
        <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
        <meta name="twitter:creator" content="@author_handle">
        <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

        <!-- Open Graph data -->
        <meta property="og:title" content="{{ get_setting('meta_title') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
        <meta property="og:description" content="{{ get_setting('meta_description') }}" />
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
        <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
        rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if (\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
        <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css?version=' . $version) }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css?version=' . $version) }}">

    <link rel="stylesheet" href="{{ static_asset('assets/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/selectize.bootstrap4.css') }}">

    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_found: '{{ translate('Nothing found') }}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
    </script>

    <style>
        @import url("{{ url('/public/') }}/fonts/Tajawal-Bold.ttf");

        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
        }

        :root {
            --primary: {{ get_setting('base_color', '#e62d04') }};
            --hov-primary: {{ get_setting('base_hov_color', '#c52907') }};
            --soft-primary: {{ hex2rgba(get_setting('base_color', '#e62d04'), 0.15) }};
        }

        .row {
            margin: auto
        }

        .top-modalSearch {
            margin-top: 150px
        }

        .modal-backdrop {
            z-index: 1200;
        }

        .z-search_modal {
            z-index: 1250;
        }

        .search_overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            z-index: 1200;
            width: 100%;
            background: #33333363;
        }

        .body-fixed {
            overflow: hidden
        }

        .modal-search {
            position: absolute;
            top: 100%;
            bottom: 0;
            /* justify-content: center; */
            /* left: 0; */
            /* right: 0; */
            justify-content: center;
            align-items: center;
            z-index: 1250;
        }

    </style>



    @if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ env('TRACKING_ID') }}');
        </script>
    @endif

    @if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
        <!-- Facebook Pixel Code -->
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ env('FACEBOOK_PIXEL_ID') }}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}&ev=PageView&noscript=1" />
        </noscript>
        <!-- End Facebook Pixel Code -->
    @endif

    @php
        echo get_setting('header_script');

        // $product = App\Models\Product::findOrFail(194948);

        //     return dd($product->taxe->tax_type);

    @endphp

</head>

<body>



    @if (auth()->check())
        <div id="notify_special_offers">

        </div>
    @endif

    @php

        // foreach ($sellers as $item) {
        //     $sellers []=$item->id;
        //     $array[$item->id] = $item->num_of_sale;
        // }
        //                     $array =

        //       return dd($sellers);
    @endphp
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column">

        <!-- Header -->
        @include('frontend.inc.nav')

        @yield('content')


    </div>
    @include('frontend.inc.footer')

    @if (get_setting('show_cookies_agreement') == 'on')
        <div class="aiz-cookie-alert shadow-xl">
            <div class="p-3 bg-dark rounded">
                <div class="text-white mb-3">
                    @php
                        echo get_setting('cookies_agreement_text');
                    @endphp
                </div>
                <button class="btn btn-primary aiz-cookie-accepet">
                    {{ translate('Ok. I Understood') }}
                </button>
            </div>
        </div>
    @endif

    @include('frontend.partials.modal')





    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size"
            role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" id="dismiss_modal" class="close absolute-top-right btn-icon close z-1"
                    data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalShare">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Share') }}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="aiz-share">

                    </div>

                </div>
            </div>

        </div>
    </div>



    @yield('modal')
    <script type="text/javascript">
        let general_path = "{{ env('APP_URL') }}";
    </script>
    <!-- SCRIPTS -->
    <script src="{{ static_asset('js/frontend.js?version=' . $version) }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}

    <script src="{{ static_asset('assets/js/jquery-3.6.0.slim.min.js') }}"></script>
    <script src="{{ static_asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ static_asset('assets/js/vendors.js') }}"></script>
    <script src="{{ static_asset('assets/js/aiz-core.js?version=' . $version) }}"></script>
    <script src="{{ static_asset('assets/js/sweetalert2.all.js') }}"></script>

    <script src="{{ static_asset('assets/js/sifter.min.js') }}"></script>
    <script src="{{ static_asset('assets/js/microplugin.min.js') }}"></script>
    <script src="{{ static_asset('assets/js/selectize.min.js') }}"></script>


    @if (get_setting('facebook_chat') == 1)
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v3.3'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat" attribution=setup_tool page_id="{{ env('FACEBOOK_PAGE_ID') }}">
        </div>
    @endif

    <script>
        @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
    </script>

    <script>
        $(document).ready(function() {



            // $("input").not("#search").focus(function(e) {
            //     e.preventDefault();
            //     if ($(document).width() < 500) {
            //         $(".sticky-top").addClass("d-none")
            //         $("#bottom_bar").addClass("d-none")
            //     }
            // });

            // $("input").not("#search").blur(function(e) {
            //     e.preventDefault();
            //     if ($(document).width() < 500) {
            //         $(".sticky-top").removeClass("d-none")
            //         $("#bottom_bar").removeClass("d-none")

            //     }
            // });

            var width = $(window).width() < 600;
            console.log({
                width
            });
            @if (get_setting('theme_cat') == 1)
                $(".category-menu-icon").on(!width ? "mouseover" : "click", function() {
                    $(".cat-width").get(0).style.setProperty("--width-sub-cat", "250px");

                    $(".nav_overlay").addClass("z-3")

                    $("#bottom_bar").removeClass("fixed-bottom")
                    $("#cat_angle_down").removeClass("las la-angle-down");
                    $("#cat_angle_down").addClass("las la-angle-up");
                    $("body").addClass("overflow-hidden ");

                    $("#category-menu-icon").addClass("menu_hover");
                    $("#main_cat").addClass("text-white");
                    $("#cat_drop_down").removeClass("d-none");
                    $("#overlay_cat").removeClass("d-none");
                });

                $(".category-menu-icon").on(!width ? "mouseleave" : "blur", function() {
                    $(".cat-width").get(0).style.setProperty("--width-sub-cat", "150px");

                    $(".nav_overlay").removeClass("z-3")

                    $("#bottom_bar").addClass("fixed-bottom")
                    $("body").removeClass("overflow-hidden ");

                    $("#category-menu-icon").removeClass("menu_hover");
                    $("#cat_drop_down").addClass("d-none");
                    $("#cat_angle_down").removeClass("las la-angle-up");
                    $("#cat_angle_down").addClass("las la-angle-down");

                    $("#main_cat").removeClass("text-white");

                    $("#overlay_cat").addClass("d-none");
                });






                $(".brand-menu-icon").on(!width ? "mouseover" : "click", function() {
                    $(".brand-width").get(0).style.setProperty("--width-sub-brand", "250px");


                    $(".nav_overlay").addClass("z-3")

                    $("#bottom_bar").removeClass("fixed-bottom")
                    $("body").addClass("overflow-hidden ");

                    $("#brand_angle_down").removeClass("las la-angle-down");
                    $("#brand_angle_down").addClass("las la-angle-up");

                    $("#brand-menu-icon").addClass("menu_hover");
                    $("#main_brand").addClass("text-white");
                    $("#brand_drop_down").removeClass("d-none");
                    $("#overlay_cat").removeClass("d-none");
                });

                $(".brand-menu-icon").on(!width ? "mouseleave" : "blur", function() {
                    $(".brand-width").get(0).style.setProperty("--width-sub-brand", "170px");

                    $(".nav_overlay").removeClass("z-3")

                    $("#bottom_bar").addClass("fixed-bottom")
                    $("body").removeClass("overflow-hidden ");

                    $("#brand-menu-icon").removeClass("menu_hover");
                    $("#brand_drop_down").addClass("d-none");

                    $("#brand_angle_down").removeClass("las la-angle-up");
                    $("#brand_angle_down").addClass("las la-angle-down");

                    $("#main_brand").removeClass("text-white");

                    $("#overlay_cat").addClass("d-none");
                });
            @endif


            $("#call_company").click(function() {
                window.open('tel:' + "{{ get_setting('contact_phone') }}");

            })
            $(".dropdownMenuHelp").mouseover(function() {

                $("#drop_down_help").addClass("show");
            })

            $(".dropdownMenuHelp").mouseleave(function() {

                $("#drop_down_help").removeClass("show");
            })

            $(".sub_cat_nav").click(function() {

                $(".aiz-mobile-side-nav-cat").removeClass("active");
                $(".aiz-mobile-side-nav-sub-cat").addClass("active");
                var id = $(this).data("cat_id");
                $.ajax({
                    type: "get",
                    url: "{{ url('/subCat') }}" + '/' + id,
                    success: function(res) {
                        console.log({
                            res
                        });
                        $("#sub_cat").html(res);
                    }
                });

            })
            $("#sub_cat").on("click", "#back_sub", function() {

                $(".aiz-mobile-side-nav-sub-cat").removeClass("active");
                $(".aiz-mobile-side-nav-cat").addClass("active");

            })

            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function() {
                    // if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    //     $.post('{{ route('category.elements') }}', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                    //         $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    //     });
                    // }

                    // if(!$(el).find('.sub-cat-menu2').hasClass('loaded')){
                    //     $.post('{{ route('category.elements') }}', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                    //         $(el).find('.sub-cat-menu2').addClass('loaded').html(data);
                    //     });
                    // }

                    if (!$(el).find('.sub-cat-menu3').hasClass('loaded')) {
                        $.post('{{ route('category.elements') }}', {
                            _token: AIZ.data.csrf,
                            id: $(el).data('id')
                        }, function(data) {
                            $(el).find('.sub-cat-menu3').addClass('loaded').html(data);
                        });
                    }
                });
            });
            // if ($('#lang-change').length > 0) {
            //     $('#lang-change .dropdown-menu a').each(function() {
            //         $(this).on('click', function(e){
            //             e.preventDefault();
            //             var $this = $(this);
            //             var locale = $this.data('flag');
            //             $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
            //                 location.reload();
            //             });

            //         });
            //     });
            // }

            $(".bottom-overmouse").mouseover(function() {
                $(this).css("border-width", "5px");
            })
            $(".bottom-overmouse").mouseleave(function() {
                $(this).css("border-width", "3px");
            })

            $("#lang-change").on('click', function(e) {
                console.log($(this));
                e.preventDefault();
                var $this = $(this).children("#lang_code");
                var locale = $this.data('flag');
                console.log({
                    locale
                });
                $.post('{{ route('language.change') }}', {
                    _token: AIZ.data.csrf,
                    locale: locale
                }, function(data) {
                    location.reload();
                });

            });

            if ($('#currency-change').length > 0) {
                $('#currency-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        var currency_code = $this.data('currency');
                        $.post('{{ route('currency.change') }}', {
                            _token: AIZ.data.csrf,
                            currency_code: currency_code
                        }, function(data) {
                            location.reload();
                        });

                    });
                });
            }
        });

        // $('#search').on('keyup', function() {
        //     search();
        // });




        // $('#search').on('blur', function() {
        //     $('.typed-search-box').addClass('d-none');
        //     $('body').removeClass("typed-search-box-shown");
        //     $("#app_nav_list").removeClass("d-none");
        // });

        // function search() {
        //     var searchKey = $('#search').val();
        //     if (searchKey.length > 0) {
        //         $('body').addClass("typed-search-box-shown");

        //         $('.typed-search-box').removeClass('d-none');
        //         $('.search-preloader').removeClass('d-none');
        //         $("#app_nav_list").addClass("d-none");
        //         $.post('{{ route('search.ajax') }}', {
        //             _token: AIZ.data.csrf,
        //             search: searchKey
        //         }, function(data) {
        //             if (data == '0') {
        //                 // $('.typed-search-box').addClass('d-none');
        //                 $('#search-content').html(null);
        //                 $('.typed-search-box .search-nothing').removeClass('d-none').html(
        //                     'Sorry, nothing found for <strong>"' + searchKey + '"</strong>');
        //                 $('.search-preloader').addClass('d-none');
        //                 $("#app_nav_list").addClass("d-none");


        //             } else {
        //                 $('.typed-search-box .search-nothing').addClass('d-none').html(null);
        //                 $('#search-content').html(data);
        //                 $('.search-preloader').addClass('d-none');
        //                 $("#app_nav_list").addClass("d-none");

        //             }
        //         });
        //     } else {
        //         $('.typed-search-box').addClass('d-none');
        //         $('body').removeClass("typed-search-box-shown");
        //         $("#app_nav_list").removeClass("d-none");

        //     }
        // }

        function updateNavCart() {
            $.post('{{ route('cart.nav_cart') }}', {
                _token: AIZ.data.csrf
            }, function(data) {
                $('#cart_items').html(data);
            });
        }

        function removeFromCart(key, cart_id) {

            $.post('{{ route('cart.removeFromCart') }}', {
                _token: AIZ.data.csrf,
                key: key,
                id: cart_id
            }, function(data) {

                updateNavCart();
                $('#cart-summary').html(data);
                AIZ.plugins.notify('success', 'Item has been removed from cart');
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) - 1);
            });
        }

        function removeFromWichList(id) {

            $.post('{{ route('wishlists.remove') }}', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {

                updateNavCart();
                $('#wishlist').html(data);
                AIZ.plugins.notify('success', 'Item has been removed from wichlist');
                // $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            });
        }

        function removeAllCarts() {

            $.post('{{ route('cart.removeAllCarts') }}', {
                _token: AIZ.data.csrf
            }, function(data) {

                updateNavCart();
                $('#cart-summary').html(data);
                AIZ.plugins.notify('success', "{{ translate('all Items has been removed from cart') }}");
                $('#cart_items_sidenav').html(0);
            });
        }

        function removeAllWichlist() {

            $.post('{{ route('wishlist.removeAllWichlist') }}', {
                _token: AIZ.data.csrf
            }, function(data) {

                updateNavCart();
                $('#wishlist').html(data);
                AIZ.plugins.notify('success', "{{ translate('all Items has been removed from wichlist') }}");
                $('#wishlist_items_sidenav').html(0);
            });
        }

        function addToCompare(id) {
            $.post('{{ route('compare.addToCompare') }}', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {

                if (data.compare_check == 0) {
                    AIZ.plugins.notify('warning', "{{ translate('Item has Not from same Categorey') }}");

                } else {
                    $('#compare').html(data.view);
                    AIZ.plugins.notify('success', "{{ translate('Item has been added to compare list') }}");
                    $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html()) + 1);
                }

            });
        }

        function addToWishList(id) {
            @if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller'))
                $.post('{{ route('wishlists.store') }}', {
                    _token: AIZ.data.csrf,
                    id: id
                }, function(data) {
                    if (data != 0) {
                        $('#wishlist').html(data);
                        AIZ.plugins.notify('success', "{{ translate('Item has been added to wishlist') }}");
                    } else {
                        AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
                    }
                });
            @else
                AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
            @endif
        }

        function showAddToCartModal(id) {
            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('{{ route('cart.showCartModal') }}', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                AIZ.plugins.slickCarousel();
                AIZ.plugins.zoom();
                AIZ.extra.plusMinus();
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function() {
            getVariantPrice();
        });

        function getVariantPrice() {

            if ($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('products.variant_price') }}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        console.log({
                            data
                        });

                        $('.product-gallery-thumb .carousel-box').each(function(i) {
                            if ($(this).data('variation') && data.variation == $(this).data(
                                    'variation')) {
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })

                        $('#option-choice-form #chosen_price_div').removeClass('d-none');
                        $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                        $('#available-quantity').html(data.quantity);
                        //    $('.input-number').prop('max', data.quantity);
                        if (parseInt(data.quantity) < 1 && data.digital == 0) {
                            $('.buy-now').hide();
                            $('.add-to-cart').hide();
                        } else {
                            $('.buy-now').show();
                            $('.add-to-cart').show();
                        }
                    }
                });
            }
        }

        function checkAddToCartValidity() {

            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });

            if ($('#option-choice-form input:radio:checked').length == count) {
                return true;
            }

            return false;
        }

        function addToCart() {
            // addPhotosAndNotes()


            if (checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        console.log({
                            data
                        });

                        if (data.status == 3) {
                            $('#addToCart').hide();
                            $("#dismiss_modal").trigger("click");
                            AIZ.plugins.notify('warning', data.msg);

                        } else {
                            @if (auth()->check())
                                @if (auth()->user()->show_msg_add_cart == 1)
                                    $('#addToCart-modal-body').html(null);
                                    $('.c-preloader').hide();
                                    $('#modal-size').removeClass('modal-lg');
                                    $('#addToCart-modal-body').html(data.view);
                                @else
                                    $("#dismiss_modal").trigger("click");
                                @endif
                            @else
                                $('#addToCart-modal-body').html(null);
                                $('.c-preloader').hide();
                                $('#modal-size').removeClass('modal-lg');
                                $('#addToCart-modal-body').html(data.view);
                            @endif


                            updateNavCart();
                            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) + 1);
                        }

                    }
                });
            } else {
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }

        }



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


        function buyNow() {

            if (checkAddToCartValidity()) {
                $('#addToCart-modal-body').html(null);
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        if (data.status == 1) {
                            updateNavCart();
                            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) + 1);
                            window.location.replace("{{ route('cart') }}");
                        } else if (data.status == 3) {
                            $("#dismiss_modal").trigger("click");
                            AIZ.plugins.notify('warning', data.msg);

                        } else {
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.view);
                        }
                    }
                });
            } else {
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }




        }

        function show_purchase_history_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('purchase_history.details') }}', {
                _token: AIZ.data.csrf,
                order_id: order_id
            }, function(data) {
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function show_order_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('orders.details') }}', {
                _token: AIZ.data.csrf,
                order_id: order_id
            }, function(data) {
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function cartQuantityInitialize() {
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

        function imageInputInitialize() {
            $('.custom-input-file').each(function() {
                var $input = $(this),
                    $label = $input.next('label'),
                    labelVal = $label.html();

                $input.on('change', function(e) {
                    var fileName = '';

                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}',
                            this.files.length);
                    else if (e.target.value)
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        $label.find('span').html(fileName);
                    else
                        $label.html(labelVal);
                });

                // Firefox bug fix
                $input
                    .on('focus', function() {
                        $input.addClass('has-focus');
                    })
                    .on('blur', function() {
                        $input.removeClass('has-focus');
                    });
            });
        }

        //          $.ajax({
        //     url: "{{ route('dashboard.category_menu') }}",
        //     type: 'GET',
        //     success: function(res) {

        //         $("#category_menu").html(res.category_menu)
        //         console.log(res);
        //         // alert(res);
        //     }
        // });
    </script>

    @yield('script')

    @php
        echo get_setting('footer_script');
    @endphp



</body>

</html>

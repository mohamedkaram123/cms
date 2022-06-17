<!-- Top Bar -->

<div class="top-navbar bg-white border-bottom border-soft-secondary z-1035">
    <div class="row">

        <div class="col-4  text-right d-none d-lg-block " style="padding: 0">
            <ul class="list-inline mb-0 " style="background-color: #f9fafc;">
                @auth
                    @if (isAdmin())
                        <li class="list-inline-item mr-3">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-reset text-nav-header py-2 d-inline-block opacity-60 hover_list_li">{{ translate('My Panel') }}</a>
                        </li>
                    @else
                        <li class="list-inline-item mr-3 ">
                            <a href="{{ route('dashboard') }}"
                                class="text-reset text-nav-header py-2 d-inline-block opacity-60 hover_list_li">{{ translate('My Panel') }}</a>
                        </li>
                    @endif
                    <li class="list-inline-item mid-40">
                        <a href="{{ route('logout') }}"
                            class="text-reset text-nav-header py-2 d-inline-block opacity-60 hover_list_li">{{ translate('Logout') }}</a>
                    </li>
                @else
                    <li class="list-inline-item mr-3 mid-35">
                        <a href="{{ route('user.login') }}"
                            class="text-reset text-nav-header py-2 d-inline-block opacity-60 hover_list_li">
                            <i class="las la-user"></i>
                            {{ translate('Login Or Register Now') }}</a>
                    </li>
                    {{-- <li class="list-inline-item">
                        <a href="{{ route('user.registration') }}"
                            class="text-reset text-nav-header py-2 d-inline-block opacity-60">{{ translate('Registration') }}</a>
                    </li> --}}
                @endauth
            </ul>
        </div>

        <div class="col-lg-4 d-md-flex flex-row d-none" style="padding: 0">
            <ul class="list-inline mb-0 borders_nav list_hotenzal w-100 br-l">
                <li class=" list_li ">

                    <a href="{{ route('wishlists.index') }}"
                        class="text-reset text-nav-header py-2 hover_list_li d-inline-block opacity-60">
                        <i class="las la-heart "></i>
                        {{ translate('My wishlists') }}</a>
                </li>
                <li class="  list_li ">
                    <a href="{{ route('purchase_history.index') }}"
                        class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60">
                        <i class="las la-tractor"></i>
                        {{ translate('Track the shipment') }}</a>
                </li>
                <li class="  list_li ">
                    <a href="{{ route('cart') }}"
                        class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60">
                        <i class="las la-shopping-cart"></i>
                        {{ translate('Cart') }}</a>
                </li>

                <li class="  list_li ">
                    <div class="dropdown">
                        <a href="{{ route('cart') }}"
                            class="dropdown-toggle dropdownMenuHelp  drop_down_help text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ translate('Help') }}</a>
                        <div class="dropdown-menu drop_helps dropdownMenuHelp " id="drop_down_help"
                            aria-labelledby="dropdownMenuHelp" style="max-width: fit-content">
                            <a class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item "
                                id="call_company" href="javascript:void(0)">
                                <i class="las la-phone-volume"></i>
                                {{ translate('Call Company') }}
                                - {{ get_setting('contact_phone') }}

                            </a>
                            <a class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item "
                                href="javascript:void(0)">
                                <i class="las la-at"></i>
                                {{ translate('send on') }}
                                - {{ get_setting('contact_email') }}

                            </a>
                            <a href="{{ route('terms') }}"
                                class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item ">
                                <i class="la la-file-text "></i>
                                {{ translate('Terms & conditions') }}

                            </a>
                            <a href="{{ route('returnpolicy') }}"
                                class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item ">
                                <i class="la la-mail-reply "></i>
                                {{ translate('Return Policy') }}
                            </a>

                            <a href="{{ route('supportpolicy') }}"
                                class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item ">
                                <i class="la la-support"></i>
                                {{ translate('Support Policy') }}
                            </a>
                            <a href="{{ route('privacypolicy') }}"
                                class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item ">
                                <i class="la la-exclamation-circle"></i>
                                {{ translate('Privacy Policy') }}
                            </a>
                        </div>
                    </div>
                </li>

                <li class="  list_li ">
                    <a href="{{ route('ourbranches') }}"
                        class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60">
                        <i class="las la-map-marker-alt"></i>
                        {{ translate('our branches') }}</a>
                </li>

        </div>
        <div class="col-lg-4 d-none d-lg-block  col" style="padding: 0">
            <ul class="list-inline d-flex justify-content-lg-start d-lg-block d-md-none justify-content-around  mb-0"
                style="background-color: #f9fafc;">
                @if (get_setting('show_currency_switcher') == 'on')
                    <li class="list-inline-item dropdown list_li_currency" id="currency-change">
                        @php
                            if (Session::has('currency_code')) {
                                $currency_code = Session::get('currency_code');
                            } else {
                                $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                            }
                        @endphp
                        <a href="javascript:void(0)"
                            class="dropdown-toggle text-nav-header hover_list_li text-reset py-2 opacity-60"
                            data-toggle="dropdown" data-display="static">
                            @if ($currency_code == 'SAR')
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/flags/sa.png') }}" class="mr-1 lazyload"
                                    alt="sa" height="11">
                            @endif
                            {{ translate(\App\Currency::where('code', $currency_code)->first()->name) }}
                            {{ \App\Currency::where('code', $currency_code)->first()->symbol }}


                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                            @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                <li>
                                    <a class="dropdown-item text-nav-header hover_list_li @if ($currency_code == $currency->code) active @endif"
                                        href="javascript:void(0)" data-currency="{{ $currency->code }}">
                                        {{ $currency->name }}
                                        ({{ $currency->symbol }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if (get_setting('show_language_switcher') == 'on')
                    <li class="list-inline-item dropdown mr-3 mis-30" id="lang-change">
                        @php
                            if (Session::has('locale')) {
                                $locale = Session::get('locale', Config::get('app.locale'));
                            } else {
                                $locale = 'en';
                            }

                            $reverse_lang = $locale == 'en' ? 'sa' : 'en';
                        @endphp
                        <a href="javascript:void(0)" id="lang_code" data-flag="{{ $reverse_lang }}"
                            class=" hover_list_li text-nav-header text-reset py-2">
                            <i class="las la-language"></i>
                            <span
                                class="opacity-60">{{ \App\Language::where('code', $reverse_lang)->first()->name == 'English' ? 'English' : 'عربي' }}</span>
                        </a>
                        {{-- <a href="javascript:void(0)"
                            class="dropdown-toggle hover_list_li text-nav-header text-reset py-2" data-toggle="dropdown"
                            data-display="static">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ static_asset('assets/img/flags/' . $locale . '.png') }}"
                                class="mr-2 lazyload"
                                alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                            <span
                                class="opacity-60">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            @foreach (\App\Language::all() as $key => $language)
                                <li>
                                    <a href="javascript:void(0)" data-flag="{{ $language->code }}"
                                        class="dropdown-item text-nav-header hover_list_li @if ($locale == $language) active @endif">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                            class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                        <span class=" language">{{ $language->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul> --}}
                    </li>
                @endif


            </ul>
        </div>
    </div>
</div>
<!-- END Top Bar -->
<header id="header_sticky"
    class="@if (get_setting('header_stikcy') == 'on') sticky-top @endif  bg-white border-bottom shadow-sm">
    <div class="position-relative logo-bar-area ">


        @php
            $rtl = \App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl;

        @endphp
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="d-lg-none ">
                    <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle"
                        data-target=".aiz-mobile-side-nav-cat">
                        @if ($rtl == 1)
                            <i style="font-size: 32px" class="las la-indent"></i>
                        @else
                            <i style="font-size: 32px" class="las la-outdent"></i>
                        @endif

                    </a>
                </div>
                <div class="col-auto col-xl-3 pl-0 pr-3 d-flex align-items-center logo-front">
                    <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if ($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                                class="mw-100 h-30px h-md-40px" height="40">
                        @else
                            <img src="{{ static_asset('assets/img/logos.png') }}" alt="{{ env('APP_NAME') }}"
                                class="mw-100 h-30px h-md-40px" height="40">
                        @endif
                    </a>


                    @if (Route::currentRouteName() != 'home' && get_setting('theme_cat') == 0)
                        <div class="d-none d-xl-block align-self-stretch category-menu-icon-box ml-auto mr-0">
                            <div class="h-100 d-flex align-items-center" id="category-menu-icon">
                                <div
                                    class="dropdown-toggle navbar-light bg-light h-40px w-50px pl-2 rounded border c-pointer">
                                    <span class="navbar-toggler-icon">
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="d-lg-none ml-auto mr-0">
                    <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle"
                        data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>

                </div>


                <div id="search_group" class="flex-grow-1 front-header-search d-flex align-items-center bg-white">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation" tabindex="-1">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle"
                                    data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i
                                            class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="border-0 border-lg form-control" id="search" name="q"
                                        placeholder="{{ translate('I am shopping for...') }}" autocomplete="off" />
                                    <div class="input-group-append d-none d-lg-block">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                            style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="text-left">

                            </div>
                        </div>
                    </div>

                </div>
                <div id="modal_search" class="modal-search w-md-75 w-100 h-md-auto h-100 d-none"></div>

                <div class="d-none d-lg-none ml-3 mr-0">
                    <div class="nav-search-box">
                        <a href="#" class="nav-box-link">
                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                        </a>
                    </div>
                </div>

                <div class="d-none d-lg-block ml-3 mr-0">
                    <div class="" id="compare">
                        @include('frontend.partials.compare')
                    </div>
                </div>

                <div class="d-none d-lg-block ml-3 mr-0">
                    <div class="" id="wishlist">
                        @include('frontend.partials.wishlist')
                    </div>
                </div>

                <div class="d-none d-lg-block  align-self-stretch ml-3 mr-0" data-hover="dropdown">
                    <div class="nav-cart-box dropdown h-100" id="cart_items">
                        @include('frontend.partials.cart')
                    </div>
                </div>



            </div>
        </div>

        @if (Route::currentRouteName() != 'home' && get_setting('theme_cat') == 0)
            <div class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 d-none "
                id="hover-category-menu">
                <div class="container">
                    <div class="row gutters-10 position-relative">
                        <div class="col-lg-3 position-static">
                            @include('frontend.partials.category_menu')
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    @if (get_setting('header_menu_labels') != null && count(json_decode(get_setting('header_menu_links'), true)) == count(json_decode(get_setting('header_menu_labels'), true)))
        <div class="bg-white border-top border-gray-200   ">
            <div class="container @if (get_setting('theme_cat') == 1) nav_overlay @endif">
                <ul id="app_nav_list"
                    class="list-inline mb-0 pl-0  d-inline-flex-links-header  text-center flexable_mob">
                    @if (get_setting('theme_cat') == 1)
                        <li id="category-menu-icon"
                            class="list-inline-item mr-0 cat-width mx-2 fs-10  d-md-inline-flex  "
                            style="border-bottom: 3px solid  {!! json_decode(get_setting('header_menu_colors'), true)[0] !!} ">
                            <div class="dropdown w-100 ">
                                <div class="text-center">
                                    <a href="#" style="justify-content: center"
                                        class=" fs-14 fs-10 pl-4 px-3 py-2 d-inline-block d-flex flex-row hover-main-menue fw-600 hov-opacity-100 text-reset category-menu-icon">
                                        <span class="main_cat">{{ translate('Main Category') }}</span>
                                        <i id="cat_angle_down" style="font-size: 20px;margin-inline: 5px"
                                            class="las la-angle-down main_cat"></i>
                                    </a>
                                </div>
                                <div class="category-menu-icon d-none  position-absolute cat-width {{ dir_lang() == 'rtl' ? 'cat' : 'brand' }}_menu_mob"
                                    id="cat_drop_down">
                                    @include('frontend.partials.cat_menu2')
                                </div>
                            </div>
                        </li>
                        <li id="brand-menu-icon"
                            style="margin-inline: 10px;border-bottom: 3px solid {!! json_decode(get_setting('header_menu_colors'), true)[1] !!}  "
                            class="list-inline-item mr-0 brand-width mx-2   d-md-inline-flex  ">
                            <div class="dropdown w-100 ">
                                <div class="text-center">
                                    <a href="#" style="justify-content: center"
                                        class=" fs-14 fs-10 pl-4 px-3 py-2 d-inline-block hover-main-menue fw-600 d-flex flex-row hov-opacity-100 text-reset brand-menu-icon">
                                        <span id="main_brand">{{ translate('Main Brands') }}</span>
                                        <i id="brand_angle_down" style="font-size: 20px;margin-inline: 5px"
                                            class="las la-angle-down main_cat"></i>
                                    </a>
                                </div>
                                <div class="brand-menu-icon d-none {{ dir_lang() == 'rtl' ? 'brand' : 'cat' }}_menu_mob  position-absolute brand-width"
                                    id="brand_drop_down">
                                    @include('frontend.partials.brand_menu2')
                                </div>
                            </div>
                        </li>
                    @endif
                    @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                        @if ($value == 'All Blogs')
                            @if (count(\App\Blog::all()) > 0)
                                <li class="list-inline-item mr-0 d-none mx-2  d-lg-inline-flex bottom-overmouse"
                                    style="border-bottom: 3px solid {!! json_decode(get_setting('header_menu_colors'), true)[$key] !!} ">
                                    <a href="{{ BusinessSettings::get_link($value, $key) }}"
                                        class=" fs-12 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset ">
                                        {{ translate($value) }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="list-inline-item mx-2 mr-0 d-none d-lg-inline-flex bottom-overmouse"
                                style="border-bottom: 3px solid {!! json_decode(get_setting('header_menu_colors'), true)[$key] !!}  ">
                                <a href="{{ BusinessSettings::get_link($value, $key) }}"
                                    class=" fs-12 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset ">
                                    {{ translate($value) }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>


    @endif

    @if (get_setting('theme_cat') == 1)
        <div id="overlay_cat" class="overlay_cat d-none">

        </div>
    @endif
    <div class="search_overlay d-none">

    </div>
</header>
@php
$rtl = \App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl;

@endphp
<div class="aiz-mobile-side-nav-cat {{ $rtl == 1 ? 'sidebar-right' : null }}  collapse-sidebar-wrap sidebar-xl d-xl-none w-100 z-1035"
    style="direction: ltr">
    <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav-cat"
        data-same=".mobile-side-nav-thumb"></div>
    <div class="collapse-sidebar  bg-white">
        @include('frontend.inc.cat_side_nav')
    </div>
</div>

<div class="aiz-mobile-side-nav-sub-cat {{ $rtl == 1 ? 'sidebar-right' : null }}   collapse-sidebar-wrap sidebar-xl d-xl-none z-1035"
    style="direction: ltr">
    <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle"
        data-target=".aiz-mobile-side-nav-sub-cat" data-same=".mobile-side-nav-thumb"></div>
    <div id="sub_cat" class="collapse-sidebar  bg-white">
        <center class="mt-4">
            <img src="{{ static_asset('assets/img/loading.gif') }}" style="width: 25px;height: 25px;" />
        </center>
        {{-- @include("frontend.inc.cat_side_nav") --}}
    </div>
</div>

<section class="bg-white border-top mt-auto">
    @php
        $link_footer_des = json_decode(get_setting('footer_links_descriptions'), true);
        $link_footer_title = json_decode(get_setting('footer_links_title'), true);

    @endphp
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('terms') }}">
                    <i class="la la-file-text la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate($link_footer_title[0]) }}</h4>
                    <p>{{ translate($link_footer_des[0]) }}</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('returnpolicy') }}">
                    <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate($link_footer_title[1]) }}</h4>
                    <p>{{ translate($link_footer_des[1]) }}</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('supportpolicy') }}">
                    <i class="la la-support la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate($link_footer_title[2]) }}</h4>
                    <p>{{ translate($link_footer_des[2]) }}</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left border-right text-center p-4 d-block"
                    href="{{ route('privacypolicy') }}">
                    <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate($link_footer_title[3]) }}</h4>
                    <p>{{ translate($link_footer_des[3]) }}</p>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark py-2 text-light footer-widget">
    <div class="container">
        <div class="row" style="justify-content: center">
            <div class="col-lg-2 col-md-2 d-md-block d-none">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        {{ translate(get_setting('widget_one')) }}
                    </h4>
                    <ul class="list-unstyled">
                        @if (get_setting('widget_one_labels') != null)
                            @foreach (json_decode(get_setting('widget_one_labels'), true) as $key => $value)
                                <li class="mb-2 ">
                                    <a href="{{ json_decode(get_setting('widget_one_links'), true)[$key] }}"
                                        class="opacity-50 hov-opacity-100 text-reset">
                                        {{ translate($value) }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 d-md-block d-none">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        {{ translate(get_setting('widget_two')) }}
                    </h4>
                    <ul class="list-unstyled">
                        @if (get_setting('widget_two_labels') != null)
                            @foreach (json_decode(get_setting('widget_two_labels'), true) as $key => $value)
                                <li class="mb-2">
                                    <a href="{{ json_decode(get_setting('widget_two_links'), true)[$key] }}"
                                        class="opacity-50 hov-opacity-100 text-reset">
                                        {{ translate($value) }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-2 d-md-block d-none">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        {{ translate(get_setting('widget_three')) }}
                    </h4>
                    <ul class="list-unstyled">
                        @if (get_setting('widget_three_labels') != null)
                            @foreach (json_decode(get_setting('widget_three_labels'), true) as $key => $value)
                                <li class="mb-2">
                                    <a href="{{ json_decode(get_setting('widget_three_links'), true)[$key] }}"
                                        class="opacity-50 hov-opacity-100 text-reset">
                                        {{ translate($value) }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-2  col-md-2 d-md-block d-none">
                <div class=" mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        {{ translate('Contact Info') }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="d-block opacity-30">{{ translate('Address') }}:</span>
                            <span class="d-block opacity-70">{{ get_setting('contact_address') }}</span>
                        </li>
                        <li class="mb-2">
                            <span class="d-block opacity-30">{{ translate('Phone') }}:</span>
                            <span class="d-block opacity-70">{{ get_setting('contact_phone') }}</span>
                        </li>
                        <li class="mb-2">
                            <span class="d-block opacity-30">{{ translate('Email') }}:</span>
                            <span class="d-block opacity-70">
                                <a href="mailto:{{ get_setting('contact_email') }}"
                                    class="text-reset">{{ get_setting('contact_email') }}</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>


            {{-- <div class="col-md-4 col-lg-2">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        {{ translate('My Account') }}
                    </h4>
                    <ul class="list-unstyled">
                        @if (Auth::check())
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('logout') }}">
                                    {{ translate('Logout') }}
                                </a>
                            </li>
                        @else
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('user.login') }}">
                                    {{ translate('Login') }}
                                </a>
                            </li>
                        @endif
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('purchase_history.index') }}">
                                {{ translate('Order History') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('wishlists.index') }}">
                                {{ translate('My Wishlist') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('orders.track') }}">
                                {{ translate('Track Order') }}
                            </a>
                        </li>
                        @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated)
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-light" href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                            </li>
                        @endif
                    </ul>
                </div>
                @if (get_setting('vendor_system_activation') == 1)
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                            {{ translate('Be a Seller') }}
                        </h4>
                        <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md">
                            {{ translate('Apply Now') }}
                        </a>
                    </div>
                @endif
            </div> --}}
            <div class="col-lg-4 col-xl-4 text-center text-md-left">
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="d-block">
                        @if (get_setting('footer_logo') != null)
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset(get_setting('footer_logo')) }}"
                                alt="{{ env('APP_NAME') }}" height="44">
                        @else
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"
                                height="44">
                        @endif
                    </a>
                    <div class="d-inline-block d-md-block my-2">
                        <ul class="list-inline ">
                            @if (get_setting('app_store_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('app_store_link') }}" target="_blank">
                                        <img src="{{ url('/public/assets/img/app_store.png') }}" height="50"
                                            class="mw-100 h-auto" style="max-height: 50px;width:100px">
                                    </a>
                                </li>
                            @endif
                            @if (get_setting('google_play_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('google_play_link') }}" target="_blank">
                                        <img src="{{ url('/public/assets/img/google_play.png') }}" height="50"
                                            class="mw-100 h-auto" style="max-height: 50px;width:100px">
                                    </a>
                                </li>
                            @endif
                            @if (get_setting('app_gallary_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('app_gallary_link') }}" target="_blank">
                                        <img src="{{ url('/public/assets/img/app_galary.png') }}" height="50"
                                            class="mw-100 h-auto" style="max-height: 50px;width:100px">
                                    </a>
                                </li>
                            @endif


                        </ul>
                    </div>
                    <div class="my-3">
                        @php
                            echo get_setting('about_us_description');
                        @endphp
                    </div>
                    <div class="d-inline-block d-md-block">
                        <ul class="list-inline social colored ">
                            @if (get_setting('facebook_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('facebook_link') }}" target="_blank"
                                        class="facebook"><i class="lab la-facebook-f"></i></a>
                                </li>
                            @endif
                            @if (get_setting('twitter_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('twitter_link') }}" target="_blank"
                                        class="twitter"><i class="lab la-twitter"></i></a>
                                </li>
                            @endif
                            @if (get_setting('instagram_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('instagram_link') }}" target="_blank"
                                        class="instagram"><i class="lab la-instagram"></i></a>
                                </li>
                            @endif
                            @if (get_setting('youtube_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('youtube_link') }}" target="_blank"
                                        class="youtube"><i class="lab la-youtube"></i></a>
                                </li>
                            @endif
                            @if (get_setting('linkedin_link') != null)
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('linkedin_link') }}" target="_blank"
                                        class="linkedin"><i class="lab la-linkedin-in"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="d-inline-block d-md-block">
                        <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                            @csrf
                            <div class="form-group mb-0 mx-2">
                                <input type="email" class="form-control"
                                    placeholder="{{ translate('Your Email Address') }}" name="email" required />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ translate('Subscribe') }}
                            </button>
                        </form>
                    </div>


                    <div class="col-12 mt-4 d-md-none link_footer">


                        <div class="">
                            <div id="headingOne">
                                {{-- <h5 class="mb-0">
                                    <a style="color: #fff" class="btn " data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        {{ translate(get_setting('widget_one')) }}
                                    </a>
                                </h5> --}}
                                <ul class="list-unstyled mt-4  text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    <li class="mb-2">
                                        <a style="color: #fff;font-size: 12px"
                                            class="opacity-50 hov-opacity-100 text-reset" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            {{ translate(get_setting('widget_one')) }}
                                        </a>
                                    </li>
                                </ul>

                            </div>

                            <div id="collapseOne" class="collapse " aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <ul class="list-unstyled mt-4  text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    @if (get_setting('widget_one_labels') != null)
                                        @foreach (json_decode(get_setting('widget_one_labels'), true) as $key => $value)
                                            <li class="mb-2">
                                                <a href="{{ json_decode(get_setting('widget_one_links'), true)[$key] }}"
                                                    class="opacity-50 hov-opacity-100 text-reset">
                                                    {{ translate($value) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 d-md-none link_footer">


                        <div class="">
                            <div class="" id="headingOne1">
                                <ul class="list-unstyled mt-4  text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    <li class="mb-2">
                                        <a style="color: #fff;font-size: 12px"
                                            class="opacity-50 hov-opacity-100 text-reset" data-toggle="collapse"
                                            data-target="#collapseOne1" aria-expanded="true"
                                            aria-controls="collapseOne1">
                                            {{ translate(get_setting('widget_two')) }}
                                        </a>
                                    </li>
                                </ul>

                            </div>

                            <div id="collapseOne1" class="collapse " aria-labelledby="headingOne1"
                                data-parent="#accordion">
                                <ul class="list-unstyled mt-4 text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    @if (get_setting('widget_two_labels') != null)
                                        @foreach (json_decode(get_setting('widget_two_labels'), true) as $key => $value)
                                            <li class="mb-2">
                                                <a href="{{ json_decode(get_setting('widget_two_links'), true)[$key] }}"
                                                    class="opacity-50 hov-opacity-100 text-reset">
                                                    {{ translate($value) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 d-md-none link_footer">


                        <div class="">
                            <div class="" id="headingOne2">
                                <ul class="list-unstyled mt-4  text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    <li class="mb-2">
                                        <a style="color: #fff;font-size: 12px"
                                            class="opacity-50 hov-opacity-100 text-reset" data-toggle="collapse"
                                            data-target="#collapseOne2" aria-expanded="true"
                                            aria-controls="collapseOne2">
                                            {{ translate(get_setting('widget_three')) }}
                                        </a>
                                    </li>
                                </ul>

                            </div>

                            <div id="collapseOne2" class="collapse " aria-labelledby="headingOne2"
                                data-parent="#accordion">
                                <ul class="list-unstyled mt-4 text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    @if (get_setting('widget_three_labels') != null)
                                        @foreach (json_decode(get_setting('widget_three_labels'), true) as $key => $value)
                                            <li class="mb-2">
                                                <a href="{{ json_decode(get_setting('widget_three_links'), true)[$key] }}"
                                                    class="opacity-50 hov-opacity-100 text-reset">
                                                    {{ translate($value) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-md-none link_footer">


                        <div class="">
                            <div class="" id="headingOne3">
                                <ul class="list-unstyled mt-4  text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    <li class="mb-2">
                                        <a style="color: #fff;font-size: 12px"
                                            class="opacity-50 hov-opacity-100 text-reset" data-toggle="collapse"
                                            data-target="#collapseOne3" aria-expanded="true"
                                            aria-controls="collapseOne3">
                                            {{ translate('Contact Info') }}
                                        </a>
                                    </li>
                                </ul>

                            </div>

                            <div id="collapseOne3" class="collapse " aria-labelledby="headingOne3"
                                data-parent="#accordion">
                                <ul class="list-unstyled mt-4 text-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}">
                                    <li class="mb-2">
                                        <span class="d-block opacity-30">{{ translate('Address') }}:</span>
                                        <span class="d-block opacity-70">{{ get_setting('contact_address') }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="d-block opacity-30">{{ translate('Phone') }}:</span>
                                        <span class="d-block opacity-70">{{ get_setting('contact_phone') }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="d-block opacity-30">{{ translate('Email') }}:</span>
                                        <span class="d-block opacity-70">
                                            <a href="mailto:{{ get_setting('contact_email') }}"
                                                class="text-reset">{{ get_setting('contact_email') }}</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class=" col-12 text-md-left  text-center">
                <ul class="list-inline mb-0">
                    @if (get_setting('payment_method_images') != null)
                        @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                            <li class="list-inline-item">
                                <img src="{{ uploaded_asset($value) }}" height="50" class="mw-100 h-auto"
                                    style="max-height: 50px">
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="pt-3 pb-1  bg-black text-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="text-center m-auto">
                    @php
                        echo get_setting('frontend_copyright_text');
                    @endphp
                </div>
            </div>

        </div>
    </div>
</footer>


<div id="bottom_bar" class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top">
    <div class="d-flex justify-content-around align-items-center">
        <a href="{{ route('home') }}"
            class="text-reset flex-grow-1 text-center py-3   {{ areActiveRoutes(['home'], 'color-icon-menu') }}">
            <div class="d-flex flex-column">
                <i class="las la-home la-2x"></i>
                <span>{{ translate('Home') }}</span>
            </div>

        </a>
        <a class="text-reset flex-grow-1 text-center py-3 search-menu " href=" javascript:void(0);"
            data-toggle="class-toggle" data-target=".front-header-search">

            <div class="d-flex flex-column">
                <i class="las la-search la-flip-horizontal la-2x"></i>
                <span>{{ translate('Search') }}</span>
            </div>
        </a>
        <a href="{{ route('cart') }}"
            class="text-reset flex-grow-1 text-center py-3  {{ areActiveRoutes(['cart'], 'color-icon-menu') }}">
            <span class="d-inline-block position-relative px-2">
                <div class="d-flex flex-column">
                    <i class="las la-shopping-cart la-2x"></i>
                    <span>{{ translate('Cart') }}</span>
                </div>
                @if (Session::has('cart'))
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right"
                        id="cart_items_sidenav">{{ count(Session::get('cart')) }}</span>
                @else
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right"
                        id="cart_items_sidenav">0</span>
                @endif
            </span>
        </a>
        {{-- @if (Auth::check()) --}}
        {{-- @if (isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-reset flex-grow-1 text-center py-2">
                    <span class="avatar avatar-sm d-block mx-auto">
                        @if (Auth::user()->photo != null)
                            <div class="d-flex flex-column">
                                <img src="{{ custom_asset(Auth::user()->avatar_original) }}">
                                <span>{{ translate('Login') }}</span>
                            </div>
                        @else
                            <div class="d-flex flex-column">
                                <img src="{{ static_asset('assets/img/avatar-place.png') }}">
                                <span>{{ translate('Login') }}</span>
                            </div>
                        @endif
                    </span>
                </a>
            @else --}}
        <a href="javascript:void(0)" class="text-reset flex-grow-1 text-center tab-menu py-2 mobile-side-nav-thumb"
            data-toggle="class-toggle" data-target=".aiz-mobile-side-nav">
            <span class="avatar avatar-sm d-block mx-auto">
                {{-- @if (Auth::user()->photo != null) --}}
                <div class="d-flex flex-column">
                    <i class="las la-bars la-2x"></i>
                    <span>{{ translate('Menu') }}</span>
                </div>
                {{-- @else
                            <div class="d-flex flex-column">
                                <i class="las la-bars"></i>
                                <span>{{ translate('Menu') }}</span>
                            </div> --}}
                {{-- @endif --}}
            </span>
        </a>
        {{-- @endif --}}
        {{-- @else
            <a href="{{ route('user.login') }}" class="text-reset flex-grow-1 text-center py-2">
                <span class="avatar avatar-sm d-block mx-auto">
                    <div class="d-flex flex-column">
                        <i class="las la-bars"></i>
                        <span>{{ translate('Menu') }}</span>
                    </div>
                </span>
            </a>
        @endif --}}
    </div>
</div>
@if (!isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap  sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer  overlay-fixed" data-toggle="class-toggle"
            data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar saidbar-width bg-white">
            @include('frontend.inc.user_side_nav2')
        </div>
    </div>
@endif

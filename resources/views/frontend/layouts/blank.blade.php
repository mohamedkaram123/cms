<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ env('APP_URL')}}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta itemprop="name" content="{{ get_setting('meta_title') }}">
    <meta itemprop="description" content="{{ get_setting('meta_description') }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">
        <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Favicon -->
    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->

    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
        <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">

      <link rel="stylesheet" href="{{ static_asset('assets/css/slick.css') }}"/>
   @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/slick-theme.css') }}">
    @php
    echo get_setting('header_script');

@endphp
<style>
    .aiz-carousel .slick-dots button {
    width: 0px;
    padding: 0px;
    color:  var(--primary);
    border: 0;
    background: var(--primary);
    border-radius: 50%;
    margin: 0px;
}
.slick-dots li {
    position: relative;
    display: inline-block;
    color: var(--primary)
    width: 20px;
    height: 20px;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
}

.slick-dots .slick-active {

    color: #ddd!important

}


.pragraph{
        max-width: 260px;
    margin: 0 auto;
    text-align: center;
}

.text-center-register {
  display: flex;
  flex-direction: row;
}
.text-center-register:before, .text-center-register:after{
  content: "";
  flex: 1 1;
  border-bottom: 1px #ddd solid;
  margin: auto;
}
.text-center-register:before {
  margin-inline: 10px
}
.text-center-register:after {
  margin-inline: 10px
}

  .slick-dots li button:before
    {
        font-size: 20px;
        line-height: 20px;
        ...
    }
</style>
    <script>
        var AIZ = AIZ || {};
    </script>

    @yield("style")

</head>
<body>
    <div class="d-flex flex-column">
<div class="top-navbar bg-white border-bottom border-soft-secondary z-1035 d-none">
        <div class="row">
            <div class="col-lg-3  col" style="padding: 0">
                <ul class="list-inline d-flex justify-content-around justify-content-lg-center mb-0" style="background-color: #f9fafc;">
                    @if(get_setting('show_language_switcher') == 'on')
                    <li class="list-inline-item dropdown mr-3" id="lang-change">
                        @php
                            if(Session::has('locale')){
                                $locale = Session::get('locale', Config::get('app.locale'));
                            }
                            else{
                                $locale = 'en';
                            }
                        @endphp
                        <a href="javascript:void(0)" class="dropdown-toggle text-nav-header text-reset py-2" data-toggle="dropdown" data-display="static">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-2 lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                            <span class="opacity-60">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            @foreach (\App\Language::all() as $key => $language)
                                <li>
                                    <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item text-nav-header @if($locale == $language) active @endif">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                        <span class="language">{{ $language->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif

                    @if(get_setting('show_currency_switcher') == 'on')
                    <li class="list-inline-item dropdown" id="currency-change">
                        @php
                            if(Session::has('currency_code')){
                                $currency_code = Session::get('currency_code');
                            }
                            else{
                                $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                            }
                        @endphp
                        <a href="javascript:void(0)" class="dropdown-toggle text-nav-header text-reset py-2 opacity-60" data-toggle="dropdown" data-display="static">
                            {{ \App\Currency::where('code', $currency_code)->first()->name }} {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                            @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                <li>
                                    <a class="dropdown-item text-nav-header @if($currency_code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-6 d-md-flex flex-row d-none" style="padding: 0">
                <ul class="list-inline mb-0 borders_nav list_hotenzal w-100 br-l" >
                       <li class=" list_li ">

                                <a href="{{route("wishlists.index")}}" class="text-reset text-nav-header py-2 hover_list_li d-inline-block opacity-60">
                                    <i  class="las la-heart "></i>
                                    {{ translate('My wishlists')}}</a>
                            </li>
                               <li class="  list_li ">
                                <a href="{{route("purchase_history.index")}}" class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60">
                                    <i class="las la-tractor"></i>
                                    {{ translate('Track the shipment')}}</a>
                            </li>
                               <li class="  list_li ">
                                <a href="{{route("cart")}}"   class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60">
                                    <i class="las la-shopping-cart"></i>
                                    {{ translate('Cart')}}</a>
                            </li>
                               <li class="  list_li ">
                               <div class="dropdown">
                                    <a href="{{route("cart")}}"
                                    class="dropdown-toggle dropdownMenuHelp  drop_down_help text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    >
                                    {{ translate('Help')}}</a>
                                        <div class="dropdown-menu drop_helps dropdownMenuHelp "
                                        id="drop_down_help"
                                         aria-labelledby="dropdownMenuHelp"
                                         style="max-width: fit-content"
                                         >
                                            <a   class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item " id="call_company" href="javascript:void(0)">
                                                <i class="las la-phone-volume"></i>
                                                {{translate("Call Company") }}
                                                     - {{get_setting("contact_phone")}}

                                            </a>
                                            <a   class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item " href="javascript:void(0)">
                                                 <i class="las la-at"></i>
                                                {{translate("send on") }}
                                                    - {{get_setting("contact_email")}}

                                            </a>
                                            <a href="{{ route('terms') }}"  class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item " >
                                                 <i class="la la-file-text "></i>
                                                {{ translate('Terms & conditions') }}

                                            </a>
                                            <a href="{{ route('returnpolicy') }}"  class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item " >
                                                <i class="la la-mail-reply "></i>
                                                {{ translate('Return Policy') }}
                                            </a>

                                            <a href="{{ route('supportpolicy') }}"  class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item " >
                                                <i class="la la-support"></i>
                                                {{ translate('Support Policy') }}
                                            </a>
                                            <a href="{{ route('privacypolicy') }}"  class="text-reset text-nav-header hover_list_li  py-2 d-inline-block opacity-60 dropdown-item " >
                                                <i class="la la-exclamation-circle"></i>
                                                {{ translate('Privacy Policy') }}
                                            </a>
                                        </div>
                                        </div>
                            </li>

            </div>

            <div class="col-3 text-center d-none d-lg-block" style="padding: 0">
                <ul class="list-inline mb-0" style="background-color: #f9fafc;">
                    @auth
                        @if(isAdmin())
                            <li class="list-inline-item mr-3">
                                <a href="{{ route('admin.dashboard') }}" class="text-reset text-nav-header py-2 d-inline-block opacity-60">{{ translate('My Panel')}}</a>
                            </li>
                        @else
                            <li class="list-inline-item mr-3">
                                <a href="{{ route('dashboard') }}" class="text-reset text-nav-header py-2 d-inline-block opacity-60">{{ translate('My Panel')}}</a>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <a href="{{ route('logout') }}" class="text-reset text-nav-header py-2 d-inline-block opacity-60">{{ translate('Logout')}}</a>
                        </li>
                    @else
                        <li class="list-inline-item mr-3">
                            <a href="{{ route('user.login') }}" class="text-reset text-nav-header py-2 d-inline-block opacity-60">{{ translate('Login')}}</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('user.registration') }}" class="text-reset text-nav-header py-2 d-inline-block opacity-60">{{ translate('Registration')}}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
</div>
        <div class="flex-grow-1">
            @yield('content')
        </div>

    </div><!-- .aiz-main-wrapper -->
    <script src="{{ static_asset('assets/js/vendors.js') }}" ></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}" ></script>
    <script src="{{ static_asset('assets/js/slick.min.js') }}" ></script>

    @yield('script')
    @php
        echo get_setting('footer_script');
    @endphp
        <script>
        $(document).ready(function() {
            
            

  @foreach (session('flash_notification', collect())->toArray() as $message)
	        AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
	    @endforeach

   if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
                            location.reload();
                        });

                    });
                });
            }
        })
</script>
</body>
</html>

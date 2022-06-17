@extends('frontend.layouts.blank')

@section('content')


<div class="h-100 bg-cover bg-white bg-center py-7" style="background-image: url({{ uploaded_asset(get_setting('user_login_background')) }})">

        <div class="profile">
            <div class="container " >
                <div class="row " >
                      <div class=" col-md-4    col-12 ">
                                    <div class="text-center">
                                        <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                                    @php
                                        $header_logo = get_setting('header_logo');
                                    @endphp
                                    @if($header_logo != null)
                                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                                    @else
                                        <img src="{{ static_asset('assets/img/logos.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                                    @endif
                                </a>
                                    </div>

                                    <div class="card shadow-lg text-center" >

                                        <div class="px-4  py-5 ">
                                            <div class="">
                                                <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                                            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                                        @else
                                                            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                        @endif
                                                        @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                                            <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                                    </div>

                                                    <div class="d-flex " style="justify-content: space-between">
                                                        <div class="p-2">
                                                            <label class="aiz-checkbox">
                                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                                                <span class="aiz-square-check"></span>
                                                            </label>
                                                        </div>
                                                        <div class="p-2">
                                                            <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                                        </div>
                                                    </div>

                                                    <div class="mb-5">
                                                        <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                                                    </div>
                                                </form>

                                                {{-- @if (env("DEMO_MODE") == "On")
                                                    <div class="mb-5">
                                                        <table class="table table-bordered mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ translate('Seller Account')}}</td>
                                                                    <td>
                                                                        <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ translate('Customer Account')}}</td>
                                                                    <td>
                                                                        <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif

                                                @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                                    <div class="separator mb-3">
                                                        <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                                    </div>
                                                    <ul class="list-inline social colored text-center mb-5">
                                                        @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                                            <li class="list-inline-item">
                                                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                                    <i class="lab la-facebook-f"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                                            <li class="list-inline-item">
                                                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                                    <i class="lab la-google"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                                            <li class="list-inline-item">
                                                                <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                                    <i class="lab la-twitter"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                @endif --}}
                                            </div>
                                            <div style="    margin: 30px 0 20px;">
                                                <div class="content-divider text-muted form-group">
                                                <div class="text-center-register">
                                                    {{translate("Dont have an account?")}}
                                                </div>
                                            </div>
                                            </div>

                                            <div class="text-center">
                                                <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-6  d-md-block d-none" style="padding-top:40px" >

                            <div class="aiz-carousel" data-arrows="false" data-dots="true" data-autoplay="true" data-infinite="true">
                                 @php
                                 $slider_images = json_decode(get_setting('login_sliders'), true);
                               $slider_pragraphs = json_decode(get_setting('login_slider_pragraph_shops'), true);

                                 @endphp
                                  @foreach ($slider_images as $key => $value)
                                <div class="d-flex flex-column " >
                                    <div class="p-2 d-flex"  style="justify-content: center" >
                                        <a href="{{ json_decode(get_setting('login_sliders'), true)[$key] }}">
                                        <img
                                            class="d-block mw-100 img-fit rounded "
                                            src="{{ uploaded_asset($slider_images[$key]) }}"
                                            alt="{{ env('APP_NAME')}} promo"
                                            style="width:400px;height: 400px"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                    </a>
                                    </div>

                                    <div class="p-2 text-center mt-2">
                                        <p class="pragraph">{{translate($slider_pragraphs[$key]) }}</p>
                                    </div>


                                </div>
                            @endforeach
                            </div>

                    </div>

                </div>
            </div>
        </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">

$(document).ready(function(){

  $('.your-classs').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  cssEase: 'linear'
});
});
    </script>
@endsection

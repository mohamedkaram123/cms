@extends('frontend.layouts.blank')

@php
$dir = \App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 ? 'right' : 'left';
@endphp

@section('style')
    <style>
        @media (min-width: 1000px) {
            .border_register-right {
                border-right: 5px solid #eee;
            }

            .border_register-left {
                border-left: 5px solid #eee;
            }
        }

        /* .pos_text_container-right {
                                                                                                                                                margin-top: 10%;
                                                                                                                                                position: relative;
                                                                                                                                                right: 150px;

                                                                                                                                            }

                                                                                                                                            .pos_text_container-left {
                                                                                                                                                margin-top: 10%;
                                                                                                                                                position: relative;
                                                                                                                                                left: 150px;

                                                                                                                                            } */

   
        @media (min-width : 1300px) {
            .pos_text_container-right {
                margin-top: 10%;
                position: relative;
                right: 150px;

            }

            .pos_text_container-left {
                margin-top: 10%;
                position: relative;
                left: 150px;

            }
            .padding-row{
                padding: 20px 70px 0;
            }
        }


        @media (min-width < 1300px) {
            .pos_text_container-right {
                margin-top: 10%;
                position: relative;
                right: 100px;

            }

            .pos_text_container-left {
                margin-top: 10%;
                position: relative;
                left: 100px;

            }
        }

        .translate {
            top: 30px;
            opacity: 0
        }

    </style>
@endsection
@section('content')



    <div class="h-100 bg-cover bg-white bg-center py-5"
        style="background-image: url({{ uploaded_asset(get_setting('user_register_background')) }})">

        <div class="container ">
            <div class="row ">
                <div class="translate col-lg-3 col-md-5 mx-auto d-lg-block d-none pos_text_container-{{ $dir }}"
                    style="margin-top: 10%">
                    <div>
                        <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                            @php
                                $header_logo = get_setting('header_logo');
                            @endphp
                            @if ($header_logo != null)
                                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                                    class="mw-100 h-65px " >
                            @else
                                <img src="{{ static_asset('assets/img/logos.png') }}" alt="{{ env('APP_NAME') }}"
                                    class="mw-100 h-65px " >
                            @endif
                        </a>
                    </div>

                    <h1 style="font-weight: bold">{{ translate(get_setting('user_register_title')) }}
                    </h1>

                    <p>
                        {{ translate(get_setting('user_register_desc')) }}
                    </p>
                </div>
                <div 
                    class="translate col-xl-5 col-lg-7 padding-row col-md-10 mx-auto border_register-{{ $dir }}">
                    <div class="text-center d-lg-none d-block">
                        <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                            @php
                                $header_logo = get_setting('header_logo');
                            @endphp
                            @if ($header_logo != null)
                                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                                    class="mw-100   h-65px" >
                            @else
                                <img src="{{ static_asset('assets/img/logos.png') }}" alt="{{ env('APP_NAME') }}"
                                    class="mw-100  h-65px" >
                            @endif
                        </a>
                    </div>

                    <div class="px-4 py-3 py-lg-4">
                        <div class="">
                            <form id="reg-form" class="form-default" role="form"
                                action="{{ URL::temporarySignedRoute('register', now()->addMinutes(30)) }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        value="{{ old('name') }}" placeholder="{{ translate('Full Name') }}"
                                        name="name" />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{-- <label for="country">{{translate('Country')}}</label> --}}
                                    <select class="select2 form-control aiz-selectpicker" name="country_id" id="country"
                                        data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                        @foreach (App\Models\Country::orderBy('order', 'desc')->get() as $country)
                                            {{-- <input type="hidden" id="country_tel" value="{{ $country->tel }}" /> --}}
                                            <option id={{ 'country_tel' . $country->id }}
                                                data-tel="{{ $country->tel }}" value="{{ $country->id }}">
                                                {{ translate($country->name) }} </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">

                                    <div class="d-flex flex-row">


                                        <div style="width: 100%;margin-inline-end: 10px" class="form-group">
                                            <input id="phone" type="text"
                                                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                name="phone" value="{{ old('phone') }}" autofocus
                                                placeholder="{{ translate('Phone') }}" required />
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div style="width:30%;">
                                            <select disabled id="country_tel_data"
                                                class="select2 form-control aiz-selectpicker " name="country_tel"
                                                data-toggle="select2" data-live-search="true">

                                                @foreach (App\Models\Country::orderBy('order', 'desc')->get() as $country)
                                                    <option value="{{ $country->tel }}">
                                                        {{ '+ ' . $country->tel }} </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>

                                </div>

                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <div class="form-group phone-form-group mb-1">
                                        <input type="tel" id="phone-code"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off" />
                                    </div>

                                    <input type="hidden" name="country_code" value="" />

                                    <div class="form-group email-form-group mb-1 d-none">
                                        <input type="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="{{ old('email') }}" placeholder="{{ translate('Email') }}"
                                            name="email" autocomplete="off" />
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group text-right">
                                        <button class="btn btn-link p-0 opacity-50 text-reset" type="button"
                                            onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required
                                            placeholder="{{ translate('Email') }}">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="pass" type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            placeholder="{{ translate('Password') }}" name="password" />
                                        <div class="input-group-append">
                                            <button id="ey_p_bt" class="btn btn-outline-primary" type="button">
                                                <i id="ey_p" class="las la-eye d-none"></i>
                                                <i id="eys_p" class="las la-eye-slash"></i>
                                            </button>

                                        </div>
                                    </div>
                                    <small
                                        style="font-size: 12px;font-weight: bold;color:var(--primary)">{{ translate('Notes: Password must contain uppercase and lowercase letters, symbols, and at least 8 characters') }}</small>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="passCon" type="password" class="form-control"
                                            placeholder="{{ translate('Confirm Password') }}"
                                            name="password_confirmation" />
                                        <div class="input-group-append">
                                            <button id="ey_pc_bt" class="btn btn-outline-primary" type="button">
                                                <i id="ey_pc" class="las la-eye  d-none"></i>
                                                <i id="eys_pc" class="las la-eye-slash "></i>
                                            </button>

                                        </div>
                                    </div>

                                </div>

                                @if (\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}">
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="checkbox_example_1" required />
                                        <span
                                            class=opacity-60>{{ translate('By signing up you agree to our terms and conditions.') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div id="recaptcha-container"></div>

                                <div class="mb-5">
                                    <button type="submit" id="btn-submit"
                                        class="btn btn-primary btn-block fw-600">{{ translate('Create Account') }}</button>
                                </div>
                            </form>


                            @if (\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                <div class="separator mb-3">
                                    <span class="bg-white px-3 opacity-60">{{ translate('Or Join With') }}</span>
                                </div>
                                <ul class="list-inline social colored text-center mb-5">
                                    @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                                class="facebook">
                                                <i class="lab la-facebook-f"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                                class="google">
                                                <i class="lab la-google"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                                class="twitter">
                                                <i class="lab la-twitter"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                        <div class="text-center">
                            <p class="text-muted mb-0">{{ translate('Already have an account?') }}</p>
                            <a href="{{ route('user.login') }}">{{ translate('Log In') }}</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    @if (\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">
        //////////////////////////////////////////////////////////////


        $(document).ready(function() {
            // alert('helloman');

            $(".translate").animate({
                top: "0px",
                opacity: 1
            }, 800);
            // console.log("ddd");
            $("#ey_p_bt").click(function(e) {
                e.preventDefault();
                toggle_pass()
            });

            $("#ey_pc_bt").click(function(e) {
                e.preventDefault();
                toggle_pass_confirm()
            });
            var toggle_pass = () => {
                if ($("#pass").attr("type") == "password") {
                    $("#pass").attr("type", "text")
                    $("#ey_p").removeClass("d-none");
                    $("#eys_p").addClass("d-none");
                } else {
                    $("#pass").attr("type", "password")
                    $("#ey_p").addClass("d-none");
                    $("#eys_p").removeClass("d-none");
                }
            }

            var toggle_pass_confirm = () => {
                if ($("#passCon").attr("type") == "password") {
                    $("#passCon").attr("type", "text")
                    $("#ey_pc").removeClass("d-none");
                    $("#eys_pc").addClass("d-none");

                } else {
                    $("#passCon").attr("type", "password")
                    $("#ey_pc").addClass("d-none");
                    $("#eys_pc").removeClass("d-none");
                }
            }

            $("#country").change(function(e) {
                e.preventDefault();

                //  console.log($("#country_tel" + $(this).val()).data("tel"));


                $("#country_tel_data").val($("#country_tel" + $(this).val()).data("tel")).change();
            });
            
            
               $("#passCon").keyup(function(e) {
                e.preventDefault();

                console.log({
                    pass: $(this).val(),
                    passconfirm: $("#pass").val()
                });
                if ($(this).val() === $("#pass").val()) {
                    $(this).removeClass("is-invalid")
                    $("#pass").removeClass("is-invalid")
                    $(this).addClass("is-valid")
                    $("#pass").addClass("is-valid")
                } else {
                    $(this).removeClass("is-valid")
                    $("#pass").removeClass("is-valid")
                    $(this).addClass("is-invalid")
                    $("#pass").addClass("is-invalid")

                }

            });

            // $("#country_tel").change(function (e) {
            //     e.preventDefault();

            //     console.log($(this).val());
            // });

        })
    </script>
@endsection

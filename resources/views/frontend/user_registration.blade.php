@extends('frontend.layouts.app')

@section('content')
{{-- {{ dd(session()->get("locale")) }} --}}




    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center pt-4">
                                <h1 class="h4 fw-600">
                                    {{ translate('Create an account.')}}
                                </h1>
                            </div>
                            <div class="px-4 py-3 py-lg-4">
                                <div class="">
                                    <form id="reg-form" class="form-default" role="form" action="{{URL::temporarySignedRoute('register', now()->addMinutes(30))}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name" />
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                         <div class="form-group">
                            {{-- <label for="country">{{translate('Country')}}</label> --}}
                            <select  class="select2 form-control aiz-selectpicker" name="country_id" id="country" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                @foreach (App\Models\Country::orderBy('order', 'desc')->get()  as $country)
                                {{-- <input type="hidden" id="country_tel" value="{{ $country->tel }}" /> --}}
                                    <option id={{"country_tel" . $country->id}} data-tel="{{ $country->tel }}" value="{{ $country->id }}">{{ translate($country->name)  }} </option>
                                @endforeach
                            </select>
                        </div>


                            <div class="form-group">

                                        <div class="d-flex flex-row" >


                                            <div style="width: 100%;margin-inline-end: 10px" class="form-group">
                                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}"  autofocus placeholder="{{ translate('Phone') }}" required />
                                                    @if ($errors->has('phone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                                        </span>
                                                    @endif
                                            </div>
                                            <div style="width:30%;">
                                                <select disabled id="country_tel_data"  class="select2 form-control aiz-selectpicker " name="country_tel" data-toggle="select2" data-live-search="true"  >

                                                    @foreach (App\Models\Country::orderBy('order', 'desc')->get() as $country)

                                                            <option  value="{{  $country->tel  }}">{{"+ ". $country->tel  }} </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>

                            </div>

                                        @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                            <div class="form-group phone-form-group mb-1">
                                                <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off" />
                                            </div>

                                            <input type="hidden" name="country_code" value="" />

                                            <div class="form-group email-form-group mb-1 d-none">
                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off" />
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group text-right">
                                                <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div>
                                        @else
                                                                <div class="form-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ translate('Email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                                        @endif

                                        <div class="form-group">
                                            <div class="input-group">
                                            <input id="pass" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password" />
                                            <div class="input-group-append">
                                                <button id="ey_p_bt" class="btn btn-outline-primary" type="button">
                                                      <i id="ey_p" class="las la-eye d-none"></i>
                                             <i id="eys_p" class="las la-eye-slash" ></i>
                                                </button>

                                            </div>
                                            </div>
                                            <small style="font-size: 12px;font-weight: bold;color:var(--primary)">{{translate("Notes: Password must contain uppercase and lowercase letters, symbols, and at least 8 characters")}}</small>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                              <input id="passCon" type="password" class="form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation" />
                                                 <div class="input-group-append">
                                                <button id="ey_pc_bt" class="btn btn-outline-primary" type="button">
                                                      <i id="ey_pc" class="las la-eye  d-none"></i>
                                             <i id="eys_pc" class="las la-eye-slash " ></i>
                                                </button>

                                            </div>
                                            </div>

                                        </div>

                                        @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="checkbox_example_1" required />
                                                <span class=opacity-60>{{ translate('By signing up you agree to our terms and conditions.')}}</span>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                        <div id="recaptcha-container"></div>

                                        <div class="mb-5">
                                            <button type="submit" id="btn-submit"  class="btn btn-primary btn-block fw-600">{{  translate('Create Account') }}</button>
                                        </div>
                                    </form>


                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Join With')}}</span>
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
                                    @endif
                                </div>
                                <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Already have an account?')}}</p>
                                    <a href="{{ route('user.login') }}">{{ translate('Log In')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">


//////////////////////////////////////////////////////////////


     $(document).ready(function(){
            // alert('helloman');

            $("#ey_p_bt").click(function (e) {
                e.preventDefault();
                toggle_pass()
            });

             $("#ey_pc_bt").click(function (e) {
                e.preventDefault();
                toggle_pass_confirm()
            });
         var toggle_pass = ()=>{
             if($("#pass").attr("type") == "password"){
                 $("#pass").attr("type","text")
                 $("#ey_p").removeClass("d-none");
                 $("#eys_p").addClass("d-none");
             }else{
                  $("#pass").attr("type","password")
                  $("#ey_p").addClass("d-none");
                  $("#eys_p").removeClass("d-none");
             }
         }

          var toggle_pass_confirm = ()=>{
             if($("#passCon").attr("type") == "password"){
                 $("#passCon").attr("type","text")
                 $("#ey_pc").removeClass("d-none");
                 $("#eys_pc").addClass("d-none");

             }else{
                  $("#passCon").attr("type","password")
                    $("#ey_pc").addClass("d-none");
                  $("#eys_pc").removeClass("d-none");
             }
         }

            $("#country").change(function (e) {
                e.preventDefault();

              //  console.log($("#country_tel" + $(this).val()).data("tel"));


                $("#country_tel_data").val($("#country_tel" + $(this).val()).data("tel")).change();
            });

            // $("#country_tel").change(function (e) {
            //     e.preventDefault();

            //     console.log($(this).val());
            // });

        })

        @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            // alert('helloman');


            $("#country").change(function (e) {
                e.preventDefault();

            });


            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif

        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection

<div class="d-flex flex-column">
    <div class="d-flex flex-column" style="align-items: center">
        <span class="avatar avatar-md mr-md-2">
            <img src="{{ static_asset('assets/img/avatar-place.png') }}" />

        </span>

        <h3>{{ translate('Register') }}</h3>
    </div>
    <div class="form-group">
        <input id="name_register" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
            value="{{ old('name') }}" placeholder="{{ translate('Full Name') }}" name="name" />
        <small class="require_data" id="name_required"></small>
    </div>
    <div class="form-group d-none">
        {{-- <label for="country">{{translate('Country')}}</label> --}}
        <select class="select2 form-control aiz-selectpicker" name="country_id" id="country_register"
            data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
            @foreach (App\Models\Country::orderBy('order', 'desc')->get() as $country)
                {{-- <input type="hidden" id="country_tel" value="{{ $country->tel }}" /> --}}
                <option id={{ 'country_tel' . $country->id }} data-tel="{{ $country->tel }}"
                    value="{{ $country->id }}">
                    {{ translate($country->name) }} </option>
            @endforeach
        </select>
    </div>


    <div id="register_phone_row" class="form-group">

        <div class="d-flex flex-row">


            <div style="width: 100%;margin-inline-end: 10px" class="form-group">
                <input id="register_phone" type="text"
                    class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                    value="{{ old('phone') }}" autofocus placeholder="{{ translate('Phone') }}" required />
                <small class="require_data" id="phone_required"></small>

            </div>
            <div style="width:30%;">
                <select id="register_country_tel" class=" form-control  ">

                    @foreach (App\Models\Country::orderBy('order', 'desc')->get() as $country)
                        <option value="{{ $country->tel }}">
                            {{ '+ ' . $country->tel }} </option>
                    @endforeach
                </select>
            </div>


        </div>

    </div>


    <div id="register_mail_group" class="form-group d-none">
        <input id="register_email" autocomplete="new-email" type="email"
            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required
            placeholder="{{ translate('Email') }}">

        <small class="require_data" id="email_required"></small>
    </div>

    <div class="form-group">
        <div class="input-group">
            <input id="pass" autocomplete="new-password" type="password"
                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                placeholder="{{ translate('Password') }}" name="password" />
            <input type="hidden" name="password_confirmation" id="pass_conf" />
            <div class="input-group-append">
                <button id="ey_p_bt" class="btn btn-outline-primary" type="button">
                    <i id="ey_p" class="las la-eye d-none"></i>
                    <i id="eys_p" class="las la-eye-slash"></i>
                </button>

            </div>
        </div>
        <small class="require_data" id="password_required"></small>
    </div>

    {{-- <div class="mb-3">
         <label class="aiz-checkbox">
             <input type="checkbox" name="checkbox_example_1" required />
             <span class=opacity-60>{{ translate('By signing up you agree to our terms and conditions.') }}</span>
             <span class="aiz-square-check"></span>
         </label>
     </div>
     <div id="recaptcha-container"></div> --}}

    <div class="mb-2">
        <button type="button" id="btn_register"
            class="btn btn-primary btn-block fw-600">{{ translate('Create Account') }}</button>
    </div>

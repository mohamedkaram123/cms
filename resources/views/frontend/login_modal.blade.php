<form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
    @csrf


    @if (get_setting('login_email_phone') == 1)
        <div class="d-flex flex-column">
            <div class="d-flex flex-column" style="align-items: center">
                <span class="avatar avatar-md mr-md-2">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" />

                </span>

                <h3>{{ translate('Login') }}</h3>
            </div>
            <div id="choose_methd" class="d-none">
                <div class="line-left-right">
                    <span>{{ translate('Please choose one of the two methods') }}</span>
                </div>
                <div class="d-flex flex-row" style="justify-content: space-evenly">

                    <button id="btn_email" class="btn btn-outline-primary btn-otp-cart-login">
                        <div class="d-flex flex-column">
                            <i style="font-size: 24px" class="las la-at"></i>
                            <span>{{ translate('email') }}</span>
                        </div>
                    </button>

                    <button id="btn_phone" class="btn btn-outline-primary btn-otp-cart-login">
                        <div class="d-flex flex-column">
                            <i style="font-size: 24px" class="las la-sms"></i>
                            <span>{{ translate('sms msg') }}</span>
                        </div>
                    </button>

                </div>

            </div>

            <div id="email" class="d-none form-group">
                <input id="email_input" type="email"
                    class="form-control h-auto  {{ $errors->has('email') ? ' is-invalid' : '' }}"
                    value="{{ old('email') }}" placeholder="{{ translate('Enter Your Email') }}" name="email"
                    required>
                <small class="require_data" id="require_email"></small>
            </div>


            <div id="phone" class="d-none form-group ">
                <div class="d-flex flex-row">
                    {{-- <input type="tel" id="demo" placeholder="" id="telephone"> --}}

                    <div style="width: 70%;">
                        <input id="phone_input" type="number"
                            class="form-control h-auto  {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                            placeholder="{{ translate('Enter Your Phone') }}" name="phone" required>
                        <small class="require_data" id="require_phone"></small>
                    </div>

                    {{-- <input type="number" class="form-control" style="padding: 10px;width: 20%;" readonly value="{{ "+" . get_country()->tel }}" /> --}}

                    <div style="width: 20%;margin-inline: 10px">

                        @php
                            $static = static_asset('assets/img/flags/');
                        @endphp
                        <a href="javascript:void(0)"
                            class="dropdown-toggle hover_list_li text-nav-header text-reset py-2" id="title_flag"
                            data-toggle="dropdown" data-display="static">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ static_asset('assets/img/flags/' . Str::lower(get_country()->code) . '.png') }}"
                                class="mr-1 lazyload" alt="{{ get_country()->tel }}" height="11">
                            <span class=" language">{{ get_country()->tel }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left"
                            style="position: fixed !important;overflow: scroll;max-height: 300px;top: 200px;right: 200px">
                            @foreach ($countries as $CountryItem)
                                <li>

                                    <div data-item="{{ json_encode($CountryItem) }}"
                                        data-item_loc="{{ $static }}" href="#"
                                        data-flag="{{ Str::lower($CountryItem->code) }}"
                                        class="dropdown-item text-nav-header item_flag hover_list_li ">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ static_asset('assets/img/flags/' . Str::lower($CountryItem->code) . '.png') }}"
                                            class="mr-1 lazyload" alt="{{ $CountryItem->tel }}" height="11">
                                        <span class=" language">+ {{ $CountryItem->tel }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <input type="hidden" name="country" id="country_tel" value="{{ get_country()->tel }}" />
                        class="form-control ">

                        {{-- <select name="country" id="country_tel" class="form-control  countries">

                            @foreach ($countries as $CountryItem)
                                <option value="{{ $CountryItem->tel }}"
                                    data-data='{"image": "{{ static_asset('assets/img/flags/' . Str::lower($CountryItem->code) . '.png') }}","code":"+{{ $CountryItem->tel }}","search-text":" +{{ $CountryItem->tel }}"}'
                                    {{ get_country()->code == $CountryItem->code ? "selected='selected'" : '' }}>
                                </option>
                            @endforeach

                        </select> --}}
                    </div>
                </div>

            </div>


            <div id="code" class="d-none form-group ">
                <input id="code_input" type="text" class="form-control h-auto  "
                    placeholder="{{ translate('Enter Verification code') }}" name="code">
                <small class="require_data" id="require_code"></small>
                {{-- <input type="number" class="form-control" style="padding: 10px;width: 20%;" readonly value="{{ "+" . get_country()->tel }}" /> --}}

            </div>

            <div id="btn_submit" class="mb-2 d-none">
                <button type="submit" id="btn_submit_data"
                    class="btn btn-primary btn-block fw-600">{{ translate('Login') }}</button>
            </div>


            <div id="btn_code" class=" d-none" style="margin-bottom: 15px">
                <button type="submit" id="btn_code_data" class="btn btn-primary btn-block fw-600"><i
                        class="las la-check"></i> {{ translate('Verification') }}</button>
            </div>

            <div id="btn_counter" class=" text-center d-none" style="margin-bottom: 15px">
                <button disabled type="submit" id="btn_counter_data" class="btn btn-primary ">
                </button>

            </div>

        </div>
    @else
        <div class="form-group">
            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                <input type="text"
                    class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                    value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone') }}" name="email"
                    id="email">
            @else
                <input type="email"
                    class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                    value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email">
            @endif
            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                <span class="opacity-60">{{ translate('Use country code before number') }}</span>
            @endif
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control h-auto form-control-lg"
                placeholder="{{ translate('Password') }}">
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <label class="aiz-checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class=opacity-60>{{ translate('Remember Me') }}</span>
                    <span class="aiz-square-check"></span>
                </label>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('password.request') }}"
                    class="text-reset opacity-60 fs-14">{{ translate('Forgot password?') }}</a>
            </div>
        </div>


        <div class="mb-2">
            <button type="submit" class="btn btn-primary btn-block fw-600">{{ translate('Login') }}</button>
        </div>
    @endif
</form>

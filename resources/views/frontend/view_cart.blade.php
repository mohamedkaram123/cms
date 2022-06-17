@extends('frontend.layouts.app')

@section('content')
    <style>
        .selectize-dropdown,
        .selectize-input {
            padding: 10px;

        }

        .selectize-dropdown-content {
            position: fixed;
            width: 80%;
            left: 6%;
            top: 205px;
        }

        .modal-dialog-login {
            max-width: 410px;
        }

    </style>
    <section class="pt-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row aiz-steps arrow-divider">
                        <div class="col active">
                            <div class="text-center text-primary">
                                <i class="la-3x mb-2 las la-shopping-cart"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('1. My Cart') }}
                                </h3>
                            </div>
                        </div>
                        {{-- <div class="col ">
                        <div class="text-center">

                            <i class="la-3x mb-2 las la-shopping-bag"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Choose Products')}}</h3>

                        </div>
                    </div> --}}
                        <div class="col">
                            <div class="text-center">
                                <i class="la-3x mb-2 opacity-50 las la-truck"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">
                                    {{ translate('2. Delivery info') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">
                                    {{ translate('3. Payment') }}</h3>
                            </div>
                        </div>
                        {{-- <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (get_setting('multy_vendors') == 1)
        @if (auth()->check())
            @include('frontend.multi_view_carts.auth_cart')
        @else
            @include('frontend.multi_view_carts.session_cart')
        @endif
    @else
        @if (auth()->check())
            @include('frontend.view_carts.auth_cart')
        @else
            @include('frontend.view_carts.session_cart')
        @endif
    @endif
@endsection

@section('modal')
    <div class="modal fade " id="GuestCheckout">
        <div class="modal-dialog modal-dialog-login modal-dialog-zoom ">
            <div class="modal-content " style="border-radius: 10px;margin-top: 150px">

                <div class="modal-body" style="padding: unset !important">

                    <div id="insert_form" class="p-3">
                        <button type="button" class="btn btn-icon" data-dismiss="modal">
                            <i class="las la-times"></i>
                        </button>
                        <div id="form_login" class="d-none">
                            @include('frontend.login_modal')
                        </div>
                        <div id="form_register" class="d-none">
                            @include('frontend.register_modal')
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div id="recaptcha-container"></div>
@endsection

@section('script')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script type="text/javascript">
        $(".item_flag").click(function(e) {
            e.preventDefault();
            var item = $(this).data("item");
            var loca = $(this).data("item_loc");
            var img = loca + "/" + item.code.toLowerCase() + ".png";

            $("#title_flag").html('<img src="{{ static_asset('assets/img/placeholder.jpg') }}"' +
                'data-src="' + img + '"' +
                ' class="mr-1 lazyload" alt="' + item.tel + '" height="11">' +
                '<span class=" language">+ ' + item.tel + '</span>'
            );
            $("#country_tel").val(item.tel)
            console.log($(this).data("item"));
        })

        function addFilesShow() {
            if ($("#choose_file").hasClass("d-none")) {
                $("#btn_show_file").html("<i class='la la-minus' ></i> {{ translate('Add Files') }}");
                $("#choose_file").removeClass("d-none");
            } else {
                $("#btn_show_file").html("<i class='la la-plus' ></i> {{ translate('Add Files') }}");
                $("#choose_file").addClass("d-none");
            }
        }

        function addNotes() {
            if ($("#text_notes").hasClass("d-none")) {
                $("#text_notes").removeClass("d-none");
            } else {
                $("#text_notes").addClass("d-none");
            }
        }
        $("#btn_register").click(function(e) {
            handleBtnLoad($(this), "{{ translate('Create Account') }}")
            let btn = $(this);
            e.preventDefault();


            data = {
                "_token": '{{ csrf_token() }}',
                "email": $("#register_email").val(),
                "phone": $("#register_phone").val(),
                "country_code": $("#register_country_tel").val(),
                "country_id": $("#country_register").val(),
                "name": $("#name_register").val(),
                "password": $("#pass").val(),
                "password_confirmation": $("#pass_conf").val()
            }

            $.ajax({
                type: "post",
                url: "{{ route('register_user') }}",
                data: data,
                success: function(res) {

                    if (res.status == 0) {
                        handleBtn(btn, "{{ translate('Create Account') }}")
                        if ($.type(res.msg) === "string") {

                        } else {
                            let req_data = {
                                "name": "",
                                "email": "",
                                "password": "",
                                "phone": ""
                            }
                            for (let [key, value] of Object.entries(req_data)) {

                                if (typeof res.msg[key] === 'undefined' || res.msg[key] === null) {



                                    if ($("#email_input").val() != "") {

                                        if (key == "email") {
                                            $("#register_mail_group").addClass("d-none")
                                        }

                                    } else {
                                        if (key == "phone") {
                                            $("#register_phone_row").addClass("d-none")
                                        }
                                    }
                                    $(`#${key}_required`).text("");

                                } else {
                                    if (key == "email") {
                                        $("#register_mail_group").removeClass("d-none")
                                    }

                                    if (key == "phone") {
                                        $("#register_phone_row").removeClass("d-none")
                                    }



                                    $(`#${key}_required`).text(res.msg[key][0]);
                                }



                            }
                        }
                    } else {
                        location.href = res.url;
                    }


                }
            });

        });
        // $("#email_input").change(function(e) {
        //     console.log({
        //         e: e.target.value
        //     });
        //     $("#register_email").val(e.target.value);
        // });
        $(".check_product_all").change(function(e) {
            e.preventDefault();

            $(".check_product").trigger("click");



        });

        $("#session_btn").click(function(e) {
            e.preventDefault();

        });
        $('.countries').selectize({
            searchField: 'search-text',
            render: {
                option: function(data, escape) {
                    return '<div class="form-control">' +
                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                        '<span class="title">' + escape(data.text) + '</span>' +
                        '<span class="code">' + escape(data.code) + '</span>' +
                        '</div>';
                },
                item: function(data, escape) {
                    return '<div>' +
                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                        escape(data.text) +
                        escape(data.code) +
                        '</div>';
                }
            }
        });

        $('.list-items').selectize({
            render: {
                option: function(data, escape) {
                    return '<div>' +
                        '<span class="title">' + escape(data.text) + '</span>' +
                        '</div>';
                },

                item: function(data, escape) {
                    return '<div>' +
                        escape(data.text) +
                        '</div>';
                }
            }
        });

        $("#btn_phone").click(function(e) {
            e.preventDefault();

            $("#choose_methd").addClass("d-none")

            $("#phone").removeClass("d-none")
            $("#btn_submit").removeClass("d-none")

        });

        $("#btn_email").click(function(e) {
            e.preventDefault();

            $("#choose_methd").addClass("d-none")


            $("#email").removeClass("d-none")
            $("#btn_submit").removeClass("d-none")

        });

        function removeFromCartView(e, key, id) {
            e.preventDefault();
            removeFromCart(key, id);
        }

        function updateQuantity(key, element) {
            $("#total_price_" + key).html(
                "<img src='{{ url('/public/assets/img/loader.gif') }}' style='height:40px;'    />")
            $("#btn_plus_" + key).attr("disabled", "disabled")
            $("#btn_minus_" + key).attr("disabled", "disabled")



            $.post('{{ route('cart.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                quantity: element.value,
                cart_id: $(element).data("cart_id")
            }, function(data) {

                updateNavCart();
                $('#cart-summary').html(data);
            });
        }

        function showCheckoutModal() {

            $("#form_login").removeClass("d-none")
            $("#form_register").addClass("d-none")
            handleLoginPhone()
            $('#GuestCheckout').modal();
        }

        var count = 30;
        var counter;


        function handleLoginPhone() {
            $("#require_phone").text("")
            $("#require_email").text("")
            $("#require_code").text("")
            $("#choose_methd").removeClass("d-none")
            $("#email").addClass("d-none")
            $("#phone").addClass("d-none")
            $("#btn_submit").addClass("d-none")
            $("#code").addClass("d-none")
            $("#btn_code").addClass("d-none")
            $("#btn_counter").addClass("d-none")

            $("#country_tel").removeAttr("disabled")
            $("#email_input").removeAttr("disabled")
            $("#phone_input").removeAttr("disabled")

            $("#btn_counter_data").attr("disabled", "disabled");

            clearInterval(counter);
            count = 30;
            handleBtn($("#btn_submit_data"), "{{ translate('Login') }}")

        }


        function handleBtnLoad(btn, text) {
            btn.html(text +
                "<img src='{{ url('/public/assets/img/loading.gif') }}' style='height:20px;margin-inline:20px'    /> "
            )
            btn.attr("disabled", "disabled")

        }


        function handleBtn(btn, text) {
            btn.html(text)
            btn.removeAttr("disabled")

        }


        function timer() {
            count = count - 1;
            if (count <= 0) {
                clearInterval(counter);
                $("#btn_counter_data").removeAttr("disabled");
                $("#btn_counter_data").text("{{ translate('Re-transmitter') }}")
                //counter ended, do something here
                return;
            }
            $("#btn_counter_data").text("{{ translate('Re-transmitter') }}" + " " + count)

            //Do code for showing the number of seconds here
        }

        function addVerficationCode() {

            $("#btn_submit").addClass("d-none");
            $("#code").removeClass("d-none")
            $("#btn_code").removeClass("d-none")
            $("#btn_counter").removeClass("d-none")
            counter = setInterval(timer, 1000); //1000 will  run it every 1 second

            timer()


        }

        $("#btn_submit_data").click(function(e) {
            e.preventDefault();

            var btn = $(this);
            handleBtnLoad($(this), "{{ translate('Login') }}")


            var check_require = true
            if ($("#email").hasClass("d-none")) {
                if ($("#phone_input").val() == "") {
                    check_require = false
                    $("#require_phone").text("{{ translate('please enter your phone') }}")
                    handleBtn($(this), "{{ translate('Login') }}")

                }
            } else {
                if ($("#email_input").val() == "") {
                    check_require = false

                    $("#require_email").text("{{ translate('please enter your email') }}")
                    handleBtn($(this), "{{ translate('Login') }}")

                }
            }

            if (check_require) {


                data = {
                    "_token": '{{ csrf_token() }}',
                    "email": $("#email_input").val(),
                    "phone": $("#phone_input").val(),
                    "country_tel": $("#country_tel").val()
                }

                $.ajax({
                    type: "post",
                    url: "{{ route('cart.login.submition') }}",
                    data: data,
                    success: function(res) {

                        if (res.status == 0) {
                            if ($("#email_input").val() == "") {
                                $("#register_mail_group").removeClass("d-none")

                            } else {
                                $("#register_email").val($("#email_input").val());
                                // $("#register_phone").val("");

                                // $("#register_country_tel").val("");
                                $("#register_mail_group").addClass("d-none")

                            }

                            if ($("#phone_input").val() != "" && $("#country_tel").val() != "") {
                                $("#register_email").val("");


                                $("#register_phone").val($("#phone_input").val());

                                $("#register_country_tel").val($("#country_tel").val());
                                $("#register_phone_row").addClass("d-none")

                                //  $("#register_country_tel").val($("#country_tel").val());
                            } else {
                                $("#register_phone").val("");
                                $("#register_phone_row").removeClass("d-none")

                            }

                            $("#form_login").addClass("d-none")
                            $("#form_register").removeClass("d-none")

                            $("#email_input").val("");
                            $("#phone_input").val("");


                        } else if (res.status == 1) {



                            if ($("#email").hasClass("d-none")) {
                                $("#phone_input").attr("disabled", "disabled")
                                $("#country_tel").attr("disabled", "disabled")
                                $("#require_phone").text("")


                                var phone = `+${$("#country_tel").val() + $("#phone_input").val()}`;
                                phoneAuth(phone)
                            } else {
                                $("#email_input").attr("disabled", "disabled")
                                $("#require_email").text("")

                            }
                            addVerficationCode()


                        }
                    }
                });
            }


        });

        @if (!Auth::check())
            const firebaseConfig = {
                apiKey: "{{ get_setting('API KEY FIREBASE') }}", ///  "AIzaSyAGr-cMpw_CPFYQyK3DM33Uviy03peqKW8",
                authDomain: "{{ get_setting('AUTH DOMAIN FIREBASE') }}", // "loginotp-30c7e.firebaseapp.com",
                projectId: "{{ get_setting('PROJECT ID FIREBASE') }}", // "loginotp-30c7e",
                storageBucket: "{{ get_setting('STORAGE BUCKET FIREBASE') }}", // "loginotp-30c7e.appspot.com",
                messagingSenderId: "{{ get_setting('MESSAGING SENDER ID FIREBASE') }}", //"114147845669",
                appId: "{{ get_setting('APP ID FIREBASE') }}", //"1:114147845669:web:5ede7ce51313344798c1cc",
                measurementId: "{{ get_setting('MEASUREMENT ID FIREBASE') }}", // "G-2YTC08Y2CP"
            };

            firebase.initializeApp(firebaseConfig);
            render()
        @endif
        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: "invisible"
            });
            recaptchaVerifier.render();
        }


        function phoneAuth(phone) {

            firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier).then(function(confirmationResult) {
                //s is in lowercase
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;

                // resendIncrement += 1
                // localStorage.setItem("resendIncrement", resendIncrement);

                // $("#resend_increment").text(`(${resendIncrement}\\3)`);

            }).catch(function(error) {

                // alert(error.message);
            });
        }

        function codeverify(code) {

            coderesult.confirm(code).then(function(result) {


                data = {
                    "_token": '{{ csrf_token() }}',
                    "email": $("#email_input").val(),
                    "phone": $("#phone_input").val(),
                    "code": $("#code_input").val(),
                    "country_tel": $("#country_tel").val()

                }

                $.ajax({
                    type: "post",
                    url: "{{ route('cart.login.submit.code') }}",
                    data: data,
                    success: function(res) {
                        if (res.status == 0) {

                            $("#require_code").text(res.msg)

                            handleBtn(btn, "{{ translate('Verification') }}")

                        } else if (res.status == 1) {
                            window.location.reload();
                        }
                    }
                });

            }).catch(function(error) {


                $("#require_code").text("{{ translate('verify code Invalid') }}")

                handleBtn($("#btn_code_data"), "{{ translate('Verification') }}")
            });




        }



        function make_register(view) {
            $("#title_modal").html("{{ translate('Register') }}")
            $("#insert_form").html(view)

        }


        $("#btn_code_data").click(function(e) {
            e.preventDefault();

            var btn = $(this);
            handleBtnLoad(btn, "{{ translate('Verification') }}")

            var check_require = true
            if ($("#code_input").val() == "") {
                check_require = false
                $("#require_code").text("{{ translate('please enter verfication code') }}")
                handleBtn($(this), "{{ translate('Verification') }}")

            }



            if (check_require) {

            }
            console.log({
                email: $("#email_input").val()
            });
            if ($("#email_input").val() != "") {
                data = {
                    "_token": '{{ csrf_token() }}',
                    "email": $("#email_input").val(),
                    "phone": $("#phone_input").val(),
                    "code": $("#code_input").val(),
                    "country_tel": $("#country_tel").val()

                }

                $.ajax({
                    type: "post",
                    url: "{{ route('cart.login.submit.code') }}",
                    data: data,
                    success: function(res) {
                        if (res.status == 0) {

                            $("#require_code").text(res.msg)

                            handleBtn(btn, "{{ translate('Verification') }}")

                        } else if (res.status == 1) {
                            window.location.reload();
                        }
                    }
                });

            } else {
                codeverify($("#code_input").val())
            }

        });

        $("#btn_counter_data").click(function(e) {
            e.preventDefault();
            if ($("#email_input").val() != "") {
                data = {
                    "_token": '{{ csrf_token() }}',
                    "email": $("#email_input").val(),
                    "phone": $("#phone_input").val(),
                    "country_tel": $("#country_tel").val()

                }

                $.ajax({
                    type: "post",
                    url: "{{ route('cart.login.submition') }}",
                    data: data,
                    success: function(res) {
                        counter = setInterval(timer, 1000); //1000 will  run it every 1 second
                        timer()

                    },
                    catch: function(err) {
                        console.log({
                            err
                        });
                    }
                });

            } else {
                var phone = `+${$("#country_tel").val() + $("#phone_input").val()}`;
                phoneAuth(phone)
            }


            $("#btn_counter_data").attr("disabled", "disabled");

            clearInterval(counter);
            count = 30;


            counter = setInterval(timer, 1000); //1000 will  run it every 1 second
            timer()


        });


        // choose products

        let arr = [];

        $(".check_product").change(function(e) {
            e.preventDefault();



            let owner_id = $(this).data("owner_id");
            let product_id = $(this).data("product_id");
            let digital = $(this).data("digital");
            let variant = $(this).data("variant");


            let data = {
                owner_id,
                product_id,
                digital,
                variant
            }

            if (arr.length > 0) {
                var check = false;
                arr.forEach(item => {
                    if (item.digital != digital) {
                        check = true;
                    }
                });
                if (!check) {
                    if ($(this).prop('checked')) {
                        arr.push(data);

                    } else {
                        arr = arr.filter(item => `${item.product_id + item.variant}` !== `${product_id + variant}`);

                    }
                } else {
                    $(this).prop('checked', !$(this).prop('checked'));

                    AIZ.plugins.notify('warning',
                        "{{ translate('not allowed choose digital products and normal products') }}");

                }

            } else {
                if ($(this).prop('checked')) {
                    arr.push(data);

                } else {
                    arr = arr.filter(item => `${item.product_id + item.variant}` !== `${product_id + variant}`);

                }
            }
            console.log({
                arr
            });

            $("#products_btn").val(JSON.stringify(arr))

        });




        function removeArr(owner_id) {
            arr = arr.filter(function(obj) {
                return obj.owner_id !== owner_id;
            });
            arr = myArra
        }


        $(".form-default").submit(function(e) {

            @if (auth()->check())
                if (arr.length != 0) {


                } else {

                    e.preventDefault();

                    AIZ.plugins.notify('warning', "{{ translate('Please choose at least one product') }}");

                }
            @endif


        });



        $("#choose_all").click(function(e) {
            e.preventDefault();


            $(".check_product").trigger("click");

            if (arr.length == 0) {
                $(this).removeClass("active")
            } else {
                $(this).addClass("active")
            }

            ///register



        });


        $("body").on("click", "#ey_p_bt", function(e) {
            toggle_pass()
        });

        // $("#ey_pc_bt").click(function(e) {
        //     e.preventDefault();
        //     toggle_pass_confirm()
        // });

        $("body").on("change", "#pass", function(e) {

            $("#pass_conf").val(e.target.value);

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
    </script>
@endsection

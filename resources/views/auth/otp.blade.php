@extends('frontend.layouts.app')

@section('style')
@endsection
@section('content')
    {{-- {{
    dd(getCookiess("BOLLA"))
}} --}}
    <div style="margin-block: 20px;" class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative col-md-6 col-12">
            <div style="border-radius: 10px;padding:40px" class="card text-center">
                <h6>{{ translate('Please enter the code') }}<br> </h6>
                <div> <span>{{ translate('sent to') }}</span> <small>{{ "+($tel) $phone" }}</small> </div>
                {{-- <div id="otp"  class="inputs d-flex flex-row justify-content-center mt-2"> --}}
                <form method="POST" style="direction: ltr" id="form_send_code" action="{{ route('register_otp_data') }}"
                    style="margin: 10px;justify-content:space-around" class="digit-group " data-group-name="digits"
                    data-autosubmit="false" autocomplete="off">
                    @csrf

                    <div class="d-flex flex-row">
                        <input class="form-control input-num-otp" type="text" id="digit-1" name="digit-1"
                            data-next="digit-2" />


                        <input class="form-control input-num-otp" type="text" id="digit-2" name="digit-2" data-next="digit-3"
                            data-previous="digit-1" />

                        <input class="form-control input-num-otp" type="text" id="digit-3" name="digit-3" data-next="digit-4"
                            data-previous="digit-2" />

                        <input class="form-control input-num-otp" type="text" id="digit-4" name="digit-4" data-next="digit-5"
                            data-previous="digit-3" />

                        <input class="form-control input-num-otp" type="text" id="digit-5" name="digit-5" data-next="digit-6"
                            data-previous="digit-4" />


                        <input class="form-control input-num-otp" type="text" id="digit-6" name="digit-6"
                            data-next="digit-1" data-previous="digit-5" />

                    </div>

                </form>
                {{-- </div> --}}
                <div class="mt-4"> <button class="btn btn-primary "
                        id="verify">{{ translate('verification') }}</button> </div>
                <div class="mt-3 content d-flex justify-content-center align-items-center">
                    <span>{{ translate("Didn't get the code ?") }}</span> <a href="#" id="resend_code"
                        class="text-decoration-none ms-3">{{ translate('resend code') }}</a> <span
                        id="resend_increment">(1/3)</span> </div>
            </div>
        </div>
    </div>


    <div id="recaptcha-container"></div>
@endsection
@section('script')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script type="text/javascript">
        const firebaseConfig = {
            apiKey: "{{ get_setting('API KEY FIREBASE') }}", ///  "AIzaSyAGr-cMpw_CPFYQyK3DM33Uviy03peqKW8",
            authDomain: "{{ get_setting('AUTH DOMAIN FIREBASE') }}", // "loginotp-30c7e.firebaseapp.com",
            projectId: "{{ get_setting('PROJECT ID FIREBASE') }}", // "loginotp-30c7e",
            storageBucket: "{{ get_setting('STORAGE BUCKET FIREBASE') }}", // "loginotp-30c7e.appspot.com",
            messagingSenderId: "{{ get_setting('MESSAGING SENDER ID FIREBASE') }}", //"114147845669",
            appId: "{{ get_setting('APP ID FIREBASE') }}", //"1:114147845669:web:5ede7ce51313344798c1cc",
            measurementId: "{{ get_setting('MEASUREMENT ID FIREBASE') }}", // "G-2YTC08Y2CP"
        };

        localStorage.setItem("resendIncrement", localStorage.getItem("resendIncrement") != null ? localStorage.getItem(
            "resendIncrement") : 0);

        var resendIncrement = parseInt(localStorage.getItem("resendIncrement"));
        $("#resend_increment").text(`(${resendIncrement}\\3)`);

        let repach = "";
        let coderesult = "";
        let otp_check = 0;
        window.onload = function() {

            render();
            if (resendIncrement < 3) {

                phoneAuth()

            } else {
                $.ajax("{{ route('setCookies.otp') }}", {
                    type: "get",
                    success: function(data) { // success callback function

                        if (data.data == 0) {
                            localStorage.removeItem("resendIncrement");
                            resendIncrement = 0
                            phoneAuth()

                        }
                    },
                    error: function(err) { // error callback
                        console.log({
                            err
                        });
                    }
                });

            }

        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: "invisible"
            });
            recaptchaVerifier.render();
        }


        function phoneAuth() {
            //get the number
            // var number = document.getElementById('phone').value;
            var phone = "+" + "{{ $tel . $phone }}";
            console.log({
                phone
            });
            //phone number authentication function of firebase
            //it takes two parameter first one is number,,,second one is recaptcha
            firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier).then(function(confirmationResult) {
                //s is in lowercase
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;

                resendIncrement += 1
                localStorage.setItem("resendIncrement", resendIncrement);

                $("#resend_increment").text(`(${resendIncrement}\\3)`);
                //  console.log(coderesult);
                //alert("Message sent");
            }).catch(function(error) {



                Swal.fire({
                    icon: 'error',
                    text: error.message,
                    confirmButtonText: "{{ translate('ok') }}",
                    confirmButtonColor: '#e62e04',

                })
                // alert(error.message);
            });
        }

        function codeverify(btn) {
            var digit1 = document.getElementById('digit-1').value;
            var digit2 = document.getElementById('digit-2').value;
            var digit3 = document.getElementById('digit-3').value;
            var digit4 = document.getElementById('digit-4').value;
            var digit5 = document.getElementById('digit-5').value;
            var digit6 = document.getElementById('digit-6').value;
            code = `${digit1}${digit2}${digit3}${digit4}${digit5}${digit6}`


            if (code.toString().length == 6) {
                if (coderesult != "") {
                    btn.append(
                        '<img style="marginInline:10" src={{ asset('public/assets/img/loading.gif') }} width="15px" height="15px" />'
                        );
                    btn.attr("disabled", true);
                    coderesult.confirm(code).then(function(result) {
                        // alert("Successfully registered");
                        var user = result.user;
                        $("#form_send_code").submit();
                        console.log(user);
                    }).catch(function(error) {


                        btn.html("{{ translate('verification') }}")
                        btn.removeAttr("disabled");


                        // alert("{{ translate('The code you entered is wrong') }}")


                        Swal.fire({
                            icon: 'error',
                            text: "{{ translate('The code you entered is wrong') }}",
                            confirmButtonText: "{{ translate('ok') }}",
                            confirmButtonColor: '#e62e04',

                        })
                        //    alert(error.message);
                    });
                } else {

                    Swal.fire({
                        icon: 'error',
                        text: "{{ translate('please wait 12 hours to return resend code') }}",
                        confirmButtonText: "{{ translate('ok') }}",
                        confirmButtonColor: '#e62e04'

                    })
                }

            } else {

                Swal.fire({
                    icon: 'error',
                    text: "{{ translate('The code you entered is wrong please check number code') }}",
                    confirmButtonText: "{{ translate('ok') }}",
                    confirmButtonColor: '#e62e04'

                })


                btn.html('{{ translate('verification') }}');
                btn.removeAttr("disabled");

            }

        }

        firebase.initializeApp(firebaseConfig);


        $(document).ready(function() {


            $("#resend_code").click(function(e) {
                e.preventDefault();
                if (resendIncrement >= 3) {
                    $.ajax("{{ route('setCookies.otp') }}", {
                        type: "get",
                        success: function(data) { // success callback function

                            if (data.data == 0) {
                                localStorage.removeItem("resendIncrement");
                                resendIncrement = 0
                                phoneAuth()

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: "{{ translate('You have exceeded the maximum number of messages') }}",
                                    confirmButtonText: "{{ translate('ok') }}",
                                    confirmButtonColor: '#e62e04',

                                })
                            }
                        },
                        error: function(err) { // error callback
                            console.log({
                                err
                            });
                        }
                    });

                } else {
                    phoneAuth()

                }

            });

            $("#verify").click(function(e) {
                e.preventDefault();

                codeverify($(this))



            });

            $('.digit-group').find('input').each(function() {
                $(this).attr('maxlength', 1);
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent().parent());

                    if (e.keyCode === 8 || e.keyCode === 37) {
                        var prev = parent.find('input#' + $(this).data('previous'));

                        if (prev.length) {
                            $(prev).select();
                        }
                    } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e
                            .keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e
                        .keyCode === 39) {
                        var next = parent.find('input#' + $(this).data('next'));

                        if (next.length) {
                            $(next).select();
                        } else {
                            if (parent.data('autosubmit')) {
                                parent.submit();
                            }
                        }
                    }
                });
            });
        })
    </script>
@endsection

@extends('layouts.master-layouts')

@section('title')
register
@endsection
 {!! NoCaptcha::renderJs() !!}
@section('body')

<body class="index-background" data-layout="horizontal">
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    @endsection
    @section('content')

    <div class="account-pages my-5">
        <div>
            <form id="register_form" method="POST" action="/auth-register">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div style="background:#30200ac7">
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-primary p-4">
                                            <h6 class="title-font title-color">Account Detail</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body pt-0 title-color">
                                <div id="error_div">

                                </div>


                                <div class="p-2">
                                    <div class="form-group">
                                        <label for="username">Username<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Enter username" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" value="{{ old('password') }}" name="password" id="password" placeholder="Enter password" required>
                                        <span style="color:black;padding-right:23px" toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="verify_password">Verify Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" value="{{ old('verify_password') }}" name="verify_password" id="verify_password" placeholder="Enter Verify Password" required>
                                        <p id="match_password" class="text-danger">Password is not matched!</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="referrer">Referrer</label>
                                        <input type="number" class="form-control" value="{{ old('referrer') }}" name="referrer" id="referrer" placeholder="Enter Referrer" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div style="background:#30200ac7">
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-primary p-4">
                                            <h5 class="title-font title-color">Personal Detail</h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body pt-0 title-color">
                                <div class="p-2">
                                    <div class="form-group">
                                        <label for="ig_id">Player ID(In Game Id)<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" value="{{ old('ig_id') }}" name="ig_id" id="ig_id" placeholder="Enter Player ID" required>
                                    </div>
                                     <div class="form-group">
                                        <label for="ign">In Game Nickname(IGN)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('ign') }}" name="ign" id="ign" placeholder="Enter IGN" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="phone_number">Phone Number<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" value="{{ old('phone_number') }}" name="phone_number" id="phone_number" placeholder="Enter phone" required>
                                        <span id="verified" style="display:none;color:green;">Verified Successfully !</span>

                                        <!-- <p id="phone_verified" class="text-info p-2">verified!</p> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email Address<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="find_us">How did you find us?</label>
                                        <input type="text" class="form-control" value="{{ old('find_us') }}" name="find_us" id="find_us" placeholder="Enter how to find us" required>
                                    </div>
                                    <div class="form-group text-danger">
                                        *Notice: Only one account is allowed per personal, house, location!
                                        Multi-accounts are not allowed!
                                    </div>
                                    <div class="">
                                                                                <h6 style="text-align:center;margin-top:4%;" class="title-font title-color">Smart Captcha</h6>

                                      
                                        <center>
                                            <p style="color:grey;text-align:center;letter-spacing:2px;font-size: 31px;background-image:url('{{ asset("assets/images/captcha/captcha.png")}}')">
                                                {{$smart_captcha}}
                                            </p>
                                        </center>
                                        <center>
                                            <input type="text" required id="smart_answer_captcha" name="smart_answer_captcha" placeholder="" aria-describedby="exampleHelpText" style="margin-top:1%;margin-bottom:5%;width: 70%;color:black;" required>
                                            <input type="hidden" name="result_smart_captcha" id="result_smart_captcha" placeholder="" value="<?php echo $smart_captcha; ?>">
                                        </center>
                                    </div>
                                    <div class="form-group">
                                          <div> {!! app('captcha')->display() !!}</div>
                                    </div>
                                    <div class="mt-4 form-group">
                                        <button class="btn btn-primary btn-block waves-effect waves-light title-font" type="button" style="font-size:1.5rem" onclick="Register()">CREATE ACCOUNT</button>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>



                </div>
            </form>
            <div class="mt-5 text-center">
                <p style="color:white;">Already have an account ? <a href="auth-login" class="font-weight-medium title-color">
                        Login</a> </p>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="verifyModal" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Enter OTP</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p id="resend_msg" style="text-align:center;color:green;"></p>
                    <p id="error_msg" style="text-align:center;color:green;"></p>
                    <div class="text-center">
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="text" id="otp" name="otp" placeholder="OTP" maxlength="6">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="btn btn-primary" id="otp_submit">
                                Submit
                            </button>
                        </div>
                        <div class="container-login100-form-btn">
                            <button class="btn btn-info" id="otp_resend">
                                Resend
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->


            </div>
        </div>
    </div>



    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log(location.search)
            if (location.search) {
                var referrer_id = location.search.split('=')[1];
                $('#referrer').val(referrer_id);
            }
            $(".toggle-password").click(function() {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $("#match_password").hide();
            $('#password').keyup(function() {
                MatchPassword();
            })
            $('#verify_password').keyup(function() {
                MatchPassword();
            })

            $("#otp_submit").click(function() {
                $.ajax({
                    type: "POST",
                    url: "/auth-register/verify-number",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        otp: $('#otp').val(),
                        verify_number:window.localStorage.getItem('key')
                    },
                    success: function(dataResult) {
                        if (dataResult == 'success') {
                            $("#verifyModal").modal('hide');
                            $("#verified").show();
                            $('#register_form').submit();
                        } else if (dataResult == 'fail') {
                            $("#error_msg").html('Invalid OTP !');
                        }

                    }
                });
            });
            $("#otp_resend").click(function() {
                $.ajax({
                    type: "POST",
                    url: "/auth-register/resend-number",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        phone_number: $('#phone_number').val(),
                        verify_number:window.localStorage.getItem('key')
                        
                    },
                    success: function(dataResult) {
                        if (dataResult == 'success') {
                            $("#resend_msg").html('OTP Resend Successfully !');
                        }
                    }
                });
            });
        })

        function MatchPassword() {
            if ($('#password').val() != $('#verify_password').val()) {
                $("#match_password").show();
            } else {
                $("#match_password").hide();
            }
        }

        function Register() {
            password = $('#password').val();
            verify_password = $('#verify_password').val();

             if(password==''){
                alert('Input password!');
                return;
            }
            if (password != verify_password) {
                $("#match_password").show();
                return;
            }
            user_answer = $("#smart_answer_captcha").val();

            result = $("#result_smart_captcha").val();
             var captcha = $('#g-recaptcha-response').val();
 
            if (user_answer != result) {
                alert('Invalid Smart Captcha!');
            } else {

                if ($('#phone_number').val() != '') {
                    $.ajax({
                        type: "POST",
                        url: "/auth-register/send-number",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            phone_number: $('#phone_number').val(),
                            name: $('#name').val(),
                            email: $('#email').val(),
                            ig_id: $('#ig_id').val(),
                            captcha
                        },
                        success: function(dataResult) {
                            /*var dataResult = JSON.parse(dataResult);*/

                           if(Number(dataResult)>0) {
                                alert('Sent verification code successfully!');
                                $("#verifyModal").modal('show');
                                window.localStorage.setItem('key',dataResult);
                            }else {
                                displayValidationError(dataResult)
                            } 
                        }
                    });
                } else {
                    alert("Mobile number can not be blank !");
                }

                // $('#register_form').submit();
                $("match_password").hide();
            }
        }

        function displayValidationError(dataResult) {
            var error_data = JSON.parse(dataResult);
            console.log(error_data);
            if (error_data) {
                if (error_data.email && error_data.email.length > 0) {
                    error_data.email.forEach(item => {
                        $('#error_div').append(`<label class="error">${item}</label>`)
                    })
                }
                if (error_data.name && error_data.name.length > 0) {
                    error_data.name.forEach(item => {
                        $('#error_div').append(`<label class="error">${item}</label>`)
                    })
                }
                if (error_data.phone_number && error_data.phone_number.length > 0) {
                    error_data.phone_number.forEach(item => {
                        $('#error_div').append(`<label class="error">${item}</label>`)
                    })
                }
                if (error_data.ig_id && error_data.ig_id.length > 0) {
                    error_data.ig_id.forEach(item => {
                        $('#error_div').append(`<label class="error">${item}</label>`)
                    })
                }
                 if (error_data['g-recaptcha-response'] && error_data['g-recaptcha-response'].length > 0) {
                    error_data['g-recaptcha-response'].forEach(item => {
                        $('#error_div').append(`<label class="error">${item}</label>`)
                    })
                }
            }
        }
    </script>
    @endsection
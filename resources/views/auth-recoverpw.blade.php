@extends('layouts.master-layouts')

@section('title')
Reset Password
@endsection
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
    <div class="home-btn d-none d-sm-block">
        <a href="{{url('index')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card overflow-hidden" style="background:#30200ac7">
                        <div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="p-4">
                                        <h5 class="title-font title-color"> Reset Password</h5>
                                    </div>
                                    <div class="p-4">
                                        @if ($errors->any())
                                        <label for="email" class="error">{{ $errors->first('email') }}</label><br>
                                        <label for="phone_number" class="error">{{ $errors->first('phone_number') }}</label><br>
                                        @endif
                                        @if(Session::get('wrong_email'))
                                        <label for="email" class="error">{{ Session::get('wrong_email') }}</label><br>
                                        @endif
                                         @if(Session::get('wrong_number'))
                                        <label for="phone" class="error">{{Session::get('wrong_number') }}</label>
                                        @endif 
                                        @if(Session::get('success'))
                                        <label for="phone" class="text-success">{{Session::get('success') }}</label>
                                        @endif 
                                        </div>
                                     
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body pt-0"> 
                            <div class="p-2">
                            <form class="form-horizontal" action="{{url('/reset-password')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email" class="title-color">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number" class="title-color">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                                placeholder="Enter phone number" required>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary w-md waves-effect waves-light"
                                                    type="submit">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p style="color:white">Remember It ? <a href="{{url('auth-login')}}" class="font-weight-medium title-color"> Sign In here</a> </p>
                    </div>

                </div>
            </div>
        </div>
    </div>



    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    @endsection
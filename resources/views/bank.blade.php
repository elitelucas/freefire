@extends('layouts.master-layouts')

@section('title')
Bank
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


    <div class="total-content">
        <div class="text-center p-2" style="background-color: #0782C0">
            <h3 class="title-font title-color">
                BANK
            </h3>
        </div>
        @if(Session::get('no-id'))
        <h7 class="text-danger title-font">{{Session::get('no-id')}}
        </h7>
        @endif
         @if ($errors->has('g-recaptcha-response'))
    <div class="p-3 text-center">

        <span class="help-block text-danger">
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
        </span>
    </div>
    @endif

    <div class="row mt-2">
        <div class="col-md-6 text-center">
            <div class=" mb-2">
                <h5 class="title-font title-color">
                    Your total diamond is: {{Auth::user()->diamond}}
                </h5>
            </div>
            <div class=" mb-2">
                <h5 class="title-font title-color">
                    Your total inr is: {{Auth::user()->inr}}
                </h5>
            </div>
            <div class="mb-2">
                <div class="mb-2" style="color:white">
                    Buy diamond:
                </div>
                <form id="buy_diamond_form" action="{{ url('/bank/buy-diamond') }}" method="post" enctype="multipart/form-data">

                    <div>
                        {{csrf_field()}}
                        <select id="buy_diamond" name="buy_diamond" style="width:100%">
                            <option></option>
                            @foreach($all_buy_diamonds_limit as $item)
                            <option value="{{$item->buy_diamonds_limit_id}}">
                                {{$item->buy_diamonds_limit_inr_amount}}&nbsp;inr-{{$item->buy_diamonds_limit_diamonds_amount}}&nbsp;diamonds
                            </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-2 mt-2">
                        {!! app('captcha')->display() !!}

                    </div>
                </form>
            </div>

            <button id="buy_button" class="btn btn-primary">
                buy
            </button>
        </div>
        <div class="col-md-6 text-center">
            <div class="mb-3">
                <img width="46%" src="{{asset('/assets/images/deposit-inr.jpg')}}">
            </div>
            <div>
                <a href="{{url('/wallet')}}">
                    <button class="btn btn-primary">
                        Deporsit INR
                    </button>
                </a>

            </div>

        </div>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
    </div>
    <form id="account-form" action="{{ route('account') }}" method="get" style="display: none;">
    </form>
    </div>
    </div>
   
   




    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
        $('#buy_button').click(function() {
            $('#buy_diamond_form').submit();
        })
    </script>



    @endsection
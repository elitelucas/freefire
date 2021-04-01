@extends('layouts.master-layouts')

@section('title')
Withdraw
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


    <div class="total-content mb-5">
        <div class="text-center p-2" style="background-color: #0782C0">
            <h3 class="title-font title-color">
                WITHDRAW
            </h3>
        </div>
          @if ($errors->has('g-recaptcha-response'))
        <div class="p-3 text-center">
    
            <span class="help-block text-danger">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
        </div>
        @endif
          @if (Session::get('withdraw_amount'))
        <div class="p-3 text-center">
            <span class="help-block text-success">
                <strong>{{ Session::get('withdraw_amount') }}</strong>
            </span>
        </div>
        @endif
        <div class="row mt-5 mb-3">
            <div class="col-md-6 text-center">
                <div class="title-color title-font mb-2">
                    AVAILABLE BALANCE TO WITHDRAW
                </div>
                <div id="user_diamond" class="title-font title-color">
                    {{Auth::user()->diamond}}&nbsp;diamond
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="title-color title-font mb-2">
                    YOUR PLAYER ID
                </div>
                <div class="title-font title-color">
                    {{Auth::user()->ig_id}}
                </div>
            </div>
        </div>
        <div class="w-50 mx-auto text-center mb-3">
            <div class="mb-2">
                <h5 class="title-color title-font">
                    Select withdraw option!
                </h5>
            </div>
            <form id="amount_form" action="{{url('/withdraw/save-amount')}}" method="post">
                    @csrf
                <div class="mb-2">
                    
                       <select id="withdraw_amount" name="withdraw_amount" class="w-100">
                        @foreach($all_withdraw_limit as $withdraw_limit)
                        <option value="{{$withdraw_limit->withdraw_limit_amount}}">{{$withdraw_limit->withdraw_limit_amount}}&nbsp;diamonds</option>
                        @endforeach
                    </select>
                   
                </div>
                    <div class="mb-2 title-color title-font">
                    Fee:&nbsp;<input type="number" id="fee" name="fee" value="{{$withdraw_fee}}" readonly>
                    </div>
                <div class="mb-2">
                 {!! app('captcha')->display() !!}
                 </div>
             </form>
        </div>

        <div class="text-center">
            <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem" onclick="withdraw()">WITHDRAW</button>
        </div>

    </div>




    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
          function withdraw(){
        var user_diamond = parseFloat($('#user_diamond').text());
        var withdraw_amount = parseFloat($('#withdraw_amount').val());
        var fee = parseFloat($('#fee').val());
        if (withdraw_amount+fee > user_diamond) {
            alert('Withdraw amount is bigger than the current diamond.');
            return;
        } else {
            $('#amount_form').submit();
        }
    }
    </script>

    @endsection
@extends('layouts.master-layouts')

@section('title')
Wallet
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


    <div class="total-content mb-5">
        <div class="text-center p-2" style="background-color: #0782C0">
            <h3 class="title-font title-color">
                MY WALLET
            </h3>
        </div>
        @if(Session::get('amount-error'))
        <div class="text-center p-3">
            <h7 class="text-danger title-font">{{Session::get('amount-error')}}
            </h7>
        </div>
        @endif

        <div class="row w-75 mx-auto pt-5">
            <div class="col-md-4">
                <div class="mb-3">
                    <h6 class="title-font title-color">My wallet</h6>
                </div>
                <div class="mb-3">
                    <a href="{{url('/wallet')}}">
                        <button class="btn btn-primary"><i class="bx bx-plus-circle"></i><br> wallet top-up</button>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="{{url('/wallet/transaction')}}">
                        <button class="btn btn-primary"><i class="bx bx-book"></i><br> transactions</button>
                    </a>
                </div>
            </div>
            <form method="post" action="{{ url('/wallet/checkout') }}">
                {{ csrf_field() }}
                <div class="col-md-8 wallet-padding">
                    <div>
                        <h6 class="title-font title-color">
                            <span>Balance</span>&nbsp;&nbsp;&nbsp;<span>&#x20B9;&nbsp;{{Auth::user()->inr}}</span>
                        </h6>
                    </div>

                    <div class="mb-3">
                        <div class="mb-2">
                            <div style="color:white">
                                Currency
                            </div>
                            <div style="color:white">
                                <input type="text" placeholder="Indian Rupee( &#x20B9;)" readonly>
                            </div>
                        </div>
                        <div>
                            <div style="color:white">
                                Enter Amount
                            </div>
                            <div>
                                <input type="number" name="deposit_amount" value="{{$inr_deposit_limit->inr_deposit_limit_min}}">
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">

                        <button class="btn btn-primary">
                            Add
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>




    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>


    @endsection
@extends('layouts.master-layouts')

@section('title')
About Us
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

    <div class="total-content">
        <div class="text-center">
            <h5 class="title-font title-color" >
                About Us
            </h5>
            <hr class="accountbottmline mb-2">

        </div>
        <div class="mb-2 title-color">
            <div class="mb-1">
                <i class="bx bx-check"></i>&nbsp;&nbsp;Freefiregame is a established digital goods and services platform for gamers. And which provides the best professional game solution for all the gamers. We sell professional and affordable game top up.

            </div>
            <div class="mb-1">
                <i class="bx bx-check"></i>&nbsp;&nbsp;In-site games for all users to earn extra diamonds rewards and they can withdraw diamonds to their game account Instantly.
            </div>
            <div class="mb-2">
                <i class="bx bx-check"></i>&nbsp;&nbsp;We conduct free fire tournament for users. They can join tournaments freely or paying small amount and win exciting tournament rewards
            </div>
            <div class="mb-2">
                We aspire to provide the best customer service and fast delivery speed to customer and with a solution that is affordable for the gamer to boost and improve gamer’s experience in playing the game.
            </div>
            <div class="mb-2">
                Currently , Freefiregame aims to provide more and more digital product & services for customer , whilst further improve our customer service and maintain our fast delivery speed.
            </div>
            <div class="mb-1">
                Have fun shopping in Freefiregame.in and talk to our customer support 24 / 7.
            </div>
        </div>
        <div class="text-center mb-4 title-color">
            <div>
                <h5 class="title-color">
                    Safe & secure service
                </h5>
            </div>
            <div class="mb-3">
                <img src="{{asset('assets/images/secure.png')}}">
            </div>
            <div>
                Freefiregame safe and secure service , if there is any issues occurs in your account by using the service in Freefiregame, don’t hesitate to contact us immediately
            </div>
        </div>
        <div class="row mb-2 title-color">
            <div class="col-md-5">
                <img width="100%" src="{{asset('/assets/images/message.png')}}">
            </div>
            <div class="col-md-7">
                <div class="mb-3">
                    Freefiregame.in
                </div>
                <div class="mb-3">
                    Email : freefiregamesite@gmail.com
                </div>
                <div class="mb-3">
                    Contact Number / WhatsApp  : +91 9999999999 (Chat Only)
                </div>
            </div>
        </div>

    </div>


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    @endsection
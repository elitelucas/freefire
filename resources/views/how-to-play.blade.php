@extends('layouts.master-layouts')

@section('title')
How to play
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
        <div class="mb-3">
            <h5 class="title-font title-color">
                HOW TO PLAY?
            </h5>
        </div>
        <div class="mb-3 title-color" >
            First, you have to <a href="{{url('auth-register')}}">Register</a> and <a href="{{url('auth-login')}}">Login</a> your game profile.
        </div>
        <div class="mb-3 title-color">
            After you login game, Verify your account by following steps there.
        </div>
        <div class="mb-3 title-color">
            Now you can change your Player from <a href="{{url('players-before')}}"> here</a>. First 2 players are available for free anytime.
        </div>
        <div class="mb-3 title-color">
            You may train a Adam. Adam will give you rewards every 10 minutes, however this is Optional command if you wish to increase your score better.
        </div>
        <div class="mb-3 title-color">
            By this time, you gather score by your chosen player to keep your balance rising. Remember to pickup score made by your Player at least once a day.
        </div>
        <div class="mb-3 title-color">
            At this point, and when you collect generated energy, you will get chance to win Foods.
        </div>
        <div class="mb-3 title-color">
            Feed your player to get stronger and healthy. When your player health is good enough, you will be able to do Attacks and win extra bonus.
        </div>
        <h6 class="mb-3 title-color">
            You have more questions not listed here?<br>
            Please Contact us : <strong>freefiregamesite@gmail.com</strong>
        </h6>
    </div>


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    @endsection
@extends('layouts.master-layouts')

@section('title')
Faq
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
                FREQUENCY ASKED QUESTIONS
            </h5>
        </div>
        <div class="mb-3 title-color">
            <h5 class="title-color">
                What is freefiregame.in ?
            </h5>
            <div>
                Freefiregame.in is a Game to play online on Laptop or Phone. You are always a winner, no chance to lose : )
            </div>
        </div>
        <div class="mb-3 title-color">
            <h5 class="title-color">
                How to improve my score in freefiregame.in ?
            </h5>
            <div>
                Refer your friends to join game, you will get more score to have a better rank.
            </div>
        </div>
        <div class="mb-3 title-color">
            <h5 class="title-color">
                What is STAR ?
            </h5>
            <div>
                STAR helps you to upgrade your player, in result you can improve your score in game.
            </div>
        </div>
        <div class="mb-3 title-color">
            <h5 class="title-color">
                What is Gems?
            </h5>
            <div>
                Gems is freefiregame.in rewards for the users. User can earn gems by playing in-site games. Gems can be converted into diamonds.
            </div>
        </div>
        <div class="mb-3 title-color" >
            <h5 class="title-color">
                What is Diamond?
            </h5>
            <div>
                Diamond is free fire mobile in-game currency. It is used to make purchase items in game.
            </div>
        </div>
        <div class="mb-3 title-color">
            <h5 class="title-color">
                What is tournament?
            </h5>
            <div>
                It is the event conducted by the freefiregame.in. Users are required to register for participating in the events. And win exciting rewards from the tournament.
            </div>
        </div>
        <div class="mb-3 title-color">
            <h5 class="title-color">
                How to register tournament?
            </h5>
            <div>
                At first users required to register/Login to the freefiregame. And post to that users are required to visit tournament page for registering the tournament.
            </div>
        </div>
        <div class="mb-3 title-color">
            <h5 class="title-color">
                How many members are allowed to register in tournament?
            </h5>
            <div>
                It depends on the limitation of the tournament entry given by freefiregame.in
                For example, If limitation is 20/match. then 20 members are allowed to register for one tournament
            </div>
        </div>
    </div>


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    @endsection
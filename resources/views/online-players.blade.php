@extends('layouts.master-layouts')

@section('title')
Online Players
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
        <div class="text-center p-2" style="background-color: #0782C0">
            <h2 class="title-font title-color">
                Online Players
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" class="pt-3 pb-3" width="100%" style="background-size: 100% 100%;  background-position:100%">
            <div class="mt-3 mb-3 text-center">
                <h6 class="title-font title-color">Recent online players</h6>
            </div>
             @foreach($all_online_players as $item)
            <div class="p-5 row">
                <div class="col-md-6">
                    <div>
                        <img width="100%" src="{{$item->user->avatar}}">
                    </div>
                </div>
                <div class="col-md-6">
                        <h6 style="word-break: break-all;" class="title-color title-font">{{$item->user->name}}</h6>
                </div>
            </div>
             @endforeach
            <div class="mt-3 mb-3 text-center">
                <h6 class="title-font title-color">{{$players_count}}&nbsp; Active players</h6>
            </div>
        </div>

    </div>


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    @endsection
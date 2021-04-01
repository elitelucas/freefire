@extends('layouts.master-layouts')

@section('title')
Collect
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

    <div class="mainbodybgdailygift">
        <div class="text-center p-2" style="background-color: #0782C0">
            <h2 class="title-font title-color">
                COLLECT
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" width="100%" style="background-size: 100% 100%; height:fit-content; background-position:100%;background-color:#30200ac7">
            <div class="text-center">
                <h5 class="mb-2 title-font title-color">YOU WON!
                </h5>
                <h6 class="mb-2 title-font title-color">
                    <span id="collected_gems">{{$collected_gems}}</span>GEMS!
                </h6>
            </div>
            <div class="text-center">
                <img class="collect-main-image"  
                src="{{asset('/assets/images/players/'.$player_image)}}">
            </div>
            @if($food!="none")
            <div class="collect-food">
                <div>
                    <h5 class="title-font  title-color">
                        YOU WON!
                    </h5>
                </div>
                <div >
                    <img class="w-100" src="{{asset('/assets/images/stores/'.$food)}}">
                </div>
            </div>
            @endif
        </div>

        <div class="text-center collect-button-margin" >
            <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
        </div>
        <form id="account-form" action="{{ route('account') }}" method="get" style="display: none;">
        </form>
    </div>



    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
   
    @endsection
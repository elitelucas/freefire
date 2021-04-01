@extends('layouts.master-layouts')

@section('title')
Daily Gift
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
                DAILY GIFTS
            </h2>
        </div>
        <div id="infoDiv" class="text-center pt-2 pb-2 title-font" style="font-size: 2rem; color: #fb00ff;">
            YOU RECEIVED <span id='displayGift' style="color:#0008ff"></span>&nbsp;&nbsp;GEMS FOR DAILY GIFT.
        </div>
        <div id="mainGift" width="100%"  class="daily-gift-bg-img daily-gift-div">
            <div class="pt-5 pb-5 text-center">
                <h5 class="title-font" style="color:black">Choose your gift!</h5>
            </div>
            <div class="row dailygiftmaindiv text-center">
                <div class="col-4">
                    <a href="javascript:void(0)" data-cur="2" class="dailyGift">
                        <img class="w-100 animatebounce imggift" src="{{asset('/assets/images/daily-gifts/Gift-box.png')}}">
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0)" data-cur="2" class="dailyGift">
                        <img class="w-100 animatebounce imggift" src="{{asset('/assets/images/daily-gifts/Gift-box.png')}}">
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0)" data-cur="2" class="dailyGift">
                        <img class="w-100 animatebounce imggift" src="{{asset('/assets/images/daily-gifts/Gift-box.png')}}">
                    </a>
                </div>
            </div>
        </div>

        <div id="showSecond" width="100%" style="background-size: 100% 100%; height:500px; background-position:100%;" class="daily-gift-bg-img">
            <div style="float: left;width: 100%;color: black; margin-bottom: 100px; margin-top: 100px;">
                <div class="text-center">
                    <h3 class="title-font title-color">Your Prize today is <br>(<span id="time"> 5 </span>)</h3>
                </div>
            </div>
        </div>

        <div id="countDownId" width="100%" style="background-size: 100% 100%; height:500px; background-position:100%;" class="daily-gift-bg-img">
            <div class="text-center">
                <h3 id="open_prize_text" class="title-font title-color">Open Your Prize !</h3>
            </div>
            <div class="text-center" style="margin-top:50px">
                <a href="javascript:void(0)" id="giftSatoshi">
                    <img id="beforeImage" style="height:150px" id="new_img" src="" height="150px">
                    <img id="afterImage" style="height:300px" src="{{asset('/assets/images/daily-gifts/gift-box-opened.png')}}" height="300px">
                </a>
            </div>
        </div>

        <div id="countDownsatoshi" width="100%" style="background-size: 100% 100%; height:500px; background-position:100%;" class="daily-gift-bg-img">

        </div>

        <div class="text-center">
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
    <script>
        $(document).ready(function() {
            $('#countDownId').hide();
            $('#countDownsatoshi').hide();
            $('#showSecond').hide();

            $('#infoDiv').hide();
            $('#afterImage').hide();

            $('.dailyGift').click(function() {
                $('#mainGift').hide();
                $('#showSecond').show();

                var cur_img = $(this).attr("data-cur");
                $("#beforeImage").attr('src', '/public/assets/images/daily-gifts/Gift-box.png')

                var fiveMinutes = 4,
                    display = document.querySelector('#time');
                startTimer(fiveMinutes, display);

            });

            function startTimer(duration, display) {
                var timer = duration,
                    minutes, seconds;
                var end = setInterval(function() {
                    minutes = parseInt(timer / 60, 10)
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    //display.textContent = minutes + ":" + seconds;
                    display.textContent = seconds;

                    if (--timer < 0) {
                        //window.location = "http://www.example.com";

                        $('#showSecond').hide();
                        $('#countDownId').show();

                        clearInterval(end);
                    }
                }, 1000);
            }
            $('#giftSatoshi').click(function() {
                var id = $(this).attr('id');
                //alert(id);
                $.ajax({
                    url: '/account/daily-gift/random',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(data) {
                        if (data == 'fail') {
                            alert('You already received daily gift!');
                            return;
                        }
                        $('#infoDiv').show();
                        $('#displayGift').text(data);
                        $('#beforeImage').hide();
                        $('#afterImage').show();
                        $('#open_prize_text').hide();
                    }
                });
            });
        })
    </script>
    @endsection
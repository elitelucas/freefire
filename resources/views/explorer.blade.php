@extends('layouts.master-layouts')

@section('title')
Explorer
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
                EXPLORER
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" width="100%"  class="explorer-bg-img explorer-bg-div">
            <div class="pt-5 pb-5 text-center">
                <h5 id="find_text" class="title-font" style="color:black">Find wukong!</h5>
            </div>
            <div id="beforeImage" class="row dailygiftmaindiv text-center bush-div-position" style="margin-top:20px;cursor:pointer">
                <div class="col-md-3 imgBush">
                    <img class="explorer-bush-1" src="{{asset('/assets/images/explorers/ghille-bush.png')}}">
                </div>
                <div class="col-md-3 imgBush">
                    <img class="explorer-bush-2" src="{{asset('/assets/images/explorers/ghille-bush.png')}}">
                </div>
                <div class="col-md-3 imgBush">
                    <img class="explorer-bush-3" src="{{asset('/assets/images/explorers/ghille-bush.png')}}">
                </div>
                <div class="col-md-3 imgBush">
                    <img class="explorer-bush-4" src="{{asset('/assets/images/explorers/ghille-bush.png')}}">
                </div>

                <!-- <a href="javascript:void(0)" data-cur="2" class="dailyGift">
                    <img id="beforeImage" style="height:190px" class="imggift" src="{{asset('/assets/images/explorers/ghille-bush.png')}}">
                    <img id="afterImage" style="height:190px" class="imggift" src="{{asset('/assets/images/explorers/explorer-reward.png')}}">
                </a> -->
            </div>
            <div id="afterImage" class="text-center explorer-man-img-div">
                <img class="imggift explorer-man-img" src="{{asset('/assets/images/explorers/explorer-reward.png')}}">
            </div>
        </div>
        <div class="text-center explorer-back-position" style="margin-top:50px">
            <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:1.5rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
            <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:1.5rem" onclick="event.preventDefault(); tryAnother();">Try another</button>
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
        var kk = true;

        function tryAnother() {
            $('#infoDiv').html('');
            kk = true;
        }
        $(document).ready(function() {
            $('#afterImage').hide();
            var random_num = Math.floor(Math.random() * 4);
            $('.imgBush').on('click', function(event) {
                if (!kk) return;
                console.log($(this).index());
                kk = false;
                if ($(this).index() == random_num) {
                    console.log('sdf');
                    $.ajax({
                        url: '/account/explorer/get-star',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            if (data == 'fail') {
                                alert('You already received daily star!');
                                return;
                            }
                            $('#infoDiv').html(`
                            <h3 class="mb-3" style="font-size: 2rem; color: #fb00ff;">
                YOU WIN A NEW STAR.
            </h3>
            <div>
                <img src="{{asset('/assets/images/star.png')}}">
            </div>`);
                            $('#beforeImage').hide();
                            $('#afterImage').show();
                            $('#find_text').hide();
                            $('.daily-gift-div').css('margin-bottom','0');
                        }
                    });
                } else {
                    $('#infoDiv').html(`<h3 class="mb-3" style="font-size: 2rem; color: #fb00ff;">TRY ANOTHER.</h3>`)
                }
            })
        })
    </script>
    @endsection
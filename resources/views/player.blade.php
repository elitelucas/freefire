@extends('layouts.master-layouts')

@section('title')
Player
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
        <div class="text-center p-2 mb-2" style="background-color: #0782C0">
            <h3 class="title-font title-color">
                CHANGE PLAYERS
            </h3>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 text-center">
                <div>
                    <h5 class="title-font title-color">
                        YOUR STARS
                    </h5>
                </div>
                <div>
                    <img style="width:20%" src="{{asset('/assets/images/star.png')}}">
                </div>
                <div>
                    <h5 class="title-font text-success">
                        <span style="font-size:1rem">X</span>
                        <span id="user_star">{{Auth::user()->star}}</span>
                    </h5>
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div>
                    <h5 class="title-font title-color">
                        YOUR SCORE
                    </h5>
                </div>
                <div>
                    <img style="width:20%" src="{{asset('/assets/images/diamonds.png')}}">
                </div>
                <div>
                    <h5 class="title-font text-success" id="user_diamond">
                        {{Auth::user()->diamond}}
                    </h5>
                </div>
            </div>

        </div>

        <div class="p-2 mb-2" id="info_div" style="background: #c784595e;width:60%;margin:auto">
            <div id="swal_before">
                <div>
                    <h7 class="title-font title-color">
                        ARE YOU SURE YOU WANT TO CHANGE YOUR PLAYER?
                    </h7>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <img width="50%" id="current_player_image" src="{{asset('/assets/images/players/'.$updated_user->player->player_image)}}">
                    </div>
                    <div class="col-4 text-center" style="padding-top:20px">
                        <div>
                            <img width="50%" src="{{asset('/assets/images/leftarrow.png')}}">
                        </div>
                        <div>
                            <button class="btn btn-primary" onclick="confirmBuy()">yes</button>
                            <button class="btn btn-danger" onclick="cancelBuy()">no</button>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <img width="50%" id="changed_player_image" src="{{asset('/assets/images/players/Hayto.png')}}">
                    </div>
                </div>
            </div>
            <div id="swal_after_error" class="text-center" style="color:white">
                <div>
                    <h5 class="text-danger"> No enough <span class="swal_after_error_text">Stars</span>!</h5>
                </div>
                <div>
                    <small>Please make sure you have enough <span class="swal_after_error_text">stars</span> to rent this player!</small>
                </div>
            </div>
            <div id="swal_after_success" class="text-center" style="color:white">
                <h5 style="color:white"> Upgrade Completed!</h5>
                <div class="mt-3">
                    Play more and do collects to find a new STARS!<br>
                    You can find <strong class="title-color">1 STAR</strong>every day!<br>
                    STARS can be used to rent new players!
                </div>
            </div>

        </div>
        <div width="100%" style="background-size: 100% 100%; background-position:100%;" class="players-bg-img">
            <div class="p-4">
                <div class="row pl-2 pr-2">
                    <div class="col-md-1">

                    </div>
                    @foreach($all_players as $player)
                    <div class="col-md-2">
                        <div class="mb-3 text-center" style="color:white">
                            <div class="mb-2">
                                <div>
                                    SPEED
                                </div>
                                <div class="speed-bar">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 
                                        <?php
                                        echo intval($player->player_minute * 100 / $max_speed) ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 
                                        <?php echo 100 - intval($player->player_minute * 100 / $max_speed) ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="capacity-bar">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 
                                        <?php echo intval($player->player_capacity * 100 / $max_capacity) ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 
                                        <?php echo 100 - intval($player->player_capacity * 100 / $max_capacity) ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    CAPACITY
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->player_id==$player->player_id && intval($left_time)>0)
                        <div class="text-center">
                            <p class="text-center" style="color:white">
                                Duration:<br>
                                <span id="left_time"><strong>{{$left_time}}</strong></span>&nbsp;left!
                            </p>
                        </div>
                        @elseif($player->player_membership=='free'&&Auth::user()->player_id==$player->player_id && intval($left_time)<= 0)
                        <div class="text-center">
                            <p class="text-center" style="color:white">
                                Duration:<br>
                                <span><strong>Life Time</strong></span>
                            </p>
                        </div>
                        @else
                        <div class="text-center">
                            <p>
                                &nbsp;
                                <br>
                                &nbsp;
                            </p>
                        </div>
                        @endif
                        <div class="mb-3">
                            <a href="javascript:void(0)">
                                <img class="w-100 player-pop-up" class="w-100" src="{{asset('/assets/images/players/'.$player->player_image)}}">
                            </a>
                        </div>
                        <div class="text-center">
                            <div>
                                <h7 class="title-font title-color">
                                    <span>{{$player->player_price}}</span><br>
                                    <span>&nbsp;{{$player->player_price_type}}</span>
                                </h7>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light" onclick="BuyPlayer('{{$player->player_id}}','{{$player->player_price}}','{{$player->player_price_type}}','{{$player->player_image}}')">
                                    <i class="bx bx-cart-alt"></i>
                                    buy
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-1">

                    </div>

                </div>

            </div>

        </div>
        <div class="mt-3 p-3" style="background: #c784595e;">
            <div class="mb-3 text-center">
                <h5 class="title-color title-font text-center">PLAYER CHANGE</h5>
            </div>
            <div class="title-color text-center" style="font-size:0.7rem">
                Make sure you have enough starts and funds to change your player.<br>
                Players for stars will remain 2 days only, then will switch back to
                <button style="padding:0" class="btn btn-info">Andrew player</button> as default.<br>
                <button style="padding:0" class="btn btn-info">Andrew</button> and
                <button style="padding:0" class="btn btn-info">Hayto</button> players will remain for lifetime.
            </div>
        </div>
        <div class="mt-3">
            <div class="text-center">
                <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
            </div>
            <form id="account-form" action="{{ route('account') }}" method="get" style="display: none;">
            </form>
        </div>
        <input id="player_id" name="player_id" type='text' hidden>
        <input id="player_price" name="player_price" type='text' hidden>
        <input id="player_price_type" name="player_price_type" type='text' hidden>

    </div>





    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#info_div').hide();

        })

        function confirmBuy() {
            var player_id = $('input#player_id').val();
            var player_price = $('input#player_price').val();
            var player_price_type = $('input#player_price_type').val();
            console.log('player_id')
            console.log(player_id)

            user_star = Number($('#user_star').text());
            user_diamond = Number($('#user_diamond').text());
            user_inr = Number($('#user_inr').text());
            if (player_price_type == 'diamonds') {
                if (user_diamond < player_price) {
                    $('#swal_before').hide();
                    $('#swal_after_error').show();
                    $('.swal_after_error_text').text('diamonds');

                    return;
                }
            } else if (player_price_type == 'stars') {
                if (user_star < player_price) {
                    $('#swal_before').hide();
                    $('#swal_after_error').show();
                    $('.swal_after_error_text').text('stars');
                    return;
                }
            } else if (player_price_type == 'inr') {
                if (user_inr < player_price) {
                    $('#swal_before').hide();
                    $('#swal_after_error').show();
                    $('.swal_after_error_text').text('INR');
                    return;
                }
            }

            $.ajax({
                url: '/players/buy-player',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    player_id
                },
                success: function(data) {

                    if (data == 'fail') {
                        $('#swal_before').hide();
                        $('#swal_after_error').show();
                        $('#swal_after_success').hide();
                    } else {
                        $('#swal_before').hide();
                        $('#swal_after_error').hide();
                        $('#swal_after_success').show();
                        location.reload();

                    }
                }
            });
        }

        function BuyPlayer(player_id, player_price, player_price_type, player_image) {
            if (player_id == '{{$updated_user->player_id}}') {
                alert('Player is using now!');
                return;
            }
            var left_time = parseInt($('#left_time').text());
            if (left_time > 0) {
                alert('Cannot convert player! Wait until duration is finished!');
                return;
            }
            $('#info_div').show();
            $('input#player_id').val(player_id);
            $('input#player_price').val(player_price);
            $('input#player_price_type').val(player_price_type);

            $('#swal_before').show();
            $('#swal_after_error').hide();
            $('#swal_after_success').hide();

            $('img#changed_player_image').attr('src', '/assets/images/players/' + player_image);
        }

        function cancelBuy() {
            $('#info_div').hide();
        }
    </script>

    @endsection

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
                        <span id="user_star">0</span>
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
                        0
                    </h5>
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
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light">
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
        

    </div>





    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
  

    @endsection
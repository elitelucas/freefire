@extends('layouts.master-layouts')

@section('title')
Food Store
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

        <div  id="store_text" class="text-center p-2" style="background-color: #0782C0">
            <h2 class="title-font title-color">
                STORE
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainDiv" style="background:rgba(107, 63, 15, 0.63)">
            <div class="text-center mb-3" style=" margin-top: 15px; width: 80%;margin-left: 10%;">
                <h7 class="title-font title-color">
                    Do more collects to find more foods!<br>
                    You can find up to 5 items every day!<br>
                    Food can be used to make your player happy and healthy!<br>
                </h7>
            </div>
            <div class="text-center mb-3">
                <h5 class="card-title text-center title-font title-color">Your health</h4>

                    <div class="progress w-50 mx-auto" style="height: 20px;">
                        <div id="health_bar" class="progress-bar" role="progressbar" style="width:<?php echo Auth::user()->player_health; ?>%;" aria-valuenow="{{Auth::user()->player_health}}" aria-valuemin="0" aria-valuemax="100">
                            {{Auth::user()->player_health}}%
                        </div>
                    </div>
                    @if(Auth::user()->player_health==100)
                    <button style="position: relative;top: -29px;left: 36%;" id="attack_button" type="button" class="btn btn-success waves-effect waves-light">ATTACK</button>
                    @endif
            </div>

            <div class="text-center">
                <img style="width: 42%" src="{{asset('/assets/images/players/'.$current_player_image)}}">
            </div>
            <div class="text-center mt-2">
                <h6 class="title-font title-color">
                    MY FOODS<br>
                    FEED UP YOUR PLAYER.
                </h6>
            </div>
            <div class="text-center">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr class="title-color">
                            <th>Sr.no</th>
                            <th>ITEM</th>
                            <th>POWER</th>
                            <th>QUANTITY</th>
                            <th></th>

                        </tr>
                    </thead>


                    <tbody>
                        @foreach($foods as $key=>$food)
                        <tr class="title-color">
                            <td>{{$key+1}}</td>

                            <td style="width:10%">
                                <img class="w-100" src="{{asset('/assets/images/stores/'.$food->food->foods_image)}}" />
                            </td>
                            <td>{{$food->food->foods_health_capacity}}</td>
                            <td>{{$food->user_food_amount}}</td>

                            <td style="cursor:pointer">
                                <button type="button" class="btn btn-primary waves-effect waves-light title-font" onclick="Eat(
                                    this,
                                    '{{ $food->user_food_id }}',
                                    '{{$food->user_food_amount}}',
                                    '{{$food->food->foods_health_capacity}}')">EAT</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div id="giftDiv" width="100%" style="background-size: 100% 100%; height:fit-content;padding-top:30px; background-position:100%;background-color: #30200ac7">

            <div class="text-center">
                <img class="store-image" src="{{asset('/assets/images/foods/attack.png')}}">
            </div>
            <div>
                <h4 class="title-color title-font store-text">YOU WON <span id="attack_gem"></span>GEMS</h4>
            </div>
        </div>

        <div id="back_button" class="text-center">
            <button type="button" class="btn btn-success waves-effect waves-light title-font mt-4" style="font-size:3rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
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
            $('#giftDiv').hide();
            if (parseInt($('#health_bar').text()) == 100)
                $('#attack_button').show()
            else
                $('#attack_button').hide();

            $('#attack_button').click(function(e) {
                e.preventDefault();
                $.ajax({
                        url: '/account/food-store/attack-gems',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            $('#mainDiv').hide();
                            $('#giftDiv').show();
                            $('#attack_gem').text(data);                          
                            $('#store_text').hide(); 
                            $('#back_button').addClass('food-store-back');                         
                        }
                    });
            })
        })

        function Eat(that,id, amount, health) {
            var health_bar = parseInt($('#health_bar').text());

            if (amount > 0) {
                if (health_bar == 100) {
                    alert('Health is full!')
                } else {
                    $.ajax({
                        url: '/account/food-store/decrease-food-amount',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id,
                            health
                        },
                        success: function(data) {
                            if (data == 'success') {
                                location.reload();
                            }else{
                                var health=Number(data)+health_bar;

                                if(health>100){
                                    $('#health_bar').text(100);
                                    $('#health_bar').css('width','100%');
                                }else{
                                    $('#health_bar').text(health);
                                    $('#health_bar').css('width',health+'%');
                                }
                                $(that).parent().prev().text(0);
                                $(that).prop('disabled', true);
                            }
                        }
                    });
                }

            } else {
                alert('Food Quantity is not enough!')
            }

        }
    </script>
    @endsection
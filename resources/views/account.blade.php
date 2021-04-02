@extends('layouts.master-layouts')

@section('title')
Account
	
@endsection
 {!! NoCaptcha::renderJs() !!}
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

    <div class="total-content mb-5">
        <div class="text-center">
            <h3 class="title-font title-color">EDIT ACCOUNT</h3>
        </div>

        <div class="text-center">
            @foreach($all_daily_message as $item)
            @if($item->daily_message_status==0)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{$item->daily_message_content}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" onclick="changeDailyMessageStatus('{{$item->daily_message_id}}','{{$item->daily_message_username}}')">×</span>
                </button>
            </div>
            @endif
            @endforeach

            @foreach($user_daily_message as $item)
            @if($item->daily_message_status==0)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{$item->daily_message_content}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" onclick="changeDailyMessageStatus('{{$item->daily_message_id}}','{{$item->daily_message_username}}')">×</span>
                </button>
            </div>
            @endif
            @endforeach

        </div>
        <hr class="accountbottmline mb-2">

        <div style="padding-left: 2%;">
            <a href="/edit-profile" class="yellow-menu-button-account yellow-menu-button">Edit Profile
            </a>
            <a href="/top-up-history" class="yellow-menu-button-account yellow-menu-button">Top-up History
            </a>
            <a href="/withdraw-history" class="yellow-menu-button-account yellow-menu-button">Withdraw History
            </a>
            <a href="/tournament-history" class="yellow-menu-button-account yellow-menu-button">Tournament History
            </a>
        </div>
        @if($daily_gifts_rewards&&$daily_star_rewards)
        <div class="text-center mb-2" style="background-color: #2b090991;width: 90%;margin: auto;padding: 1% 2%;">
            <h8 class="title-font" style="color:green">
                COME BACK TOMORROW :)<br>
                YOUR DAILY LIMIT GOT OVER FOR THE DAY.COME BACK TOMORROW FOR MORE REWARD`S!<br>
                PREMIUM PLAYERS(YOU CAN BUY USING STAR $FUNDS)
            </h8>
        </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-4 text-center">
                @if(!$daily_gifts_rewards)
                <h5 class="title-font title-color">
                    Daily Gift
                </h5>
                <div>
                    <a href="/account/daily-gift">
                        <img class="w-100 thumbnail1" src="{{asset('/assets/images/daily-gifts/daily-gifts-before.png')}}" />
                    </a>
                </div>
                <h5 class="title-font title-color">+120 GEMS</h5>
                @else
                <h5 class="title-font title-color">
                    Daily Gift
                </h5>
                <div>
                    <img class="w-100 thumbnail1" src="{{asset('/assets/images/daily-gifts/Daily-gifts-after.png')}}" />
                </div>
                <h5 class="title-font title-color">+120 GEMS</h5>
                @endif
            </div>
            <div class="col-md-4 text-center">
                @if(!$daily_star_rewards)
                <h5 class="title-font title-color">
                    Explore
                </h5>
                <div>
                    <a href="/account/explorer">
                        <img class="w-100 thumbnail1" src="{{asset('/assets/images/explorers/explorer-before.png')}}" />
                    </a>
                </div>
                <h5 class="title-font title-color">+1 Star</h5>
                @else
                <h5 class="title-font title-color">
                    Explore
                </h5>
                <div>
                    <img class="w-100 thumbnail1" src="{{asset('/assets/images/explorers/explorer-after.png')}}" />
                </div>
                <h5 class="title-font title-color">+1 Star</h5>
                @endif
            </div>
            <div class="col-md-4 text-center">
                <h5 class="title-font title-color">
                    Food Store
                </h5>
                <div>
                    <a href="/account/food-store">
                        <img class="w-100 thumbnail1" src="{{asset('/assets/images/stores/food-account.png')}}" />
                    </a>
                </div>
                <h5 class="title-font title-color">Your foods:<span> {{$food_amount}}</span></h5>
                @if(Session::get('result'))
                <h7 class="text-danger title-font">{{Session::get('result')}}
                </h7>
                @endif


            </div>

        </div>

        <div class="row mb-3">
            <div class="col-md-4 text-center">
                <h5 class="title-font title-color">
                    Top-up
                </h5>
                <div>
                    <a href="/account/top-up">
                        <img class="w-100 thumbnail1" src="{{asset('/assets/images/top-ups/top-up-account.jpg')}}" />
                    </a>
                </div>
                <h5 class="title-font title-color">Diamond</h5>
            </div>
            <div class="col-md-4 text-center">
                <h5 class="title-font title-color">
                    Bank
                </h5>
                <div>
                    <a href="/bank">
                        <img class="w-100 thumbnail1" src="{{asset('/assets/images/banks/bank-account.jpg')}}" />
                    </a>
                </div>
                <h5 class="title-font title-color">Deposit</h5>

            </div>
            <div class="col-md-4 text-center">
                <h5 class="title-font title-color">
                    Conversion
                </h5>
                <div>
                    <a href="/conversion">
                        <img class="w-100 thumbnail1" src="{{asset('/assets/images/conversions/conversion-account.png')}}" />
                    </a>
                </div>
                <h5 class="title-font title-color">1000GEMS=1Diamond</h5>
                @if(Session::get('conversion'))
                <h7 class="text-danger title-font">{{Session::get('conversion')}}
                </h7>
                @endif
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">

                <div>
                    <a href="javascript:void();">
                        <img id="worker_image" class="w-100 thumbnail1" src="{{asset('/assets/images/workers/worker-before.png')}}" />
                    </a>
                </div>
                <div id="worker_before_text">
                    <h5 class="title-font title-color">I`M FREE</h5>
                    <p class="text-white"><a id="clickMe" href="javascript:void(0)" class="title-color">Click here</a>&nbsp;&nbsp;If you want to train a Adam!</p>
                </div>
                <div id="worker_after_text">
                    <h5 class="title-font title-color">Under Training...</h5>
                    <p class="text-white"> +5 gems/min for undefined is collected by Adam !
                        Training will expire in
                        <span id="timer">
                            <span id="minute">{{$worker->worker_minute-1}}</span>:
                            <span id="second">59</span>
                        </span> seconds.
                        Train Adam again !
                    </p>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 text-center">
                <div class="mb-5">
                    <a href="">
                        <img class="w-100 image-border-color" src="{{asset('/assets/images/withdraw-collect/withdraw.jpg')}}" />
                    </a>
                </div>
                <div class="text-center mb-3">
                    <a href="{{ url('/withdraw') }}">
                        <button style="font-size:2rem" type="button" class=" mt-3 btn btn-danger waves-effect waves-light title-font" <?php if ($withdraw_status->withdraw_status_status == 0) echo 'disabled' ?>>Withdraw</button>
                    </a>
                </div>
            </div>
            <span style="position: absolute;margin-top: 1%;margin-left:2%">
                <h4 style="color:black" id="total_gems">{{Auth::user()->gems}}</h4>
                <h6 style=" color:black"> Gems. (Score)</h6>
            </span>


            <div class="col-md-6 text-center">
                <div>
                    <a href="/account/worker">
                        <img class="w-100 image-border-color" src="{{asset('/assets/images/withdraw-collect/collect-background.jpg')}}" />
                    </a>
                </div>
                <img style="position:absolute;margin-top:-78%;margin-left:-24%" class="w-50" src="{{asset('/assets/images/players/'.$current_player->player_image)}}" />
                <div class="text-center">
                    <div class="mt-2" id="satoshi_earn">
                        <h5 class="text-center title-font title-color">Gems Won Today is : <span id="gems_won_today">{{$collect_gem->collect_gem_daily_amount}}</span></h5>
                    </div>
                    @if(Session::get('collect_amount'))
                    <h7 class="text-danger title-font">{{Session::get('collect_amount')}}
                    </h7>
                    @endif
                    <div class="text-center mb-3" style="padding-top:10px">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <button id="collect_button" style="font-size:2rem" type="button" class=" mt-3 btn btn-danger waves-effect waves-light title-font">Collect</button>
                                </div>
                                @if(Session::get('collect-over'))
                                <div class="mt-2">
                                    <h7 class="text-danger title-font"> {{Session::get('collect-over')}}</h7>
                                </div>
                                @endif
                            </div>
                            <div class="col-6" style="margin-top:26px">
                                <span style="font-size: 1.5rem;color: #f46a6a;">
                                    <span class="title-font gem-hour-amount">{{$collect_gem->collect_gem_hour_amount}}</span>
                                    /
                                    <span class="title-font gem-hour-limit">{{$current_player->player_capacity}}</span>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="text-center">
            <h3 class="title-font title-color">
                scores
            </h3>
        </div>
        <div class="row" style="margin-right:0;margin-left:0">
            <div class="col-md-4 callout" style="padding-left: 0;padding-right: 0;padding-top: 24px;">
                <ul style="font-size: 12px;line-height: 2.2;margin-top: 24px;">
                    <li>My Balance: <span>{{Auth::user()->diamond}}</span>&nbsp;&nbsp;Diamonds</li>
                    <li>Pending: <span></span>&nbsp;&nbsp;Diamonds</li>
                    <li>Paid: <span></span>&nbsp;&nbsp;Diamonds</li>

                </ul>
            </div>
            <div class="col-md-4 callout">
                <div class="title-color title-font" id="satoshi_earn" style="font-size: 1rem;margin-top:31px">
                    <p>Generated : <span class="gem-hour-amount">{{$collect_gem->collect_gem_hour_amount}}</span> Gems</p>
                    <p>My Speed : <span class="gem-hour-limit">{{$current_player->player_capacity}}</span>/
                        <span>{{$current_player->player_hours}}</span>Hour
                    </p>
                    <p>My Capicity : <span class="gem-daily-limit">{{$current_player->player_daily_limit}}</span> Gems</p>
                </div>
            </div>
            <div class="col-md-4 callout text-center" style="padding-top:43px">
                <h3 class="title-font title-color">
                    Gems won
                </h3>
                <h3 class="mt-2 title-font title-color">
                    <span class="gem-hour-amount">{{$collect_gem->collect_gem_hour_amount}}</span>
                    /
                    <span class="gem-hour-limit">{{$current_player->player_capacity}}</span>
                </h3>
            </div>

        </div>
    </div>

    <!-- sample modal content -->
    <div id="captcha_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Captcha Code From</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! app('captcha')->display() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="submitCaptcha()">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div id="collect_captcha_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Captcha Code From</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! app('captcha')->display() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="submitCollectCaptcha()">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
        var workerInterval;
        var timerInterval;
        var worker_minute = '{{ $worker->worker_minute }}';
        console.log(worker_minute);

        function earnSatoshi(a, b) {

        }

        $(document).ready(function() {
            //start collect!!
            var collectInterval = setInterval(startCollectTimer, 10000);


            var worker_gem = JSON.parse('{!! json_encode($worker_gem->toArray()) !!}');
            WorkerBeforeImageAndText()

            //image is different accordit to worker is working or not
            //worker is not working
            if (worker_gem.worker_gem_status == 1) {
                console.log('sdfsdfsdfsd')
                WorkerAfterImageAndText()
                // workerGemWorking();
                $('#minute').text('0' + worker_gem.worker_gem_timer_minute);
                if (Number(worker_gem.worker_gem_timer_second) < 10)
                    $('#second').text('0' + worker_gem.worker_gem_timer_second);
                else {
                    $('#second').text(worker_gem.worker_gem_timer_second);
                }
                startTimer();
            }

            $('#time').hide();
            $('#clickMe').click(function() {
                $("#captcha_modal").modal("show");

                $("a.refresh").click(function() {
                    //  alert('hello');
                    $.ajax({
                        type: "GET",
                        url: "/worker/refresh-captcha",
                        success: function(data) {
                            if (data) {
                                $("#captcha_display").html(data.captcha_input);
                            }
                        }
                    });
                });
            });
            $('#collect_button').click(function(){
                $("#collect_captcha_modal").modal("show");
            })


        });

        function gotoCollectPage() {
            $('body').append(`<a id="goCollect" href="/account/collect/" hidden></a>`);
            // if(Number($('.gem-hour-amount:first'))>0)
            $('#goCollect')[0].click();
            // else
            // alert('There is no collected gems!')
        }


        function submitCaptcha() {
            var captcha = $('#g-recaptcha-response').val();
            $("#captcha_modal").modal("hide");

            $.ajax({
                url: '/worker/validation-captcha',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'g-recaptcha-response': captcha
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    if (result.status == 'fail') {
                        alert('Invalid captcha!');
                        return;
                    }
                    $('#captcha_modal').hide();
                    WorkerAfterImageAndText();
                    // workerGemWorking();
                    startTimer();


                }
            });
        }
        
        function submitCollectCaptcha() {
            var captcha = $('#g-recaptcha-response-1').val();

            $("#collect_captcha_modal").modal("hide");

            $.ajax({
                url: '/account/collect/collectCaptcha',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    captcha
                },
                success: function(data) {
                    if (data == 'fail') {
                        alert('Invalid captcha!');
                        return;
                    }
                    $('#collect_captcha_modal').hide();
                    gotoCollectPage();


                }
            });
        }

        function startTimer() {
            $.ajax({
                url: '/worker/start-timer',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log('sss');
                }
            });
            timerInterval = setInterval(function() {
                var minute = Number($('#minute').text());
                console.log(minute);
                var second = Number($('#second').text());
                $.ajax({
                    url: '/worker/send-time',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        minute,
                        second
                    },
                    success: function(data) {
                        console.log('sss');
                    }
                });
                if (minute == 0) {
                    if (second == 0) {
                        $('#minute').text(Number(worker_minute) - 1);
                        $('#second').text('59');
                        workerIncrease();
                        endTimer()
                        clearInterval(timerInterval);
                        WorkerBeforeImageAndText();
                    } else {
                        second--;
                        if (second < 10)
                            $('#second').text('0' + second);
                        else {
                            $('#second').text(second--);
                        }
                    }
                } else {
                    if (second == 0) {
                        console.log(minute--);
                        $('#minute').text('0' + minute--);
                        $('#second').text('59');
                        workerIncrease();
                    } else {
                        if (second <= 10) {
                            console.log(second--);
                            $('#second').text('0' + second--);
                        } else {
                            console.log(second--);
                            $('#second').text(second--);
                        }
                    }
                }

            }, 1000)
        }

        function endTimer() {
            $.ajax({
                url: '/worker/end-timer',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log('sss');
                }
            });
        }

        function workerGemWorking() {
            workerInterval = setInterval(workerIncrease, 1000);
        }

        function workerIncrease() {
            $.ajax({
                url: '/worker/worker-increase',
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data == "over limit") {
                        alert('the working gem amount is over the limit. Please collect the gems.');
                        location.reload();
                    } else {
                        var old_gems = Number($('#total_gems').text());
                        $('#total_gems').text(old_gems + Number(data));
                    }

                }
            });
        }

        function WorkerAfterImageAndText() {
            $('#worker_after_text').show();
            $('#worker_before_text').hide();
            $('#worker_image').attr('src', '/assets/images/workers/worker-after.png');
        }

        function WorkerBeforeImageAndText() {
            $('#worker_before_text').show();
            $('#worker_after_text').hide();
            $('#worker_image').attr('src', '/assets/images/workers/worker-before.png');
        }

        function startCollectTimer() {
            $.ajax({
                type: "POST",
                url: "/collect/start-timer",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('.gem-hour-amount').text(data);
                }
            });
        }
        function changeDailyMessageStatus(id,username){
            $.ajax({
                type: "POST",
                url: "/account/daily-message/changeStatus",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id,username
                },
                success: function(data) {
                    console.log(data)
                }
            });
        }
    </script>
    @endsection

@extends('layouts.master-layouts')

@section('title')
Purchase
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
                PURCHASE
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" width="100%" style="background-size: 100% 100%;  background-position:100%">
            <div class="row title-color">
                <div class="col-md-5" style="padding-top:21px;padding-bottom:10px">
                    <img class="imggift w-100 img-border" src="{{asset('/assets/images/purchase/purchase-image.png')}}">

                </div>
                <div class="col-md-7">
                    <div>
                        <h5 class="title-font description-title-color">GARENA FREEFIRE GAME</h5>
                    </div>
                    <div>
                        <h7 class="title-font title-color">
                            <span></span>Diamonds top up freefire(first time)
                        </h7>
                    </div>
                    <div class=" mt-2 mb-2 text-danger" style="font-size: 0.7rem;">
                        Bonus Diamonds will be credited by Garena Free Fire upon 1st purchase in games, we do not hold any responsibilities if you did not receive them.
                    </div>
                    <form method="post" action="{{url('/account/addToCart')}}">
                    @csrf
                        <div>
                            <div>
                                Player Id<span class="text-danger">*</span>:enter your character ID here
                            </div>
                            <div>
                                <input type="number" name="player_id" value="{{Auth::user()->ig_id}}" class="w-100" required>
                            </div>
                        </div>

                        <div>
                            <div>
                                In-Game Nickname(IGN)<span class="text-danger">*</span>:character name
                            </div>
                            <div>
                                <input type="text" name="ign" class="w-100" value="{{Auth::user()->ign}}" required>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <input type="number" name="count" class="w-25 mr-2" value="1" style="height:37px" required>
                            <input type="number" name="top_up_id" value="{{$top_up_id}}" hidden>
                            <button type="submit" class="btn btn-success waves-effect waves-light title-font">Add to Cart</button>
                        </div>
                    </form>


                </div>
            </div>
            <div class="title-color">
                <div class="mt-3 mb-3">
                    <h5 class="title-font description-title-color">Description</h5>
                </div>
                <div class="mb-2">
                    Delivery Instruction for Garena Free Fire Diamonds Top Up with Player ID :
                </div>
                <div class="mb-3">
                    <ul>
                        <li>
                            1. First, place your order and contact via WhatsApp chat with your order number.
                        </li>
                        <li>
                            2 Next, provide us your Player ID as shown in the picture below.
                        </li>
                        <li>
                            3. After that, please wait patiently for the diamonds to be credited to your account within 30 minutes.
                        </li>
                    </ul>
                </div>
                <div class="mb-2">
                    <img class="w-100 image-border-color" src="{{asset('/assets/images/purchase/description-image.jpg')}}" />
                </div>
            </div>
            <div class="title-color mb-2">
                <div class="mt-2 mb-2">
                    <h5 class="title-font description-title-color">Disclaimer:</h5>
                </div>
                <div class="mb-3">
                    <ul>
                        <li>
                            Bonus Diamonds will be credited by Garena Free Fire upon 1st purchase in games, we do not hold any responsibilities if you did not receive them.
                        </li>
                        <li>
                            Bonus only eligible for first time top-up, once you have topped up in either inside the app or from another seller, you will not receive the first-time top-up.
                        </li>
                        <li>
                            You may send us your Player ID to check whether you will receive the bonus diamonds.
                        </li>
                    </ul>
                </div>
                <div>
                    Note: This Top Up Service is AVAILABLE for INDIA region.
                </div>
            </div>
            <div class="title-color">
                <div class="title-font title-color" class="mb-2">
                    <h5 class="title-font description-title-color">
                        Product Description
                    </h5>
                </div>
                <div class="mb-2">
                    Free Fire is the ultimate survival shooter game available on mobile. Each 10-minute game places you on a remote island where you are pit against 49 other players, all seeking survival. Players freely choose their starting point with their parachute and aim to stay in the safe zone for as long as possible. Drive vehicles to explore the vast map, hide in trenches, or become invisible by proning under grass. Ambush, snipe, survive, there is only one goal: to survive and answer the call of duty.
                </div>
            </div>
            <div class="title-color">
                <div class="mb-2">
                    <h5 class="title-font description-title-color">
                        [Survival shooter in its original form]
                    </h5>
                </div>
                <div class="mb-2">
                    <h7 class="title-color">
                        Search for weapons, stay in the play zone, loot your enemies and become the last man standing. Along the way, go for legendary airdrops while avoiding airstrikes to gain that little edge against other players.
                    </h7>
                </div>
            </div>
            <div class="title-color">
                <div class="mb-2">
                    <h6 class="title-font description-title-color">
                        [10 minutes, 50 players, epic survival goodness awaits]
                    </h6>
                </div>
                <div class="mb-2">
                    Fast and Lite gameplay – Within 10 minutes, a new survivor will emerge. Will you go beyond the call of duty and be the one under the shining lite?
                </div>
            </div>

            <div class="title-color">
                <div class="mb-2">
                    <h6 class="title-font description-title-color">
                        [4-man squad, with in-game voice chat]
                    </h6>
                </div>
                <div class="mb-2">
                    Create squads of up to 4 players and establish communication with your squad at the very first moment. Answer the call of duty and lead your friends to victory and be the last team standing at the apex.
                </div>
            </div>
            <div class="title-color">
                <div class="mb-2">
                    <h6 class="title-font description-title-color">
                        [Realistic and smooth graphics]
                    </h6>
                </div>
                <div class="mb-2">
                    Easy to use controls and smooth graphics promises the best survival experience you will find on mobile to help you immortalize your name among the legends.
                </div>
            </div>
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
        function goPurchase() {

            $('body').append(`<a id="goPurchase" href="/account/purchase" hidden></a>`);
            // if(Number($('.gem-hour-amount:first'))>0)
            $('#goPurchase')[0].click();
            // else
            // alert('There is no collected gems!')

        }
    </script>
    @endsection
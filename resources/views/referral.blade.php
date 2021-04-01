@extends('layouts.master-layouts')

@section('title')
Referral
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
                REFERRALS
            </h2>
        </div>
        <div style="background:#30200ac7">
            <div class="pt-3 text-center" style="color:white">
                Your Referral URL: 
                <a href="{{config('app.url')}}/auth-register/?id={{Auth::id()}}">
                <span class="title-color">
                {{config('app.url')}}/auth-register/{{Auth::id()}}
                </span>
                </a>
            </div>
            <div class="text-center mt-3">
                <h6 style="color:white">* You get %20 of your referral collects for lifetime!</h6>
            </div>
            <div class="mt-3 mb-3 text-center">
                <img width="80%" class="mx-auto" src="{{asset('assets/images/referral.png')}}">
            </div>
            <div class="text-center">
                <h5 style="color:white">Number of Referrals : 
                    <span id="referral_friend" class="title-color">{{$referer_cnt}}</span> Friends 
                    <span class="title-color" style="cursor:pointer" onclick="ViewReferer()">View</span>
                </h5>
                <h5 style="color:white">Score from Referrals : 
                    <span id="total_referral_gem" class="title-color">{{$referer_amount}}</span> Gems 
                    <span class="title-color" style="cursor:pointer" onclick="CollectReferGems('{{$referer_amount}}')"> Collect</span>
                </h5>
                <h5 style="color:white">Total Score you got from Referrals :
                    <span id="got_referral_gem" class="title-color">{{$total_referer_amount}}</span> Gems
                </h5>
            </div>
        
            <div class="text-center">
                <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
            </div>
            <form id="account-form" action="{{ route('account') }}" method="get" style="display: none;">
            </form>
            <form method="get" action="{{url('/referral/view')}}" id="view_form">
            </form>
        </div>
        

    </div>



    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

<script>
function CollectReferGems(amount){
    if(amount==0){
        alert('No enough amount!');
        return;
    }
    jQuery.ajax({
                type: "get",
                url: "/referral/collect",
                success: function(data) {
                   if(data=='success'){
                       location.reload();
                   }
                }
            });
}
function ViewReferer(){
    $('#view_form').submit();
}
</script>
    @endsection
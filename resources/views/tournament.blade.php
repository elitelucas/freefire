@extends('layouts.master-layouts')

@section('title')
Tournament
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
                TOURNAMENTS
            </h2>
        </div>
        <div style="background:#30200ac7;" class="pb-3">

            <div class="pt-3 mb-3">
                <div class="mb-3 p-4">
                    @foreach($all_tournaments as $tournament)
                    <div class="row text-center mb-2" style="background:#376d6d">
                        <div class="col-md-6">
                            <img width="100%" src="{{asset('assets/images/tournaments/'.$tournament->image)}}">
                        </div>
                        <div class="col-md-3" style="color:#00ff1f;margin-top:5%">
                            <div>
                                {{$tournament->title}}<br>
                                <span style="color:yellow">{{$tournament->created_at}}</span>
                            </div>
                            <div>
                                @if($tournament->user_key && $tournament->payStatus)
                                <div class="row">
                                    <div class="col-md-6" style="color:black">
                                        ID:&nbsp;{{$tournament->room_id}}
                                    </div>
                                    <div class="col-md-6" style="color:black">
                                        Pass:&nbsp;{{$tournament->room_password}}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top:5%">
                            <a href="{{url('/tournament/'.$tournament->id)}}">
                                <button class="btn btn-info waves-effect waves-light" 
                                <?php if($tournament->user_key && $tournament->payStatus) echo 'disabled' ?> >
                                <?php if($tournament->user_key && $tournament->payStatus) echo 'Registered'; else echo 'Register Tournament' ?>
                                </button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
            </div>
            <form id="account-form" action="{{ route('account') }}" method="get" style="display: none;">
            </form>
        </div>


    </div>



    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    @endsection
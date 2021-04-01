@extends('layouts.master-layouts')

@section('title')
Touranment Register
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
                REGISTERATION FOR TOURNAMENT
            </h2>
        </div>
        <div style="background:#30200ac7;" class="pb-3 pt-3">
        <form action="{{ url('/tournament/checkout') }}" method="post">
        {{csrf_field()}}
        <div class="mb-3 p-3">
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Name<span class="text-danger">*</span>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Phone Number
                    </div>
                    <div>
                        <input class="form-control" type="text" id="phone_number" name="phone_number" value="{{Auth::user()->phone_number}}" readonly required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Tournament
                    </div>
                    <div>
                        <input class="form-control" type="text" id="tournament" name="tournament" value="{{$tournament->title}}" readonly required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Amount
                    </div>
                    <div>
                        <input class="form-control" type="text" id="amount" name="amount" value="{{$tournament->amount}}" readonly required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Fee
                    </div>
                    <div>
                        <input class="form-control" type="text" id="fee" name="fee" value="{{$tournament->fee}}" readonly required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Member Details
                    </div>
                    @for($i=0; $i<$tournament->type->tournament_value;$i++)
                    <div class="row text-center mb-2">
                        <div class="col-md-6">
                            <input class="form-control" type="text"  name="player_id[]" placeholder="player ID" required>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="text"  name="ign[]" placeholder="IGN"  required>
                        </div>
                    </div>
                    @endfor

                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-info" style="font-size:2rem" >Preceed to Checkout</button>
            </div>
            <input type="text" value="{{$tournament->id}}" name="tournament_id" hidden>
        </form>

           
        </div>


    </div>



    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    @endsection
@extends('layouts.master')

@section('title') Player-Edit @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Player Edit @endslot
        @slot('li_1')  @endslot
    @endcomponent
    
    <button  class="text-white" style="position: relative;left: 96%;bottom: 17px;">
        <a href="{{ url('/admin/player') }}">
        List All
        </a>
    </button>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
               
                <form method="post" action="{{ url('/admin/player/confirmEdit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row mb-5">
                        <div class="col-4">
                            <span>image</span>
                        </div>
                        <div class="col-8">
                            <div class="mb-2">
                                <img id="srcImg" class="w-50" src="{{asset('/assets/images/players/'.$player->player_image)}}" />
                                <input type=text name="id" value="{{$player->player_id}}" hidden>
                            </div>
                            <div>
                                <input name="image" id="imgInp" type="file">
                            </div>
                        </div>             
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Name</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="name" value="{{$player->player_name}}" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Gems(Minutes)</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="minute" value="{{$player->player_minute}}" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Capacity</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="capacity" value="{{$player->player_capacity}}" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Price</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="price" value="{{$player->player_price}}" required>  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Price Type</span>
                        </div>
                        <div class="col-8">
                            <select class="w-50"  name="price_type">
                                <option value="default" <?php if($player->player_price_type=="default") echo 'selected' ?> >Default</option>
                                <option value="diamonds" <?php if($player->player_price_type=="diamonds") echo 'selected' ?> >Diamonds</option>
                                <option value="stars" <?php if($player->player_price_type=="stars") echo 'selected' ?> >Stars</option>
                                <option value="inr" <?php if($player->player_price_type=="inr") echo 'selected' ?> >INR</option>
                            </select> 
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Membership</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="membership" value="{{$player->player_membership}}" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Daily Limit(Gems)</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="daily_limit" value="{{$player->player_daily_limit}}" required>  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Duration</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="player_duration" value="{{$player->player_duration}}" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Status</span>
                        </div>
                        <div class="col-8">
                            <select class="w-50"  name="status">
                                <option value="0" <?php if($player->player_status==0) echo 'selected' ?> >Disable</option>
                                <option value="1" <?php if($player->player_status==1) echo 'selected' ?> >Enable</option>
                            </select>
                             
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit">Submit</button>                 
                    </div>
                </form>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
        
            </div>
@endsection

@section('script')
    <!-- plugin js -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Calendar init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>       

    <!-- Init js-->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#srcImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });
    </script>
@endsection

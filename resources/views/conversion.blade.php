@extends('layouts.master-layouts')

@section('title')
Conversion
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
            <h3 class="title-font title-color">
                Conversion Gems To Diamond
            </h3>
        </div>
        @if(old('gems'))
        <div id="infoDiv" class="text-center text-danger title-font">
            <h3 style="font-size: 2rem">
                Gem amount is not enough! </h3>
        </div>
        @endif
        <div class="text-center mt-3">
            <h5 class="title-font text-danger">
                Gem : Diamond = <span>{{$gem_diamond_ratio->gem}}</span>:<span>{{$gem_diamond_ratio->diamond}}</span>
            </h5>
        </div>
        <form method="post" action="/conversion/confirm">
            {{ csrf_field() }}
            <div class="mt-5 title-color title-font" style="font-size:1.5rem">
                <div class="row mb-4">
                    <div class="col-4">
                        Gems
                    </div>
                    <div class="col-4">
                        <input class="w-100" type='number' id='gems' name="gems">
                    </div>
                    <div class="col-4">
                        <h5 class="title-font title-color">Available Gems:<span id="available_gems">{{Auth::user()->gems}}</span></h5>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-4">
                        Diamond
                    </div>
                    <div class="col-4 mb-3">
                        <input class="w-100" type='number' id="diamond" name="diamond" readonly="readonly">
                    </div>
                    <div class="col-4">
                        <h5 class="title-font title-color">Available Diamonds:<span id="available_diamond">{{Auth::user()->diamond}}</span></h5>
                    </div>
                </div>
                <div class="text-center">
                    
                </div>
            </div>
        </form>
        <div class="text-center">
            <button id="convert_button" type="button" class="btn btn-primary waves-effect waves-light title-font mt-2" style="font-size:2rem">
                        <i class="bx bx-sync"></i>Convert</button>
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
        $(document).ready(function() {
            var limit='{{env("INITIAL_GEM_AMOUNT")}}';
            var available_gems=$('#available_gems').text();
            var gem_diamond_ratio = JSON.parse('{!! $gem_diamond_ratio !!}');
            console.log(gem_diamond_ratio);
         
            $('#gems').keyup(function(e){
                var dia_val=Math.floor(e.target.value/gem_diamond_ratio.gem);
                $('#diamond').val(dia_val);
            })

               $('#convert_button').click(function() {
                var change_gem_val = $('#gems').val();
                var change_diamond_val = $('#diamond').val();
                if(change_gem_val==0 || change_gem_val=='' || change_diamond_val==0 ||change_diamond_val=='' ){
                    alert('input amount!')
                    return;
                }
                if (change_gem_val % gem_diamond_ratio.gem > 0){
                    alert('input corrent gem amount!')

                }else if(Number(change_gem_val)>Number(available_gems)){
                    alert('Changed gems amount is over the available gems!')
                }else{
                        $.ajax({
                    url: '/conversion/convert',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        change_gem_val,change_diamond_val
                    },
                    success: function(data) {
                        alert('Converted successfully!')
                        if(Number(data)<Number(limit)){
                            $('body').append(`<a id="goAccount" href="/account"></a>`);
                            $('#goAccount')[0].click();
                        }else{
                            location.reload();
                        }
                    }
                });
                    }
            })
        })
    </script>

    @endsection
@extends('layouts.master-layouts')

@section('title')
Top up 
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
                TOP-UP
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" width="100%" style="background-size: 100% 100%; background:rgba(107, 63, 15, 0.63); background-position:100%;" class="daily-gift-bg-img">
            <div id="top_up_mobile" class="mb-5 text-center title-color">
            @foreach($all_top_ups as $item)
                <div class="row">
                    <div class="col-1">
                    </div>
                    @foreach($item as $top_up)
                    <div class="col-md-2 col-sm-12 mb-3" style="padding-top:45px">
                        <div class="mb-2">
                            <img class="w-100" src="{{asset('/assets/images/top-ups/'.$top_up->top_up_image)}}" alt="no image">
                        </div>
                        <div class="mb-2" style="font-size: 0.7rem;color: black;font-weight: bold;">
                            {{$top_up->top_up_diamond}}+{{$top_up->top_up_first_bonus}} {{$top_up->top_up_title}}
                        </div>
                        <div class="mb-2">
                            <span><i class="fas fa-rupee-sign"></i><span><del>{{$top_up->top_up_offer_amount}}<del></span></span>
                            <span style="font-size:1rem;color:white"><i class="fas fa-rupee-sign"></i><span>{{$top_up->top_up_actual_amount}}</span></span>
                        </div>
                        <div class="mb-2">
                            @if($top_up->top_up_out_of_stock==0)
                            <button type="button"
                            class="btn btn-danger waves-effect waves-light" style="font-size:0.7rem" disabled>
                                <i class="bx bx-log-out-circle"></i>
                                Out of Stock
                            </button>
                            @else
                            <button type="button" 
                            class="btn btn-primary waves-effect waves-light" style="font-size:0.7rem">
                                <i class="bx bx-check-circle"></i>
                                In Stock
                            </button>
                            @endif
                        </div>
                        <div>
                            <button style="font-size:0.8rem" type="button"  onclick="goPurchase('{{$top_up->top_up_id}}')"
                            class="btn btn-success btn-rounded waves-effect waves-light" <?php if ($top_up->top_up_out_of_stock == 0) echo 'disabled'; ?>>
                                <i class="bx bx-cart-alt"></i>
                                buy
                            </button>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-1">
                    </div>
                </div>
                @endforeach
                <form id="id_form" method="post" action="{{url('/account/purchase')}}" style="display: none;">
                {{csrf_field()}}
                <input type="number" name="top_up_id" id="top_up_id">
                </form>


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
    function goPurchase(top_up_id){
       
           $('#top_up_id').val(top_up_id);
           $('#id_form').submit();
        
    }
    </script>
    @endsection
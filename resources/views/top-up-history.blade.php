@extends('layouts.master-layouts')

@section('title')
Top up History
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
                Top up history
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" class="pt-3 pb-3" width="100%" style="background-size: 100% 100%;  background-position:100%">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr class="title-color">
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($top_up_order as $key=>$item)
                    <tr class="title-color">

                        <td style="width:10%">
                            <img class="w-100" src="{{asset('/assets/images/top-ups/'.$item->topUp->top_up_image)}}" />
                        </td>
                        <td>{{$item->top_up_order_amount}}+{{$item->top_up_order_first_bonus_amount}}&nbsp;Diamonds top up freefire<br>
                            {{$item->player_id}}
                        </td>
                        <td>
                            {{$item->top_up_order_inr_amount}}
                        </td>
                        <td>{{$item->top_up_order_count}}</td>
                        <td>{{$item->top_up_order_inr_amount*$item->top_up_order_count}}</td>
                        <td>{{$item->top_up_order_status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    </div>


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
  
    @endsection
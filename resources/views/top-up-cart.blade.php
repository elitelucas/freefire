@extends('layouts.master-layouts')

@section('title')
Top up Cart
@endsection
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
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
                Shopping cart
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" class="pt-3 pb-3 title-color" width="100%" style="background-size: 100% 100%;  background-position:100%">
            <table id="datatable" class="table table-bordered dt-responsive title-color" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr class="title-color">
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Update</th>
                        <th>Delete</th>

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
                        <td><input class="w-100" type="number" name="count" value="{{$item->top_up_order_count}}"></td>
                        <td>{{$item->top_up_order_inr_amount*$item->top_up_order_count}}</td>
                        <td class="text-info" style="cursor:pointer" onclick="UpdateCart('{{$item->top_up_order_id}}',this)">
                            <span>Update</span>
                        </td>
                        <td style="cursor:pointer">
                            <i class="fas fa-window-close text-danger" onclick="Del('{{$item->top_up_order_id}}')"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mb-3 title-color">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
                <div>
                    <h5 class="title-color title-font">
                        Cart Totals
                    </h5>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        Subtotal
                    </div>
                    <div class="col-md-6">
                        {{$total_price}}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        Total
                    </div>
                    <div class="col-md-6">
                        {{$total_price}}
                    </div>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-info waves-effect waves-light title-font mt-2" onclick="checkout()">Proceed To checkout</button>
                </div>
            </div>

        </div>
    </div>


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
        function Del(top_up_order_id) {
            $.ajax({
                type: "get",
                url: "/account/top-up-cart/delete",
                data: {
                    top_up_order_id
                },
                success:function(data){
                    if(data=="success"){
                        location.reload();
                    }
                }
            })
        }
        function UpdateCart(top_up_order_id,that){
            var count=$(that).siblings().find('input').val();
            $.ajax({
                type: "get",
                url: "/account/top-up-cart/update",
                data: {
                    top_up_order_id,
                    count
                },
                success:function(data){
                    if(data=="success"){
                        location.reload();
                    }
                }
            })
        }

        function checkout() {
            $.ajax({
                type: "get",
                url: "/account/top-up-cart/checkout",
                success:function(data){
                    if(data=="success"){
                        alert('Recharged successfully!');
                        location.reload();
                    }else if(data=='over amount'){
                        alert('Your INR balance is not enough!');
                    }
                }
            })
        }
    </script>
    @endsection

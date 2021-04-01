@extends('layouts.master-layouts')

@section('title')
Withdraw History
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
                Withdraw history
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" class="pt-3 pb-3" width="100%" style="background-size: 100% 100%;  background-position:100%">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr class="title-color">
                        <th>Sr.no</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th>Diamond</th>
                        <th>Fee</th>
                        <th>IGN</th>
                        <th>In-Game Player ID</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($diamond_withdraw as $key=>$item)
                    <tr class="title-color">
                        <td >{{$key+1}}</td>
                        <td>{{$item->created_at}} </td>
                        <td>{{$item->diamond_withdraw_status}} </td>
                        <td>{{$item->diamond_withdraw_amount}} </td>
                        <td>{{$item->diamond_withdraw_fee}} </td>
                        <td>{{$item->diamond_withdraw_ign}} </td>
                        <td>{{$item->diamond_withdraw_player_ID}} </td>
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
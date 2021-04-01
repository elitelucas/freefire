@extends('layouts.master-layouts')

@section('title')
Wallet transaction
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
                Transaction history
            </h2>
        </div>
        <div id="infoDiv" class="text-center title-font">

        </div>
        <div id="mainGift" class="pt-3 pb-3" width="100%" style="background-size: 100% 100%;  background-position:100%">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr class="title-color">
                        <th>Sr.no</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Status</th>
                        <th>Details</th>
                        <th>Created Date</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($transaction_history as $key=>$item)
                    <tr class="title-color">
                        <td >{{$key+1}}</td>
                        <td>{{$item->customer_name}} </td>
                        <td>{{$item->customer_phone}} </td>
                        <td>{{$item->order_amount}} </td>
                        <td>{{$item->order_currency}} </td>
                        <td>{{$item->status}} </td>
                        <td>{{$item->details}} </td>
                        <td>{{$item->created_at}} </td>
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
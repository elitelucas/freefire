@extends('layouts.master-layouts')

@section('title')
Referral View
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
            <div class="pt-3">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr class="title-color">
                            <th>Sr.no</th>
                            <th>Referrer</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($refer as $key=>$item)
                        <tr class="title-color">
                            <td>{{$key+1}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{round($item->amount,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
            </div>
             <form id="account-form" action="{{ route('referral') }}" method="get" style="display: none;">
            </form>
        </div>


    </div>



    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>


    @endsection
@extends('layouts.master')

@section('title') INR Withdraw @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') INR Withdraw @endslot
        @slot('li_1')  @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>Fees</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Change Request</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_inr_withdraw as $key=>$inr_withdraw)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$inr_withdraw->user->name}}</td>
                                <td>{{$inr_withdraw->inr_withdraw_amount}}</td>
                                <td>{{$inr_withdraw->inr_withdraw_fee}}</td>
                                <td>{{$inr_withdraw->inr_withdraw_status}}</td>
                                <td>{{$inr_withdraw->inr_withdraw_type}}</td>
                                <td style="cursor:pointer">
                                    <a class="text-success" href="{{ url('admin/inr-withdraw/'.$inr_withdraw->inr_withdraw_id) }}">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@extends('layouts.master')

@section('title') INR-View @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') INR View @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 96%;bottom: 17px;">
    <a href="{{ url('/admin/inr-withdraw') }}">
        List All
    </a>
</button>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3>User Withdraw Request!</h3>

                <form method="post" action="{{ url('/admin/inr-withdraw/confirmView') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Username</span>
                        </div>
                        <div class="col-8">
                            <span>{{$inr_withdraw->user->name}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Email</span>
                        </div>
                        <div class="col-8">
                            <span>{{$inr_withdraw->user->email}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Type</span>
                        </div>
                        <div class="col-8">
                            <span>{{$inr_withdraw->inr_withdraw_type}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Withdraw INR Amount</span>
                        </div>
                        <div class="col-8">
                            <span>{{$inr_withdraw->inr_withdraw_amount}}</span>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success waves-effect waves-light" onclick="Accept('{{$inr_withdraw->inr_withdraw_id}}')">Accept</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" onclick="Reject('{{$inr_withdraw->inr_withdraw_id}}')">Reject</button>
                            </div>
                        </div>
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
    function Accept(id) {
        $.ajax({
            type: 'POST',
            url: '/admin/inr-withdraw/accept',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            success: function(data) {
                if (data == 'success')
                    alert('accepted successfully');
            }
        });
    }

    function Reject(id) {
        $.ajax({
            type: 'POST',
            url: '/admin/inr-withdraw/reject',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            success: function(data) {
                if (data == 'success')
                    alert('rejected successfully');
            }
        });
    }
</script>
@endsection
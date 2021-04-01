@extends('layouts.master')

@section('title') Diamond-View @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Diamond View @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 96%;bottom: 17px;">
    <a href="{{ url('/admin/diamond-withdraw') }}">
        List All
    </a>
</button>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3>User Withdraw Request!</h3>

                <form method="post" action="{{ url('/admin/diamond-withdraw/confirmView') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Username</span>
                        </div>
                        <div class="col-8">
                            <span>{{$diamond_withdraw->user->name}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>IGN</span>
                        </div>
                        <div class="col-8">
                            <span>{{$diamond_withdraw->user->ign}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>IG ID</span>
                        </div>
                        <div class="col-8">
                            <span>{{$diamond_withdraw->user->ig_id}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Email</span>
                        </div>
                        <div class="col-8">
                            <span>{{$diamond_withdraw->user->email}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Type</span>
                        </div>
                        <div class="col-8">
                            <span>{{$diamond_withdraw->diamond_withdraw_type}}</span>
                        </div>
                    </div>
                     <div class="row mb-2">
                        <div class="col-4">
                            <span>Withdraw Diamond Fee</span>
                        </div>
                        <div class="col-8">
                            <span>{{$diamond_withdraw->diamond_withdraw_fee}}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Withdraw Diamond Amount</span>
                        </div>
                        <div class="col-8">
                            <span>{{$diamond_withdraw->diamond_withdraw_amount}}</span>
                             @if($diamond_withdraw->diamond_withdraw_status=='pending')
                            <div class="mt-3">
                                <button type="button" class="btn btn-success waves-effect waves-light" onclick="Accept('{{$diamond_withdraw->diamond_withdraw_id}}')">Accept</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" onclick="Reject('{{$diamond_withdraw->diamond_withdraw_id}}')">Reject</button>
                            </div>
                            @endif
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
            url: '/admin/diamond-withdraw/accept',
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
            url: '/admin/diamond-withdraw/reject',
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
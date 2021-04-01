@extends('layouts.master')

@section('title') Top-Up Order @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Top-Up Order @endslot
@slot('li_1') @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Username</th>
                            <th>IGN</th>
                            <th>IG ID</th>
                            <th>First Top Up</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Change Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_top_up_order as $key=>$top_up_order)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$top_up_order->user->name}}</td>
                            <td>{{$top_up_order->user->ign}}</td>
                            <td>{{$top_up_order->user->ig_id}}</td>
                            <td>{{$top_up_order->user->first_top_up}}</td>
                            <td>{{$top_up_order->top_up_order_amount}}</td>
                            <td>{{$top_up_order->top_up_order_status}}</td>
                            <td>{{$top_up_order->top_up_order_type}}</td>
                            <td style="cursor:pointer">
                                <button type="button" class="btn btn-success waves-effect waves-light" 
                                onclick="Accept('{{$top_up_order->top_up_order_id}}')"
                                <?php if($top_up_order->top_up_order_status=="approved") echo "disabled"; ?>
                                >Accept</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" 
                                onclick="Reject('{{$top_up_order->top_up_order_id}}')"
                                <?php if($top_up_order->top_up_order_status=="pending") echo "disabled"; ?>
                                >Reject</button>
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
<script>
    function Accept(id) {
        $.ajax({
            type: 'POST',
            url: '/admin/top-up-order/accept',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            success: function(data) {
                if (data == 'success'){
                    alert('accepted successfully');
                    location.reload();
                }
            }
        });
    }
    function Reject(id) {
        $.ajax({
            type: 'POST',
            url: '/admin/top-up-order/reject',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            success: function(data) {
                if (data == 'success'){
                    alert('rejected successfully');
                    location.reload();
                }
            }
        });
    }
</script>
@endsection
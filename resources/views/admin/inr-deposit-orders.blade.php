@extends('layouts.master')

@section('title') Inr Deposit Orders @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Inr Deposit Orders @endslot
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
                            <th>Order Id</th>
                            <th>Order Amount</th>
                            <th>Order Currency</th>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Customer Email</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Created Date</th>
                            <th>Approve</th>
                            <th>Delete</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_inr_deposit_orders as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->order_id}}</td>
                            <td>{{$item->order_amount}}</td>
                            <td>{{$item->order_currency}}</td>
                            <td>{{$item->customer_name}}</td>
                            <td>{{$item->customer_phone}}</td>
                            <td>{{$item->customer_email}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->details}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                @if($item->status!='paid')
                                <span style="color:green" onclick="Approve('{{$item->id}}','{{$item->user_id}}')">Approve</span>
                                @endif
                            </td>
                            <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="Del('{{$item->id}}')"></i></td>
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
    function Del(id) {
        $.ajax({
            url: '/admin/inr-deposit-orders/delete',
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            dataType: "html",
            success: function() {
                swal("Done!", "It was succesfully deleted!", "success");
                location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });

    }

    function Approve(id, user_id) {
        console.log(user_id)
        $.ajax({
            url: '/admin/inr-deposit-orders/approve',
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id,
                user_id
            },
            dataType: "html",
            success: function(data) {
                if (data == "success") {
                    swal("Done!", "It was succesfully approved!", "success");
                    location.reload();
                } else {
                    swal("Error approving!", "Please try again", "error");
                }

            }
        });

    }
</script>
@endsection
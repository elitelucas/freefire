@extends('layouts.master')

@section('title') Top Up @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">

@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Top Up @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 90%;bottom: 17px;">
    <a href="{{ url('/admin/top-up/add') }}">
        Add Top-Up
    </a>
</button>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Amout</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Out of Stock</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_top_up as $key=>$top_up)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$top_up->top_up_diamond}}+{{$top_up->top_up_first_bonus}} {{$top_up->top_up_title}}</td>
                            <td style="width:10%"> 
                                    <img class="w-100" src="{{asset('/assets/images/top-ups/'.$top_up->top_up_image)}}" alt="no image" />
                            </td>
                            <td>
                                <span><i class="fas fa-rupee-sign"></i><span><del>{{$top_up->top_up_offer_amount}}<del></span></span>
                                <span style="font-size:1.2rem;color:green"><i class="fas fa-rupee-sign"></i><span>{{$top_up->top_up_actual_amount}}</span></span>
                            </td>
                            <td style="cursor:pointer">
                                <a href="{{ url('admin/top-up/'.$top_up->top_up_id) }}">
                                    <i class="fas fa-edit text-success">
                                    </i>
                                </a>
                            </td>
                            <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="Delete('{{$top_up->top_up_id}}')"></i></td>
                            <td>
                            @if($top_up->top_up_out_of_stock==0)
                                <button type="button" class="btn btn-danger waves-effect waves-light" onclick="OutOfStock('{{$top_up->top_up_id}}','{{$top_up->top_up_out_of_stock}}')">
                                    Out of Stock
                                </button>
                            @else
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="OutOfStock('{{$top_up->top_up_id}}','{{$top_up->top_up_out_of_stock}}')">
                                    In Stock
                                </button>
                            @endif
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

<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
      function Delete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/top-up/delete',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id
                    },
                    success: function(data) {
                        if (data == 'success') {
                            location.reload();
                        }

                    }
                });
            }

        });
    }

    function OutOfStock(id,stock) {
        $.ajax({
                    type: 'POST',
                    url: '/admin/top-up/stock',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id,stock
                    },
                    success: function(data) {
                        if (data == 'success') {
                            location.reload();
                        }

                    }
                });
    }
</script>
@endsection
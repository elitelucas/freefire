@extends('layouts.master')

@section('title') Food @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Food @endslot
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
                                <th>Name</th>
                                <th>Image</th>
                                <th>Health Capacity</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($all_food as $key=>$food)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$food->foods_name}}</td>
                                <td>{{$food->foods_image}}</td>
                                <td>{{$food->foods_health_capacity}}</td>
                                <td>{{$food->foods_status}}</td>
                                <td style="cursor:pointer">
                                    <a href="{{ url('admin/food/'.$food->foods_id) }}">
                                        <i class="fas fa-edit text-success">
                                        </i>
                                    </a>
                                </td>
                                <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="Delete('{{$food->foods_id}}')"></i></td>
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
    function Delete(id) {
        $.ajax({
            url:'/admin/food/delete',
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            dataType: "html",
            success: function () {
                swal("Done!", "It was succesfully deleted!", "success");
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
  
}
    </script>
@endsection

@extends('layouts.master')

@section('title') Tournament Corners @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Tournament Corners @endslot
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
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($all_tournament_corners as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->image}}</td>
                                <td style="cursor:pointer">
                                    <a href="{{ url('admin/tournament-corners/'.$item->id) }}">
                                        <i class="fas fa-edit text-success">
                                        </i>
                                    </a>
                                </td>
                                <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="Delete('{{$item->id}}','{{$item->image}}')"></i></td>
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
    function Delete(id,image) {
        $.ajax({
            url:'/admin/tournament-corners/delete',
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id,image
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

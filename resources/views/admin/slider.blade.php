@extends('layouts.master')

@section('title') ListUser @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Slider @endslot
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
                                <th>Images</th>
                                <th>Content</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($all_sliders as $key=>$slider)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$slider->slider_image}}</td>
                                <td>{{$slider->slider_content}}</td>
                                <td style="cursor:pointer">
                                    <a href="{{ url('admin/slider/'.$slider->slider_id) }}">
                                        <i class="fas fa-edit text-success">
                                        </i>
                                    </a>
                                </td>
                                <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="Delete('{{$slider->slider_id}}')"></i></td>
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
            url:'/admin/slider/delete',
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

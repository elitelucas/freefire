@extends('layouts.master')

@section('title') Worker @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Worker @endslot
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Gems</th>
                            <th>Minutes</th>
                            <th>status</th>
                            <th>Edit</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_worker as $key=>$worker)
                        <tr>
                            <td>{{$key+1}}</td>

                            <td style="width:10%">
                                <img class="w-100" src="{{asset('/assets/images/workers/'.$worker->worker_image)}}" />
                            </td>
                            <td>{{$worker->worker_name}}</td>
                            <td>{{$worker->worker_gem}}</td>
                            <td>{{$worker->worker_minute}}</td>
                            <td>{{$worker->worker_status}}</td>
                            <td style="cursor:pointer">
                                <a href="{{ url('admin/worker/'.$worker->worker_id) }}">
                                    <i class="fas fa-edit text-success">
                                    </i>
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
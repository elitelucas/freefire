@extends('layouts.master')

@section('title') Tournament @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Tournament @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 90%;bottom: 17px;">
    <a href="{{ url('/admin/tournament/add') }}">
        Add Tournament
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
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Registered</th>
                            <th>Tournament</th>
                            <th>Edit</th>
                            <th>Remove</th>
                            <th>Room Info</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_tournament as $key=>$tournament)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tournament->title}}<br>
                            {{$tournament->created_at}}
                            </td>
                            <td>{{$tournament->amount}}</td>
                            <td>{{$tournament->fee}}</td>
                            <td>{{$tournament->registered_users_amount}}/{{$tournament->registered_users_limit}}</td>
                            <td>{{$tournament->tournament_type}}</td>
                            <td style="cursor:pointer">
                                <a href="{{ url('admin/tournament/'.$tournament->id) }}">
                                    <i class="fas fa-edit text-success">
                                    </i>
                                </a>
                            </td>
                            <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="DeleteId('{{$tournament->id}}')"></i></td>
                           
                            <td class="text-info"><a href="{{url('admin/tournament/room-info/'.$tournament->id)}}"> View</a></td>
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
function DeleteId(id){
    console.log(id);
    $.ajax({
            type: 'post',
            url: '/admin/tournament/delete',
            data: {
                "_token": "{{ csrf_token() }}",
                id
            },
            success: function(data) {
                if (data == 'success')
                    location.reload();
            }
        });
}
</script>
@endsection
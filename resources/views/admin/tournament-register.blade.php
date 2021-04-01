@extends('layouts.master')

@section('title') List all tournament registers @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') List all tournament registers @endslot
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
                            <th>Name</th>
                            <th>Username</th>
                            <th>Phone number</th>
                            <th>IGN</th>
                            <th>IGID</th>
                            <th>Tournament</th>
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Details</th>
                            <th>Pay tournament amount</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_tournament_registers as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->phone_number}}</td>
                            <td>{{$item->ign}}</td>
                            <td>{{$item->igid}}</td>
                            <td>{{$item->tournament}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->fee}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->created_at}}</td>
                            <td style="cursor:pointer">
                                <a href="{{ url('admin/tournament-register/edit/'.$item->id) }}">
                                    view
                                </a>
                            </td>
                            <td style="cursor:pointer">
                                <a href="{{ url('admin/tournament-register/pay/'.$item->id) }}">
                                    pay
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
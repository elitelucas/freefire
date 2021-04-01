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


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-4">
                    <h5> Submitting room id and password</h5>
                </div>
                <form action="{{url('/admin/tournament/set-room-info')}}" method="post">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-md-6">
                            ID:&nbsp;
                            <input type="text" name="id" value="{{$tournament->id}}" hidden>
                            <input type="text" name="room_id" value="{{$tournament->room_id}}">
                        </div>
                        <div class="col-md-6">
                            Password:&nbsp;
                            <input type="text" name="room_password" value="{{$tournament->room_password}}">
                        </div>

                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>


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
    function DeleteId(id) {
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
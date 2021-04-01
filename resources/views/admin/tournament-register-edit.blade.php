@extends('layouts.master')

@section('title') Tournament Register @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Tournament Register @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 96%;bottom: 17px;">
    <a href="{{ url('/admin/tournament-register') }}">
        List All
    </a>
</button>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-4">
                        <span> Title</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="text" name="title" value="{{$tournament->title}}" readonly required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <span> Name</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="text" name="amount" value="{{$tournament_register->name}}" readonly required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <span> Username</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="text" name="amount" value="{{$tournament_register->username}}" readonly required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <span> Phone Number</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="number" value="{{$tournament_register->phone_number}}" readonly required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <span> IGN</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="text" name="amount" value="{{$tournament_register->ign}}" readonly required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <span> IGID</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="text" name="amount" value="{{$tournament_register->igid}}" readonly required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <span> Tournament</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="text" name="amount" value="{{$tournament_register->tournament}}" readonly required>
                    </div>

                </div>


                <div class="row mb-2">
                    <div class="col-4">
                        <span> Amount</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="number" name="amount" value="{{$tournament->amount}}" readonly required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <span> Fees</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="number" name="fee" value="{{$tournament->fee}}" readonly required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <span> Status</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="text" name="status" value="{{$tournament_register->status}}" readonly required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <span> Details</span>
                    </div>

                    <?php $ss = json_decode($tournament_register->details) ?>

                    <div class="col-8">
                        @foreach($ss as $item)
                        <div class="row">
                            <div class="col-md-6">
                                ID:&nbsp;{{$item->player_id}}
                            </div>
                            <div class="col-md-6">
                                IGN:&nbsp;{{$item->ign}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-success waves-effect waves-light" onclick="event.preventDefault(); document.getElementById('account-form').submit();">Back</button>
                </div>
                <form id="account-form" action="{{ route('admin.tournament-register') }}" method="get" style="display: none;">
                </form>
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#srcImg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>
@endsection
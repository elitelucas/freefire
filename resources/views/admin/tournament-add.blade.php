@extends('layouts.master')

@section('title') Top-Up-Add @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Top-Up Add @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 96%;bottom: 17px;">
    <a href="{{ url('/admin/tournament') }}">
        List All
    </a>
</button>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form method="post" action="{{ url('/admin/tournament/confirmAdd') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Title</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="title" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Amount</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="amount" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Fees</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="fee" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Tournament</span>
                        </div>
                        <div class="col-8">
                            <select class="w-50" name="tournament_type" required>
                                @foreach($all_tournament_type as $tournament)
                                <option value="{{$tournament->id}}">{{$tournament->tournament_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Register Limit</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="registered_users_limit" required>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-4">
                            <span>image</span>
                        </div>
                        <div class="col-8">
                            <div class="mb-2">
                                <img id="srcImg" class="w-50" alt="no image" />
                            </div>
                            <div>
                                <input name="image" id="imgInp" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>
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
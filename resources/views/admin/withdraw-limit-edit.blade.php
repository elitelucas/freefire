@extends('layouts.master')

@section('title') Withdraw Limit @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">

@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Withdraw Limit @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 96%;bottom: 17px;">
    <a href="{{ url('/admin/withdraw-limit') }}">
        List All
    </a>
</button>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3>
                    <?php
                    if ($withdraw_limit->withdraw_limit_type == 1)
                        echo 'Diamond';
                    else if ($withdraw_limit->withdraw_limit_type == 2)
                        echo 'INR money'
                    ?>
                </h3>

                <form method="post" action="{{ url('/admin/withdraw-limit/confirmEdit') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Admin Fees</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="fee" value="{{$withdraw_limit->withdraw_limit_fee}}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Withdraw Limit Min</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="min" value="{{$withdraw_limit->withdraw_limit_min}}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Withdraw Limit Max</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="max" value="{{$withdraw_limit->withdraw_limit_max}}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Enable/Disable Option</span>
                        </div>
                        <div class="col-8">
                            <div class="custom-control custom-switch custom-switch-lg mb-3" dir="ltr">
                                <input type="checkbox" name="switch" class="custom-control-input" 
                                id="customSwitchsizelg" 
                                <?php if($withdraw_limit->withdraw_limit_option=='enabled') echo 'checked' ?> >
                                <label class="custom-control-label" for="customSwitchsizelg">diable/enable</label>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="id" value="{{$withdraw_limit->withdraw_limit_id}}" hidden>


                    <div class="text-center">
                        <button type="submit">Update</button>
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
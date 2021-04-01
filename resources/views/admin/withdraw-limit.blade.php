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

<button id="add_button" class="text-white" style="position: relative;left: 84%;bottom: 17px; background:green">
    Add Withdraw limit
</button>


<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="post" action="{{ url('/admin/withdraw-limit/edit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Admin fee(diamonds)
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="fee" value="{{$withdraw_fee->withdraw_fee_amount}}" required>
                            <input type="number" name="fee_id" value="{{$withdraw_fee->withdraw_fee_id}}" hidden>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                    <div id="total_div" class="mb-3">
                        @foreach($all_withdraw_limit as $key=>$withdraw_limit)
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Withdraw&nbsp;&nbsp;{{$key+1}}
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="withdraw_amount[{{$key}}]" value="{{$withdraw_limit->withdraw_limit_amount}}" required>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-danger" onclick="Remove(this)">
                                    Remove
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Enable/Diable option
                        </div>
                        <div class="col-md-6">
                            <div class="team">
                                <div class="custom-control custom-switch custom-switch-lg mb-3" dir="ltr">
                                    <input type="checkbox" name="site_switch" class="custom-control-input" id="site_switch"
                                    <?php if($withdraw_status->withdraw_status_status==1) echo 'checked' ?>
                                    >
                                    <label class="custom-control-label" for="site_switch"></label>
                                    <input type="text" name="status_id" value="{{$withdraw_status->withdraw_status_id}}" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>

                    <div class="text-center">
                        <button id="update_button" type="submit" class="btn btn-primary">Update</button>
                        @if(Session::get('no-data'))
                        <h6 class="text-danger">
                            {{Session::get('no-data')}}
                        </h6>
                        @endif
                    </div>

                </div>
            </form>
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
    $(document).ready(function() {
        $('#add_button').click(function() {
            var div_len = $('#total_div').children().length;
            console.log(div_len);

            $('#total_div').append(
                `<div class="row mb-2">
                        <div class="col-md-3">
                            Withdraw&nbsp;&nbsp;${div_len+1}
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="withdraw_amount[${div_len}]" value="" required>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-danger" onclick="Remove(this)">
                                Remove
                            </button>
                        </div>
                    </div>
                    `
            )
        })
    })

    function Remove(that) {
        $(that).parent().parent().remove();
    }
</script>

@endsection
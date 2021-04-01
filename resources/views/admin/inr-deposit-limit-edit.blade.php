@extends('layouts.master')

@section('title') DailyGift @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') DailyGift @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 96%;bottom: 17px;">
    <a href="{{ url('/admin/inr-deposit-limit') }}">
        List All
    </a>
</button>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="/admin/inr-deposit-limit/confirmEdit" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col-4">
                            INR Deposit fee(INR)
                        </div>

                        <div class="col-8">
                            <input name="fee" type="number" value="{{$all_inr_deposit_limit[0]->inr_deposit_limit_fee}}" required>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                        INR Deposit min(INR)
                        </div>

                        <div class="col-8">
                            <input name="min" type="number" value="{{$all_inr_deposit_limit[0]->inr_deposit_limit_min}}" required>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                        INR Deposit max(INR)
                        </div>

                        <div class="col-8">
                            <input class="mb-3" name="max" type="number" value="{{$all_inr_deposit_limit[0]->inr_deposit_limit_max}}" required>
                            <div>
                                <button type="submit">Update</button>

                            </div>
                        </div>
                    </div>
                    <input name="id" type="text" value="{{$all_inr_deposit_limit[0]->inr_deposit_limit_id}}" hidden>

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
@endsection
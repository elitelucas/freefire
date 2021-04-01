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
                        <span> Amount</span>
                    </div>
                    <div class="col-8">
                        <input class="w-50" type="number" id="amount" name="amount" required>
                        <input class="w-50" type="text" id="username" name="username" value="{{$tournament_register->username}}" hidden>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-success waves-effect waves-light" onclick="Pay()">Click here to pay</button>
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
<script>
    function Pay() {
        var amount=$('#amount').val();
        var username=$('#username').val();
        if(Number(amount)<=0 ){
            alert('Input correct amount!');
            return;
        }
        $.ajax({
            type: 'POST',
            url: '/admin/tournament-register/confirmPay',
            data: {
                "_token": "{{ csrf_token() }}",
                amount,
                username
            },
            success: function(data) {
                if (data == 'success') {
                    alert('Sent Successfully!');
                }else{
                    alert('Error!');
                }

            }
        });
    }
</script>
@endsection
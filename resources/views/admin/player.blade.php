@extends('layouts.master')

@section('title') Player @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Player @endslot
@slot('li_1') @endslot
@endcomponent

<button class="text-white" style="position: relative;left: 90%;bottom: 17px;">
    <a href="{{ url('/admin/player/add') }}">
        Add Player
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Minutes</th>
                            <th>Membership</th>
                            <th>Price</th>
                            <th>Price Type</th>
                            <th>Daily Limit</th>
                            <th>status</th>
                            <th>Edit</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_player as $key=>$player)
                        <tr>
                            <td>{{$key+1}}</td>

                            <td style="width:10%">
                                <img class="w-100" src="{{asset('/assets/images/players/'.$player->player_image)}}" />
                            </td>
                            <td>{{$player->player_name}}</td>
                            <td>{{$player->player_minute}}</td>
                            <td>{{$player->player_membership}}</td>
                            <td>{{$player->player_price}}</td>
                            <td>{{$player->player_price_type}}</td>
                            <td>{{$player->player_daily_limit}}</td>
                            <td>{{$player->player_status}}</td>
                            <td style="cursor:pointer">
                                <a href="{{ url('admin/player/'.$player->player_id) }}">
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
@extends('layouts.master')

@section('title') ListUser @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') ListUser @endslot
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Gems</th>
                            <th>Diamond</th>
                            <th>INR</th>
                            <th>IGN</th>
                            <th>IG ID</th>
                            <th>Foods</th>
                            <th>Refferals</th>
                            <th>Star</th>
                            <th>Ip Address</th>
                            <th>Edit</th>
                            <th>Active/Block</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_users as $key=>$user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->gems}}</td>
                            <td>{{$user->diamond}}</td>
                            <td>{{$user->inr}}</td>
                            <td>{{$user->ign}}</td>
                            <td>{{$user->ig_id}}</td>
                            <td>{{$user->foods}}</td>
                            <td>{{$user->referrals}}</td>
                            <td>{{$user->star}}</td>
                            <td>{{$user->ip_address}}</td>
                            <td><span style="cursor:pointer;color:green" onclick="ReadyEdit('{{$user}}','{{$key}}')">Edit</span></td>
                            <td><span style="cursor:pointer;color:green" onclick="ChangeBlock('{{$user->id}}','{{$user->block}}',this)">
                                    {{$user->block}}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade bs-example-modal-lg" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="post" action="/admin/list-user/editUser">
                    {{ csrf_field() }}

                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Username</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="text" name="name" id="name">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Email</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="email" name="email" id="email">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Phone Number</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="text" name="phone_number" id="phone_number">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Gems</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="gems" id="gems">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Diamond</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="diamond" id="diamond">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>INR</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="inr" id="inr">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>IGN</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="text" name="ign" id="ign">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>IG ID</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="text" name="ig_id" id="ig_id">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Mushroom-1</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="mushroom_1" id="mushroom_1">
                            <input class="w-75" type="number" name="mushroom_1_id" id="mushroom_1_id" hidden>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Mushroom-2</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="mushroom_2" id="mushroom_2">
                            <input class="w-75" type="number" name="mushroom_2_id" id="mushroom_2_id" hidden>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Mushroom-3</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="mushroom_3" id="mushroom_3">
                            <input class="w-75" type="number" name="mushroom_3_id" id="mushroom_3_id" hidden>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Mushroom-4</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="mushroom_4" id="mushroom_4">
                            <input class="w-75" type="number" name="mushroom_4_id" id="mushroom_4_id" hidden>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Medkit</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="medkit" id="medkit">
                            <input class="w-75" type="number" name="medkit_id" id="medkit_id" hidden>
                        </div>
                    </div>
                   
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Player Health(%)</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="player_health" id="player_health" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Referrals</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="referrals" id="referrals">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Star</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="number" name="star" id="star">
                        </div>
                    </div>
    
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Ip Address</label>
                        </div>
                        <div class="col-8">
                            <input class="w-75" type="text" name="ip_address" id="ip_address">
                        </div>
                    </div>
                    <input type="text" name="id" id="id" hidden>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                            Submit
                        </button>

                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="EditCancel()">
                            Cancel
                        </button>
                    </div>
                </form>


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
    function ReadyEdit(user, idx) {
        var user = JSON.parse(user);
         $('#id').val(user.id);
        $('#name').val(user.name);
        $('#email').val(user.email);
        $('#phone_number').val(user.phone_number);
        $('#gems').val(user.gems);
        $('#diamond').val(user.diamond);
        $('#inr').val(user.inr?user.inr:0);
        $('#ign').val(user.ign);
        $('#ig_id').val(user.ig_id);
        $('#player_health').val(user.player_health);
        $('#referrals').val(user.referrals);
        $('#star').val(user.star);
        $('#ip_address').val(user.ip_address);

         $.ajax({
            type: 'GET',
            url: '/admin/list-user/getUserFood',
            data: {
                id: user.id
            },
            success: function(data) {
                user_food=JSON.parse(data);
                $('#mushroom_1').val(user_food[0].user_food_amount);
                $('#mushroom_2').val(user_food[1].user_food_amount);
                $('#mushroom_3').val(user_food[2].user_food_amount);
                $('#mushroom_4').val(user_food[3].user_food_amount);
                $('#medkit').val(user_food[4].user_food_amount);

                $('#mushroom_1_id').val(user_food[0].user_food_id);
                $('#mushroom_2_id').val(user_food[1].user_food_id);
                $('#mushroom_3_id').val(user_food[2].user_food_id);
                $('#mushroom_4_id').val(user_food[3].user_food_id);
                $('#medkit_id').val(user_food[4].user_food_id);
                $('#user_modal').modal('show');
            }
            
        })            

    }

    function EditCancel() {
        $('#user_modal').modal('hide');
    }

    function ChangeBlock(id, block, that) {
        $.ajax({
            type: 'POST',
            url: '/admin/list-user/changeBlock',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                block: block
            },
            beforeSend: function() {
                $(that).append(`<i id="loading" class="mdi mdi-spin mdi-loading ml-2"></i>`);
            },
            success: function(data) {
                if (data == 'success')
                    location.reload();
            }
        });
    }
</script>
@endsection

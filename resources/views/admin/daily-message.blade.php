@extends('layouts.master')

@section('title') Daily Message @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Daily Message @endslot
@slot('li_1') @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <select id="all_ind_select" class="form-control w-50 mx-auto">
                        <option value="All Users">All Users</option>
                        <option value="Specific User">Specific User</option>
                    </select>
                </div>
                <div id="search_user_div" class="text-center mb-2" hidden>
                    <div class="text-center">
                        <input id="search_user" class="form-control w-50 mx-auto" type="search" placeholder="search username or email">
                    </div>
                    <div>
                        <span>Search Result:</span>
                        <span id="searched_user"></span>
                    </div>
                </div>
                <div class="text-center">
                    <h3>Message</h3>
                    <textarea id="message_content" class="w-50" style="height:200px"></textarea>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-success waves-effect waves-light" onclick="Post()">Post</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" onclick="Cancel()">Cancel</button>
                </div>
                <input type="text" id="message_id" hidden>

            </div>
        </div>
    </div> <!-- end col -->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>User</th>
                            <th>Content</th>
                            <th>Pub_Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($all_daily_message as $key=>$daily_message)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$daily_message->daily_message_username}}</td>
                            <td>{{$daily_message->daily_message_content}}</td>
                            <td>{{$daily_message->daily_message_created_date}}</td>
                            <td style="cursor:pointer">
                                <i class="fas fa-edit text-success" onclick="Edit('{{$daily_message}}')">
                                </i>
                            </td>
                            <td style="cursor:pointer"><i class="fas fa-window-close text-danger" onclick="Delete('{{$daily_message->daily_message_id}}')"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div>


<!-- end row -->

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

<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js -->

<script>
    $('#all_ind_select').change(function() {
        if ($(this).val() == "Specific User") {
            $('#search_user_div').attr('hidden', false);
        } else if ($(this).val() == "All Users") {
            $('#search_user_div').attr('hidden', true);
        }
    })

    $('#search_user').keyup(function(e) {
        if (e.keyCode === 13) {
            $('#searched_user').text('');
            $.ajax({
                type: 'POST',
                url: '/admin/daily-message/searchUser',
                data: {
                    "_token": "{{ csrf_token() }}",
                    val: e.target.value,
                },
                beforeSend: function() {
                    $('#search_user').append(`<i id="loading" class="mdi mdi-spin mdi-loading ml-2"></i>`);
                },
                success: function(data) {
                    $('#searched_user').text(data);
                }
            });
        }
    });

    function Post() {
        var all_ind_select = $('#all_ind_select').val();
        var user = '';
        if (all_ind_select == "Specific User") {
            user = $('#searched_user').text();
        } else {
            user = 'allUsers';
        }
        var content = $('#message_content').val();
        if (content == '') {
            alert('input content!')
            return;
        }
        var message_id = $('#message_id').val();
        if (message_id) {
            if (user) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/daily-message/edit',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: message_id,
                        user,
                        content
                    },
                    beforeSend: function() {
                        $('#search_user').append(`<i id="loading" class="mdi mdi-spin mdi-loading ml-2"></i>`);
                    },
                    success: function(data) {
                        if (data == 'success')
                            location.reload();
                    }
                });
            } else {
                alert('select user first!')
            }
        } else {
            if (user) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/daily-message/add',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        user,
                        content
                    },
                    beforeSend: function() {
                        $('#search_user').append(`<i id="loading" class="mdi mdi-spin mdi-loading ml-2"></i>`);
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == 'success')
                            location.reload();
                    }
                });
            } else {
                alert('select user first!')
            }
        }

    }

    function Edit(daily_message) {
        var daily_message = JSON.parse(daily_message);
        console.log(daily_message);

        $('#message_id').val(daily_message.daily_message_id);
        $('#message_content').val(daily_message.daily_message_content);
        if (daily_message.daily_message_username == 'allUsers') {
            $('#search_user_div').attr('hidden', true);
            $('#searched_user').text('');
            $('#all_ind_select').val('All Users');
        } else {
            $('#all_ind_select').val('Specific User');
            $('#search_user_div').attr('hidden', false);
            $('#searched_user').text(daily_message.daily_message_username);
        }
    }

    function Delete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/daily-message/delete',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id
                    },
                    beforeSend: function() {
                        $('#search_user').append(`<i id="loading" class="mdi mdi-spin mdi-loading ml-2"></i>`);
                    },
                    success: function(data) {
                        if (data == 'success') {
                            location.reload();
                        }

                    }
                });
            }

        });
    }
    function Cancel(){
        $('#message_content').val('');
        $('#searched_user').text('');
        $('#search_user').val('');
    }
</script>
@endsection
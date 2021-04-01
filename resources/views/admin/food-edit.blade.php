@extends('layouts.master')

@section('title') Food-Edit @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Food Edit @endslot
        @slot('li_1')  @endslot
    @endcomponent
    
    <button  class="text-white" style="position: relative;left: 96%;bottom: 17px;">
        <a href="{{ url('/admin/food') }}">
        List All
        </a>
    </button>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
               
                <form method="post" action="{{ url('/admin/food/confirmEdit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row mb-5">
                        <div class="col-4">
                            <span>image</span>
                        </div>
                        <div class="col-8">
                            <div class="mb-2">
                                <img id="srcImg" class="w-50" src="{{asset('/assets/images/foods/'.$food->foods_image)}}" />
                                <input type=text name="id" value="{{$food->foods_id}}" hidden>
                            </div>
                            <div>
                                <input name="image" id="imgInp" type="file">
                            </div>
                        </div>             
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>name</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="name" value="{{$food->foods_name}}">  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>health</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="health" value="{{$food->foods_health_capacity}}">  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>status</span>
                        </div>
                        <div class="col-8">
                            <select class="w-50"  name="status">
                                <option value="0" <?php if($food->foods_status==0) echo 'selected' ?> >Disable</option>
                                <option value="1" <?php if($food->foods_status==1) echo 'selected' ?> >Enable</option>
                            </select>
                             
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit">Submit</button>                 
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

                reader.onload = function (e) {
                    $('#srcImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });
    </script>
@endsection

@extends('layouts.master')

@section('title') Tournament Corners Edit @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Tournament Corners Edit @endslot
        @slot('li_1')  @endslot
    @endcomponent
    
    <button  class="text-white" style="position: relative;left: 96%;bottom: 17px;">
        <a href="{{ url('/admin/tournament-corners') }}">
        List All
        </a>
    </button>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
               
                <form method="post" action="{{ url('/admin/tournament-corners/confirmEdit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row mb-5">
                        <div class="col-4">
                            <span>image</span>
                        </div>
                        <div class="col-8">
                            <div class="mb-2">
                                <img id="srcImg" class="w-50" src="{{asset('/assets/images/gif-files/'.$tournament_corner->image)}}" />
                                <input type=text name="id" value="{{$tournament_corner->id}}" hidden>
                            </div>
                            <div>
                                <input name="image" id="imgInp" type="file">
                            </div>
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

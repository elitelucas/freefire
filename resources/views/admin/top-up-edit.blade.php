@extends('layouts.master')

@section('title') Top-Up-Edit @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Top-Up Edit @endslot
        @slot('li_1')  @endslot
    @endcomponent
    
    <button  class="text-white" style="position: relative;left: 96%;bottom: 17px;">
        <a href="{{ url('/admin/top-up') }}">
        List All
        </a>
    </button>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
               
                <form method="post" action="{{ url('/admin/top-up/confirmEdit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row mb-5">
                        <div class="col-4">
                            <span>image</span>
                        </div>
                        <div class="col-8">
                            <div class="mb-2">
                                <img id="srcImg" class="w-50" src="{{asset('/assets/images/top-ups/'.$top_up->top_up_image)}}" />
                                <input type=text name="id" value="{{$top_up->top_up_id}}" hidden>
                            </div>
                            <div>
                                <input name="image" id="imgInp" type="file">
                            </div>
                        </div>             
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Diamond</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="diamond" value="{{$top_up->top_up_diamond}}" required>  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> First Bonus</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="first_bonus" value="{{$top_up->top_up_first_bonus}}" required>  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Title</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="title" value="{{$top_up->top_up_title}}" required>  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Actual Amount(INR)</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="actual_amount" value="{{$top_up->top_up_actual_amount}}" required>  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span> Offer Amount(INR)</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="offer_amount" value="{{$top_up->top_up_offer_amount}}" required>  
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

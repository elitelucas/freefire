@extends('layouts.master')

@section('title') Player-Add @endsection
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Player Add @endslot
        @slot('li_1')  @endslot
    @endcomponent
    
    <button  class="text-white" style="position: relative;left: 96%;bottom: 17px;">
        <a href="{{ url('/admin/player') }}">
        List All
        </a>
    </button>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
               
                <form method="post" action="{{ url('/admin/player/confirmAdd') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row mb-5">
                        <div class="col-4">
                            <span>image</span>
                        </div>
                        <div class="col-8">
                            <div class="mb-2">
                                <img id="srcImg" class="w-50" alt="no image" />
                            </div>
                            <div>
                                <input name="image" id="imgInp" type="file" required>
                            </div>
                        </div>             
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Name</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="name" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Gems(Minutes)</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="minute" required >  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Capacity</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="capacity" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Price</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="price" required>  
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Price Type</span>
                        </div>
                        <div class="col-8">
                            <select class="w-50"  name="price_type">
                                <option value="0">Diamond</option>
                                <option value="1">Star</option>
                                <option value="2">INR</option>
                            </select> 
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Membership</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="text" name="membership" required >  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Daily Limit(Gems)</span>
                        </div>
                        <div class="col-8">
                            <input class="w-50" type="number" name="daily_limit" required>  
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <span>Player Status</span>
                        </div>
                        <div class="col-8">
                            <select class="w-50"  name="status">
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
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

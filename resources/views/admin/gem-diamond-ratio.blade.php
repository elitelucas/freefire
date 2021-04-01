@extends('layouts.master')

@section('title') Gem to Diamond @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}">
@endsection
@section('content')

@component('common-components.breadcrumb')
@slot('title') Conversation Gem To Diamond @endslot
@slot('li_1') @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ url('/admin/gem-diamond-ratio/update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-4">
                            <h3>Gems</h3>
                        </div>
                        <div class="col-8">
                            <input type="number" name="gem" value="{{$all_gem_diamond_ratio->gem}}">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4">
                            <h3>Diamond</h3>
                        </div>
                        <div class="col-8">
                            <input type="number" name="diamond" value="{{$all_gem_diamond_ratio->diamond}}">
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                            </div>
                        </div>
                        <input type="number" name="id" value="{{$all_gem_diamond_ratio->id}}" hidden>
                    </div>

                </form>

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
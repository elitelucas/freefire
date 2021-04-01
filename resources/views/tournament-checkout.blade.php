@extends('layouts.master-layouts')

@section('title')
Tournament Checkout
@endsection
@section('body')

<body class="index-background" data-layout="horizontal">
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    @endsection
    @section('content')


    <div class="total-content mb-5">
        <div class="text-center p-2" style="background-color: #0782C0">
            <h3 class="title-font title-color">
                CHECKOUT
            </h3>
        </div>
        @if(Session::get('over_amount'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Error!</strong> {{ Session::get('over_amount') }}
        </div>
        @endif

        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Error!</strong> {{ $message }}
        </div>
        @endif
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Success!</strong> {{ $message }}
        </div>
        @endif

        <div class="row pt-4">
            <div class="col-md-6 mt-5 p-5">
                <div class="mb-2 title-font title-color">
                    Billing details
                </div>
                <div>
                    <div style="color:white">
                        Username
                    </div>
                    <div>
                        <input class="w-100" type="text" id="username" name="username" value="{{Auth::user()->name}}" readonly required>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-2 title-font title-color">
                    Your order
                </div>
                <div class="row mb-2" style="color:white">
                    <div class="col-md-6">
                        <div>
                            Product
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            Subtotal
                        </div>
                    </div>
                </div>
                <div class="row mb-2" style="color:white">
                    <div class="col-md-6">
                        <div>
                            Tournament Amount
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            &#x20B9; {{$tournament_register->amount}}
                        </div>
                    </div>
                </div>
                <div class="row mb-2" style="color:white">
                    <div class="col-md-6">
                        <div>
                            Subtotal
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            &#x20B9; {{$tournament_register->amount}}
                        </div>
                    </div>
                </div>

                <div class="row mb-2" style="color:white">
                    <div class="col-md-6">
                        <div>
                            Fee
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            &#x20B9; {{$tournament_register->fee}}
                        </div>
                    </div>
                </div>
                <div class="row mb-2" style="color:white">
                    <div class="col-md-6">
                        <div>
                            Total
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            &#x20B9; {{$tournament_register->amount+$tournament_register->fee}}
                        </div>
                    </div>
                </div>
                <div class="mb-3" style="color:red">
                    Your personal data will be used to process your order, support your
                    experience throughout this website, and for other purpose described in
                    our <a href="#">privacy policy</a>.
                </div>
                <div class="mb-3" style="color:white">
                    <input type="checkbox" id="terms" name="terms" value="terms" required>
                    <label for="terms"> I have read and agree to the website terms and conditions</label>
                </div>
                
                <div class="mb-3 text-center">
                    <button id="submit_button" class="btn btn-primary">Place order</button>
                </div>
                <form id="id_form" action="{{url('/tournament/place-order')}}" method="post" style="display:none">
                @csrf
                <input type="text" name="id" value="{{$tournament_register->id}}">
                </form>
            </div>
        </div>

    </div>




    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#submit_button').click(function() {
                if ($('#terms').prop('checked') == false) {
                    alert('You have to agree term of service!');
                    return;
                }
                $('#id_form').submit();

            });
        })
    </script>


    @endsection
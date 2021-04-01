@extends('layouts.master-layouts')

@section('title')
@lang('translation.Preloader')
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
                <div class="row">
                    <div class="col-md-6">
                        <div style="color:white">
                            First name
                        </div>
                        <div>
                            <input class="w-100" type="text" id="firstname" name="firstname" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="color:white">
                            Last name
                        </div>
                        <div>
                            <input class="w-100" type="text" id="lastname" name="lastname" required>

                        </div>
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
                            Wallet Top-up X 1
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            &#x20B9; {{$deposit_amount}}
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
                            &#x20B9; {{$deposit_amount}}
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
                            &#x20B9; {{$deposit_amount}}
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
                <form id="redirectForm" method="post" action="{{url('/wallet/checkout/request')}}" style="display:none">
                @csrf
                        <input class="form-control" name="appId" value="{{env('CASHFREE_APP_ID')}}" />
                        <input class="form-control" name="orderId" />
                        <input class="form-control" name="orderAmount" value={{$deposit_amount}} />
                        <input class="form-control" name="orderCurrency" value="INR" />
                        <input class="form-control" name="orderNote" />
                        <input class="form-control" name="customerName" id="customerName" />
                        <input class="form-control" name="customerEmail" value="{{Auth::user()->email}}"/>
                        <input class="form-control" name="customerPhone" value="{{Auth::user()->phone_number}}" />
                        <input class="form-control" name="returnUrl" value="{{env('APP_URL')}}/wallet/checkout/success" />
                        <input class="form-control" name="notifyUrl" value="{{env('APP_URL')}}/wallet/checkout/success" />
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
                var firstname=$('#firstname').val();
                var lastname=$('#lastname').val();
                if (firstname == '') {
                    alert('Input First Name!');
                    return;
                }
                if (lastname == '') {
                    alert('Input Last Name!');
                    return;
                }
                $('#customerName').val(firstname+' '+lastname);
                if ($('#terms').prop('checked') == false) {
                    alert('You have to agree term of service!');
                    return;
                }

                $('#redirectForm').submit();
            });
            $('.razorpay-payment-button').hide();
        })
    </script>


    @endsection
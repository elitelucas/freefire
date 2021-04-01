@extends('layouts.master-layouts')

@section('title')
Terms
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

    <div class="total-content">
        <div class="mb-3">
            <h5 class="title-font title-color">
                TERMS AND CONDITIONS PAGE
            </h5>
        </div>
        <div class="mb-3 title-color">

            <strong>ANTI-CHEAT POLICY</strong><br><br>
            Any attempt to cheat/hack our system will be logged and may lead to an immediate suspension. and Using auto-click and any-other programs/software are strictly forbidden and your account will be terminated without notice.
            <br><br>
            <strong>REFUND POLICY</strong><br><br>
            Fees for upgrading your membership or purchasing intangible items are generally non-refundable. Aside from this, we will work with you to solve any problems you may have.<br><br>
            <strong>
                CREATE ACCOUNT
            </strong><br><br>
            You are not allowed to create more than 1 account per person, household or I.P. address. Any attempt to create more than one account will lead to the termination of all of them.<br><br>
            <strong>ADVERTISEMENT</strong><br><br>
            The Website must not contain or promote any viruses and must not contain pornographic, racist, discriminating, vulgar, illegal, or other adult materials of any kind. However we provide some advertising types (Popup Visits or Banners) on our Publishers Sites to advertise any type of sites to help you advertise your adult site or other related type sites.<br><br>
            <strong>REFER & EARN !</strong><br><br>
            When an invited user does their registration, the referrer gets 20% commission on all their claims. A successful referral is when an invited user successfully completes a registration as per the conditions.<br><br>

            <strong>COUNTRIES ACCEPTED</strong><br><br>
            We do not allow the use of Proxy Servers to Register an Account on our site - this will cause account suspension. We currently accept members from India.<br><br>
        </div>

    </div>


    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    @endsection
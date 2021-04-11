@extends('layouts.master-layouts')

@section('title')
Home
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
        <div>
            <div class="text-center">
                <h2 class="title-font title-color">
                    WELCOME TO FREEFIREGAME.IN
                </h2>
            </div>
            <div class="text-center">
                <p class="title-color">
                    Freefiregame is Diamond Generator Game to get Diamonds every minutes. Try it! Refer your friends, enemies and everyone else and receive 20% lifetime commission on all their claim. We have no minimum payout, and always instant!
                </p>
            </div>

            <div class="mb-5" id="jssor_1" style="    border: 3px solid #c5db3b;position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1920px; height: 1079px; overflow: hidden; visibility: hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div style="position:absolute;display:block;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>
                <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1920px; height: 1079px;  overflow: hidden;">
                    @foreach($all_sliders as $key=>$slider)

                    <div data-p="225.00" style="display: none;">
                        <img data-u="image" src="{{asset('/assets/images/sliders/'.$slider->slider_image)}}" />
                        {!! $slider->slider_content !!}
                    </div>
                    @endforeach
                </div>
                <!-- Bullet Navigator -->
                <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                    <!-- bullet navigator item prototype -->
                    <div data-u="prototype" style="width:16px;height:16px;"></div>
                </div>
                <!-- Arrow Navigator -->
                <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
                <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
                <a href="http://www.jssor.com" style="display:none">Slideshow Maker</a>
            </div>

        </div>
        <div class="text-center mb-2">
            <h3 class="title-font title-color">
                JOIN AND HAVE FUN WITH GAMES INSIDE!
            </h3>
        </div>
        <div class="mb-5">
            <img style="width:100%" src="{{asset('/assets/images/sliders/slide-2.jpg')}}" />
        </div>


        <div class="mb-5 text-center">
            <h3 class="title-font title-color">
                HOT ITEMS
            </h3>
        </div>
        <div id="top_up_mobile" class="mb-5 text-center title-color">
            @foreach($all_top_ups as $item)
            <div class="row">
                <div class="col-1">
                </div>
                @foreach($item as $top_up)
                <div class="col-md-2 col-sm-12 mb-3">
                    <div class="mb-2">
                        <img width="100%" src="{{asset('/assets/images/top-ups/'.$top_up->top_up_image)}}" alt="no image">
                    </div>
                    <div class="mb-2">
                        {{$top_up->top_up_diamond}}+{{$top_up->top_up_first_bonus}} {{$top_up->top_up_title}}
                    </div>
                    <div class="mb-2">
                        <span><i class="fas fa-rupee-sign"></i><span><del>{{$top_up->top_up_offer_amount }}<del></span></span>
                        <span style="font-size:1.2rem;color:green"><i class="fas fa-rupee-sign"></i><span>{{$top_up->top_up_actual_amount}}</span></span>
                    </div>
                    <div class="mb-2">
                        @if($top_up->top_up_out_of_stock==0)
                        <button type="button" class="btn btn-danger waves-effect waves-light">
                            <i class="bx bx-log-out-circle"></i>
                            Out of Stock
                        </button>
                        @else
                        <button type="button" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-check-circle"></i>
                            In Stock
                        </button>
                        @endif
                    </div>
                    <div>
                        <?php if ($top_up->top_up_out_of_stock != 0) { ?>
                        <a href="{{url('auth-login')}}">
                            <?php }; ?>
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light" <?php if ($top_up->top_up_out_of_stock == 0) echo 'disabled'; ?>>
                            <i class="bx bx-cart-alt"></i>
                            buy
                        </button>
                        <?php if ($top_up->top_up_out_of_stock != 0) { ?>
                        </a>
                        <?php }; ?>
                    </div>
                </div>
                @endforeach
                <div class="col-1">
                </div>
            </div>
            @endforeach

        </div>
        <div id="top_up_web"  class="mb-5 text-center title-color">
            @foreach($all_top_ups as $item)
            <div class="row row-cols-5 mb-2">
                
                @foreach($item as $top_up)
                <div class="col">
                    <div class="mb-2">
                        <img width="100%" src="{{asset('/assets/images/top-ups/'.$top_up->top_up_image)}}" alt="no image">
                    </div>
                    <div class="mb-2">
                        {{$top_up->top_up_diamond}}+{{$top_up->top_up_first_bonus}} {{$top_up->top_up_title}}
                    </div>
                    <div class="mb-2">
                        <span><i class="fas fa-rupee-sign"></i><span><del>{{$top_up->top_up_offer_amount}}<del></span></span>
                        <span style="font-size:1.2rem;color:green"><i class="fas fa-rupee-sign"></i><span>{{$top_up->top_up_actual_amount}}</span></span>
                    </div>
                    <div class="mb-2">
                        @if($top_up->top_up_out_of_stock==0)
                        <button type="button" class="btn btn-danger waves-effect waves-light">
                            <i class="bx bx-log-out-circle"></i>
                            Out of Stock
                        </button>
                        @else
                        <button type="button" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-check-circle"></i>
                            In Stock
                        </button>
                        @endif
                    </div>
                   <div>
                        <?php if ($top_up->top_up_out_of_stock != 0) { ?>
                        <a href="{{url('auth-login')}}">
                            <?php }; ?>
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light" <?php if ($top_up->top_up_out_of_stock == 0) echo 'disabled'; ?>>
                            <i class="bx bx-cart-alt"></i>
                            buy
                        </button>
                        <?php if ($top_up->top_up_out_of_stock != 0) { ?>
                        </a>
                        <?php }; ?>
                    </div>
                </div>
                @endforeach
               
            </div>
            @endforeach

        </div>
       

        <div class="mb-5 text-center">
            <h3 class="title-font title-color">
                HOW TO BUY
            </h3>
        </div>

        <div id="buy_web" class="mb-5 title-color">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="text-center">
                        <div class="mb-2">
                            <img style="width:100%" src="{{asset('/assets/images/how_to_buy/search.png')}}" alt="no image">
                        </div>
                        <div class="mb-2">
                            <h5 class="title-color">
                                1.Choose Category
                            </h5>
                        </div>
                        <div>
                            Sign in to freefiregame or <a href="/auth-register">register</a> an <a href="/auth-login">Login</a>. Go to the Shop page to choose the desired category or you want.
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="text-center">
                        <div class="mb-2">
                            <img style="width:100%" src="{{asset('/assets/images/how_to_buy/choose_items.png')}}" alt="no image">
                        </div>
                        <div class="mb-2">
                            <h5 class="title-color">
                                2.Choose Your Item
                            </h5>
                        </div>
                        <div>
                            Choose the product you want. Next, Select the quantity you want and click Add to Cart.
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="text-center">
                        <div class="mb-2">
                            <img style="width:100%;border-radius:20px" src="{{asset('/assets/images/how_to_buy/checkout.jpg')}}" alt="no image">
                        </div>
                        <div class="mb-2">
                            <h5 class="title-color">
                                3.Checkout
                            </h5>
                        </div>
                        <div>
                            Complete the checkout by choosing a payment method and make payment.
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="text-center">
                        <div class="mb-2">
                            <img style="width:100%;border-radius:20px" src="{{asset('/assets/images/how_to_buy/receive_items.jpg')}}" alt="no image">
                        </div>
                        <div class="mb-2">
                            <h5 class="title-color">
                                4.Receive Items
                            </h5>
                        </div>
                        <div>
                            After payment made , contact via WhatsApp for listing , etc. and with your order ID to receive your item. 
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div>
            <div class="mb-5 text-center">
                <h3 class="title-font title-color">
                    TOURNAMENT CORNERS
                </h3>
            </div>
             @foreach($send_corner as $item)
            <div class="row mb-3">
                @foreach($item as $obj)
                <div class="col-6 col-md-3 mb-3">
                    <img class="gif-border" style="width:100%" src="{{asset('/assets/images/gif-files/'.$obj->image)}}" alt="no image">
                </div>
                @endforeach
            </div>
            @endforeach

        </div>
        <div>
            <div class="mb-5 text-center">
                <h3 class="title-font title-color">
                    PAYMENT METHODS
                </h3>
            </div>
            <div class="mb-5">
                <div id="payment_methods" class="row">
                    <div id="paypal" class="col-md-4 payment-method">
                        <img style="width:100%" src="{{asset('/assets/images/payments/paypal.png')}}" alt="no image">
                    </div>
                    <div id="paytm" class="col-md-4">
                        <img style="width:100%" src="{{asset('/assets/images/payments/paytm.png')}}" alt="no image">
                    </div>
                    <div id="visa_master" class="col-md-4">
                        <img style="width:100%" src="{{asset('/assets/images/payments/visa-master.png')}}" alt="no image">
                    </div>
                </div>

            </div>
            <div id="pay_options" class="text-center">
                <input class="pay_option_item" type="radio" name="paypal" checked>
                <input class="pay_option_item" type="radio" name="paytm">
                <input class="pay_option_item" type="radio" name="visa_master">
            </div>
        </div>
    </div>








    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('/assets/js/jssor.slider.mini.js')}}"></script>

    <script>
        $('.pay_option_item').click(function() {
            var name = $(this).attr('name');
            $(this).prop('checked', true);
            $(this).siblings().each(function() {
                $(this).prop('checked', false);
            });

            $('#payment_methods').children().each(function() {
                if ($(this).attr('id') == name) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            })
        })
        $(window).on('resize', function() {
            console.log($('body').width());
            if ($('body').width() < 500) {
                console.log('sdfsdf')
                $('#top_up_mobile').show();
                $('#top_up_web').hide();
                $('div#paytm').hide();
                $('div#visa_master').hide();
                $('#pay_options').show();
            } else {
                $('#top_up_web').show();
                $('#top_up_mobile').hide();
                $('#pay_options').hide();
                $('#payment_methods').children().each(function() {
                    $(this).show();
                })
            }
        });
        jQuery(document).ready(function($) {
            $('.top-up-images').each(function(index) {
                if (index < $('.top-up-images').length - 1) {
                    $(this).css('padding-right', '3%');
                }

            })
            if ($('body').width() < 500) {
                $('#top_up_mobile').show();
                $('#top_up_web').hide();
                $('#pay_options').show();
                $('div#paytm').hide();
                $('div#visa_master').hide();
            } else {
                $('#top_up_web').show();
                $('#top_up_mobile').hide();
                $('#pay_options').hide();
            }


            var jssor_1_SlideoTransitions = [
                [{
                    b: 5500,
                    d: 3000,
                    o: -1,
                    r: 240,
                    e: {
                        r: 2
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    c: {
                        x: 51.0,
                        t: -51.0
                    }
                }, {
                    b: 0,
                    d: 1000,
                    o: 1,
                    c: {
                        x: -51.0,
                        t: 51.0
                    },
                    e: {
                        o: 7,
                        c: {
                            x: 7,
                            t: 7
                        }
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    sX: 9,
                    sY: 9
                }, {
                    b: 1000,
                    d: 1000,
                    o: 1,
                    sX: -9,
                    sY: -9,
                    e: {
                        sX: 2,
                        sY: 2
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    r: -180,
                    sX: 9,
                    sY: 9
                }, {
                    b: 2000,
                    d: 1000,
                    o: 1,
                    r: 180,
                    sX: -9,
                    sY: -9,
                    e: {
                        r: 2,
                        sX: 2,
                        sY: 2
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1
                }, {
                    b: 3000,
                    d: 2000,
                    y: 180,
                    o: 1,
                    e: {
                        y: 16
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    r: -150
                }, {
                    b: 7500,
                    d: 1600,
                    o: 1,
                    r: 150,
                    e: {
                        r: 3
                    }
                }],
                [{
                    b: 10000,
                    d: 2000,
                    x: -379,
                    e: {
                        x: 7
                    }
                }],
                [{
                    b: 10000,
                    d: 2000,
                    x: -379,
                    e: {
                        x: 7
                    }
                }],
                [{
                    b: -1,
                    d: 1,
                    o: -1,
                    r: 288,
                    sX: 9,
                    sY: 9
                }, {
                    b: 9100,
                    d: 900,
                    x: -1400,
                    y: -660,
                    o: 1,
                    r: -288,
                    sX: -9,
                    sY: -9,
                    e: {
                        r: 6
                    }
                }, {
                    b: 10000,
                    d: 1600,
                    x: -200,
                    o: -1,
                    e: {
                        x: 16
                    }
                }]
            ];

            var jssor_1_options = {
                $AutoPlay: true,
                $SlideDuration: 1000,
                $SlideEasing: $Jease$.$OutQuint,
                $CaptionSliderOptions: {
                    $Class: $JssorCaptionSlideo$,
                    $Transitions: jssor_1_SlideoTransitions
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>
    @endsection
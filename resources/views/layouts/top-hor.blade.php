<header id="page-topbar" style="background:transparent;box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 0%);">
    <div class="navbar-header d-flex justify-content-between">
        <div class="d-flex">
            <!-- LOGO -->
            <div>
                <a href="{{url('/index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('/assets/images/logo-light.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('/assets/images/logo-light.png')}}" alt="" height="150" style="padding-top:50px">

                    </span>
                </a>

                <a href="{{url('/index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('/assets/images/logo-light.svg')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('/assets/images/logo-light.png')}}" alt="" height="19">
                    </span>
                </a>
            </div>
            

            <button type="button" style="margin-left:40%" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>
         <div id="top-wallet" style="margin-top:70px">
            <span>
                <span> <i class="text-danger mdi mdi-shopping-outline" style="font-size:3rem"></i>
                <a href="{{route('top-up-cart')}}">
                     <span id="cart_amount" class="text-danger" style="position: relative;top: -5px;    right: 35px;">{{Auth::user()&&Auth::user()->total_cart_count?Auth::user()->total_cart_count:0}}</span>
                </a>
                </span>
                <button id="user_inr" style="margin-bottom:15px" type="button" class="btn btn-outline-danger waves-effect waves-light">
                    <i class="fas fa-rupee-sign"></i>{{Auth::user()&&Auth::user()->total_cart_price?Auth::user()->total_cart_price:0.00}}
                </button>
            </span>
        </div>

    </div>
</header>
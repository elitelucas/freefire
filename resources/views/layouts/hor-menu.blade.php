<div class="topnav topnav-margin" style="background:transparent;box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 0%);">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu" style="background-color:#ffffff">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                @if(Auth::user())
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="{{url('/account')}}" id="topnav-dashboard"  >
                            <i class="bx bx-user"></i>ACCOUNT
                        </a>
                    </li>

                    <li  class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="{{url('/wallet')}}" id="topnav-dashboard">
                            <i class="bx bx-wallet"></i>
                            <i style="font-size:0.7rem; padding-left:3%;padding-right:1%" class="fas fa-rupee-sign"></i>
                            {{Auth::user()->inr}}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="{{url('/players')}}" id="topnav-dashboard">
                            <i class="bx bx-customize"></i>PLAYERS
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="{{url('/referral')}}" id="topnav-dashboard">
                            <i class="bx bxs-share-alt"></i> AFFILIATE
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="{{url('/chat')}}" id="topnav-dashboard">
                            <i class="bx bx-chat"></i> CHAT
                        </a>
                    </li>

                    <li class="nav-item dropdown"> 
                        <a style="padding-right:1%;padding-top:14px"  class="nav-link dropdown-toggle arrow-none" href="{{url('/tournament')}}" id="topnav-more">
                            <i class="bx bx-file"></i>TOURNAMENTS
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a style="padding-right:1%;padding-top:14px" class="nav-link dropdown-toggle arrow-none" href="javascript:void();"
                         id="topnav-layout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out-circle "></i>LOGOUT
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </ul>
                @else
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a style="padding-right:0" class="nav-link dropdown-toggle arrow-none" href="{{url('/')}}" id="topnav-dashboard">
                            <i class="bx bx-home-circle"></i> HOME
                        </a>
                    </li>

                    <li style="padding-right:0" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{url('/how-to-play')}}" id="topnav-uielement">
                            <i class="bx bx-tone"></i>HOW TO PLAY
                        </a>
                    </li>

                    <li style="padding-right:0" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{url('/players-before')}}" id="topnav-pages">
                            <i class="bx bx-customize"></i>PLAYERS
                        </a>
                    </li>

                    <li style="padding-right:0" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{url('/auth-login')}}">
                            <i class="bx bx-log-in"></i>LOG IN
                        </a>
                    </li>
                    <li style="padding-right:0" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{url('/auth-register')}}">
                            <i class="bx bx-edit-alt"></i>REGISTER
                        </a>
                    </li>

                    <li style="padding-right:0" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{url('/tournament-before')}}" id="topnav-more">
                            <i class="bx bx-file"></i>TOURNAMENTS
                        </a>
                    </li>


                </ul>
                @endif

            </div>
        </nav>
    </div>
</div>
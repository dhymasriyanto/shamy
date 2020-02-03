<div class="navbar-custom navbar-custom-dark">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{Auth::user()->getPhotoProfil()}} " alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">{{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <a href="" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Profil</span>
                </a>
                <div class="dropdown-divider"></div>
                <!-- item-->
                <a href="{{route('auth.logout')}}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                <i class="fe-settings noti-icon"></i>
            </a>
        </li>
    </ul>
    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{route('home')}}" class="logo text-center">
            <span class="logo-lg"><img src="{{asset('images/logo-inverse.png')}}" alt="" height="32"></span>
            <span class="logo-sm"><img src="{{asset('images/logo.png')}}" alt="" height="32"></span>
        </a>
    </div>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
        <li>
            @yield('page_title_top')
        </li>
    </ul>
</div>

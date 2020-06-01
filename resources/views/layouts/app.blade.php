<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 19/12/2019
 * Time: 19:03
 */
?>
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="description" content="{{config('app.name_long')}}">
    <meta name="keywords" content="{{config('app.keywords')}}">
    <meta name="author" content="{{config('app.author')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <!-- CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('adminto/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminto/css/icons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminto/css/app.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-vue.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/placeholder-loading.min.css')}}">

    {{--    toast--}}
    <link href="{{asset('adminto/libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- JS-->
    @if(\Illuminate\Support\Facades\App::environment('production'))
        <script type="text/javascript" src="{{asset('js/vue.min.js')}}"></script>
    @else
        <script type="text/javascript" src="{{asset('js/vue.js')}}"></script>
    @endif
    <script type="text/javascript" src="{{asset('js/manifest.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/vendor.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-vue.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pjax.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app-custom.js')}}"></script>
    {{--    <script type="text/javascript" src="../../js/app.js"></script>--}}
</head>
<body class="topbar-dark">
<div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div>
<div id="wrapper">
    <!-- Topbar Start -->
    <div class="navbar-custom navbar-custom-dark">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            {{--            <li class="d-none d-sm-block">--}}
            {{--                <form class="app-search">--}}
            {{--                    <div class="app-search-box">--}}
            {{--                        <div class="input-group">--}}
            {{--                            <input type="text" class="form-control" placeholder="Search...">--}}
            {{--                            <div class="input-group-append">--}}
            {{--                                <button class="btn" type="submit">--}}
            {{--                                    <i class="fe-search"></i>--}}
            {{--                                </button>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </form>--}}
            {{--            </li>--}}
            {{--            <li class="dropdown notification-list">--}}
            {{--                <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">--}}
            {{--                    <i class="fe-bell noti-icon"></i>--}}
            {{--                    <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>--}}
            {{--                </a>--}}
            {{--                <div class="dropdown-menu dropdown-menu-right dropdown-lg">--}}
            {{--                    <!-- item-->--}}
            {{--                    <div class="dropdown-item noti-title">--}}
            {{--                        <h5 class="m-0">--}}
            {{--                                        <span class="float-right">--}}
            {{--                                            <a href="" class="text-dark">--}}
            {{--                                                <small>Clear All</small>--}}
            {{--                                            </a>--}}
            {{--                                        </span>Notification--}}
            {{--                        </h5>--}}
            {{--                    </div>--}}
            {{--                    <div class="slimscroll noti-scroll">--}}
            {{--                        <!-- item-->--}}
            {{--                        <a href="javascript:void(0);" class="dropdown-item notify-item active">--}}
            {{--                            <div class="notify-icon">--}}
            {{--                                <img src="{{asset('images/logo.png')}}" class="img-fluid rounded-circle" alt="" /> </div>--}}
            {{--                            <p class="notify-details">Cristina Pride</p>--}}
            {{--                            <p class="text-muted mb-0 user-msg">--}}
            {{--                                <small>Hi, How are you? What about our next meeting</small>--}}
            {{--                            </p>--}}
            {{--                        </a>--}}
            {{--                        <!-- item-->--}}
            {{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
            {{--                            <div class="notify-icon bg-primary">--}}
            {{--                                <i class="mdi mdi-comment-account-outline"></i>--}}
            {{--                            </div>--}}
            {{--                            <p class="notify-details">Caleb Flakelar commented on Admin--}}
            {{--                                <small class="text-muted">1 min ago</small>--}}
            {{--                            </p>--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--                    <!-- All-->--}}
            {{--                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">--}}
            {{--                        View all--}}
            {{--                        <i class="fi-arrow-right"></i>--}}
            {{--                    </a>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
                   role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{Auth::user()->getPhotoProfil()}} " alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">{{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a href="{{route('account.profil.show')}}" class="dropdown-item notify-item">
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
            {{--            <li class="dropdown notification-list">--}}
            {{--                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">--}}
            {{--                    <i class="fe-settings noti-icon"></i>--}}
            {{--                </a>--}}
            {{--            </li>--}}
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
    <div class="left-side-menu">
        <div class="slimscroll-menu">
            <!--- Sidemenu -->
        @include('partials.sidemenu')
        <!-- End Sidebar -->
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
    <div class="content-page">
        <div class="content">
            @yield('main_content')
        </div>
        <!-- paceholder -->
        <div class="wrapper">
            <div class="container-fluid">
                @include('partials.placeholder')
            </div>
        </div>
        <!-- Footer Start -->
    @include('partials.footer')
    <!-- end Footer -->
    </div>
</div>
<!-- END wrapper -->
@include('partials.rightsidebar')
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

{{--toast--}}
<!-- Toastr js -->
<script src="{{asset('adminto/libs/toastr/toastr.min.js')}}"></script>

<script src="{{asset('adminto/js/pages/toastr.init.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('adminto/libs/select2/select2.min.js')}}" defer></script>--}}

<script type="text/javascript" src="{{asset('adminto/js/vendor.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminto/js/app.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vee-validate/id.js')}}"></script>

<script type="text/javascript" src="{{asset('js/jquery.serializeToJSON.min.js')}}"></script>
</body>
</html>

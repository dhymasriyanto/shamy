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
    @include('partials.head')
</head>
<body class="topbar-dark">
<div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div>
<div id="wrapper">
    <!-- Topbar Start -->
    @include('partials.navbar')
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
<div class="rightbar-overlay">

</div>
@include('partials.js')
</body>
</html>

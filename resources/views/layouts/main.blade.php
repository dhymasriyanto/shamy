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
</head>
<body class="authentication-bg">
<div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div>

@yield('body')

@include('partials.footer_large')
<!-- Vendor js -->
<script src="{{asset('adminto/js/vendor.min.js')}}"></script>
    <!-- App js -->
<script src="{{asset('adminto/js/app.min.js')}}"></script>
</body>
</html>

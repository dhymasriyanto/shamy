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
<!-- JS-->
<script type="text/javascript" src="{{asset('js/vue.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-vue.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/pjax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/app-custom.js')}}"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Polda Riau Satu Data: SDM dan Perencanaan" name="description" />
    <meta content="Pizaini and team" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <!-- App css -->
    <link href="{{ asset('adminto/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminto/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminto/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="drop-menu-dark">
    <div class="home-btn d-none d-sm-block">
        <a href="{{ route('home') }}" title="Home"><i class="fas fa-home h2 text-dark"></i></a>
    </div>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a class="nav-link" href="{{ route('auth.login.form') }}">
                            <span><img src="{{asset('images/logo.png') }}" alt="Logo" height="54"></span>
                        </a>
                        {{config('app.name')}}
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>
                            @if ($message = Session::get('auth.error'))
                                <div class="alert alert-warning alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ $message }}
                                </div>
                            @endif
                            <p class="text-muted">Sign in menggunakan:</p>
                            <ul class="list-group mb-0 user-list">
                                <li class="list-group-item">
                                    <a href="{{route('auth.login.redirect')}}" class="user-list-item">
                                        <div class="user avatar-sm float-left mr-2">
                                            <img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="user-desc">
                                            <h5 class="name mt-0 mb-1">AULIA ID</h5>
                                            <p class="desc text-muted mb-0 font-12">Single identity STAI Auliaurrasyidin</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <hr>
                            <footer class="blockquote-footer text-muted">Autentikasi single identity. <a href="{{config('services.laravelpassport.host').'/tentang'}}">Pelajari lebih lanjut</a> </footer>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->


    </div>
    <!-- end page -->
    <footer class="footer" style="left: 0px !important;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    2018 - 2019 &copy; Shamy v{{env('APP_VERSION')}} by <a href="https://www.digistlab.com" target="_blank">Digistlab</a>
                </div>
                <div class="col-md-6">
                    <div class="text-md-right footer-links d-none d-sm-block">
                        <a href="javascript:void(0);">About Us</a>
                        <a href="javascript:void(0);">Help</a>
                        <a href="javascript:void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Vendor js -->
    <script src="{{asset('adminto/js/vendor.min.js')}}"></script>
    {{--    <!-- App js -->--}}
    <script src="{{asset('adminto/js/app.min.js')}}"></script>
</body>
</html>

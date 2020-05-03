<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Ulang | {{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{config('app.name_long')}}" name="description" />
    <meta content="{{config('app.author')}}" name="author" />
    <meta name="keywords" content="{{config('app.keywords')}}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <!-- App css -->
    <link href="{{ asset('adminto/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminto/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminto/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="authentication-bg">
<div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div>
<div class="home-btn d-none d-sm-block">
    <a href="{{ route('home') }}" title="Home"><i class="fas fa-home h2 text-dark"></i></a>
</div>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="text-center">
                    <a class="nav-link" href="{{ route('auth.login.form') }}">
                        <span><img src="{{asset('images/logo.png') }}" alt="Logo" height="64"></span>
                    </a>
                    <p class="text-muted mt-2 mb-4">{{config('app.name')}}</p>
                </div>
                <div class="text-center mb-4">
                    <h4 class="text-uppercase mt-0">Daftar Ulang</h4>
                </div>
                <div class="card-group">
                    <div class="card">
                        <div class="card-body p-4">
                            @if ($errors->has('email') || $errors->has('password'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ $errors->first('username') }} {{ $errors->first('password') }}
                                </div>
                            @endif
                            <form method="POST" action="/daftarulang/{{$id}}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="password">NIM</label>
                                    <input class="form-control" id="nim" type="text" class="form-control" required disabled value="{{$nim}}" placeholder="Enter your password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Nama</label>
                                    <input class="form-control" id="nama" type="text" class="form-control" required disabled value="{{$nama}}" placeholder="Enter your password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input class="form-control" id="password" type="password" class="form-control" data-parsley-required-message="Password harus diisi!" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">{{ __('Konfirmasi Password') }}</label>
                                    <input class="form-control" id="password2" data-parsley-equalto="#password" type="password" data-parsley-required-message="Konfirmasi password harus diisi!" data-parsley-equalto-message="Password yang dimasukkan harus sama!" class="form-control" required  placeholder="Enter your confirmation password">
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block waves-effect btn-rounded" type="submit"> Daftar Ulang </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                        <div class="card-footer">
                            <div class="text-center blockquote-footer">
                                @if (Route::has('auth.register'))
                                    <a  href="{{ route('auth.register') }}" class="text-muted ml-1">{{ __('Belum terdaftar?') }}</a>
                                @endif
                                @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}" class="text-muted ml-1">{{ __('Lupa password?') }}</a>
                                @endif
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
    @include('partials.footer_large')
    <!-- Vendor js -->
    <script src="{{asset('adminto/js/vendor.min.js')}}"></script>
    {{--    <!-- App js -->--}}
    <script src="{{asset('adminto/js/app.min.js')}}"></script>

    <!-- Validation js (Parsleyjs) -->
    <script src="{{asset('adminto/libs/parsleyjs/parsley.min.js')}}"></script>

    <!-- validation init -->
    <script src="{{asset('adminto/js/pages/form-validation.init.js')}}"></script>
</body>
</html>

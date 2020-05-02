<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name', 'Laravel') }}</title>
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
                    <h4 class="text-uppercase mt-0">Sign In</h4>
                </div>
                <div class="card-group">
                    <div class="card">
                        <div class="card-body p-4">
                            @if ($errors->has('email') || $errors->has('password'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ $errors->first('email') }} {{ $errors->first('password') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('auth.login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="emailaddress">{{ __('E-Mail') }}</label>
                                    <input class="form-control" id="email" type="email"class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input class="form-control"id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input  class="custom-control-input" type="checkbox" name="remember"  id="remember" checked id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block waves-effect btn-rounded" type="submit"> Log In </button>
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
                    <div class="card">
                        <div class="card-body p-4">
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
                        </div> <!-- end card-body -->
                        <div class="card-footer">
                            <footer class="blockquote-footer text-muted">Autentikasi single identity. <a href="{{config('services.laravelpassport.host').'/tentang'}}">Pelajari lebih lanjut</a> </footer>
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
</body>
</html>

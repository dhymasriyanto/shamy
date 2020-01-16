@extends('layouts.main')
@section('title')
    Error 404 | {{ config('app.name', 'Laravel') }}
@endsection

@section('body')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a class="nav-link" href="{{ route('home') }}">
                            <span><img src="{{asset('images/logo.png') }}" alt="Logo" height="64"></span>
                        </a>
                        <p class="text-muted mt-2 mb-4">{{config('app.name')}}</p>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="text-center">
                                <h1 class="text-error">404</h1>
                                <h3 class="mt-3 mb-2">Page not Found</h3>
                                <p class="text-muted mb-3">It's looking like you may have taken a wrong turn. Don't worry... it happens to
                                    the best of us. You might want to check your internet connection. Here's a little tip that might
                                    help you get back on track.</p>

                                <a href="{{ route('home') }}" class="btn btn-danger waves-effect waves-light"><i class="fas fa-home mr-1"></i> Back to Home</a>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    @include('partials.footer_large')
@endsection

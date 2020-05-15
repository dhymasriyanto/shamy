<?php
use App\Libs\AppHelpers;
$title = 'Akademik';
$appendTitle = AppHelpers::appendTitle($title, true);
?>

@extends($appLayout)

@section('title', $appendTitle)

@section('page_title_top')
    <h4 class="page-title-main page_title_top_app">{{$title}}</h4>
@endsection

@section('main_content')
    <div class="main_content_app d-none">
        <!-- main app -->
        <div id="app" >
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title">Selamat Datang di Sistem Akademik</h4>
                                <p class="text-muted mb-4 font-14">
                                    STAI Auliaurrasyidin Tembilahan Riau
                                </p>

                                <div class="row">
                                    <div class="col-12">
{{--                                        TODO:<br>--}}
{{--                                        Mengolah data JSON,<br>--}}
{{--                                        Fitur lanjutan yang dibutuhkan,<br>--}}
{{--                                        Isi dashboard,<br>--}}
{{--                                        Foto,<br>--}}
{{--                                        Status aktif,<br>--}}
{{--                                        API,<br>--}}
{{--                                        JQuery Validate--}}
                                    </div>

                                </div>
                                <!-- end row -->

                            </div> <!-- end card-box -->
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
        {{--Templates--}}
        {{--Define your javascript below--}}
        <script type="text/javascript" src="{{asset('js/home/index.js')}}"></script>
    </div>
@endsection

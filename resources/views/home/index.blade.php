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
                                <p class="text-muted font-14">
                                    STAI Aulia
                                </p>

                                <!-- end row -->

                            </div> <!-- end card-box -->


                        </div><!-- end col -->
                    </div>
                    {{-- @if(Auth::user()->role == 'administrator') --}}
                    <div class="row">
                        <div class="col-4">
                          <div class="card-box">
                          <b>Jumlah Seluruh Kelas</b>
                          <h1 class="mt-2">@{{ datakelas.length }}</h1>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="card-box ">
                          <b>Jumlah Akta Ajar</b>
                          <h1  class="mt-2">@{{ datamengajar.length }}</h1>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="card-box ">
                        <b>Jumlah Kelas Kosong</b>
                        <h1  class="mt-2">@{{kelaskosong.length}}</h1>
                          </div>
                        </div>
                    </div>

                    <div class="col-12">
                    <div class="justify-content-center text-center ">
                      <div class="card-box  ">
                        <b>Jumlah Mahasiswa per Kelas</b>
                        <chart-component class="mt-2"></chart-component>

                      </div>
                    </div>
                  </div>
                      <div class="col-12">
                        <div class="justify-content-center text-center">
                          <div class="card-box">
                            <b >Jumlah Dosen per Jurusan</b>
                            <chart-component2 class="mt-2"></chart-component2>
                          </div>
                        </div>
                    </div>
{{-- @endif --}}



                </div>
            </div>
        </div>
        {{--Templates--}}
        {{--Define your javascript below--}}
        <script type="text/javascript" src="{{asset('js/home/index.js')}}"></script>
    </div>
@endsection

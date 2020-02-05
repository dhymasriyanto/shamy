<?php
use App\Libs\AppHelpers;
$title = 'Data Kurikulum';
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
                                <h4 class="m-t-0 header-title">Title</h4>
                                <p class="text-muted mb-4 font-14">
                                    Sub title
                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <a href="/kurikulum/tambah/" class="btn btn-dark waves-effect"> <i class="fa fa-plus mr-1"></i>Tambah</a><br><br>
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Mata Kuliah</th>
                                                <th>Jurusan</th>
                                                <th>Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="kurikulum in datakurikulum">
                                                <td>@{{  kurikulum.id }}</td>
                                                <td>@{{  kurikulum.nama }}</td>
                                                <td><button class="btn btn-danger waves-effect" @click="hapus(kurikulum.id)">Hapus
                                                    </button></td>
                                            </tr>
                                            </tbody>
                                        </table>
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
{{--        <script type="text/javascript" src="{{asset('js/home/index.js')}}"></script>--}}
        <script type="text/javascript" src="{{asset('js/kurikulum/index.js')}}"></script>
    </div>
@endsection

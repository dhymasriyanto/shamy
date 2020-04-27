<?php
use App\Libs\AppHelpers;
$title = 'Jadwal';
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
                                <div class="row">
                                    <div class="col-12">
                                        <a href="/mengajar/tambah/" class="btn btn-dark waves-effect"> <i class="fa fa-plus mr-1"></i>Tambah</a><br><br>
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Dosen</th>
                                                <th>Mata Kuliah</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="mengajar in datamengajar">
                                                <td>@{{  mengajar.id }}</td>
                                                <td>@{{  mengajar.nama }}</td>
                                                <td><button class="btn btn-danger waves-effect" @click="hapus(mengajar.id)">Hapus
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
        <script type="text/javascript" src="{{asset('js/mengajar/index.js')}}"></script>
    </div>
@endsection

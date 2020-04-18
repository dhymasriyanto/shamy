<?php

use App\Libs\AppHelpers;

$title = 'Data Kelas';
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
        <div id="app">
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
                                        <a href="/kelas/tambah/" class="btn btn-dark waves-effect"> <i
                                                class="fa fa-plus mr-1"></i>Tambah</a><br><br>
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Semester</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Tahun Ajaran</th>
{{--                                                <th>Mahasiswa</th>--}}
                                                <th>Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="kelas in datakelas">
                                                <td>@{{ kelas.id }}</td>
                                                <td>@{{ kelas.semester }}</td>
                                                <td>@{{ kelas.nama }}</td>
                                                <td>@{{ kelas.get_jurusan.nama }}</td>
                                                <td>@{{ kelas.get_tahun_ajaran.tahun_ajaran }}</td>
{{--                                                <td><span v-for="mahasiswa in datamahasiswa">--}}
{{--                                                        <span v-for="n in kelas.mahasiswa.length">--}}
{{--                                                            <p v-if="kelas.mahasiswa[n-1] == mahasiswa.id">--}}
{{--                                                                @{{ (n)+ ". " + mahasiswa.nama }}--}}
{{--                                                            </p>--}}
{{--                                                        </span>--}}
{{--                                                    </span>--}}
{{--                                                </td>--}}
                                                <td>
                                                    <button class="btn btn-info waves-effect"
                                                            @click="lihatRincian(kelas.id)">Rincian
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div v-on:keyup.enter="lihatRincian" id="modalRincian" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Rincian {{$title}}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" v-for="kelas in rinciankelas">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama Kelas</label>
                                                        <div class="col-md-9">
                                                            <label class="col-md-3 col-form-label">@{{ kelas.nama
                                                                }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Semester</label>
                                                        <div class="col-md-9">
                                                            <label class="col-md-3 col-form-label">@{{ kelas.semester
                                                                }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jurusan</label>
                                                        <div class="col-md-9">
                                                            <label class="col-md-3 col-form-label">@{{
                                                                kelas.get_jurusan.nama }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                                        <div class="col-md-9">
                                                            <label class="col-md-3 col-form-label">@{{
                                                                kelas.get_tahun_ajaran.tahun_ajaran }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Peserta Didik</label>
                                                        <div class="col-md-9">
                                                                <span v-for="mahasiswa in allrinciankelas">

                                                        <span v-for="n in kelas.mahasiswa.length">
                                                            <p v-if="kelas.mahasiswa[n-1] == mahasiswa.id">
                                                                @{{ (n)+ ". " + mahasiswa.nama }}
                                                            </p>
                                                        </span>

                                                                </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                            </div> <!-- end card-box -->
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
        {{--Templates--}}
        {{--Define your javascript below--}}
        {{--        <script type="text/javascript" src="{{asset('js/home/index.js')}}"></script>--}}
        <script type="text/javascript" src="{{asset('js/kelas/index.js')}}"></script>
    </div>
@endsection

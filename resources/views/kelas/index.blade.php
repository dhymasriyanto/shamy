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
                                <h4 class="m-t-0 header-title">Data Kelas</h4>
                                <p class="text-muted mb-4 font-14">
                                    Sub title
                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-dark waves-effect" data-toggle="modal"
                                                data-target="#modaltambah"><i
                                                class="fa fa-plus mr-1"></i>Tambah
                                        </button>
                                        <br><br>
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Semester</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Jumlah Peserta Didik</th>
                                                {{--                                                <th>Mahasiswa</th>--}}
                                                <th>Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(kelas,n) in datakelas">
                                                <td>@{{ (n+1) }}</td>
                                                <td>@{{ kelas.semester }}</td>
                                                <td>@{{ kelas.nama }}</td>
                                                <td>@{{ kelas.get_jurusan.nama }}</td>
                                                <td>@{{ kelas.get_tahun_ajaran.tahun_ajaran }}</td>
                                                <td v-if="!kelas.mahasiswa.length">Belum ada peserta didik</td>
                                                <td v-else>@{{ kelas.mahasiswa.length }}</td>
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
                                                            @click="lihatRincian(kelas.id)"><i class="fas fa-th-list mr-1"></i>Rincian
                                                    </button>
                                                    <button type="button" @click="edit(kelas.id)"
                                                            class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-edit mr-1"></i>Edit
                                                    </button>
                                                    <button class="btn btn-danger waves-effect"
                                                            @click="hapusdata(kelas.id)"><i
                                                            class="fa fa-trash mr-1"></i>Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- end row -->


                                <!-- sample modal content -->
                                <div v-on:keyup.enter="hapus" id="modalhapus" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Yakin ingin menghapus @{{ editnama }} ? </h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success waves-effect waves-light"
                                                        data-dismiss="modal">Tidak
                                                </button>
                                                <button type="button" @click="hapus()"
                                                        class="btn btn-danger waves-effect waves-light">Ya
                                                </button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
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
                                                <div v-for="kelas in rinciankelas">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama Kelas</label>
                                                        <div class="col-md-9">
                                                            <label class="col-form-label">: @{{ kelas.nama }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Semester</label>
                                                        <div class="col-md-9">
                                                            <label class=" col-form-label">: @{{ kelas.semester
                                                                }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jurusan</label>
                                                        <div class="col-md-9">
                                                            <label class="col-form-label">: @{{
                                                                kelas.get_jurusan.nama }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                                        <div class="col-md-9">
                                                            <label class=" col-form-label">: @{{
                                                                kelas.get_tahun_ajaran.tahun_ajaran }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-form-label row">Peserta Didik</label>
                                                        <div >
                                                            <div
                                                                v-if="!kelas.mahasiswa.length">Belum ada peserta didik
                                                            </div>
                                                            <div v-else>

                                                                <table class="table table-bordered table-hover">

                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama</th>
                                                                        <th>NIM</th>
                                                                        <th>Jurusan</th>
                                                                        <th>Opsi</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>


                                                                    <tr v-for="(mahasiswa, n) in allrinciankelas">
                                                                        <td>
{{--                                                                            <div v-for="n in kelas.mahasiswa.length">--}}
{{--                                                                                <div--}}
{{--                                                                                    v-if="kelas.mahasiswa[n-1] == mahasiswa.id">--}}

                                                                                    @{{ (n+1) }}


{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
                                                                        </td>
                                                                        <td>
                                                                            @{{ mahasiswa.nama }}

                                                                        </td>
                                                                        <td>
                                                                            @{{ mahasiswa.nomor_induk }}

                                                                        </td>
                                                                        <td>
                                                                            @{{ mahasiswa.get_jurusan.nama }}

                                                                        </td>
                                                                        <td>
{{--                                                                            <button class="btn btn-danger waves-effect"--}}
{{--                                                                                    @click="hapusmahasiswa(kelas.id, mahasiswa.id)"><i--}}
{{--                                                                                    class="fa fa-trash mr-1"></i>Hapus--}}
{{--                                                                            </button>--}}
                                                                            <button class="btn btn-danger waves-effect"
                                                                                    @click="hapusmodal(kelas.id, mahasiswa.id)"><i
                                                                                    class="far fa-window-close mr-1"></i>Keluarkan
                                                                            </button>

{{--                                                                            <button class="btn btn-danger waves-effect" data-toggle="modal" data-target="#hapusmodal"><i--}}
{{--                                                                                    class="fa fa-trash mr-1"></i>Hapus--}}
{{--                                                                            </button>--}}
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>

                                                                </table>

                                                            </div>

                                                            {{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div v-on:keyup.enter="hapus" id="hapusmodal" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Yakin ingin mengeluarkan @{{ editnama }} dari kelas? </h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success waves-effect waves-light"
                                                        data-dismiss="modal">Tidak
                                                </button>
                                                <button type="button" @click="hapusmahasiswa()"
                                                        class="btn btn-danger waves-effect waves-light">Ya
                                                </button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div v-on:keyup.enter="create" id="modaltambah" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Tambah {{$title}}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama Kelas</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" type="text" class="form-control"
                                                                   v-model="nama">
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Semester</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" type="text" class="form-control"
                                                                   v-model="semester">
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jurusan</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="id_jurusan">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="jurusan in datajurusan"
                                                                        v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="id_tahun_ajaran">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="tahun_ajaran in datatahunajaran"
                                                                        v-bind:value="tahun_ajaran.id">
                                                                    @{{ tahun_ajaran.tahun_ajaran }}
                                                                </option>
                                                            </select>
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
{{--                                                        <label class="col-md-3 col-form-label">Mahasiswa</label>--}}
                                                        <div class="col-md-9">
                                                            <input hidden name="mahasiswa" type="text"
                                                                   class="form-control"
                                                                   v-model="mahasiswa" value="[]">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                                        data-dismiss="modal">Batal
                                                </button>
                                                <button type="button" @click="create()"
                                                        class="btn btn-success waves-effect waves-light">Simpan
                                                </button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div v-on:keyup.enter="update" id="modaledit" class="modal fade" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" method="POST">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama Kelas</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" type="text" class="form-control"
                                                                   v-model="editnama">
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Semester</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" type="text" class="form-control"
                                                                   v-model="editsemester">
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jurusan</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editid_jurusan">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="jurusan in datajurusan"
                                                                        v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editid_tahun_ajaran">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="tahun_ajaran in datatahunajaran"
                                                                        v-bind:value="tahun_ajaran.id">
                                                                    @{{ tahun_ajaran.tahun_ajaran }}
                                                                </option>
                                                            </select>
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
{{--                                                        <label class="col-md-3 col-form-label">Mahasiswa</label>--}}
                                                        <div class="col-md-9">
                                                            <input hidden name="mahasiswa" type="text"
                                                                   class="form-control"
                                                                   v-model="editmahasiswa">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                                        data-dismiss="modal">Batal
                                                </button>
                                                <button type="button" @click="update()"
                                                        class="btn btn-success waves-effect waves-light">Simpan
                                                </button>
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

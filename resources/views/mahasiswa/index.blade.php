<?php
use App\Libs\AppHelpers;
$title = 'Data Mahasiswa';
$appendTitle = AppHelpers::appendTitle($title, true);
?>

@extends($appLayout)

@section('title', $appendTitle)

@section('page_title_top')
    <h4 class="page-title-main page_title_top_app">{{$title}}</h4>
@endsection

@section('main_content')
    <link href="{{asset('adminto/libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <div class="main_content_app d-none">
        <!-- main app -->
        <div id="app">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title">Data Mahasiswa</h4>
                                <p class="text-muted mb-4 font-14">
                                    Sub title
                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-dark waves-effect" data-toggle="modal" data-target="#modaltambah"> <i
                                                class="fa fa-plus mr-1" ></i>Tambah</button><br><br>
                                        <div class="form-row">
                                            <div class="col-3">
                                                <h5>Jurusan</h5>
                                                <select class="form-control" v-model="search">
                                                    <option value="">Semua</option>
                                                    <option v-for="jurusan in datajurusan" v-bind:value="jurusan.nama">
                                                        @{{ jurusan.nama }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <h5>Nama</h5>
                                                <input class="form-control" v-model="search2"><br><br>
                                            </div>
                                        </div>
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIM</th>
                                                <th>Jurusan</th>
                                                <th>Status Aktif</th>
                                                <th>Jenis Pendaftaran</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tempat, Tanggal Lahir</th>
                                                <th>Agama</th>
                                                <th>Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(mahasiswa,no) in filteredItems">
                                                <td>@{{  no+1 }}</td>
                                                <td>@{{  mahasiswa.nama }}</td>
                                                <td>@{{  mahasiswa.nomor_induk }}</td>
                                                <td>@{{  mahasiswa.get_jurusan.nama }}</td>
                                                <td>-</td>
                                                <td>@{{  mahasiswa.jenis_pendaftaran }}</td>
                                                <td>@{{  mahasiswa.jenis_kelamin }}</td>
                                                <td>@{{  mahasiswa.tempat_lahir }}, @{{  mahasiswa.tanggal_lahir }}</td>
                                                <td>@{{  mahasiswa.agama }}</td>
                                                <td><button type="button" @click="edit(mahasiswa.id)" class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-edit mr-1" ></i>Edit</button>
                                                    <button class="btn btn-danger waves-effect" @click="hapusdata(mahasiswa.id)"><i
                                                            class="fa fa-trash mr-1" ></i>Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- end row -->
                                <!-- sample modal content -->
                                <div v-on:keyup.enter="hapus" id="modalhapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Yakin ingin menghapus @{{ editnama }} ? </h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal">Tidak</button>
                                                <button type="button" @click="hapus()" class="btn btn-danger waves-effect waves-light">Ya</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div v-on:keyup.enter="create" id="modaltambah" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Tambah {{$title}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="nama">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">NIM</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="nim">
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
                                                                <option v-for="jurusan in datajurusan" v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis Pendaftaran</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="jenis_pendaftaran">
                                                                <option disabled value="">Pilih</option>
                                                                <option value="Peserta didik baru">Peserta didik baru</option>
                                                                <option value="Pindahan">Pindahan</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="jenis_kelamin">
                                                                <option disabled value="">Pilih</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tempat Lahir</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="tempat_lahir">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tanggal Lahir</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="date" class="form-control" v-model="tanggal_lahir">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Agama</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="agama">
                                                                <option disabled value="">Pilih</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                                <option value="Katolik">Katolik</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Buddha">Buddha</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Batal</button>
                                                <button type="button" @click="create()" class="btn btn-success waves-effect waves-light">Simpan</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div v-on:keyup.enter="update" id="modaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="editnama">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">NIM</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="editnim">
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
                                                                <option v-for="jurusan in datajurusan" v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis Pendaftaran</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editjenis_pendaftaran">
                                                                <option disabled value="">Pilih</option>
                                                                <option value="Peserta didik baru">Peserta didik baru</option>
                                                                <option value="Pindahan">Pindahan</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editjenis_kelamin">
                                                                <option disabled value="">Pilih</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tempat Lahir</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="edittempat_lahir">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tanggal Lahir</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="date" class="form-control" v-model="edittanggal_lahir">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Agama</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editagama">
                                                                <option disabled value="">Pilih</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                                <option value="Katolik">Katolik</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Buddha">Buddha</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Batal</button>
                                                <button type="button" @click="update()" class="btn btn-success waves-effect waves-light">Simpan</button>
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
        <script src="{{asset('adminto/libs/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('adminto/js/pages/toastr.init.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/mahasiswa/index.js')}}"></script>
    </div>
@endsection

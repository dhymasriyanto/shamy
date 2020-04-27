<?php
use App\Libs\AppHelpers;
$title = 'Data Mata Kuliah';
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
                                                <input class="form-control" v-model="search2">
                                            </div>
                                            <div class="col-3">
                                                <h5>Bobot</h5>
                                                <select class="form-control" v-model="search3">
                                                    <option selected value="">Pilih</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <h5>Jenis</h5>
                                                <select class="form-control" v-model="search4">
                                                    <option selected value="">Pilih</option>
                                                    <option value="Wajib Program Studi">Wajib Program Studi</option>
                                                    <option value="Pilihan">Pilihan</option>
                                                    <option value="Tugas akhir/Skripsi/Tesis/Disertasi">Tugas akhir/Skripsi/Tesis/Disertasi</option>
                                                </select><br><br>
                                            </div>
                                        </div>
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Singkatan</th>
                                                <th>Kurikulum</th>
                                                <th>Bobot</th>
                                                <th>Jenis</th>
                                                <th>Program Studi</th>
                                                <th>Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(matakuliah,no) in filteredItems">
                                                <td>@{{  no+1 }}</td>
                                                <td>@{{  matakuliah.kode }}</td>
                                                <td>@{{  matakuliah.nama }}</td>
                                                <td>@{{  matakuliah.singkatan }}</td>
                                                <td>@{{  matakuliah.get_kurikulum.nama }}</td>
                                                <td>@{{  matakuliah.bobot }}</td>
                                                <td>@{{  matakuliah.jenis }}</td>
                                                <td>@{{  matakuliah.get_jurusan.nama }}</td>
                                                <td><button type="button" @click="edit(matakuliah.id)" class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-edit mr-1" ></i>Edit</button>
                                                    <button class="btn btn-danger waves-effect" @click="hapusdata(matakuliah.id)"><i
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
                                <div v-on:keyup.enter="create" id="modaltambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
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
                                                        <label class="col-md-3 col-form-label">Kode</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="kode">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Singkatan</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="singkatan">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Kurikulum</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="id_kurikulum">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="kurikulum in datakurikulum" v-bind:value="kurikulum.id">
                                                                    @{{ kurikulum.nama }}
                                                                </option>
                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Bobot (SKS)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="bobot">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="jenis">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="Wajib Program Studi">Wajib Program Studi</option>
                                                                <option value="Pilihan">Pilihan</option>
                                                                <option value="Tugas akhir/Skripsi/Tesis/Disertasi">Tugas akhir/Skripsi/Tesis/Disertasi</option>
                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Program Studi</label>
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
                                    <div class="modal-dialog">
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
                                                        <label class="col-md-3 col-form-label">Kode</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="editkode">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Singkatan</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="editsingkatan">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Kurikulum</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editid_kurikulum">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="kurikulum in datakurikulum" v-bind:value="kurikulum.id">
                                                                    @{{ kurikulum.nama }}
                                                                </option>
                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Bobot (SKS)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editbobot">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>

                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="editjenis">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="Wajib Program Studi">Wajib Program Studi</option>
                                                                <option value="Pilihan">Pilihan</option>
                                                                <option value="Tugas akhir/Skripsi/Tesis/Disertasi">Tugas akhir/Skripsi/Tesis/Disertasi</option>
                                                            </select>
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Program Studi</label>
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
        <script src="{{asset('adminto/libs/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('adminto/js/pages/toastr.init.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/mata-kuliah/index.js')}}"></script>
    </div>
@endsection

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
                                        <div>
                                            <div class="col-sm-1" style="margin-bottom: 1.5rem; padding-left: 0px; ">
                                                <h5>Jumlah entri</h5>
                                                <b-form-select
                                                    v-model="perPage"
                                                    id="perPageSelect"
                                                    class="form-control"
                                                    :options="pageOptions">
                                                </b-form-select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="alert alert-warning" v-if="!filteredItems.length">
                                                <strong>Sorry!</strong> No data
                                            </div>
                                            <b-table
                                                v-if="filteredItems.length"
                                                head-variant="dark"
                                                ref="table"
                                                striped
                                                hover
                                                :items="filteredItems"
                                                :fields="fields"
                                                :current-page="currentPage"
                                                :per-page="perPage"
                                                :filter="filter"
                                                selectable
                                                select-mode="single"
                                                responsive="md">
                                                <template v-slot:cell(index)="data">
                                                    @{{ data.index + 1 }}
                                                </template>
                                                <template v-slot:cell(tempattanggal)="data">
                                                    @{{ data.item.tempat_lahir }}, @{{ data.item.tanggal_lahir }}
                                                </template>
                                                <template v-slot:cell(aksi)="data">
                                                    <div class="button-list">
                                                        <button type="button" @click="edit(data.item.id)" class="btn btn-success waves-effect waves-light"><i
                                                                class="mdi mdi-18px mdi-file-document-edit-outline" ></i> Ubah </button>
                                                        <button class="btn btn-danger waves-effect" @click="hapusdata(data.item.id)"><i
                                                                class="mdi mdi-18px mdi-delete-forever" ></i> Hapus
                                                        </button>
                                                    </div>
                                                </template>
                                            </b-table>
                                            <div class="col-12 col-md-6 float-left">
                                                <p>Menampilkan @{{(currentPage*perPage+1)-perPage}} sampai @{{(currentPage*perPage)}} dari @{{totalRows}} data</p>
                                            </div>
                                            <div class="col-12 col-md-6 float-right">
                                                <b-pagination
                                                    v-model="currentPage"
                                                    :total-rows="totalRows"
                                                    :per-page="perPage"
                                                    align="right"
                                                    class="my-0">
                                                </b-pagination>
                                            </div>
                                        </div>
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
                                                <form @submit.prevent="create()" id="formtambah">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="text" class="form-control" v-model="nama">
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Kode</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="text" class="form-control" v-model="kode">
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Singkatan</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="text" class="form-control" v-model="singkatan">
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Kurikulum</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="id_kurikulum">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="kurikulum in datakurikulum" v-bind:value="kurikulum.id">
                                                                    @{{ kurikulum.nama }}
                                                                </option>
                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Bobot (SKS)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="bobot">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>

                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="jenis">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="Wajib Program Studi">Wajib Program Studi</option>
                                                                <option value="Pilihan">Pilihan</option>
                                                                <option value="Tugas akhir/Skripsi/Tesis/Disertasi">Tugas akhir/Skripsi/Tesis/Disertasi</option>
                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Program Studi</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="id_jurusan">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="jurusan in datajurusan" v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"><i class="mdi mdi-18px mdi-file-cancel-outline"></i> Batal </button>
                                                <button type="submit" form="formtambah" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-18px mdi-content-save-outline"></i> Simpan </button>
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
                                                <form @submit.prevent="update()" id="formedit">
                                                    <!-- Name -->
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="text" class="form-control" v-model="editnama">
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Kode</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="text" class="form-control" v-model="editkode">
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Singkatan</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="text" class="form-control" v-model="editsingkatan">
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Kurikulum</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="editid_kurikulum">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="kurikulum in datakurikulum" v-bind:value="kurikulum.id">
                                                                    @{{ kurikulum.nama }}
                                                                </option>
                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Bobot (SKS)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="editbobot">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>

                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Jenis</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="editjenis">
                                                                <option disabled selected value="">Pilih</option>
                                                                <option value="Wajib Program Studi">Wajib Program Studi</option>
                                                                <option value="Pilihan">Pilihan</option>
                                                                <option value="Tugas akhir/Skripsi/Tesis/Disertasi">Tugas akhir/Skripsi/Tesis/Disertasi</option>
                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Program Studi</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" required v-model="editid_jurusan">
                                                                <option disabled value="">Pilih</option>
                                                                <option v-for="jurusan in datajurusan" v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
{{--                                                            <span style="color: red" class="form-text text-muted">--}}
{{--                                                                **keterangan--}}
{{--                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"><i class="mdi mdi-18px mdi-file-cancel-outline"></i> Batal </button>
                                                <button type="submit" form="formedit" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-18px mdi-content-save-outline"></i> Simpan </button>
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

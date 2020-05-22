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
    <link href="{{asset('adminto/libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <div class="main_content_app d-none">
        <!-- main app -->
        <div id="app">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-dark waves-effect" data-toggle="modal" data-target="#modaltambah"> <i
                                    class="fa fa-plus mr-1" ></i>Tambah</button>
                            <div style="float: right" class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><b-link href="/">Beranda</b-link></li>
                                        <li class="breadcrumb-item active">{{$title}}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-12">
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <h5>Nama</h5>
                                                        <input class="form-control" v-model="search"><br><br>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="col-sm-1" style="margin-bottom: 1.5rem; margin-top: -1.5rem; padding-left: 0px; ">
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
                                                        <strong>Maaf!</strong> Data Tidak Ada
                                                    </div>
                                                    <b-table
                                                        v-if="filteredItems.length"
                                                        head-variant="dark"
                                                        ref="table"
                                                        striped
                                                        hover
                                                        bordered
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
                                                        <template v-slot:cell(aturanjumlahsks)="data">
                                                            @{{ data.item.aturan_lulus }} - @{{ data.item.aturan_wajib }} - @{{ data.item.aturan_pilihan }}
                                                        </template>
                                                        <template v-slot:cell(jumlahsks)="data">
                                                            @{{ data.item.skswajib }} - @{{ data.item.skspilihan }}
                                                        </template>
                                                        <template v-slot:cell(aksi)="data">
                                                            <div class="button-list">
                                                                <button type="button" @click="lihatRincian(data.item.id)" class="btn btn-info waves-effect waves-light"><i
                                                                        class="mdi mdi-18px mdi-file-document-edit-outline" ></i> Rincian </button>
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
                                    </div>
                                <!-- end row -->
                        <div v-on:keyup.enter="lihatRincian" id="modalRincian" class="modal fade" tabindex="-1"
                             role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Rincian Mata Kuliah di Kurikulum @{{namamodal}}</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div v-for="matkul in rincianmatkul">
                                            <!-- Name -->
                                            <button class="btn btn-dark waves-effect" data-dismiss="modal" data-toggle="modal" @click="allMataKuliah()"> <i
                                                    class="fa fa-plus mr-1" ></i>Tambah</button><br><br>
                                            <div class="form-group">
                                                <div>
                                                    <div class="form-row">
                                                        <div class="col-md-3">
                                                            <h5>Kode MK</h5>
                                                            <input class="form-control" v-model="search6"><br><br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <h5>Nama</h5>
                                                            <input class="form-control" v-model="search5"><br><br>
                                                        </div>
                                                    </div>

                                                    </div>
                                                    <div>
                                                        <div class="col-sm-1" style="margin-bottom: 1.5rem; margin-top: -1.5rem; padding-left: 0px; ">
                                                            <h5>Jumlah entri</h5>
                                                            <b-form-select
                                                                v-model="perPage2"
                                                                id="perPageSelect"
                                                                class="form-control"
                                                                :options="pageOptions2">
                                                            </b-form-select>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="alert alert-warning" v-if="!filteredItems2.length">
                                                            <strong>Maaf!</strong> Data Tidak Ada
                                                        </div>
                                                        <b-table
                                                            v-if="filteredItems2.length"
                                                            head-variant="dark"
                                                            ref="table"
                                                            striped
                                                            hover
                                                            bordered
                                                            :items="filteredItems2"
                                                            :fields="fields2"
                                                            :current-page="currentPage2"
                                                            :per-page="perPage2"
                                                            :filter="filter"
                                                            selectable
                                                            select-mode="single"
                                                            responsive="md">
                                                            <template v-slot:cell(index)="data">
                                                                @{{ data.index + 1 }}
                                                            </template>
                                                            <template v-slot:cell(aksi)="data">
                                                                <div class="button-list">
                                                                    <button class="btn btn-danger waves-effect" @click="modalHapusRincian(data.item.id,data.item.nama)"><i
                                                                            class="mdi mdi-18px mdi-delete-forever" ></i> Hapus
                                                                    </button>
                                                                </div>
                                                            </template>
                                                        </b-table>
                                                        <div class="col-12 col-md-6 float-left">
                                                            <p>Menampilkan @{{(currentPage*perPage+1)-perPage}} sampai @{{(currentPage*perPage)}} dari @{{totalRows2}} data</p>
                                                        </div>
                                                        <div class="col-12 col-md-6 float-right">
                                                            <b-pagination
                                                                v-model="currentPage2"
                                                                :total-rows="totalRows2"
                                                                :per-page="perPage2"
                                                                align="right"
                                                                class="my-0">
                                                            </b-pagination>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        <div v-on:keyup.enter="tambahRincian" id="modalTambahRincian" class="modal fade" tabindex="-1"
                             role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Tambah Mata Kuliah di Kurikulum @{{namamodal}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" data-toggle="modal" data-target="#modalRincian"
                                                aria-hidden="true">×
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div v-for="matkul in rincianmatkul">
                                            <!-- Name -->
                                            <div class="form-group">
                                                <div >
                                                    <div class="form-row">
                                                        <div class="col-md-3">
                                                            <h5>Kode MK</h5>
                                                            <input class="form-control" v-model="search8"><br><br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <h5>Nama</h5>
                                                            <input class="form-control" v-model="search7"><br><br>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="col-sm-1" style="margin-bottom: 1.5rem; margin-top: -1.5rem; padding-left: 0px; ">
                                                            <h5>Jumlah entri</h5>
                                                            <b-form-select
                                                                v-model="perPage3"
                                                                id="perPageSelect"
                                                                class="form-control"
                                                                :options="pageOptions3">
                                                            </b-form-select>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="alert alert-warning" v-if="!filteredItems3.length">
                                                            <strong>Maaf!</strong> Data Tidak Ada
                                                        </div>
                                                        <b-table
                                                            v-if="filteredItems3.length"
                                                            head-variant="dark"
                                                            ref="table"
                                                            striped
                                                            hover
                                                            bordered
                                                            :items="filteredItems3"
                                                            :fields="fields3"
                                                            :current-page="currentPage3"
                                                            :per-page="perPage3"
                                                            :filter="filter"
                                                            selectable
                                                            select-mode="single"
                                                            responsive="md">
                                                            <template v-slot:cell(index)="data">
                                                                @{{ data.index + 1 }}
                                                            </template>
                                                            <template v-slot:cell(aksi)="data">
                                                                <div class="button-list">
                                                                    <button class="btn btn-success waves-effect" @click="tambahRincian(data.item.id)"><i
                                                                            class="mdi mdi-18px mdi-plus" ></i> Tambahkan
                                                                    </button>
                                                                </div>
                                                            </template>
                                                        </b-table>
                                                        <div class="col-12 col-md-6 float-left">
                                                            <p>Menampilkan @{{(currentPage3*perPage3+1)-perPage3}} sampai @{{(currentPage3*perPage3)}} dari @{{totalRows3}} data</p>
                                                        </div>
                                                        <div class="col-12 col-md-6 float-right">
                                                            <b-pagination
                                                                v-model="currentPage3"
                                                                :total-rows="totalRows3"
                                                                :per-page="perPage3"
                                                                align="right"
                                                                class="my-0">
                                                            </b-pagination>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
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
                                                <button type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal"><i class="mdi mdi-18px mdi-close"></i> Tidak </button>
                                                <button type="button" @click="hapus()" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-18px mdi-check"></i> Iya </button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            <!-- sample modal content -->
                            <div v-on:keyup.enter="hapusRincian" id="modalhapusrincian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <button type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal"><i class="mdi mdi-18px mdi-close"></i> Tidak </button>
                                            <button type="button" @click="hapusRincian()" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-18px mdi-check"></i> Iya </button>
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
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Program Studi</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control custom-select" required v-model="id_jurusan">
                                                                <option disabled value="" selected>Pilih</option>
                                                                <option v-for="jurusan in datajurusan" v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Mulai Berlaku</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control custom-select" required v-model="id_tahun_ajaran">
                                                                <option disabled value="" selected>Pilih</option>
                                                                <option v-for="tahunajaran in datatahunajaran" v-bind:value="tahunajaran.id">
                                                                    @{{ tahunajaran.tahun_ajaran }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Aturan Jumlah SKS (Lulus)</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="number" class="form-control" v-model="aturan_lulus">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Aturan Jumlah SKS (Wajib)</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="number" class="form-control" v-model="aturan_wajib">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Aturan Jumlah SKS (Pilihan)</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="number" class="form-control" v-model="aturan_pilihan">
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
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Program Studi</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control custom-select" required v-model="editid_jurusan">
                                                                <option disabled value="" selected>Pilih</option>
                                                                <option v-for="jurusan in datajurusan" v-bind:value="jurusan.id">
                                                                    @{{ jurusan.nama }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Mulai Berlaku</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control custom-select" required v-model="editid_tahun_ajaran">
                                                                <option disabled value="" selected>Pilih</option>
                                                                <option v-for="tahunajaran in datatahunajaran" v-bind:value="tahunajaran.id">
                                                                    @{{ tahunajaran.tahun_ajaran }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Aturan Jumlah SKS (Lulus)</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="number" class="form-control" v-model="editaturan_lulus">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Aturan Jumlah SKS (Wajib)</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="number" class="form-control" v-model="editaturan_wajib">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Aturan Jumlah SKS (Pilihan)</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" required type="number" class="form-control" v-model="editaturan_pilihan">
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="createdby" class="col-form-label">Dibuat oleh</label>
                                                        <input style="background-color: rgba(128,128,128,0.18)" class="form-control" id="createdby" disabled v-model="created_by">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="updatedby" class="col-form-label">Terakhir diubah oleh</label>
                                                        <input style="background-color: rgba(128,128,128,0.18)" class="form-control" id="updatedby" disabled v-model="updated_by">
                                                    </div>
                                                </div>
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
        <script src="{{asset('adminto/libs/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('adminto/js/pages/toastr.init.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/kurikulum/index.js')}}"></script>
    </div>
@endsection

<?php
use App\Libs\AppHelpers;
$title = 'Data Dosen';
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
                                                <input class="form-control" v-model="search2"><br><br>
                                            </div>
                                        </div>
                                    <div>
                                        <div class="col-12 col-md-4 my-3 float-left">
                                            <b-form-group
                                                label="Per page"
                                                label-cols-sm="3"
                                                label-align-sm="left"
                                                label-size="sm"
                                                label-for="perPageSelect"
                                                class="ml-0">
                                                <b-form-select
                                                    v-model="perPage"
                                                    id="perPageSelect"
                                                    size="sm"
                                                    :options="pageOptions">
                                                </b-form-select>
                                            </b-form-group>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="alert alert-warning" v-if="!filteredItems.length">
                                            <strong>Sorry!</strong> No data
                                        </div>
                                        <b-table
                                            v-if="filteredItems.length"
                                            head-variant="light"
                                            ref="table"
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
                                                <button type="button" @click="edit(data.item.id)" class="btn btn-success waves-effect waves-light"><i
                                                        class="fa fa-edit mr-1" ></i>Edit</button>
                                                <button class="btn btn-danger waves-effect" @click="hapusdata(data.item.id)"><i
                                                        class="fa fa-trash mr-1" ></i>Hapus
                                                </button>
                                            </template>
                                        </b-table>
                                        <div class="col-12 col-md-6 float-left">
                                            <p>Showing @{{(currentPage*perPage+1)-perPage}} to @{{(currentPage*perPage)}} of @{{totalRows}} entries</p>
                                        </div>
                                        <div class="col-12 col-md-6 float-right">
                                            <b-pagination
                                                v-model="currentPage"
                                                :total-rows="totalRows"
                                                :per-page="perPage"
                                                align="right"
                                                size="sm"
                                                class="my-0"
                                                pills>
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
                                                        <label class="col-md-3 col-form-label">NIDN</label>
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" v-model="nip">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" v-model="nama">
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
                                                            <input type="text" class="form-control" v-model="tempat_lahir">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Tanggal Lahir</label>
                                                        <div class="col-md-9">
                                                            <input type="date" class="form-control" v-model="tanggal_lahir">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Agama</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="agama">
                                                                <option value="Tidak diisi">Pilih</option>
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
                                                        <label class="col-md-3 col-form-label">NIDN</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="editnip">
                                                            <span style="color: red" class="form-text text-muted">
                                                                **keterangan
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Nama</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" type="text" class="form-control" v-model="editnama">
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
                                                                <option value="Tidak diisi">Pilih</option>
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
        <script src="{{asset('adminto/libs/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('adminto/js/pages/toastr.init.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/dosen/index.js')}}"></script>

    </div>
@endsection

<?php
use App\Libs\AppHelpers;
$title = 'Data Tahun Ajaran';
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
                                <h4 class="m-t-0 header-title">Data Tahun Ajaran</h4>
                                <p class="text-muted mb-4 font-14">
                                    Sub title
                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-dark waves-effect" data-toggle="modal" data-target="#modaltambah"> <i
                                                class="fa fa-plus mr-1" ></i>Tambah</button><br><br>
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(tahunajaran,no) in datatahunajaran">
                                                <td>@{{  no+1 }}</td>
                                                <td>@{{  tahunajaran.tahun_ajaran }}</td>
                                                <td><button type="button" @click="edit(tahunajaran.id)" class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-edit mr-1" ></i>Edit</button>
                                                    <button class="btn btn-danger waves-effect" @click="hapusdata(tahunajaran.id)"><i
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
                                <div id="modalhapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Yakin ingin menghapus @{{ edittahun_ajaran }} ? </h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal">Tidak</button>
                                                <button type="button" @click="hapus()" class="btn btn-danger waves-effect waves-light">Ya</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div id="modaltambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                        <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                                        <div class="col-md-9">
                                                            <input name="nama"  type="text" class="form-control" v-model="tahun_ajaran">
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
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
                                <div id="modaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                        <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                                        <div class="col-md-9">
                                                            <input name="nama" id="edittahun_ajaran" type="text" class="form-control" v-model="edittahun_ajaran">
                                                            <span id="pesan" class="form-text text-muted">
                                                            </span>
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
        <script type="text/javascript" src="{{asset('js/tahun-ajaran/index.js')}}"></script>
    </div>
@endsection

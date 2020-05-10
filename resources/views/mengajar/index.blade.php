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
                                                    <b-button pill variant="dark" class="mb-2" href="" v-b-modal.modal-1><i
                                                    class="fa fa-plus mr-1"></i>Tambah
                                        </b-button>
                                        <b-modal id="modal-1" title="Tambah data">
                                            <p class="my-4"> Hello </p>
                                        </b-modal>
                                        <b-table
                                                head-variant="light"
                                                id="my-table"
                                                hover
                                                :busy="isBusy"
                                                :items="datamengajar"
                                                :fields="fields"
                                                :per-page="perPage"
                                                :current-page="currentPage"
                                                small
                                        >
                                            <template v-slot:table-busy>
                                                <div class="text-center text-danger my-2">
                                                    <b-spinner class="align-middle"></b-spinner>
                                                    <strong>Memuat...</strong>
                                                </div>
                                            </template>
                                            <template v-slot:cell(no)="data">
                                                @{{ data.index + 1 }}
                                            </template>
                                            <template v-slot:cell(get_jurusan)="data">
                                                @{{ data.item.get_jurusan.nama }}
                                            </template>
                                            <template v-slot:cell(get_kelas)="data">
                                                @{{ data.item.get_kelas.nama }}
                                            </template>
                                            <template v-slot:cell(get_dosen)="data">
                                                @{{ data.item.get_dosen.nama }}
                                            </template>
                                            <template v-slot:cell(get_mata_kuliah)="data">
                                                @{{ data.item.get_mata_kuliah.nama }}
                                            </template>
                                            <template v-slot:cell(get_tahun_ajaran)="data">
                                                @{{ data.item.get_tahun_ajaran.tahun_ajaran }}
                                            </template>
                                            <template v-slot:cell(aksi)="data">
                                                <b-button pill variant="info">Rincian</b-button>
                                            </template>

                                        </b-table>
                                        <div class="col-12 col-md-6 float-left">
                                            <p>Current Page: @{{ currentPage }}</p>
                                        </div>
                                        <div class="col-12 col-md-6 float-right">
                                            <b-pagination
                                                    pills
                                                    size="sm"
                                                    v-model="currentPage"
                                                    :total-rows="rows"
                                                    :per-page="perPage"
                                                    aria-controls="my-table"
                                            >
                                            </b-pagination>
                                        </div>
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
        <script type="text/javascript" src="{{asset('js/mengajar/index.js')}}"></script>
    </div>
@endsection

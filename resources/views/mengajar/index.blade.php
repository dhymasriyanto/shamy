<?php

use App\Libs\AppHelpers;

$title = 'Akta Ajar';
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
            <vue-progress-bar></vue-progress-bar>
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">

                                <div class="row">
                                    <div class="col-12">

                                        <b-button pill variant="dark" class="mb-3" href="" v-b-modal.modal-1><i
                                                    class="fa fa-plus mr-1"></i>Tambah
                                        </b-button>
                                        <b-modal
                                                id="modal-1"
                                                {{--                                            :show="resetModal"--}}
                                                @hidden="resetModal"
                                                @ok="handleOk"
                                        >
                                            <b-form ref="form" @submit.stop.prevent="handleSubmit">
                                                <b-input-group>
                                                    <label class="col-md-3 col-form-label">Jurusan</label>
                                                    <b-form-group
                                                            size="sm"
                                                    >
                                                        <b-form-select size="sm" v-model="id_jurusan">
                                                            <option class="col-md-9" disabled value="">Pilih Jurusan
                                                            </option>
                                                            <option
                                                                    v-for="jurusan in datajurusan"
                                                                    v-bind:value="jurusan.id"
                                                            >
                                                                @{{ jurusan.nama }}
                                                            </option>

                                                        </b-form-select>
                                                    </b-form-group>
                                                </b-input-group>
                                                <b-input-group>
                                                    <label class="col-md-3 col-form-label">Kelas</label>
                                                    <b-form-group
                                                            size="sm"
                                                    >
                                                        <b-form-select size="sm" v-model="id_kelas">
                                                            <option class="col-md-9" disabled value="">Pilih Kelas
                                                            </option>
                                                            <option
                                                                    v-for="kelas in datakelas"
                                                                    v-bind:value="kelas.id"
                                                            >
                                                                @{{ kelas.nama }}
                                                            </option>

                                                        </b-form-select>
                                                    </b-form-group>
                                                </b-input-group>
                                                <b-input-group>
                                                    <label class="col-md-3 col-form-label">Dosen</label>
                                                    <b-form-group
                                                            size="sm"
                                                    >
                                                        <b-form-select size="sm" v-model="id_dosen">
                                                            <option class="col-md-9" disabled value="">Pilih Dosen
                                                            </option>
                                                            <option
                                                                    v-for="dosen in datadosen"
                                                                    v-bind:value="dosen.id"
                                                            >
                                                                @{{ dosen.nama }}
                                                            </option>

                                                        </b-form-select>
                                                    </b-form-group>
                                                </b-input-group>
                                                <b-input-group>
                                                    <label class="col-md-3 col-form-label">Mata Kuliah</label>
                                                    <b-form-group
                                                            size="sm"
                                                    >
                                                        <b-form-select size="sm" v-model="id_mata_kuliah">
                                                            <option disabled value="">Pilih Mata Kuliah</option>
                                                            <option
                                                                    v-for="matakuliah in datamatakuliah"
                                                                    v-bind:value="matakuliah.id"
                                                            >
                                                                @{{ matakuliah.nama }}
                                                            </option>

                                                        </b-form-select>
                                                    </b-form-group>
                                                </b-input-group>
                                                <b-input-group>
                                                    <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                                    <b-form-group
                                                            size="sm"
                                                    >
                                                        <b-form-select size="sm" v-model="id_tahun_ajaran">
                                                            <option disabled value="">Pilih Tahun Ajaran</option>
                                                            <option
                                                                    v-for="tahunajaran in datatahunajaran"
                                                                    v-bind:value="tahunajaran.id"
                                                            >
                                                                @{{ tahunajaran.tahun_ajaran }}
                                                            </option>

                                                        </b-form-select>
                                                    </b-form-group>
                                                </b-input-group>
                                            </b-form>
                                        </b-modal>
                                        <div>
                                            <b-form-group
                                                    class="ml-2 col-4 float-left mb-2">
                                                Tampilkan
                                                <b-form-select
                                                        class="col-3"
                                                        v-model="perPage"
                                                        size="sm"
                                                        :options="pageOptions">

                                                </b-form-select>
                                                data
                                            </b-form-group>
                                            <b-input-group class="col-3 float-right mr-2 mb-2">
                                                <b-form-input
                                                        v-model="filter"
                                                        size="sm"
                                                        placeholder="Cari"
                                                        type="text"
                                                ></b-form-input>
                                                <b-input-group-append>
                                                    <b-button
                                                            :disabled="!filter"
                                                            size="sm"
                                                            variant="link"
                                                            @click="filter = ''"

                                                    >
                                                        <i class="fa fa-times"></i></b-button>
                                                </b-input-group-append>
                                            </b-input-group>
                                        </div>
                                        <b-table
                                                show-empty
                                                :filter="filter"
                                                head-variant="light"
                                                id="my-table"
                                                hover
                                                :busy="isBusy"
                                                :items="datamengajar"
                                                :fields="fields"
                                                :per-page="perPage"
                                                :current-page="currentPage"
                                                @filtered="onFiltered"
                                                small
                                        >
                                            <template v-slot:empty>
                                                <div class="text-center text-danger my-2">
                                                    <h4>Data tidak ditemukan!</h4>
                                                </div>
                                            </template>
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
                                        <div class="float-left ml-2">
                                            <p> @{{ showingData }}</p>
                                        </div>
                                        <div class="mr-2">
                                            <b-pagination
                                                    align="right"
                                                    pills
                                                    size="sm"
                                                    v-model="currentPage"
                                                    :total-rows="totalRows"
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

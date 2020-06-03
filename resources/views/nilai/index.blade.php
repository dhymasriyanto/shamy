<?php

use App\Libs\AppHelpers;

$title = 'Nilai';
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
                                        <b-table
                                                show-empty
                                                :filter="filter"
                                                head-variant="light"
                                                id="my-table"
                                                hover
                                                :busy="isBusy"
                                                :items="datamengajar"
                                                :fields="fieldsKelas"
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
                                                <div v-for="kelas in datakelas"
                                                     v-if="kelas.id == data.item.get_kelas.id"
                                                >
                                                    @{{ kelas.nama }}

                                                </div>
                                            </template>
                                            <template v-slot:cell(mata_kuliah)="data">
                                                <div v-for="kelas in datakelas"
                                                     v-if="kelas.id == data.item.get_kelas.id"
                                                >
                                                    @{{ kelas.get_mata_kuliah.nama }}

                                                </div>
                                            </template>
                                            <template v-slot:cell(kurikulum)="data">
                                                <div v-for="kelas in datakelas"
                                                     v-if="kelas.id == data.item.get_kelas.id"
                                                >
                                                    @{{ kelas.get_kurikulum.nama }}

                                                </div>
                                            </template>
                                            <template v-slot:cell(semester)="data">
                                                <div v-for="kelas in datakelas"
                                                     v-if="kelas.id == data.item.get_kelas.id"
                                                >
                                                    @{{ kelas.semester }}

                                                </div>
                                            </template>
                                            <template v-slot:cell(get_dosen)="data">
                                                @{{ data.item.get_dosen.nama }}
                                            </template>
                                            <template v-slot:cell(aksi)="data">
                                                <b-button-group>
                                                    <button class="btn btn-info btn-rounded"
                                                            @click="lihatKelas(data.item.id_kelas, data.item.id)"

                                                            title="Lihat">
                                                        <span><i class="mdi mdi-eye mr-1"></i>Lihat Kelas</span>
                                                    </button>
                                                </b-button-group>
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

                                        <b-modal
                                                title="Rincian Kelas"
                                                id="lihatRincian"
                                                v-model="modalShow2"
                                                size="lg"
                                                hide-footer
                                                scrollable
                                                @hidden="resetModal"
                                        >
                                            <div v-for="kelas in rinciankelas">
                                                <!-- Name -->
                                                <div class="form-group row ">
                                                    <label class="col-sm-3 col-form-label">Nama Kelas</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: @{{ kelas.nama }} </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nama Mata Kuliah</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: @{{ kelas.get_mata_kuliah.nama
                                                            }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Kode Mata Kuliah</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: @{{ kelas.get_mata_kuliah.kode
                                                            }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Bobot Mata Kuliah</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: @{{ kelas.get_mata_kuliah.bobot
                                                            }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nama Kurikulum</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: @{{ kelas.get_kurikulum.nama
                                                            }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Semester</label>
                                                    <div class="col-sm-9">
                                                        <label class=" col-form-label">: @{{ kelas.semester
                                                            }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Program Studi</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: @{{
                                                            kelas.get_jurusan.nama }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Tahun Ajaran</label>
                                                    <div class="col-sm-9">
                                                        <label class=" col-form-label">: @{{
                                                            kelas.get_tahun_ajaran.tahun_ajaran }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 mb-2 col-form-label row">Peserta
                                                        Didik</label>
                                                    <div>
                                                        <div
                                                                v-if="!kelas.mahasiswa.length"><i>Belum ada peserta
                                                                didik</i>
                                                        </div>
                                                        <div v-else>
{{--                                                            <b-button pill variant="dark" href=""--}}
{{--                                                                      v-b-modal.modal-tambah><i--}}
{{--                                                                        class="fa fa-plus mr-1"></i>Simpan--}}
{{--                                                            </b-button>--}}
                                                            <b-form-group
                                                                    class="ml-2 col-4 float-left mb-2">
                                                                Tampilkan
                                                                <b-form-select
                                                                        class="col-3"
                                                                        v-model="perPage2"
                                                                        size="sm"
                                                                        :options="pageOptions2">

                                                                </b-form-select>
                                                                data
                                                            </b-form-group>
                                                            <b-input-group class="col-3 float-right mr-2 mb-2">
                                                                <b-form-input
                                                                        v-model="filter2"
                                                                        size="sm"
                                                                        placeholder="Cari"
                                                                        type="text"
                                                                ></b-form-input>
                                                                <b-input-group-append>
                                                                    <b-button
                                                                            :disabled="!filter2"
                                                                            size="sm"
                                                                            variant="link"
                                                                            @click="filter2 = ''"

                                                                    >
                                                                        <i class="fa fa-times"></i></b-button>
                                                                </b-input-group-append>
                                                            </b-input-group>


                                                            <b-table
                                                                    responsive
                                                                    show-empty
                                                                    :filter="filter2"
                                                                    head-variant="light"
                                                                    hover
                                                                    :busy="isLoading"
                                                                    :items="allrinciankelas"
                                                                    :fields="fieldsMahasiswa"
                                                                    :per-page="perPage2"
                                                                    :current-page="currentPage2"
                                                                    small
                                                                    @filtered="onFiltered2"
                                                            >
                                                                <template v-slot:empty>
                                                                    <div class="text-center text-danger my-2">
                                                                        <h4>Belum ada peserta didik</h4>
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
                                                                <template v-slot:cell(nama)="data">
                                                                    @{{ data.item.nama }}
                                                                </template>
                                                                <template v-slot:cell(nomor_induk)="data">
                                                                    @{{ data.item.nomor_induk }}
                                                                </template>
                                                                <template v-slot:cell(get_jurusan)="data">
                                                                    @{{ data.item.get_jurusan.nama }}
                                                                </template>
                                                                <template v-slot:cell(nilai_angka)="data">
                                                                    <div v-for="nilai in nilaikelas" v-if="nilai.nilai">
                                                                        <div v-if="nilai.id_mahasiswa == data.item.id && nilai.id_mengajar == id_mengajar">

                                                                            @{{ nilai.nilai.nilai_angka }}
                                                                        </div>
                                                                    </div>
                                                                    <div v-else>-</div>
                                                                </template>
                                                                <template v-slot:cell(nilai_indeks)="data">
                                                                    <div v-for="nilai in nilaikelas" v-if="nilai.nilai">
                                                                        <div v-if="nilai.id_mahasiswa == data.item.id && nilai.id_mengajar == id_mengajar">

                                                                            @{{ nilai.nilai.nilai_indeks }}
                                                                        </div>
                                                                    </div>
                                                                    <div v-else>-</div>
                                                                </template>
                                                                <template v-slot:cell(nilai_huruf)="data">
                                                                    <div v-for="nilai in nilaikelas" v-if="nilai.nilai">
                                                                        <div v-if="nilai.id_mahasiswa == data.item.id && nilai.id_mengajar == id_mengajar">

                                                                            @{{ nilai.nilai.nilai_huruf }}
                                                                        </div>
                                                                    </div>
                                                                    <div v-else>-</div>
                                                                </template>
                                                                <template v-slot:thead-top>

                                                                </template>

                                                                <template v-slot:cell(aksi)="data">
                                                                    <b-button
                                                                            variant="success"
                                                                            pill
                                                                            @click="nilai(data.item.id, id_mengajar)">
                                                                        <i class="mdi mdi-square-edit-outline mr-1"></i>
                                                                    </b-button>
                                                                </template>
                                                            </b-table>
                                                            <div class="float-left ml-2">
                                                                <p> @{{ showingData2 }}</p>
                                                            </div>
                                                            <div class="mr-2">
                                                                <b-pagination
                                                                        align="right"
                                                                        pills
                                                                        size="sm"
                                                                        v-model="currentPage2"
                                                                        :total-rows="totalRows2"
                                                                        :per-page="perPage2"
                                                                        aria-controls="my-table"
                                                                >
                                                                </b-pagination>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </b-modal>

                                    </div>
                                </div>

                            </div>

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
            </div>
        </div>
        {{--Templates--}}
        {{--Define your javascript below--}}
        <script type="text/javascript" src="{{asset('js/nilai/index.js')}}"></script>
    </div>
@endsection

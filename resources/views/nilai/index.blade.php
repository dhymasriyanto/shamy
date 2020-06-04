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
                                        @if(Auth::user()->role == 'administrator')
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
                                                            <label class="col-form-label">: @{{
                                                                kelas.get_mata_kuliah.nama
                                                                }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Kode Mata Kuliah</label>
                                                        <div class="col-sm-9">
                                                            <label class="col-form-label">: @{{
                                                                kelas.get_mata_kuliah.kode
                                                                }} </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Bobot Mata Kuliah</label>
                                                        <div class="col-sm-9">
                                                            <label class="col-form-label">: @{{
                                                                kelas.get_mata_kuliah.bobot
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
                                                                        <div v-for="nilai in nilaikelas"
                                                                             v-if="nilai.nilai">
                                                                            <div v-if="nilai.id_mahasiswa == data.item.id && nilai.id_mengajar == id_mengajar">

                                                                                @{{ nilai.nilai.nilai_angka }}
                                                                            </div>
                                                                        </div>
                                                                        <div v-else>-</div>
                                                                    </template>
                                                                    <template v-slot:cell(nilai_indeks)="data">
                                                                        <div v-for="nilai in nilaikelas"
                                                                             v-if="nilai.nilai">
                                                                            <div v-if="nilai.id_mahasiswa == data.item.id && nilai.id_mengajar == id_mengajar">

                                                                                @{{ nilai.nilai.nilai_indeks + ".00" }}
                                                                            </div>
                                                                        </div>
                                                                        <div v-else>-</div>
                                                                    </template>
                                                                    <template v-slot:cell(nilai_huruf)="data">
                                                                        <div v-for="nilai in nilaikelas"
                                                                             v-if="nilai.nilai">
                                                                            <div v-if="nilai.id_mahasiswa == data.item.id && nilai.id_mengajar == id_mengajar">

                                                                                @{{ nilai.nilai.nilai_huruf }}
                                                                            </div>
                                                                        </div>
                                                                        <div v-else>-</div>
                                                                    </template>


                                                                    <template v-slot:cell(aksi)="data">
                                                                        <b-button
                                                                                variant="success"
                                                                                pill
                                                                                {{--                                                                            v-b-modal.modal-nilai--}}
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


                                            <b-modal
                                                    title="Ubah Nilai"
                                                    id="modal-nilai"
                                                    @hidden="resetModal"
                                                    @ok="handleOk"
                                                    ref="modal"
                                                    ok-title="Simpan"
                                                    cancel-title="Batal"
                                                    v-model="modalShow"
                                            >
                                                <validation-observer ref="observer" v-slot="{ handleOk }">
                                                    <b-form ref="form" @submit.stop.prevent="handleSubmit">


                                                        <validation-provider name="Nilai Angka"
                                                                             :rules="{ required: true,  regex:/^([0-9]+)$/ , min_value:0 , max_value:100}"
                                                                             v-slot="validationContext">
                                                            <b-form-group id="example-input-group-1" label="Nilai Angka"
                                                                          label-for="example-input-1">
                                                                <b-form-input
                                                                        placeholder="Masukkan Nilai"
                                                                        @input="onChange"
                                                                        id="example-input-1"
                                                                        name="nilai_angka"
                                                                        v-model="nilai_angka"
                                                                        :state="getValidationState(validationContext)"
                                                                        aria-describedby="input-1-live-feedback"
                                                                >


                                                                </b-form-input>

                                                                <b-form-invalid-feedback
                                                                        id="input-1-live-feedback">@{{
                                                                    validationContext.errors[0]
                                                                    }}
                                                                </b-form-invalid-feedback>
                                                            </b-form-group>
                                                        </validation-provider>
                                                        <validation-provider name="Nilai Indeks"
                                                                             :rules="{ required: true ,  regex: /^([0-9]+)$/ }"
                                                                             v-slot="validationContext">
                                                            <b-form-group id="example-input-group-2"
                                                                          label="Nilai Indeks"
                                                                          label-for="example-input-2">
                                                                <b-form-input
                                                                        disabled
                                                                        placeholder="Nilai Indeks"
                                                                        @input="onChange"
                                                                        id="example-input-2"
                                                                        name="nilai_indeks"
                                                                        v-model="nilai_indeks"
                                                                        :state="getValidationState(validationContext)"
                                                                        aria-describedby="input-2-live-feedback"
                                                                >


                                                                </b-form-input>

                                                                <b-form-invalid-feedback
                                                                        id="input-2-live-feedback">@{{
                                                                    validationContext.errors[0]
                                                                    }}
                                                                </b-form-invalid-feedback>
                                                            </b-form-group>
                                                        </validation-provider>
                                                        <validation-provider name="Nilai Huruf"
                                                                             :rules="{ required: true }"
                                                                             v-slot="validationContext">
                                                            <b-form-group id="example-input-group-3" label="Nilai Huruf"
                                                                          label-for="example-input-3">
                                                                <b-form-input
                                                                        disabled
                                                                        placeholder="Nilai Indeks"
                                                                        @input="onChange"
                                                                        id="example-input-3"
                                                                        name="nilai_huruf"
                                                                        v-model="nilai_huruf"
                                                                        :state="getValidationState(validationContext)"
                                                                        aria-describedby="input-3-live-feedback"
                                                                >


                                                                </b-form-input>

                                                                <b-form-invalid-feedback
                                                                        id="input-3-live-feedback">@{{
                                                                    validationContext.errors[0]
                                                                    }}
                                                                </b-form-invalid-feedback>
                                                            </b-form-group>
                                                        </validation-provider>

                                                    </b-form>
                                                </validation-observer>

                                            </b-modal>
                                        @endif
                                        @if(Auth::user()->role == 'mahasiswa')
                                                <div class="col-md-3 mb-4">
                                                    <h5>Semester</h5>
                                                    <select class="form-control custom-select" v-model="search">
{{--                                                        <option value="">Semua</option>--}}
                                                        <option value="1">1</option>
                                                        <option v-for="n in 14" >
                                                            @{{ n+1 }}
                                                        </option>

                                                    </select>
                                                </div>

                                            <div v-if="search == ''">


                                            </div>
                                            <div v-else>
                                                <b-table
                                                        responsive
                                                        show-empty
                                                        :filter="filter4"
                                                        head-variant="light"
                                                        hover
                                                        :busy="isLoading3"
                                                        :items="filteredItems"
                                                        :fields="fieldsNilai"
                                                        :per-page="perPage4"
                                                        :current-page="currentPage4"
                                                        small
                                                        v-model="visibleRows"
                                                        @filtered="onFiltered3"
                                                >
                                                    <template v-slot:empty>
                                                        <div class="text-center text-danger my-2">
                                                            <h4>Belum ada nilai</h4>
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
                                                    <template v-slot:cell(kode_mata_kuliah)="data">
                                                        @{{ data.item.get_mata_kuliah.kode }}

                                                    </template>
                                                    <template v-slot:cell(semester)="data">
                                                        @{{ data.item.semester }}

                                                    </template>
                                                    <template v-slot:cell(mata_kuliah)="data">
                                                        @{{ data.item.get_mata_kuliah.nama }}

                                                    </template>
                                                    <template v-slot:cell(bobot)="data">
                                                        @{{ data.item.get_mata_kuliah.bobot }}

                                                    </template>
                                                    <template v-slot:cell(nm)="data">
                                                        @{{ data.item.get_mata_kuliah.bobot * data.item.nilai.nilai_indeks
                                                        }}

                                                    </template>
                                                    <template v-slot:cell(nilai_angka)="data">
                                                        @{{ data.item.nilai.nilai_angka }}
                                                    </template>
                                                    <template v-slot:cell(nilai_indeks)="data">
                                                        @{{ data.item.nilai.nilai_indeks }}
                                                    </template>
                                                    <template v-slot:cell(nilai_huruf)="data">
                                                        @{{ data.item.nilai.nilai_huruf }}
                                                    </template>
                                                    <template slot="bottom-row"

                                                    >
                                                        <b-th>Total</b-th>
                                                        <b-th></b-th>
                                                        <b-th></b-th>
                                                        <b-th></b-th>
                                                        <b-th></b-th>
                                                        <b-th ></b-th>
                                                        <b-th >@{{ nilaiAngka.toFixed(0) }}</b-th>
                                                        <b-th  >@{{ totalSKS.toFixed(0) }}</b-th>
                                                        <b-th >@{{ totalNM.toFixed(0) }}</b-th>

                                                    </template>
                                                    <template slot="table-caption">
                                                        Total IPS : @{{ totalIPS.toFixed(0) }}
                                                    </template>
                                                </b-table>
                                                <div class="float-left ml-2">
                                                    <p> @{{ showingData3 }}</p>
                                                </div>
                                                <div class="mr-2">
                                                    <b-pagination
                                                            align="right"
                                                            pills
                                                            size="sm"
                                                            v-model="currentPage4"
                                                            :total-rows="totalRows4"
                                                            :per-page="perPage4"
                                                            aria-controls="my-table"
                                                    >
                                                    </b-pagination>
                                                </div>
                                            </div>

                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
            </div>
        </div>
        {{--Templates--}}
        @include ('footer')
        {{--Define your javascript below--}}
        <script type="text/javascript" src="{{asset('js/nilai/index.js')}}"></script>
    </div>
@endsection

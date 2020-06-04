<?php

use App\Libs\AppHelpers;

$title = 'Kelas';
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
                                        <b-button pill variant="dark" href="" v-b-modal.modal-tambah><i
                                                    class="fa fa-plus mr-1"></i>Tambah
                                        </b-button>
                                        <br><br>

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
                                                responsive
                                                show-empty
                                                :filter="filter"
                                                head-variant="light"
                                                id="my-table"
                                                hover
                                                :busy="isBusy"
                                                :items="datakelas"
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
                                            <template v-slot:cell(get_tahun_ajaran)="data">
                                                @{{ data.item.get_tahun_ajaran.tahun_ajaran }}
                                            </template>
                                            <template v-slot:cell(semester)="data">
                                                @{{ data.item.semester }}
                                            </template>
                                            <template v-slot:cell(nama)="data">
                                                @{{ data.item.nama }}
                                            </template>
                                            <template v-slot:cell(get_kurikulum)="data">
                                                @{{ data.item.get_kurikulum.nama }}
                                            </template>
                                            <template v-slot:cell(get_mata_kuliah)="data">
                                                @{{ data.item.get_mata_kuliah.nama }}
                                            </template>
                                            <template v-slot:cell(get_jurusan)="data">
                                                @{{ data.item.get_jurusan.nama }}
                                            </template>
                                            <template v-slot:cell(semester)="data">
                                                @{{ data.item.semester }}
                                            </template>
                                            <template v-slot:cell(get_tahun_ajaran)="data">
                                                @{{ data.item.get_tahun_ajaran.tahun_ajaran }}
                                            </template>
                                            <template v-slot:cell(mahasiswa)="data">
                                                <b-badge variant="danger" v-if="!data.item.mahasiswa.length">
                                                    Belum ada peserta didik
                                                </b-badge>
                                                <b-badge variant="info" v-else>
                                                    @{{ data.item.mahasiswa.length }} orang
                                                </b-badge>
                                            </template>
                                            <template v-slot:cell(aksi)="data">
                                                <b-button-group>
                                                    <b-button class="btn btn-info btn-rounded" title="Rincian"
                                                              @click="lihatRincian(data.item.id)"
                                                    >
                                                        <span><i class="mdi mdi-eye"></i></span>
                                                    </b-button>
                                                    <b-button
                                                            class="btn btn-success " title="Ubah"
                                                            @click="edit(data.item.id)"
                                                    >
                                                        <span><i class=" mdi mdi-square-edit-outline"></i></span>
                                                    </b-button>
                                                    <b-button
                                                            class="btn btn-danger btn-rounded" title="Hapus"
                                                            @click="hapusdata(data.item.id)"
                                                    >
                                                        <span><i class="mdi mdi-trash-can"></i></span>
                                                    </b-button>

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
                                            @endif
                                    </div>

                                </div>
                                <!-- end row -->

                                <b-modal
                                        title="Hapus Kelas"
                                        id="modalhapus"
                                        @hidden="resetModal"
                                        @ok="handleOk"
                                        ref="modal"
                                        ok-title="Yakin"
                                        cancel-title="Batal"
                                        v-model="modalShow3"
                                >
                                    <h4>Yakin ingin menghapus @{{ editnama }} ? </h4>
                                </b-modal>

                                <b-modal
                                        title="Rincian Kelas"
                                        id="lihatRincian"
                                        v-model="modalShow2"
                                        size="lg"
                                        hide-footer
                                        scrollable
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
                                                    }} SKS</label>

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
                                            <label class="col-sm-3 mb-2 col-form-label row">Peserta Didik</label>
                                            <div>
                                                <b-button class="mb-2" pill variant="dark" href=""
                                                          @click="tambahMahasiswa = !tambahMahasiswa"
                                                          v-b-modal.modal-tambah-mahasiswa><i
                                                            class="fa fa-plus mr-1"></i>Tambah Mahasiswa
                                                </b-button>
                                                <div
                                                        v-if="!kelas.mahasiswa.length"><i>Belum ada peserta
                                                        didik</i>
                                                </div>
                                                <div v-else>
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
                                                        <template v-slot:cell(aksi)="data">
                                                            <b-button
                                                                    variant="danger"
                                                                    pill
                                                                    @click="hapusmodal(kelas.id, data.item.id)">
                                                                <i class="mdi mdi-close mr-1"></i>Keluarkan
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
                                        title="Keluarkan Mahasiswa"
                                        id="hapusmodal"
                                        @hidden="resetModal"
                                        @ok="handleOk"
                                        ref="modal"
                                        ok-title="Yakin"
                                        cancel-title="Batal"
                                        v-model="modalShow4"
                                >
                                    <h4>Yakin ingin mengeluarkan @{{ editnama }} dari kelas? </h4>
                                </b-modal>

                                <b-modal
                                        title="Tambah Kelas"
                                        id="modal-tambah"
                                        @hidden="resetModal"
                                        @ok="handleOk"
                                        ref="modal"
                                        ok-title="Simpan"
                                        cancel-title="Batal"
                                >


                                    <validation-observer ref="observer" v-slot="{ handleOk }">
                                        <b-form ref="form" @submit.stop.prevent="handleSubmit">


                                            <validation-provider name="Program Studi" :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-2" label="Program Studi"
                                                              label-for="example-input-2">
                                                    <b-form-select
                                                            @change="onChange"
                                                            id="example-input-2"
                                                            name="jurusan"
                                                            v-model="id_jurusan"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-2-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Program Studi
                                                        </option>
                                                        <option
                                                                v-for="jurusan in datajurusan"
                                                                v-bind:value="jurusan.id"
                                                        >
                                                            @{{ jurusan.nama }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-2-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>

                                            <validation-provider v-if="id_jurusan" name="Tahun Ajaran"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-3" label="Tahun Ajaran"
                                                              label-for="example-input-3">
                                                    <b-form-select
                                                            @change="onChange"
                                                            id="example-input-3"
                                                            name="tahun_ajaran"
                                                            v-model="id_tahun_ajaran"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-3-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Tahun Ajaran
                                                        </option>
                                                        <option
                                                                v-for="tahun_ajaran in datatahunajaran"
                                                                v-bind:value="tahun_ajaran.id"
                                                        >
                                                            @{{ tahun_ajaran.tahun_ajaran }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-3-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="id_tahun_ajaran && id_jurusan" name="Nama Kelas"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-1" label="Nama Kelas"
                                                              label-for="example-input-1">
                                                    <b-form-input
                                                            placeholder="Masukkan Nama Kelas"
                                                            @input="onChange"
                                                            id="example-input-1"
                                                            name="nama"
                                                            v-model="nama"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-1-live-feedback"
                                                    >


                                                    </b-form-input>

                                                    <b-form-invalid-feedback
                                                            id="input-1-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="nama" name="Kurikulum"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-6" label="Kurikulum"
                                                              label-for="example-input-6">
                                                    <b-form-select
                                                            @change="onChange2"
                                                            id="example-input-6"
                                                            name="kurikulum"
                                                            v-model="id_kurikulum"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-6-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Kurikulum
                                                        </option>
                                                        <option
                                                                v-for="kurikulum in datakurikulum"
                                                                v-if="(kurikulum.id_jurusan == id_jurusan)&&(kurikulum.id_tahun_ajaran == id_tahun_ajaran) "
                                                                v-bind:value="kurikulum.id"
                                                        >
                                                            @{{ kurikulum.nama }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-6-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="id_kurikulum" name="Mata Kuliah"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-5" label="Mata Kuliah"
                                                              label-for="example-input-5">
                                                    <b-form-select
                                                            {{--                                                             @change="onChange"--}}
                                                            id="example-input-5"
                                                            name="matakuliah"
                                                            v-model="id_mata_kuliah"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-5-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Mata Kuliah
                                                        </option>
                                                        <option
                                                                v-for="matakuliah in allrincianmatkul"
                                                                {{--                                                                v-if="(matakuliah.id_jurusan == datakurikulum.get_mata_kuliah.id) "--}}
                                                                v-bind:value="matakuliah.id"
                                                        >
                                                            @{{ matakuliah.nama }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-5-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="id_mata_kuliah && id_kurikulum" name="Semester"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-4" label="Semester"
                                                              label-for="example-input-4">
                                                    <b-form-select
                                                            {{-- @change="onChange" --}}
                                                            id="example-input-4"
                                                            name="semester"
                                                            v-model="semester"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-4-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Semester
                                                        </option>
                                                        <option
                                                                v-for="n in 14"
                                                        >
                                                            @{{ n }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-4-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                        </b-form>
                                    </validation-observer>
                                </b-modal>
                                <b-modal
                                        title="Masukkan Mahasiswa"
                                        id="tambahmodal"
                                        @hidden="resetModal"
                                        @ok="handleOk"
                                        ref="modal"
                                        ok-title="Yakin"
                                        cancel-title="Batal"
                                        v-model="modalShow5"
                                >
                                    <h4>Yakin ingin memasukkan @{{ editnama }} ke kelas? </h4>
                                </b-modal>

                                <b-modal
                                        title="Tambah Mahasiswa"
                                        id="modal-tambah-mahasiswa"
                                        @hidden="resetModal"
                                        {{--                                        @ok="handleOk"--}}
                                        ref="modal"
                                        hide-footer
                                        {{--                                        ok-title="Simpan"--}}
                                        {{--                                        cancel-title="Batal"--}}
                                        size="lg"
                                        {{--                                        v-model="modalShow5"--}}
                                >
                                    <b-form-group
                                            class="ml-2 col-4 float-left mb-2">
                                        Tampilkan
                                        <b-form-select
                                                class="col-3"
                                                v-model="perPage3"
                                                size="sm"
                                                :options="pageOptions3">

                                        </b-form-select>
                                        data
                                    </b-form-group>
                                    <b-input-group class="col-3 float-right mr-2 mb-2">
                                        <b-form-input
                                                v-model="filter3"
                                                size="sm"
                                                placeholder="Cari"
                                                type="text"
                                        ></b-form-input>
                                        <b-input-group-append>
                                            <b-button
                                                    :disabled="!filter3"
                                                    size="sm"
                                                    variant="link"
                                                    @click="filter3 = ''"

                                            >
                                                <i class="fa fa-times"></i></b-button>
                                        </b-input-group-append>
                                    </b-input-group>
                                    <b-table
                                            responsive
                                            show-empty
                                            :filter="filter3"
                                            head-variant="light"
                                            hover
                                            :busy="isLoading2"
                                            :items="allmahasiswa"
                                            :fields="fieldsMahasiswa"
                                            :per-page="perPage3"
                                            :current-page="currentPage3"
                                            small
                                            @filtered="onFiltered3"
                                    >
                                        <template v-slot:empty>
                                            <div class="text-center text-danger my-2">
                                                <h4>Seluruh peserta didik telah masuk kelas</h4>
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
                                        <template v-slot:cell(aksi)="data">
                                            <b-button
                                                    variant="success"
                                                    pill
                                                    @click="tambahmodal(data.item.id)">
                                                <i class="mdi mdi-download mr-1"></i>Masukkan
                                            </b-button>
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
                                                v-model="currentPage3"
                                                :total-rows="totalRows3"
                                                :per-page="perPage3"
                                                aria-controls="my-table"
                                        >
                                        </b-pagination>
                                    </div>
                                </b-modal>
                                <b-modal
                                        title="Ubah Kelas"
                                        id="modal-edit"
                                        @hidden="resetModal"
                                        @ok="handleOk"
                                        ref="modal"
                                        ok-title="Simpan"
                                        cancel-title="Batal"
                                        v-model="modalShow"
                                >


                                    <validation-observer ref="observer" v-slot="{ handleOk }">
                                        <b-form ref="form" @submit.stop.prevent="handleSubmit">


                                            <validation-provider name="Program Studi" :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-2" label="Program Studi"
                                                              label-for="example-input-2">
                                                    <b-form-select
                                                            @change="onChange"
                                                            id="example-input-2"
                                                            name="jurusan"
                                                            v-model="editid_jurusan"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-2-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Program Studi
                                                        </option>
                                                        <option
                                                                v-for="jurusan in datajurusan"
                                                                v-bind:value="jurusan.id"
                                                        >
                                                            @{{ jurusan.nama }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-2-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>

                                            <validation-provider v-if="editid_jurusan" name="Tahun Ajaran"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-3" label="Tahun Ajaran"
                                                              label-for="example-input-3">
                                                    <b-form-select
                                                            @change="onChange"
                                                            id="example-input-3"
                                                            name="tahun_ajaran"
                                                            v-model="editid_tahun_ajaran"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-3-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Tahun Ajaran
                                                        </option>
                                                        <option
                                                                v-for="tahun_ajaran in datatahunajaran"
                                                                v-bind:value="tahun_ajaran.id"
                                                        >
                                                            @{{ tahun_ajaran.tahun_ajaran }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-3-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="editid_tahun_ajaran" name="Nama Kelas"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-1" label="Nama Kelas"
                                                              label-for="example-input-1">
                                                    <b-form-input
                                                            placeholder="Masukkan Nama Kelas"
                                                            @input="onChange"
                                                            id="example-input-1"
                                                            name="nama"
                                                            v-model="editnama"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-1-live-feedback"
                                                    >


                                                    </b-form-input>

                                                    <b-form-invalid-feedback
                                                            id="input-1-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="editnama" name="Kurikulum"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-6" label="Kurikulum"
                                                              label-for="example-input-6">
                                                    <b-form-select
                                                            @change="onChange2"
                                                            id="example-input-6"
                                                            name="kurikulum"
                                                            v-model="editid_kurikulum"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-6-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Kurikulum
                                                        </option>
                                                        <option
                                                                v-for="kurikulum in datakurikulum"
                                                                v-if="(kurikulum.id_jurusan == editid_jurusan)&&(kurikulum.id_tahun_ajaran == editid_tahun_ajaran) "
                                                                v-bind:value="kurikulum.id"
                                                        >
                                                            @{{ kurikulum.nama }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-6-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="editid_kurikulum" name="Mata Kuliah"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-5" label="Mata Kuliah"
                                                              label-for="example-input-5">
                                                    <b-form-select
                                                            {{-- @change="onChange" --}}
                                                            id="example-input-5"
                                                            name="matakuliah"
                                                            v-model="editid_mata_kuliah"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-5-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Mata Kuliah
                                                        </option>
                                                        <option
                                                                v-for="matakuliah in allrincianmatkul"
                                                                {{--                                                                v-if="(matakuliah.id_jurusan == datakurikulum.get_mata_kuliah.id) "--}}
                                                                v-bind:value="matakuliah.id"
                                                        >
                                                            @{{ matakuliah.nama }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-5-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <validation-provider v-if="editid_mata_kuliah && editid_kurikulum"
                                                                 name="Semester"
                                                                 :rules="{ required: true }"
                                                                 v-slot="validationContext">
                                                <b-form-group id="example-input-group-4" label="Semester"
                                                              label-for="example-input-4">
                                                    <b-form-select
                                                            {{-- @change="onChange" --}}
                                                            id="example-input-4"
                                                            name="tahun_ajaran"
                                                            v-model="editsemester"
                                                            :state="getValidationState(validationContext)"
                                                            aria-describedby="input-4-live-feedback"
                                                    >
                                                        <option class="col-md-9" value="">Pilih Semester
                                                        </option>
                                                        <option
                                                                v-for="n in 14"
                                                        >
                                                            @{{ n }}
                                                        </option>

                                                    </b-form-select>

                                                    <b-form-invalid-feedback
                                                            id="input-4-live-feedback">@{{ validationContext.errors[0]
                                                        }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                        </b-form>
                                    </validation-observer>
                                </b-modal>


                            </div> <!-- end card-box -->
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
        {{--Templates--}}
        {{--Define your javascript below--}}
        {{--        <script type="text/javascript" src="{{asset('js/home/index.js')}}"></script>--}}
        <script type="text/javascript" src="{{asset('js/kelas/index.js')}}"></script>
    </div>
@endsection

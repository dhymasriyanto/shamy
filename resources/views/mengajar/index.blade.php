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
                                                <div v-for="kelas in datakelas"
                                                     v-if="kelas.id == data.item.get_kelas.id"
                                                >
                                                    @{{  kelas.nama }}

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
                                            {{--                                            <template v-slot:cell(get_kelas)="data">--}}
                                            {{--                                                @{{ data.item.get_kelas.id_mata_kuliah }}--}}
                                            {{--                                            </template>--}}
                                            {{--                                            <template v-slot:cell(get_tahun_ajaran)="data">--}}
                                            {{--                                                @{{ data.item.get_tahun_ajaran.tahun_ajaran }}--}}
                                            {{--                                            </template>--}}
                                            <template v-slot:cell(aksi)="data">
                                                <b-button-group>
                                                    <button class="btn btn-info btn-rounded"
                                                            @click="lihatRincian(data.item.id)"

                                                            title="Rincian">
                                                        <span><i class="mdi mdi-eye"></i></span>
                                                    </button>
                                                    <button class="btn btn-success"
                                                            @click="edit(data.item.id)"
                                                            title="Ubah">
                                                        <span><i class=" mdi mdi-square-edit-outline"></i></span>
                                                    </button>
                                                    <button class="btn btn-danger btn-rounded"
                                                            title="Hapus"
                                                            @click="hapusdata(data.item.id)"
                                                    >
                                                        <span><i class="mdi mdi-trash-can"></i></span>
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
                                    </div>
                                    <b-modal
                                            title="Tambah Akta Ajar"
                                            id="modal-1"
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
                                                    <b-form-group id="example-input-group-1" label="Program Studi"
                                                                  label-for="example-input-1">
                                                        <b-form-select class="js-example-basic-single"
                                                                       @change="onChange"
                                                                       id="example-input-1"
                                                                       name="jurusan"
                                                                       v-model="id_jurusan"
                                                                       :state="getValidationState(validationContext)"
                                                                       aria-describedby="input-1-live-feedback"
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
                                                                id="input-1-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider v-if="id_jurusan" name="Tahun Ajaran"
                                                                     :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-2" label="Tahun Ajaran"
                                                                  label-for="example-input-2">
                                                        <b-form-select
                                                                @change="onChange"
                                                                id="example-input-2"
                                                                name="tahun_ajaran"
                                                                v-model="id_tahun_ajaran"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-2-live-feedback"
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
                                                                id="input-2-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider v-if="id_tahun_ajaran" name="Kelas"
                                                                     :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-3" label="Kelas"
                                                                  label-for="example-input-3">
                                                        <b-form-select

                                                                id="example-input-3"
                                                                name="kelas"
                                                                v-model="id_kelas"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-3-live-feedback"
                                                        >
                                                            <option class="col-md-9" value="">Pilih Kelas
                                                            </option>
                                                            <option
                                                                    v-for="kelas in datakelas"
                                                                    v-if="(kelas.id_jurusan == id_jurusan) && (kelas.id_tahun_ajaran == id_tahun_ajaran) && (kelas.mahasiswa.length)"
                                                                    v-bind:value="kelas.id"
                                                            >
                                                                @{{ kelas.get_mata_kuliah.nama + " " + kelas.nama + " "
                                                                + kelas.get_kurikulum.nama + " (Semester " +
                                                                kelas.semester +")"}}
                                                            </option>

                                                        </b-form-select>

                                                        <b-form-invalid-feedback
                                                                id="input-3-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider v-if="id_kelas" name="Dosen"
                                                                     :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-4" label="Dosen"
                                                                  label-for="example-input-4">
                                                        <b-form-select
                                                                id="example-input-4"
                                                                name="dosen"
                                                                v-model="id_dosen"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-4-live-feedback"
                                                        >
                                                            <option class="col-md-9" value="">Pilih Dosen
                                                            </option>
                                                            <option
                                                                    v-for="dosen in datadosen"
                                                                    v-if="(dosen.id_jurusan == id_jurusan) "
                                                                    v-bind:value="dosen.id"
                                                            >
                                                                @{{ dosen.nama }}
                                                            </option>

                                                        </b-form-select>

                                                        <b-form-invalid-feedback
                                                                id="input-4-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>

                                            </b-form>
                                        </validation-observer>
                                    </b-modal>
                                    <!-- end row -->
                                    <b-modal
                                            title="Ubah Akta Ajar"
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
                                                    <b-form-group id="example-input-group-1" label="Program Studi"
                                                                  label-for="example-input-1">
                                                        <b-form-select class="js-example-basic-single"
                                                                       @change="onChange"
                                                                       id="example-input-1"
                                                                       name="jurusan"
                                                                       v-model="editid_jurusan"
                                                                       :state="getValidationState(validationContext)"
                                                                       aria-describedby="input-1-live-feedback"
                                                                {{--                                                                       disabled--}}
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
                                                                id="input-1-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider v-if="editid_jurusan" name="Tahun Ajaran"
                                                                     :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-2" label="Tahun Ajaran"
                                                                  label-for="example-input-2">
                                                        <b-form-select
                                                                {{--                                                                disabled--}}
                                                                @change="onChange"
                                                                id="example-input-2"
                                                                name="tahun_ajaran"
                                                                v-model="editid_tahun_ajaran"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-2-live-feedback"
                                                        >
                                                            <option class="col-md-9" value="">Pilih Tahun Ajaran
                                                            </option>
                                                            <option
                                                                    v-for="tahun_ajaran in datatahunajaran"
                                                                    v-bind:value="tahun_ajaran.id"
                                                                    {{--                                                                    v-if="editid_tahun_ajaran == tahun_ajaran.id"--}}
                                                            >
                                                                @{{ tahun_ajaran.tahun_ajaran }}
                                                            </option>

                                                        </b-form-select>

                                                        <b-form-invalid-feedback
                                                                id="input-2-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider name="Kelas"
                                                                     :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-3" label="Kelas"
                                                                  label-for="example-input-3">
                                                        <b-form-select
                                                                {{--                                                                disabled--}}
                                                                id="example-input-3"
                                                                name="kelas"
                                                                v-model="editid_kelas"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-3-live-feedback"
                                                        >
                                                            <option class="col-md-9" value="">Pilih Kelas
                                                            </option>
                                                            <option
                                                                    v-for="kelas in datakelas"
                                                                    v-if="(kelas.id_jurusan == editid_jurusan) && (kelas.id_tahun_ajaran == editid_tahun_ajaran)&& (kelas.mahasiswa.length) "
                                                                    v-bind:value="kelas.id"
                                                            >
                                                                @{{ kelas.get_mata_kuliah.nama + " " + kelas.nama + " "
                                                                +
                                                                kelas.get_kurikulum.nama + " (Semester " +
                                                                kelas.semester
                                                                +")"}}
                                                            </option>

                                                        </b-form-select>

                                                        <b-form-invalid-feedback
                                                                id="input-3-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider v-if="editid_kelas" name="Dosen"
                                                                     :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-4" label="Dosen"
                                                                  label-for="example-input-4">
                                                        <b-form-select
                                                                id="example-input-4"
                                                                name="dosen"
                                                                v-model="editid_dosen"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-4-live-feedback"
                                                        >
                                                            <option class="col-md-9" value="">Pilih Dosen
                                                            </option>
                                                            <option
                                                                    v-for="dosen in datadosen"
                                                                    v-if="(dosen.id_jurusan == editid_jurusan) "
                                                                    v-bind:value="dosen.id"
                                                            >
                                                                @{{ dosen.nama }}
                                                            </option>

                                                        </b-form-select>

                                                        <b-form-invalid-feedback
                                                                id="input-4-live-feedback">@{{
                                                            validationContext.errors[0] }}
                                                        </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>

                                            </b-form>
                                        </validation-observer>
                                    </b-modal>
                                </div>
                                <b-modal
                                        title="Rincian Akta Ajar"
                                        id="lihatRincian"
                                        v-model="modalShow2"
                                        @hidden="resetModal"
                                        hide-footer
                                        scrollable
                                >
                                    <div v-for="mengajar in rincianmengajar">
                                        <!-- Name -->
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">NIDPN/NUPN</label>
                                            <div class="col-sm-8">
                                                <label class=" col-form-label">:
                                                    @{{  mengajar.get_dosen.nomor_induk }} </label>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Dosen</label>
                                            <div class="col-sm-8">
                                                <label class=" col-form-label">:
                                                    @{{  mengajar.get_dosen.nama }} </label>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Program Studi</label>
                                            <div class="col-sm-8">
                                                <label class="col-form-label">
                                                    : @{{ namajurusan }}
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                            <div class="col-sm-8">
                                                <label class=" col-form-label" >
                                                    : @{{ tahunajaran }}
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Kurikulum</label>
                                            <div class="col-sm-8">
                                                <label class="col-form-label" >
                                                    : @{{ namakurikulum }}
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label class="col-sm-4 col-form-label">Nama Kelas</label>
                                            <div class="col-sm-8">
                                                <label class="col-form-label"  >: @{{ mengajar.get_kelas.nama }} </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Mata Kuliah</label>
                                            <div class="col-sm-8">
                                                <label class="col-form-label" >
                                                    : @{{ namamatakuliah  + " ("+ singkatanmatakuliah +")"}}
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Kode Mata Kuliah</label>
                                            <div class="col-sm-8">
                                                <label class=" col-form-label" >
                                                    : @{{ kodematakuliah }}
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Bobot</label>
                                            <div class="col-sm-8">
                                                <label class=" col-form-label" >
                                                    : @{{ bobotmatakuliah }} SKS
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Jenis</label>
                                            <div class="col-sm-8">
                                                <label class=" col-form-label" >
                                                    : @{{ jenismatakuliah }}
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Semester</label>
                                            <div class="col-sm-8">
                                                <label class=" col-form-label">: @{{ mengajar.get_kelas.semester }} </label>

                                            </div>
                                        </div>

                                    </div>
                                </b-modal>
                                <b-modal
                                        title="Hapus Akta Ajar"
                                        id="modalhapus"
                                        @hidden="resetModal"
                                        @ok="handleOk"
                                        ref="modal"
                                        ok-title="Yakin"
                                        cancel-title="Batal"
                                        v-model="modalShow3"
                                >
                                    <h4>Yakin ingin menghapus penugasan kepada @{{ editnama.nama }} ? </h4>
                                </b-modal>
                            </div>

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
            </div>
        </div>
        {{--Templates--}}
        {{--Define your javascript below--}}
        <script type="text/javascript" src="{{asset('js/mengajar/index.js')}}"></script>
    </div>
@endsection

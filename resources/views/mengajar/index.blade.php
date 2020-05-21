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
                                                <b-button-group>
                                                    <button class="btn btn-info btn-rounded" title="Rincian">
                                                        <span><i class="mdi mdi-eye"></i></span>
                                                    </button>
                                                    <button class="btn btn-success" title="Ubah">
                                                        <span><i class="mdi mdi-eye"></i></span>
                                                    </button>
                                                    <button class="btn btn-danger btn-rounded" title="Hapus">
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
                                            id="modal-1"
                                            @hidden="resetModal"
                                            @ok="handleOk"
                                            ref="modal"
                                    >
                                        <validation-observer ref="observer" v-slot="{ handleOk }">
                                            <b-form ref="form" @submit.stop.prevent="handleSubmit">

                                                <validation-provider name="Jurusan" :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-1" label="Jurusan"
                                                                  label-for="example-input-1">
                                                        <b-form-select
                                                                id="example-input-1"
                                                                name="jurusan"
                                                                v-model="id_jurusan"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-1-live-feedback"
                                                        >
                                                            <option class="col-md-9" disabled value="">Pilih Jurusan
                                                            </option>
                                                            <option
                                                                    v-for="jurusan in datajurusan"
                                                                    v-bind:value="jurusan.id"
                                                            >
                                                                @{{ jurusan.nama }}
                                                            </option>

                                                        </b-form-select>

                                                        <b-form-invalid-feedback
                                                                id="input-1-live-feedback">@{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider name="Tahun Ajaran" :rules="{ required: true }"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-2" label="Tahun Ajaean"
                                                                  label-for="example-input-2">
                                                        <b-form-select
                                                                id="example-input-2"
                                                                name="tahun_ajaran"
                                                                v-model="id_tahun_ajaran"
                                                                :state="getValidationState(validationContext)"
                                                                aria-describedby="input-2-live-feedback"
                                                        >
                                                            <option class="col-md-9" disabled value="">Pilih Jurusan
                                                            </option>
                                                            <option
                                                                    v-for="tahun_ajaran in datatahunajaran"
                                                                    v-bind:value="tahun_ajaran.id"
                                                            >
                                                                @{{ tahun_ajaran.tahun_ajaran }}
                                                            </option>

                                                        </b-form-select>

                                                        <b-form-invalid-feedback
                                                                id="input-2-live-feedback">@{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                            </b-form>
                                        </validation-observer>
                                    </b-modal>
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
        <script type="text/javascript" src="{{asset('js/mengajar/index.js')}}"></script>
    </div>
@endsection

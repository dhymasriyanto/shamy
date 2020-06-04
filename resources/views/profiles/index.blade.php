<?php

use App\Libs\AppHelpers;

$title = 'Profil';
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
                                <div class="bg-picture card-box">
                                    <div class="profile-info-name">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{Auth::user()->getPhotoProfil()}}"
                                                     class="rounded-circle avatar-xl img-thumbnail float-left mr-3"
                                                     alt="profile-image">
                                                <div class="profile-info-detail overflow-hidden">
                                                    @if(Auth::user()->id_mahasiswa==0)
                                                        <h4 class="m-0">{{Auth::user()->name}} </h4>
                                                        <p class="text-muted"><i>{{Auth::user()->role}} </i></p>

                                                    @elseif(Auth::user()->id_mahasiswa!=0)

                                                        <h4 class="m-0">{{$p->nama}} </h4>
                                                        <p class="text-muted"><i>{{$p->nomor_induk}} </i></p>
                                                    @endif

                                                </div>

                                                <div class="clearfix"></div>
                                                @if(Auth::user()->id_mahasiswa!=0)

                                                <b-button
                                                        class="mt-3"
                                                        variant="info"
                                                        pill
                                                        {{--                                                        v-b-modal.modal-profil--}}
                                                        @click="ubah({{Auth::user()->id_mahasiswa}})"
                                                >
                                                    <i class="mdi mdi-square-edit-outline mr-1 mb-2"></i>Ubah Profil
                                                </b-button>
                                                @endif
                                            </div>
                                            @if(Auth::user()->id_mahasiswa!=0)

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{ $p->jenis_kelamin }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{ $p->tempat_lahir }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{ $p->tanggal_lahir }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Agama</label>
                                                    <div class="col-sm-9">
                                                        <label class=" col-form-label">: {{ $p->agama }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{ $p->alamat }} </label>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nomor Induk
                                                        Kependudukan</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-form-label">: {{ $p->nomor_induk_kependudukan }} </label>
                                                    </div>
                                                </div>


                                                <b-modal
                                                        title="Ubah Profil"
                                                        id="modal-profil"
                                                        @hidden="resetModal"
                                                        @ok="handleOk"
                                                        ref="modal"
                                                        ok-title="Simpan"
                                                        cancel-title="Batal"
                                                        v-model="modalShow"
                                                >
                                                    <validation-observer ref="observer" v-slot="{ handleOk }">
                                                        <b-form ref="form" @submit.stop.prevent="handleSubmit">


                                                            <validation-provider name="Nama"
                                                                                 :rules="{ required: true}"
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-1" label="Nama *"
                                                                              label-for="example-input-1">
                                                                    <b-form-input
                                                                            disabled
                                                                            placeholder="Masukkan Nama"
                                                                            id="example-input-1"
                                                                            name="nama"
                                                                            v-model="nama"
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


                                                            <validation-provider name="NIRP"
                                                                                 :rules="{required: true}"
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-2" label="NIRP  *"
                                                                              label-for="example-input-2">
                                                                    <b-form-input
                                                                            placeholder="Masukkan NIRP"
                                                                            disabled
                                                                            id="example-input-2"
                                                                            name="nomor_induk"
                                                                            v-model="nomor_induk"
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
                                                            <validation-provider name="NIK"
                                                                                 :rules="{ regex: /^([0-9]+)$/, digits:16}"
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-9" label="NIK"
                                                                              label-for="example-input-9">
                                                                    <b-form-input
                                                                            placeholder="Masukkan NIK"
                                                                            id="example-input-9"
                                                                            name="nomor_induk_kependudukan"
                                                                            v-model="nomor_induk_kependudukan"
                                                                            :state="getValidationState(validationContext)"
                                                                            aria-describedby="input-9-live-feedback"
                                                                    >


                                                                    </b-form-input>

                                                                    <b-form-invalid-feedback
                                                                            id="input-9-live-feedback">@{{
                                                                        validationContext.errors[0]
                                                                        }}
                                                                    </b-form-invalid-feedback>
                                                                </b-form-group>
                                                            </validation-provider>

                                                            <validation-provider name="Jenis Kelamin"
                                                                                 :rules="{required: true}"
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-8"
                                                                              label="Jenis Kelamin  *"
                                                                              label-for="example-input-8">
                                                                    <b-form-select
                                                                            {{-- @change="onChange" --}}
                                                                            id="example-input-8"
                                                                            name="agama"
                                                                            v-model="jenis_kelamin"
                                                                            :state="getValidationState(validationContext)"
                                                                            aria-describedby="input-8-live-feedback"
                                                                    >
                                                                        <option class="col-md-9" value="">Pilih Jenis
                                                                            Kelamin
                                                                        </option>
                                                                        <option value="Laki-laki"> Laki-laki</option>
                                                                        <option value="Perempuan"> Perempuan</option>


                                                                    </b-form-select>

                                                                    <b-form-invalid-feedback
                                                                            id="input-8-live-feedback">@{{
                                                                        validationContext.errors[0]
                                                                        }}
                                                                    </b-form-invalid-feedback>
                                                                </b-form-group>
                                                            </validation-provider>
                                                            <validation-provider name="Tempat Lahir"
                                                                                 :rules="{required: true}"
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-4"
                                                                              label="Tempat Lahir  *"
                                                                              label-for="example-input-4">
                                                                    <b-form-input
                                                                            placeholder="Masukkan Tempat Lahir"
                                                                            id="example-input-4"
                                                                            name="tempat_lahir"
                                                                            v-model="tempat_lahir"
                                                                            :state="getValidationState(validationContext)"
                                                                            aria-describedby="input-4-live-feedback"
                                                                    >


                                                                    </b-form-input>

                                                                    <b-form-invalid-feedback
                                                                            id="input-4-live-feedback">@{{
                                                                        validationContext.errors[0]
                                                                        }}
                                                                    </b-form-invalid-feedback>
                                                                </b-form-group>
                                                            </validation-provider>
                                                            <validation-provider name="Tanggal Lahir"
                                                                                 :rules="{required: true}"
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-5"
                                                                              label="Tanggal Lahir  *"
                                                                              label-for="example-input-5">

                                                                    <b-form-input
                                                                            id="example-input-5"
                                                                            name="tanggal_lahir"
                                                                            :state="getValidationState(validationContext)"
                                                                            type="date"
                                                                            v-model="tanggal_lahir"
                                                                            button-only
                                                                            right
                                                                            locale="id-ID"
                                                                            aria-controls="input-5-live-feedback"
                                                                            aria-describedby="input-5-live-feedback"

                                                                            @context="onContext"
                                                                    ></b-form-input>

                                                                    <b-form-invalid-feedback
                                                                            id="input-5-live-feedback">@{{
                                                                        validationContext.errors[0]
                                                                        }}
                                                                    </b-form-invalid-feedback>
                                                                </b-form-group>
                                                            </validation-provider>
                                                            <validation-provider name="Agama"
                                                                                 :rules="{required: true}"
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-6"
                                                                              label="Agama  *"
                                                                              label-for="example-input-6">
                                                                    <b-form-select
                                                                            {{-- @change="onChange" --}}
                                                                            id="example-input-6"
                                                                            name="agama"
                                                                            v-model="agama"
                                                                            :state="getValidationState(validationContext)"
                                                                            aria-describedby="input-6-live-feedback"
                                                                    >
                                                                        <option class="col-md-9" value="">Pilih Agama
                                                                        </option>
                                                                        <option value="Islam"> Islam</option>
                                                                        <option value="Kristen Protestan"> Kristen
                                                                            Protestan
                                                                        </option>
                                                                        <option value="Katolik"> Katolik</option>
                                                                        <option value="Hindu"> Hindu</option>
                                                                        <option value="Buddha"> Buddha</option>
                                                                        <option value="Kong Hu Cu"> Kong Hu Cu</option>

                                                                    </b-form-select>

                                                                    <b-form-invalid-feedback
                                                                            id="input-6-live-feedback">@{{
                                                                        validationContext.errors[0]
                                                                        }}
                                                                    </b-form-invalid-feedback>
                                                                </b-form-group>
                                                            </validation-provider>
                                                            <validation-provider name="Alamat"
                                                                                 {{--                                                                                 :rules="{required: true}"--}}
                                                                                 v-slot="validationContext">
                                                                <b-form-group id="example-input-group-7" label="Alamat"
                                                                              label-for="example-input-7">
                                                                    <b-form-textarea
                                                                            placeholder="Masukkan Alamat"
                                                                            id="example-input-7"
                                                                            name="alamat"
                                                                            v-model="alamat"
                                                                            :state="getValidationState(validationContext)"
                                                                            aria-describedby="input-7-live-feedback"
                                                                    >


                                                                    </b-form-textarea>

                                                                    <b-form-invalid-feedback
                                                                            id="input-7-live-feedback">@{{
                                                                        validationContext.errors[0]
                                                                        }}
                                                                    </b-form-invalid-feedback>
                                                                </b-form-group>
                                                            </validation-provider>
                                                        </b-form>
                                                    </validation-observer>
                                                    <h6><i>Tanda <b> * </b> berarti harus diisi</i></h6>
                                                </b-modal>
                                            </div>
                                            @endif

                                        </div>

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
        <script type="text/javascript" src="{{asset('js/profiles/index.js')}}"></script>
    </div>
@endsection

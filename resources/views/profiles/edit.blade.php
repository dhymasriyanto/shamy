<?php

use App\Libs\AppHelpers;

$title = 'Ubah Profil';
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
                                                    <h4 class="m-0">{{Auth::user()->name}} </h4>
                                                    <p class="text-muted"><i>{{Auth::user()->role}} </i></p>


                                                </div>

                                                <div class="clearfix"></div>

                                                <b-button
                                                        class="mt-3"
                                                        variant="info"
                                                        pill
                                                        {{--                                                v-b-modal.modal-nilai--}}
                                                        @click="ubah({{Auth::user()->id_mahasiswa}})"
                                                >
                                                    <i class="mdi mdi-content-save mb-2"></i>Simpan
                                                </b-button>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Name -->
                                                <validation-provider name="Nama"
                                                                     :rules="{ required: true}"
                                                                     v-slot="validationContext">
                                                    <b-form-group id="example-input-group-1" label="Nama"
                                                                  label-for="example-input-1">
                                                        <b-form-input
                                                                placeholder="Masukkan Nama"
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

                                            </div>
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

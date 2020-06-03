/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {

            modalShow: false,
            modalShow2: false,
            modalShow3: false,
            modalShow4: false,
            modalShow5: false,
            tambahMahasiswa: false,
            sampai: 0,
            sampai2: 0,
            sampai3: 0,
            tampil: 0,
            tampil2: 0,
            tampil3: 0,
            filter: '',
            filter2: '',
            filter3: '',
            perPage: 10,
            perPage2: 10,
            perPage3: 10,
            currentPage: 1,
            currentPage2: 1,
            currentPage3: 1,
            pageOptions: [10, 15, 20],
            pageOptions2: [10, 15, 20],
            pageOptions3: [10, 15, 20],
            showData: '',
            showData2: '',
            showData3: '',
            totalRows: 0,
            totalRows2: 0,
            totalRows3: 0,
            isBusy: true,
            isLoading: true,
            isLoading2: true,
            id_mata_kuliah: '',
            id_mengajar: '',
            nilaiMahasiswa: [],
            datamengajar: [],
            datanilai: [],
            rinciankelas: [],
            allrinciankelas: [],
            nilaikelas: [],

            fieldsKelas: [
                {
                    key: 'no',
                    sortable: false,
                    // sortByFormatted : true
                },
                {
                    key: 'get_jurusan',
                    label: 'Program Studi',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'kurikulum',
                    label: 'Kurikulum',

                    sortable: true,
                    // sortByFormatted : true

                },

                {
                    key: 'mata_kuliah',
                    label: 'Mata Kuliah',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_kelas',
                    label: 'Kelas',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'semester',
                    label: 'Semester',

                    sortable: true,
                    // sortByFormatted : true

                },

                {
                    key: 'get_dosen',
                    label: 'Nama Dosen',

                    sortable: true,
                    // sortByFormatted : true
                },
                {
                    key: 'created_at',
                    label: 'Dibuat Tanggal',
                    sortable: true
                },
                {
                    key: 'aksi',
                    sortable: false,
                    // sortByFormatted : true

                }
            ],
            fieldsMahasiswa:[
                {
                    key: 'no',
                    sortable: false,
                    // sortByFormatted : true
                },
                {
                    key: "nama",
                    label: "Nama Mahasiswa",
                    sortable: true
                },
                {
                    key: "nomor_induk",
                    label: "Nomor Induk",
                    sortable: true
                },
                {
                    key: 'get_jurusan',
                    label: 'Program Studi',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_angka',
                    label: 'Nilai Angka',
                    sortable: false,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_indeks',
                    label: 'Nilai Indeks',
                    sortable: false,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_huruf',
                    label: 'Nilai Huruf',
                    sortable: false,
                    // sortByFormatted : true

                },
                {
                    key: 'aksi',
                    sortable: false,
                    // sortByFormatted : true

                },
            ],

            fields: [
                {
                    key: 'no',
                    sortable: false,
                },
                {
                    key: 'id_mahasiswa',
                    label: 'Mahasiswa',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'id_mengajar',
                    label: 'Kelas',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_angka',
                    label: 'Nilai Angka',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_huruf',
                    label: 'Nilai Huruf',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_indeks',
                    label: 'Nilai Index',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'aksi',
                    sortable: false,
                    // sortByFormatted : true

                },

            ],
            fieldsNilaiMahasiswa: [
                {
                    key: 'no',
                    sortable: false,
                },
                {
                    key: 'nilai_indeks',
                    label: 'Nilai Index',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_angka',
                    label: 'Nilai Angka',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_huruf',
                    label: 'Nilai Huruf',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'nilai_indeks',
                    label: 'Nilai Index',
                    sortable: true,
                    // sortByFormatted : true

                },


                {
                    key: 'aksi',
                    sortable: false,
                    // sortByFormatted : true

                },

            ],


        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.start();
            this.all();

        },
        methods: {
            start: function () {
                this.$Progress.start()
            },
            set: function (num) {
                this.$Progress.set(num)
            },
            increase: function (num) {
                this.$Progress.increase(num)
            },
            decrease: function (num) {
                this.$Progress.decrease(num)
            },
            finish: function (type, message) {
                this.$Progress.finish();
                if (type && message)
                    this.flash(type, message);
            },
            fail: function () {
                this.$Progress.fail()
            },
            flash: function (type, message) {
                if (type == "success") {
                    toastr.success(message);
                } else if (type == "error") {
                    toastr.error(message);
                } else if (type == "warning") {
                    toastr.warning(message);
                } else {
                    toastr.error("Ada kesalahan!")
                }
            },
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            resetModal: function () {
                // this.name = ''
                // this.nameState = null
                this.modalShow2 = false;
                this.id_mengajar ='';
                this.nilaikelas = [];
            },
            handleOk: function (bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit();
            },
            handleSubmit: async function () {
                // Exit when the form isn't valid
                // if (!this.checkFormValidity()) {
                //     return
                // }

                const isValid = await this.$refs.observer.validate();
                if (!isValid) {
                    // ABORT!!
                    return
                }


                // if (!this.errors) return
                // Push the name to submitted names
                // this.submittedNames.push(this.name)
                // this.create()

                // Hide the modal manually
                this.$nextTick(() => {

                    this.$refs.observer.reset();

                    // this.removeMahasiswa = false;
                    // this.tambahMahasiswa = false;
                })
            },
            onChange: function () {
                // this.$emit('input', value);
            },
            allRincianKelas: function (id, id_mengajar) {
                // vm.isLoading = true;

                axios.get('/kelas/allrinciankelas/' + id)
                    .then(function (response) {
                        // console.log(response.data);
                        // if (response.data != null) {
                        // console.log(vm.idtambah);
                        vm.allrinciankelas = response.data;
                        vm.nilaiKelas(id_mengajar);

                        // vm.totalRows2 = vm.allrinciankelas.length;
                        // vm.allMahasiswa();
                        // console.log(vm.allrinciankelas);

                        // } else {
                        //     vm.allrinciankelas = [];
                        // }

                    }).catch(function (error) {
                    console.log(error);
                    console.log('error di allrincian kelas')
                }).then(function () {
                    // vm.isLoading = false;

                });

            },
            nilaiKelas: function (id) {
                // vm.isLoading = true;

                axios.get('/nilai/nilaikelas/' + id)
                    .then(function (response) {
                        // console.log(response.data);
                        // if (response.data != null) {
                        // console.log(vm.idtambah);
                        vm.nilaikelas = response.data;
                        vm.id_mengajar=id;
                        vm.isLoading = false;

                        console.log(vm.nilaikelas[0].id_mahasiswa);
                        console.log(vm.nilaikelas[0][0].nilai_indeks);
                        // vm.totalRows2 = vm.allrinciankelas.length;
                        // vm.allMahasiswa();
                        // console.log(vm.allrinciankelas);

                        // } else {
                        //     vm.allrinciankelas = [];
                        // }

                    }).catch(function (error) {
                    console.log(error);
                    console.log('error di nilai kelas')
                }).then(function () {

                });

            },
            lihatKelas: function (id, id_mengajar) {
                // console.log(id_mengajar);
                this.start();
                // console.log('testing');
                axios.get('/kelas/' + id)
                    .then(function (response) {
                        // vm.idtambah = id;

                        vm.rinciankelas = response.data;
                        console.log(vm.rinciankelas);
                        // console.log(vm.rinciankelas[0]['mahasiswa'].length);
                        if (vm.rinciankelas[0]['mahasiswa'].length != 0) {
                            vm.isLoading = true;

                            vm.allRincianKelas(id ,id_mengajar);
                        }
                        // console.log(vm.rinciankelas[0]['id_jurusan']);
                        // vm.idjurusantambah = vm.rinciankelas[0]['id_jurusan'];
                        // vm.allMahasiswa();
                        vm.finish()
                        vm.modalShow2 = true;
                        // $("#modalRincian").modal('show');

                    }).catch(function (error) {
                    console.log('error di lihat rincian')
                }).then(function () {

                });
            },

            nilai: function (id_mahasiswa, id_mengajar) {
                axios.get('/nilai/nilaimahasiswa/' + id_mahasiswa)
                    .then(function (response) {
                        vm.nilaiMahasiswa = response.data;
                        alert(vm.nilaiMahasiswa);
                    })
                    .catch(function (error) {

                    })
                    .then(function () {

                    });
            },

            all: function (type, message) {
                axios.get('/mengajar/all')
                    .then(function (response) {
                        // handle success
                        vm.datamengajar = response.data;
                        // vm.getkelas = vm.datamengajar
                        vm.totalRows = vm.datamengajar.length;
                        vm.allKelas();
                        vm.allJurusan();
                        vm.allDosen();
                        vm.allMataKuliah();
                        vm.allTahunAjaran();
                        // vm.items = response.data;
                        // console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        vm.fail();

                        console.log(error);


                    })
                    .then(function () {
                        // always executed
                        vm.finish(type, message);

                    });
            },
            allJurusan: function () {
                axios.get('/jurusan/all')
                    .then(function (response) {
                        // handle success
                        vm.datajurusan = response.data;
                        // console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            allKelas: function () {
                axios.get('/kelas/all')
                    .then(function (response) {
                        vm.datakelas = response.data;
                    }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    vm.isBusy = false;

                });
            },
            allDosen: function () {
                axios.get('/dosen/all')
                    .then(function (response) {
                        vm.datadosen = response.data;
                    }).catch(function (error) {
                    console.log(error);
                }).then(function () {

                });
            },
            allMataKuliah: function () {
                axios.get('/mata-kuliah/all')
                    .then(function (response) {
                        vm.datamatakuliah = response.data;
                    }).catch(function (error) {
                    console.log(error);
                }).then(function () {

                });
            },
            allTahunAjaran: function () {
                axios.get('/tahun-ajaran/all')
                    .then(function (response) {
                        vm.datatahunajaran = response.data;
                    }).catch(function (error) {
                    console.log(error);
                }).then(function () {

                });
            },
            onFiltered: function (filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            onFiltered2: function (filteredItems) {
                this.totalRows2 = filteredItems.length
                this.currentPage2 = 1
            },


        },
        computed: {
            showingData() {
                this.sampai = this.currentPage * this.perPage;
                if (this.totalRows != 0) {
                    this.tampil = (this.currentPage * this.perPage + 1) - this.perPage;
                } else {
                    this.tampil = 0;
                }
                if (this.totalRows < this.sampai) {
                    this.sampai = this.totalRows;
                }
                this.showData = "Menampilkan " + (this.tampil) + " sampai " + (this.sampai) + " dari " + this.totalRows + " data";
                return this.showData;
            },
            showingData2() {
                this.sampai2 = this.currentPage2 * this.perPage2;
                if (this.totalRows2 != 0) {
                    this.tampil2 = (this.currentPage2 * this.perPage2 + 1) - this.perPage2;
                } else {
                    this.tampil2 = 0;
                }
                if (this.totalRows2 < this.sampai2) {
                    this.sampai2 = this.totalRows2;
                }
                this.showData2 = "Menampilkan " + (this.tampil2) + " sampai " + (this.sampai2) + " dari " + this.totalRows2 + " data";
                return this.showData2;
            },
            selected() {
                return this.value
            }


        },
        components: {}
    });

    $('.app-placeholder').addClass('d-none');
    $('.main_content_app').removeClass('d-none');
}

try {
    initVue();
} catch (e) {
    window.location.reload();
}

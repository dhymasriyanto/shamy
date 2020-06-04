/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            saring: [],
            visibleRows: [],
            idmahasiswa: window.idmahasiswa,
            nilaipribadimahasiswa: [],
            kelaspribadimahasiswa: [],
            mengajar: [],
            matakuliah:[],
            getkelas: [],
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
            search :1,
            filter: '',
            filter2: '',
            filter3: '',
            filter4: '',
            perPage: 10,
            perPage2: 10,
            perPage3: 10,
            perPage4: 10,
            currentPage: 1,
            currentPage2: 1,
            currentPage3: 1,
            currentPage4: 1,
            pageOptions: [10, 15, 20],
            pageOptions2: [10, 15, 20],
            pageOptions3: [10, 15, 20],
            pageOptions4: [10, 15, 20],
            showData: '',
            showData2: '',
            showData3: '',
            totalRows: 0,
            totalRows2: 0,
            totalRows3: 0,
            totalRows4: 0,
            isBusy: true,
            isLoading: true,
            isLoading2: true,
            isLoading3: true,
            id_mata_kuliah: '',
            id_mengajar: '',
            nilaiMahasiswa: [],
            datamengajar: [],
            datanilai: [],
            rinciankelas: [],
            allrinciankelas: [],
            nilaikelas: [],
            id: '',
            nama: '',
            nilai_angka: '',
            nilai_indeks: '',
            nilai_huruf: '',
            fieldsNilai:[
                {
                    key: 'no',
                    sortable: false,
                    // sortByFormatted : true
                },
                {
                    key: 'semester',
                    label: 'Semester',
                    sortable: false,
                    // sortByFormatted : true

                },
                {
                    key: 'kode_mata_kuliah',
                    label: 'Kode Mata Kuliah',
                    sortable: false,
                    // sortByFormatted : true

                },
                {
                    key: 'mata_kuliah',
                    label: 'Nama Mata Kuliah',
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
                    key: 'nilai_indeks',
                    label: 'Nilai Indeks',
                    sortable: false,
                    // sortByFormatted : true

                },

                {
                    key: 'nilai_angka',
                    label: 'Nilai Angka',
                    sortable: false,
                    // sortByFormatted : true

                },


                {
                    key: 'bobot',
                    label: 'Bobot Mata Kuliah',
                    sortable: false,
                    // sortByFormatted : true

                },
                {
                    key: 'nm',
                    label: 'Nilai Mata Kuliah (Nilai Indeks x Bobot)',
                    sortable: false,
                    // sortByFormatted : true

                },


            ],
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
            fieldsMahasiswa: [
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
                    key: 'nilai_angka',
                    label: 'Nilai Angka',
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
                    key: 'nilai_huruf',
                    label: 'Nilai Huruf',
                    sortable: true,
                    // sortByFormatted : true

                },


            ],


        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.start();
            console.log(this.idmahasiswa);
            if (this.idmahasiswa) {
                // this.nilaipribadi(this.idmahasiswa);
                this.kelaspribadi(this.idmahasiswa);
            }else{
                this.all();

            }

            // console.log(window.coba);

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
                // this.modalShow2 = false;
                this.modalShow = false;
                // this.id_mengajar = '';
                // this.nilaikelas = [];
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
                this.create()

                // Hide the modal manually
                this.$nextTick(() => {

                    this.$refs.observer.reset();
                    this.modalShow = false;
                    // this.removeMahasiswa = false;
                    // this.tambahMahasiswa = false;
                })
            },
            onChange: function () {
                // this.$emit('input', value);
                if (vm.nilai_angka >= 85 && vm.nilai_angka <= 100) {
                    vm.nilai_indeks = 4.00;
                    vm.nilai_huruf = "A";
                } else if (vm.nilai_angka >= 75 && vm.nilai_angka <= 84) {
                    vm.nilai_indeks = 3.00;
                    vm.nilai_huruf = "B";
                } else if (vm.nilai_angka >= 60 && vm.nilai_angka <= 74) {
                    vm.nilai_indeks = 2.00;
                    vm.nilai_huruf = "C";
                } else if (vm.nilai_angka >= 50 && vm.nilai_angka <= 59) {
                    vm.nilai_indeks = 1.00;
                    vm.nilai_huruf = "D";
                } else if (vm.nilai_angka >= 0 && vm.nilai_angka <= 49) {
                    vm.nilai_indeks = 0.00;
                    vm.nilai_huruf = "E";
                }
            },
            kelaspribadi:function(id){
                axios.get('/kelas/kelaspribadi/' + id)
                    .then(function (response) {
                        vm.kelaspribadimahasiswa = response.data;
                        // vm.kelaspribadimahasiswa.nilai=[[ response.data[0].nilai]];
                        vm.totalRows4 = vm.kelaspribadimahasiswa.length;
                        // console.log(vm.nilaipribadimahasiswa[0].id_mengajar);
                        //
                        // vm.getMengajar();
                        // vm.getMataKuliah();
                        vm.isLoading3 = false;


                    })
                    .catch(function (error) {

                    })
                    .then(function () {
                        vm.finish();

                    })
            },
            nilaipribadi: function (id) {
                axios.get('/nilai/nilaipribadi/' + id)
                    .then(function (response) {
                        vm.nilaipribadimahasiswa = response.data;
                        vm.nilaipribadimahasiswa.nilai=[[ response.data[0].nilai]];
                        vm.totalRows4 = vm.nilaipribadimahasiswa.length;
                        // console.log(vm.nilaipribadimahasiswa[0].id_mengajar);
                        //
                        vm.getMengajar();
                        vm.getMataKuliah();

                    })
                    .catch(function (error) {

                    })
                    .then(function () {

                    })
            },
            create: function () {
                this.start();
                axios.post('/nilai', {
                    id_mahasiswa: this.id,
                    id_mengajar: this.id_mengajar,
                    nilai_angka: this.nilai_angka,
                    nilai_indeks: this.nilai_indeks,
                    nilai_huruf: this.nilai_huruf
                })
                    .then(function (response) {
                        console.log(response.data);
                        vm.all(response.data.type, response.data.message);
                        // vm.lihatKelas(vm.id, vm.id_mengajar);
                        // vm.nilai(vm.id, vm.id_mengajar)
                        vm.nilaiKelas(vm.id_mengajar);
                        // vm.flash(response.data.type, response.data.message);
                    })
                    .catch(function (error) {
                        vm.fail();
                        vm.flash();
                        console.log(error);
                    })
                    .then(function () {
                    })
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

                        vm.totalRows2 = vm.allrinciankelas.length;
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
                        vm.id_mengajar = id;
                        vm.isLoading = false;

                        // console.log(vm.nilaikelas[0].id_mahasiswa);
                        // console.log(vm.nilaikelas[0][0].nilai_indeks);
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

                            vm.allRincianKelas(id, id_mengajar);
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

            getMengajar:function(){
                axios.get("/mengajar/all")
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.mengajar = response.data;
                        // vm.getkelas = vm.mengajar[0].get_kelas;
                        // console.log(vm.getkelas.id_mata_kuliah);
                        // vm.getMataKuliah(vm.getkelas.id_mata_kuliah);

                        // vm.editid = kelasid;
                        // vm.mahasiswaid = mahasiswaid;
                        // vm.modalShow4 = true;
                        // vm.removeMahasiswa = true;
                        // vm.finish();
                        // console.log(response.data);

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                        // vm.modalShow = true;
                        // vm.finish();

                    });
            },
            getMataKuliah:function(){
                axios.get("/mata-kuliah/all/")
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.matakuliah = response.data;
                        console.log(vm.matakuliah[0].kode);
                        // vm.editid = kelasid;
                        // vm.mahasiswaid = mahasiswaid;
                        // vm.modalShow4 = true;
                        // vm.removeMahasiswa = true;
                        // vm.finish();
                        // console.log(response.data);
                        // vm.isLoading3 = false;

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                        // vm.modalShow = true;
                        // vm.finish();


                    });
            },
            getMahasiswa: function (id) {
                axios.get("/mahasiswa/get/" + id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.nama = response.data['data'][0]['nama'];
                        // vm.editid = kelasid;
                        // vm.mahasiswaid = mahasiswaid;
                        // vm.modalShow4 = true;
                        // vm.removeMahasiswa = true;
                        // vm.finish();
                        // console.log(response.data);

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                        vm.modalShow = true;
                        vm.finish();

                    });
            },

            nilai: function (id_mahasiswa, id_mengajar) {
                this.start();
                axios.get('/nilai/nilaimahasiswa/' + id_mahasiswa, {
                    params: {
                        id_mengajar: id_mengajar
                    }
                })
                    .then(function (response) {
                        vm.nilaiMahasiswa = response.data;
                        vm.id = response.data[0]['id_mahasiswa'];
                        vm.id_mengajar = id_mengajar;
                        vm.getMahasiswa(vm.id);
                        vm.nilai_angka = response.data[0]['nilai']['nilai_angka'];
                        vm.nilai_indeks = response.data[0]['nilai']['nilai_indeks'];
                        vm.nilai_huruf = response.data[0]['nilai']['nilai_huruf'];
                        // alert(vm.nilaiMahasiswa);
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
            onFiltered3: function (filteredItems) {
                this.totalRows4 = filteredItems.length
                this.currentPage4 = 1
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
            showingData3() {
                this.sampai4 = this.currentPage4 * this.perPage4;
                if (this.totalRows4 != 0) {
                    this.tampil4 = (this.currentPage4 * this.perPage4 + 1) - this.perPage4;
                } else {
                    this.tampil4 = 0;
                }
                if (this.totalRows4 < this.sampai4) {
                    this.sampai4 = this.totalRows4;
                }
                this.showData4 = "Menampilkan " + (this.tampil4) + " sampai " + (this.sampai4) + " dari " + this.totalRows4 + " data";
                return this.showData4;
            },
            selected() {
                return this.value
            },

            filteredItems() {
                this.saring = this.kelaspribadimahasiswa.filter(kelaspribadimahasiswa => {
                    return (kelaspribadimahasiswa.semester.indexOf(this.search)) > -1
                });
                this.totalRows4 = this.saring.length;
                return this.saring
            },
            nilaiAngka() {
                return this.visibleRows.reduce((accum, item) => {
                    // Assuming expenses is the field you want to total up
                    return accum + parseFloat(item.nilai.nilai_angka)
                }, 0.00)
            },
            nilaiIndeks() {
                return this.visibleRows.reduce((accum, item) => {
                    // Assuming expenses is the field you want to total up
                    return accum + parseFloat(item.nilai.nilai_indeks)
                }, 0.00)
            },
            totalSKS() {
                return this.visibleRows.reduce((accum, item) => {
                    // Assuming expenses is the field you want to total up
                    return accum + parseFloat(item.get_mata_kuliah.bobot)
                }, 0.00)
            },
            totalNM() {
                return this.visibleRows.reduce((accum, item) => {
                    // Assuming expenses is the field you want to total up
                    return accum + parseFloat((item.nilai.nilai_indeks * item.get_mata_kuliah.bobot))
                }, 0.00)
            },
            totalIPS(){
                return this.visibleRows.reduce((accum, item) => {
                    // Assuming expenses is the field you want to total up
                    return accum + parseFloat(((item.nilai.nilai_indeks * item.get_mata_kuliah.bobot) / this.totalSKS.toFixed(0)))
                }, 0.00)
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

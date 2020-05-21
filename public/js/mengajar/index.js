/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            sampai: 0,
            tampil: 0,
            filter: '',
            perPage: 10,
            currentPage: 1,
            pageOptions: [10, 15, 20],
            showData: '',
            totalRows: 0,
            isBusy: true,
            fields: [
                {
                    key: 'no',
                    sortable: false,
                    // sortByFormatted : true
                },
                {
                    key: 'get_jurusan',
                    label: 'Nama Jurusan',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_kelas',
                    label: 'Nama Kelas',

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
                    key: 'get_mata_kuliah',
                    label: 'Nama Mata Kuliah',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_tahun_ajaran',
                    label: 'Nama Tahun Ajaran',

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
            datamengajar: [],
            datajurusan: [],
            datakelas: [],
            datadosen: [],
            datamatakuliah: [],
            datatahunajaran: [],
            id_jurusan: '',
            id_kelas: '',
            id_dosen: '',
            id_mata_kuliah: '',
            id_tahun_ajaran: ''
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
                if(type && message)
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
                } else {
                    toastr.error("Ada kesalahan!")
                }
            },
            checkFormValidity: function () {
                const valid = this.$refs.form.checkValidity()
                this.id_jurusan = valid
                // console.log(valid)
                return valid
            },
            getValidationState({ dirty, validated, valid = null }) {
                return dirty || validated ? valid : null;
            },
            resetModal: function () {
                // this.name = ''
                // this.nameState = null
                this.id_jurusan = '';
                this.id_kelas = '';
                this.id_dosen = '';
                this.id_mata_kuliah = '';
                this.id_tahun_ajaran = '';
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
                     this.$bvModal.hide('modal-1');
                     this.$refs.observer.reset();
                 })
             },
            create: function () {
                this.start();
                axios.post('/mengajar', {
                    id_jurusan: this.id_jurusan,
                    id_kelas: this.id_kelas,
                    id_dosen: this.id_dosen,
                    id_mata_kuliah: this.id_mata_kuliah,
                    id_tahun_ajaran: this.id_tahun_ajaran
                })
                    .then(function (response) {
                        console.log(response.data);
                        vm.all(response.data.type, response.data.message);
                        // vm.flash(response.data.type, response.data.message);
                    })
                    .catch(function (error) {
                        vm.fail();
                        vm.flash();
                    })
                    .then(function () {
                    })
            },
            hapus: function (id) {
                axios.delete('/mengajar/' + id)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            all: function (type, message) {
                axios.get('/mengajar/all')
                    .then(function (response) {
                        // handle success
                        vm.datamengajar = response.data;
                        vm.totalRows = vm.datamengajar.length;
                        vm.allJurusan();
                        vm.allKelas();
                        vm.allDosen();
                        vm.allMataKuliah();
                        vm.allTahunAjaran();
                        vm.finish(type, message);
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
                        vm.isBusy = false;

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
            }

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


        },
        components: {
        }
    });
    $('.app-placeholder').addClass('d-none');
    $('.main_content_app').removeClass('d-none');
}

try {
    initVue();
} catch (e) {
    window.location.reload();
}

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
            modalShow: false,
            modalShow2: false,
            modalShow3: false,
            remove: false,
            ubah: false,
            fields: [
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
                // {
                //     key: 'get_kelas',
                //     label: 'Nama Mata Kuliah',
                //
                //     sortable: true,
                //     // sortByFormatted : true
                //
                // },
                // {
                //     key: 'get_tahun_ajaran',
                //     label: 'Nama Tahun Ajaran',
                //
                //     sortable: true,
                //     // sortByFormatted : true
                //
                // },
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
            id_tahun_ajaran: '',
            id_kurikulum: '',
            editnama: '',
            editid: '',
            editid_jurusan: '',
            editid_kelas: '',
            editid_dosen: '',
            editid_tahun_ajaran: '',
            getkelas: [],
            rincianmengajar: '',
            rincian_mata_kuliah: '',
            rincian_kurikulum: '',
            rincian_jurusan: '',
            rincian_tahun_ajaran: '',
            namamatakuliah: '',
            singkatanmatakuliah: '',
            namajurusan: '',
            tahunajaran: '',
            namakurikulum: '',
            kodematakuliah: '',
            bobotmatakuliah: '',
            jenismatakuliah: ''


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
            // checkFormValidity: function () {
            //     const valid = this.$refs.form.checkValidity()
            //     this.id_jurusan = valid
            //     // console.log(valid)
            //     return valid
            // },
            getValidationState({dirty, validated, valid = null}) {
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
                this.editid_jurusan = '';
                this.editid_kelas = '';
                this.editid_dosen = '';
                this.editid_mata_kuliah = '';
                this.editid_tahun_ajaran = '';
                this.editid = '';
                this.editnama = '';
                this.remove = false;
                this.ubah = false;
                this.modalShow = false;
                this.modalShow2 = false;
                this.modalShow3 = false;
                this.getkelas = [];

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
                if (this.remove) {
                    this.hapus()
                } else {
                    const isValid = await this.$refs.observer.validate();
                    if (!isValid) {
                        // ABORT!!
                        return
                    }


                    if (this.ubah) {
                        this.update();
                        this.ubah = false;
                    } else {
                        this.create();
                    }
                }

                // if (!this.errors) return
                // Push the name to submitted names
                // this.submittedNames.push(this.name)
                // this.create()

                // Hide the modal manually
                this.$nextTick(() => {
                    this.$bvModal.hide('modal-1');
                    this.$bvModal.hide('modal-edit');
                    this.$bvModal.hide('modalhapus');
                    if (!this.remove && !this.removeMahasiswa && !this.tambahMahasiswa) {
                        this.$refs.observer.reset();
                    }
                    // Hide the modal manually
                    this.modalShow = false;
                    this.modalShow2 = false;
                    this.modalShow3 = false;
                    // this.modalShow4 = false;
                    // this.modalShow5 = false;
                    this.remove = false;
                    // this.removeMahasiswa = false;
                    // this.tambahMahasiswa = false;
                })
            },
            onChange: function () {
                if (this.id_jurusan == '') {
                    this.id_tahun_ajaran = '';
                    this.id_kelas = '';
                    this.id_dosen = '';
                } else if (this.id_tahun_ajaran == '') {
                    this.id_kelas = '';
                    this.id_dosen = '';
                } else if (this.id_kelas = '') {
                    this.id_dosen = '';
                } else if (this.id_jurusan != '' && this.id_kelas == '') {
                    this.id_dosen = '';
                }


                if (this.editid_jurusan == '') {
                    this.editid_tahun_ajaran = '';
                    this.editid_kelas = '';
                    this.editid_dosen = '';
                } else if (this.editid_tahun_ajaran == '') {
                    this.editid_kelas = '';
                    this.editid_dosen = '';
                } else if (this.editid_kelas = '') {
                    this.editid_dosen = '';
                } else if (this.editid_jurusan != '' && this.editid_kelas == '') {
                    this.editid_dosen = '';
                }


                // this.$emit('input', value);
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
                        console.log(error);
                    })
                    .then(function () {
                    })
            },
            update: function () {
                // console.log(this.nama)
                // this.isBusy = true;
                this.start();
                axios.put('/mengajar/' + this.editid, {
                    id_jurusan: this.editid_jurusan,
                    id_kelas: this.editid_kelas,
                    id_dosen: this.editid_dosen,
                    // _method: 'put'
                })
                    .then(function (response) {
                        // handle success
                        // console.log(response);

                        // $('#modaledit').modal('hide');
                        vm.all(response.data.type, response.data.message);
                        // vm.flash(response.data.type, response.data.message);

                        vm.editnama = "";
                        vm.editid_tahun_ajaran = "";
                        vm.editid_jurusan = "";
                        vm.editid_kelas = "";
                        vm.editid = "";
                        vm.editid_dosen = '';

                    })
                    .catch(function (error) {
                        // handle error
                        // $("#pesan").text("Ada kesalahan");
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },

            edit: function (id) {
                this.start();

                // console.log(this.nama)
                axios.get('/mengajar/' + id)
                    .then(function (response) {
                        // handle success
                        // console.log(response);
                        vm.editid = id;
                        vm.editnama = response.data[0]['id'];
                        vm.editid_jurusan = response.data[0]['id_jurusan'];
                        vm.getkelas = response.data[0]['get_kelas'];
                        vm.editid_tahun_ajaran = vm.getkelas['id_tahun_ajaran'];
                        vm.editid_kelas = response.data[0]['id_kelas'];
                        vm.editid_dosen = response.data[0]['id_dosen'];

                        // vm.allRincianMatkul(vm.editid_kurikulum);
                        vm.ubah = true;


                    })
                    .catch(function (error) {
                        // handle error
                        // $("#pesan").text("Ada kesalahan");
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                        vm.modalShow = true;
                        vm.finish();
                    });
                // $("#modal-edit").modal('show');
            },
            hapus: function () {
                this.start();

                axios.delete('/mengajar/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all(response.data.type, response.data.message);
                        vm.editnama = '';
                        vm.editid = '';
                        // $("#modalhapus").modal('hide');
                        console.log(response.data.type, response.data.message);
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

            rincianMataKuliah: function (id) {
                axios.get('mata-kuliah/get/' + id)
                    .then(function (response) {
                        vm.rincian_mata_kuliah = response.data;
                        vm.namamatakuliah = vm.rincian_mata_kuliah.data[0].nama;
                        vm.kodematakuliah = vm.rincian_mata_kuliah.data[0].kode;
                        vm.bobotmatakuliah = vm.rincian_mata_kuliah.data[0].bobot;
                        vm.singkatanmatakuliah = vm.rincian_mata_kuliah.data[0].singkatan;
                        vm.jenismatakuliah = vm.rincian_mata_kuliah.data[0].jenis;
                        console.log(vm.namamatakuliah, vm.kodematakuliah, vm.bobotmatakuliah, vm.singkatanmatakuliah, vm.jenismatakuliah)
                    })
                    .catch(function (error) {
                        console.log('di rincian makul');
                        console.log(error);

                    })
                    .then(function () {

                    });
            },
            rincianJurusan: function (id) {
                axios.get('jurusan/get/' + id)
                    .then(function (response) {
                        vm.rincian_jurusan = response.data;
                        vm.namajurusan = vm.rincian_jurusan.data[0].nama;

                        console.log(vm.namajurusan)
                    })
                    .catch(function (error) {
                        console.log(error);
                        console.log('di rincian jurus');

                    })
                    .then(function () {

                    });
            },
            rincianKurikulum: function (id) {
                axios.get('kurikulum/get/' + id)
                    .then(function (response) {
                        vm.rincian_kurikulum = response.data;
                        vm.namakurikulum = vm.rincian_kurikulum.data[0].nama;

                        console.log(vm.namakurikulum);
                    })
                    .catch(function (error) {
                        console.log('di rincian kuri');

                        console.log(error);
                    })
                    .then(function () {

                    });
            },
            rincianTahunAjaran: function (id) {
                axios.get('tahun-ajaran/get/' + id)
                    .then(function (response) {
                        vm.rincian_tahun_ajaran = response.data;
                        vm.tahunajaran = vm.rincian_tahun_ajaran.data[0].tahun_ajaran;

                        console.log(vm.tahunajaran)
                    })
                    .catch(function (error) {
                        console.log('di rincian ta');

                        console.log(error);
                    })
                    .then(function () {
                        vm.finish()
                        vm.modalShow2 = true;
                    });
            },
            lihatRincian: function (id) {
                this.start();
                // console.log('testing');
                axios.get('/mengajar/' + id)
                    .then(function (response) {
                        vm.rincianmengajar = response.data;
                        vm.getkelas = response.data[0]['get_kelas'];
                        vm.id_mata_kuliah = vm.getkelas.id_mata_kuliah;
                        vm.id_jurusan = vm.getkelas.id_jurusan;
                        vm.id_kurikulum = vm.getkelas.id_kurikulum;
                        vm.id_tahun_ajaran = vm.getkelas.id_tahun_ajaran;
                        vm.rincianMataKuliah(vm.id_mata_kuliah);
                        vm.rincianJurusan(vm.id_jurusan);
                        vm.rincianKurikulum(vm.id_kurikulum);
                        vm.rincianTahunAjaran(vm.id_tahun_ajaran);



                        // $("#modalRincian").modal('show');

                    }).catch(function (error) {
                    console.log('error di lihat rincian')
                }).then(function () {

                });
            },
            hapusdata: function (id) {
                this.start();
                axios.get("/mengajar/" + id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data[0]['get_dosen'];
                        vm.editid = id;
                        // console.log(response.data);
                        // $("#modalhapus").modal('show');
                        vm.modalShow3 = true;
                        vm.remove = true;
                        vm.finish();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
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

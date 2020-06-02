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
            fields: [
                {
                    key: 'no',
                    sortable: false,
                    // sortByFormatted : true
                },
                {
                    key: 'nama',
                    label: 'Nama Kelas',
                    sortable: true,
                },


                //

                //
                // {
                //     key: 'get_tahun_ajaran',
                //     label: 'Nama Tahun Ajaran',
                //
                //     sortable: true,
                //     // sortByFormatted : true
                //
                // },
                {
                    key: 'get_mata_kuliah',
                    label: 'Nama Mata Kuliah',
                    sortable: true
                },
                {
                    key: 'semester',
                    label: 'Semester',
                    sortable: true,
                },
                {
                    key: 'get_jurusan',
                    label: 'Nama Program Studi',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'mahasiswa',
                    label: 'Jumlah Peserta Didik',

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

                },

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
                    label: 'Nama Program Studi',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'aksi',
                    sortable: false,
                    // sortByFormatted : true

                },

            ],

            datakelas: [],
            // datamahasiswa: [],
            rinciankelas: [],
            allrinciankelas: [],
            datajurusan: [],
            datatahunajaran: [],
            datakurikulum: [],
            allrincianmatkul: [],
            allmahasiswa: [],
            datamatakuliah: [],
            idtambah: '',
            idjurusantambah: '',
            nama: '',
            id: '',
            semester: '',
            id_tahun_ajaran: '',
            id_jurusan: '',
            id_kurikulum: '',
            id_mata_kuliah: '',
            mahasiswa: [],
            editnama: '',
            editid: '',
            editsemester: '',
            editid_tahun_ajaran: '',
            editid_jurusan: '',
            editid_kurikulum: '',
            editid_mata_kuliah: '',
            editmahasiswa: [],
            kelasid: "",
            mahasiswaid: "",
            tambah: false,
            ubah: false,
            remove: false,
            removeMahasiswa: false,


        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.start();
            this.all();
            // this.modalLoad();

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
                }
                else if (type == "warning") {
                    toastr.warning(message);
                }
                else if (type == "error") {
                    toastr.error(message);
                } else {
                    toastr.error("Ada kesalahan!")
                }
            },
            modalLoad: function () {
                $(document).ready(function () {
                    $('#hapusmodal').on('hidden.bs.modal', function () {
                        $('#modalRincian').css('z-index', 1041);
                    });
                });
            },
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            resetModal: function () {
                // this.name = ''
                // this.nameState = null
                this.nama = '';
                this.id = '';
                this.semester = '';
                this.id_tahun_ajaran = '';
                this.id_jurusan = '';
                this.id_mata_kuliah = '';
                this.id_kurikulum = '';
                // this.mahasiswa = [];
                // this.editmahasiswa = [];
                this.editsemester = '';
                this.editid_tahun_ajaran = '';
                this.editid_jurusan = '';
                this.remove = false;
                this.removeMahasiswa = false;
                this.modalShow = false;
                this.modalShow3 = false;
                this.modalShow4 = false;
                this.modalShow5 = false;
                this.tambahMahasiswa = false;
                if (this.ubah) {
                    // this.modalShow2 = false;
                    this.editid = '';
                    this.editnama = '';
                }
                this.ubah = false;
                // if (!this.removeMahasiswa)
                // this.modalShow2 = false;
                // this.editmahasiswa = [];
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
                } else if (this.removeMahasiswa) {
                    this.hapusmahasiswa();
                } else if (this.tambahMahasiswa) {
                    this.tambahmahasiswa();
                } else {
                    const isValid = await this.$refs.observer.validate();
                    if (!isValid) {
                        // ABORT!!
                        return
                    }

                    // if (!this.errors) return
                    // Push the name to submitted names
                    // this.submittedNames.push(this.name)
                    if (this.ubah) {
                        this.update();
                        this.ubah = false;
                    } else {
                        this.create();
                    }
                }

                this.$nextTick(() => {
                    this.$bvModal.hide('modal-tambah');
                    // this.$bvModal.hide('modal-edit');
                    this.$bvModal.hide('modalhapus');
                    if (!this.remove && !this.removeMahasiswa && !this.tambahMahasiswa) {
                        this.$refs.observer.reset();
                    }
                    // Hide the modal manually
                    this.modalShow = false;
                    // this.modalShow2 = false;
                    this.modalShow3 = false;
                    this.modalShow4 = false;
                    this.modalShow5 = false;
                    this.remove = false;
                    this.removeMahasiswa = false;
                    this.tambahMahasiswa = false;

                })


            },
            create: function () {
                this.start();
                // console.log(this.nama)
                axios.post('/kelas', {
                    nama: this.nama,
                    semester: this.semester,
                    id_jurusan: this.id_jurusan,
                    id_tahun_ajaran: this.id_tahun_ajaran,
                    id_mata_kuliah: this.id_mata_kuliah,
                    id_kurikulum: this.id_kurikulum,
                    mahasiswa: this.mahasiswa
                    // _method: 'put'
                })
                    .then(function (response) {
                        // handle success
                        console.log(response);
                        // vm.nama = "";
                        // vm.semester = "";
                        // vm.id_tahun_ajaran = "";
                        // vm.id_jurusan = "";
                        // vm.id_mata_kuliah = "";
                        // vm.isBusy = true;
                        vm.all(response.data.type, response.data.message);

                        // $('#modaltambah').modal('hide');
                        // vm.flash(response.data.type, response.data.message);

                    })
                    .catch(function (error) {
                        // handle error

                        vm.fail();
                        vm.flash();
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            edit: function (id) {
                this.start();

                // console.log(this.nama)
                axios.get('/kelas/' + id)
                    .then(function (response) {
                        // handle success
                        // console.log(response);
                        vm.editid = id;
                        vm.editnama = response.data[0]['nama'];
                        vm.editsemester = response.data[0]['semester'];
                        vm.editid_tahun_ajaran = response.data[0]['id_tahun_ajaran'];
                        vm.editid_jurusan = response.data[0]['id_jurusan'];
                        vm.editid_mata_kuliah = response.data[0]['id_mata_kuliah'];
                        vm.editid_kurikulum = response.data[0]['id_kurikulum'];
                        vm.editmahasiswa = response.data[0]['mahasiswa'];
                        vm.allRincianMatkul(vm.editid_kurikulum);
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
            update: function () {
                // console.log(this.nama)
                // this.isBusy = true;
                this.start();
                axios.put('/kelas/' + this.editid, {
                    nama: this.editnama,
                    semester: this.editsemester,
                    id_jurusan: this.editid_jurusan,
                    id_tahun_ajaran: this.editid_tahun_ajaran,
                    id_kurikulum: this.editid_kurikulum,
                    id_mata_kuliah: this.editid_mata_kuliah,
                    mahasiswa: this.editmahasiswa
                    // _method: 'put'
                })
                    .then(function (response) {
                        // handle success
                        // console.log(response);

                        // $('#modaledit').modal('hide');
                        vm.all(response.data.type, response.data.message);
                        // vm.flash(response.data.type, response.data.message);

                        vm.editnama = "";
                        vm.editsemester = "";
                        vm.editid_tahun_ajaran = "";
                        vm.editid_jurusan = "";
                        vm.editid_mata_kuliah = "";
                        vm.editid_kurikulum = "";
                        vm.editmahasiswa = [];

                    })
                    .catch(function (error) {
                        // handle error
                        $("#pesan").text("Ada kesalahan");
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },

            all: function (type, message) {
                axios.get('/kelas/all/')
                    .then(function (response) {
                        // handle success
                        vm.datakelas = response.data;
                        vm.totalRows = vm.datakelas.length;
                        vm.allJurusan();
                        vm.allTahunAjaran();
                        vm.allMataKuliah();
                        vm.allKurikulum();
                        // console.log(vm.allJurusan());
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        console.log('error di all');
                    })
                    .then(function () {
                        // always executed
                        vm.finish(type, message);
                        vm.isBusy = false;
                    });
            },
            // allMahasiswa: function () {
            //     axios.get('/kelas/allmahasiswa')
            //         .then(function (response) {
            //             vm.datamahasiswa = response.data;
            //         }).catch(function (error) {
            //         console.log(error);
            //     }).then(function () {
            //
            //     });
            //
            // },
            allRincianKelas: function (id) {
                vm.isLoading = true;

                axios.get('/kelas/allrinciankelas/' + id)
                    .then(function (response) {
                        // console.log(response.data);
                        // if (response.data != null) {
                        console.log(vm.idtambah);
                        vm.allrinciankelas = response.data;
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
                    vm.isLoading = false;

                });

            },
            lihatRincian: function (id) {
                this.start();
                // console.log('testing');
                axios.get('/kelas/' + id)
                    .then(function (response) {
                        vm.idtambah = id;

                        vm.rinciankelas = response.data;
                        console.log(vm.rinciankelas);
                        // console.log(vm.rinciankelas[0]['mahasiswa'].length);
                        if (vm.rinciankelas[0]['mahasiswa'].length != 0) {

                            vm.allRincianKelas(id);
                        }
                            console.log(vm.rinciankelas[0]['id_jurusan']);
                        vm.idjurusantambah = vm.rinciankelas[0]['id_jurusan'];
                        vm.allMahasiswa();
                        vm.finish()
                        vm.modalShow2 = true;
                        // $("#modalRincian").modal('show');

                    }).catch(function (error) {
                    console.log('error di lihat rincian')
                }).then(function () {

                });

            },
            allMataKuliah: function () {
                axios.get('/mata-kuliah/all')
                    .then(function (response) {
                        // handle success
                        vm.datamatakuliah = response.data;
                        // console.log(response);
                        // const ayam = response.data;
                        // ayam.forEach(function(element) {
                        //     console.log(element);
                        // });
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            allKurikulum: function () {
                axios.get('/kurikulum/all')
                    .then(function (response) {
                        // handle success
                        vm.datakurikulum = response.data;
                        // console.log(response);
                        // const ayam = response.data;
                        // ayam.forEach(function(element) {
                        //     console.log(element);
                        // });
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },

            allMahasiswa: function () {
                console.log(this.idtambah);
                axios.get('/kelas/mahasiswa/' + this.idtambah,{
                    params:{
                        id_jurusan: this.idjurusantambah
                    }
                })
                    .then(function (response) {
                        // handle success
                        vm.allmahasiswa = response.data;
                        console.log(vm.allmahasiswa);
                        vm.totalRows3 = vm.allmahasiswa.length;
                        // console.log(response);
                        // const ayam = response.data;
                        // ayam.forEach(function(element) {
                        //     console.log(element);
                        // });
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                        vm.isLoading2 = false;

                    });
            },
            allRincianMatkul: function (id) {
                axios.get('/kurikulum/allrincianmatkul/' + id)
                    .then(function (response) {
                        vm.allrincianmatkul = response.data;
                        if (response.data[0] == null) {
                            vm.allrincianmatkul = [];
                            // vm.totalRows2 = vm.allrincianmatkul.length;
                        } else {
                            // vm.totalRows2 = vm.allrincianmatkul.length;
                        }
                    }).catch(function (error) {
                }).then(function () {

                });

            },
            allJurusan: function () {
                axios.get('/jurusan/all')
                    .then(function (response) {
                        // handle success
                        vm.datajurusan = response.data;
                        // console.log(response);
                        // const ayam = response.data;
                        // ayam.forEach(function(element) {
                        //     console.log(element);
                        // });
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            allTahunAjaran: function () {
                axios.get('/tahun-ajaran/all')
                    .then(function (response) {
                        // handle success
                        vm.datatahunajaran = response.data;
                        // console.log(response);
                        // const ayam = response.data;
                        // ayam.forEach(function(element) {
                        //     console.log(element);
                        // });
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            hapus: function () {
                this.start();
                // this.isBusy = true;
                axios.delete('/kelas/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all(response.data.type, response.data.message);
                        vm.editnama = '';
                        vm.editid = '';
                        // $("#modalhapus").modal('hide');
                        console.log(response.data.type, response.data.message);
                        // vm.flash();


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
            hapusdata: function (id) {
                this.start();
                axios.get("/kelas/" + id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data[0]['nama'];
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
            hapusmodal: function (kelasid, mahasiswaid) {
                this.start();
                // $("#hapusmodal").modal('show');
                // $("#modalRincian").css('z-index', 1039);
                axios.get("/mahasiswa/get/" + mahasiswaid)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data['data'][0]['nama'];
                        vm.editid = kelasid;
                        vm.mahasiswaid = mahasiswaid;
                        vm.modalShow4 = true;
                        vm.removeMahasiswa = true;
                        vm.finish();
                        // console.log(response.data);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            tambahmodal: function (mahasiswaid) {
                this.start();
                // $("#hapusmodal").modal('show');
                // $("#modalRincian").css('z-index', 1039);
                axios.get("/mahasiswa/get/" + mahasiswaid)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data['data'][0]['nama'];
                        // vm.editid = vm.idtambah;
                        vm.mahasiswaid = mahasiswaid;
                        vm.modalShow5 = true;
                        vm.tambahMahasiswa = true;
                        vm.finish();
                        // console.log(response.data);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            tambahmahasiswa: function () {
                axios.put('/kelas/tambahmahasiswa', {
                    kelasid: this.idtambah,
                    mahasiswaid: this.mahasiswaid
                })
                    .then(function (response) {
                        vm.all(response.data.type, response.data.message);
                        vm.lihatRincian(vm.idtambah);
                        vm.allMahasiswa();
                        vm.editnama = "";
                        vm.mahasiswaid = "";
                        vm.editid = "";
                    }).catch(function (error) {
                }).then(function () {

                });
            },
            hapusmahasiswa: function () {
                this.start()
                // console.log(this.editid);
                axios.delete("/kelas/hapusmahasiswa", {
                    data: {
                        id: this.editid,
                        mahasiswaid: this.mahasiswaid
                    }
                })
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.all(response.data.type, response.data.message);
                        console.log("id =" + vm.editid);
                        vm.lihatRincian(vm.editid);
                        vm.editnama = "";
                        vm.mahasiswaid = "";
                        vm.editid = "";
                        // vm.flash(response.data.type, response.data.message);

                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
                // $("#hapusmodal").modal('hide');

            },
            onChange: function () {
                if (this.id_jurusan == '') {
                    this.id_tahun_ajaran = '';
                    this.nama = '';
                    this.id_mata_kuliah = '';
                    this.semester = '';
                    this.id_kurikulum = '';
                    // this.id_kelas = '';
                    // this.id_dosen = '';
                } else if (this.id_tahun_ajaran == '') {
                    this.nama = '';
                    this.id_mata_kuliah = '';
                    this.semester = '';
                    this.id_kurikulum = '';
                } else if (this.nama == '') {
                    // alert('asu');
                    this.id_mata_kuliah = '';
                    this.semester = '';
                    this.id_kurikulum = '';
                } else if (this.id_kurikulum = '') {
                    this.id_mata_kuliah = '';
                    this.semester = '';
                } else if (this.id_mata_kuliah = '') {
                    this.semester = '';
                } else if (this.id_jurusan != '' && this.id_kurikulum == '') {
                    this.id_mata_kuliah = '';
                    this.semester = '';
                }
                // else if (this.id_kurikulum != '' && this.id_mata_kuliah == '') {
                //     this.semester = '';
                // }

                if (this.editid_jurusan == '') {
                    this.editid_tahun_ajaran = '';
                    this.editnama = '';
                    this.editid_mata_kuliah = '';
                    this.editsemester = '';
                    this.editid_kurikulum = '';
                    // this.id_kelas = '';
                    // this.id_dosen = '';
                } else if (this.editid_tahun_ajaran == '') {
                    this.editnama = '';
                    this.editid_mata_kuliah = '';
                    this.editsemester = '';
                    this.editid_kurikulum = '';
                } else if (this.editnama == '') {
                    // alert('asu');
                    this.editid_mata_kuliah = '';
                    this.editsemester = '';
                    this.editid_kurikulum = '';
                } else if (this.editid_kurikulum = '') {
                    this.editid_mata_kuliah = '';
                    this.editsemester = '';
                } else if (this.editid_mata_kuliah = '') {
                    this.editsemester = '';
                } else if (this.editid_jurusan != '' && this.editid_kurikulum == '') {
                    this.editid_mata_kuliah = '';
                    this.editsemester = '';
                }
                // else if (this.id_jurusan != '' && this.nama == '') {
                //     this.id_mata_kuliah = '';
                //     this.semester = '';
                // }
                // this.$emit('input', value);
            },
            onChange2: function () {

                if (this.id_kurikulum) {
                    this.id_mata_kuliah = '';
                    this.semester = '';
                    this.allRincianMatkul(this.id_kurikulum);
                }

                if (this.editid_kurikulum) {
                    this.editid_mata_kuliah = '';
                    this.editsemester = '';
                    console.log(this.editid_kurikulum);
                    this.allRincianMatkul(this.editid_kurikulum);
                }
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
                this.totalRows3 = filteredItems.length
                this.currentPage3 = 1
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
                this.sampai3 = this.currentPage3 * this.perPage3;
                if (this.totalRows3 != 0) {
                    this.tampil3 = (this.currentPage3 * this.perPage3 + 1) - this.perPage3;
                } else {
                    this.tampil3 = 0;
                }
                if (this.totalRows3 < this.sampai3) {
                    this.sampai3 = this.totalRows3;
                }
                this.showData3 = "Menampilkan " + (this.tampil3) + " sampai " + (this.sampai3) + " dari " + this.totalRows3 + " data";
                return this.showData3;
            },
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

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
                    key: 'semester',
                    label: 'Semester',
                    sortable :true,
                },
                {
                    key: 'nama',
                    label: 'Nama',
                    sortable :true,
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

            datakelas: [],
            // datamahasiswa: [],
            rinciankelas: [],
            allrinciankelas: [],
            datajurusan: [],
            datatahunajaran: [],
            nama: '',
            id: '',
            semester: '',
            id_tahun_ajaran: '',
            id_jurusan: '',
            mahasiswa: [],
            editnama: '',
            editid: '',
            editsemester: '',
            editid_tahun_ajaran: '',
            editid_jurusan: '',
            editmahasiswa: [],
            kelasid: "",
            mahasiswaid: ""


        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
            this.modalLoad();

        },

        methods: {
            flash: function (type, message) {
                if (type == "success") {
                    toastr.success(message);
                } else if (type == "error") {
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
            create: function () {
                // console.log(this.nama)
                axios.post('/kelas', {
                    nama: this.nama,
                    semester: this.semester,
                    id_jurusan: this.id_jurusan,
                    id_tahun_ajaran: this.id_tahun_ajaran,
                    mahasiswa: this.mahasiswa
                    // _method: 'put'
                })
                    .then(function (response) {
                        // handle success
                        console.log(response);
                        vm.nama = "";
                        vm.semester = "";
                        vm.id_tahun_ajaran = "";
                        vm.id_jurusan = "";
                        vm.all();

                        $('#modaltambah').modal('hide');
                        vm.flash(response.data.type, response.data.message);

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
            edit: function (id) {
                // console.log(this.nama)
                axios.get('/kelas/' + id)
                    .then(function (response) {
                        // handle success
                        // console.log(response);
                        vm.editnama = response.data[0]['nama'];
                        vm.editsemester = response.data[0]['semester'];
                        vm.editid_tahun_ajaran = response.data[0]['id_tahun_ajaran'];
                        vm.editid_jurusan = response.data[0]['id_jurusan'];
                        vm.editmahasiswa = response.data[0]['mahasiswa'];
                        vm.editid = id;

                    })
                    .catch(function (error) {
                        // handle error
                        $("#pesan").text("Ada kesalahan");
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
                $("#modaledit").modal('show');
            },
            update: function () {
                // console.log(this.nama)
                axios.put('/kelas/' + this.editid, {
                    nama: this.editnama,
                    semester: this.editsemester,
                    id_jurusan: this.editid_jurusan,
                    id_tahun_ajaran: this.editid_tahun_ajaran,
                    mahasiswa: this.editmahasiswa
                    // _method: 'put'
                })
                    .then(function (response) {
                        // handle success
                        // console.log(response);

                        $('#modaledit').modal('hide');
                        vm.all();
                        vm.flash(response.data.type, response.data.message);

                        vm.editnama = "";
                        vm.editsemester = "";
                        vm.editid_tahun_ajaran = "";
                        vm.editid_jurusan = "";
                        vm.editid = "";
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

            all: function () {
                axios.get('/kelas/all/')
                    .then(function (response) {
                        // handle success
                        vm.datakelas = response.data;
                        vm.totalRows = vm.datakelas.length;
                        vm.allJurusan();
                        vm.allTahunAjaran();

                        // vm.allMahasiswa();
                        // console.log(vm.allJurusan());
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                        vm.isBusy=false;
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
                axios.get('/kelas/allrinciankelas/' + id)
                    .then(function (response) {
                        // console.log(response.data);
                        // if (response.data != null) {
                        vm.allrinciankelas = response.data;
                        // console.log(vm.allrinciankelas);

                        // } else {
                        //     vm.allrinciankelas = [];
                        // }

                    }).catch(function (error) {
                    console.log(error);
                }).then(function () {

                });

            },
            lihatRincian: function (id) {
                axios.get('/kelas/' + id)
                    .then(function (response) {
                        // vm.id = response.data[0]['id'];

                        vm.rinciankelas = response.data;
                        console.log(vm.rinciankelas[0]['mahasiswa'].length);
                        if (vm.rinciankelas[0]['mahasiswa'].length != 0) {

                            vm.allRincianKelas(id);
                        }

                        $("#modalRincian").modal('show');

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
            }, hapus: function () {
                axios.delete('/kelas/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editnama = '';
                        vm.editid = '';
                        $("#modalhapus").modal('hide');
                        console.log(response.data.type, response.data.message);
                        vm.flash(response.data.type, response.data.message);


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
                axios.get("/kelas/" + id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data[0]['nama'];
                        vm.editid = id;
                        // console.log(response.data);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
                $("#modalhapus").modal('show');
            },
            hapusmodal: function (kelasid, mahasiswaid) {
                $("#hapusmodal").modal('show');
                $("#modalRincian").css('z-index', 1039);
                axios.get("/mahasiswa/get/" + mahasiswaid)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data['data'][0]['nama'];
                        vm.editid = kelasid;
                        vm.mahasiswaid = mahasiswaid;

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
            hapusmahasiswa: function () {
                axios.delete("/kelas/hapusmahasiswa", {
                    data: {
                        id: this.editid,
                        mahasiswaid: this.mahasiswaid
                    }
                })
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.all();

                        vm.lihatRincian(vm.editid);
                        vm.editnama = "";
                        vm.mahasiswaid = "";
                        vm.editid = "";
                        vm.flash(response.data.type, response.data.message);

                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
                $("#hapusmodal").modal('hide');

            },
            onFiltered: function (filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }

        },
        computed:{
            showingData() {
                this.sampai = this.currentPage * this.perPage;
                if (this.totalRows != 0) {
                    this.tampil = (this.currentPage * this.perPage + 1) - this.perPage;
                }else{
                    this.tampil =0;
                }
                if (this.totalRows < this.sampai) {
                    this.sampai = this.totalRows;
                }
                this.showData = "Menampilkan " + (this.tampil) + " sampai " + (this.sampai) + " dari " + this.totalRows + " data";
                return this.showData;
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

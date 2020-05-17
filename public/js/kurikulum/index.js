/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datakurikulum : [],
            datajurusan : [],
            datatahunajaran : [],
            rincianmatkul: [],
            allrincianmatkul: [],
            nama : '',
            aturan_lulus : '',
            aturan_wajib : '',
            aturan_pilihan : '',
            matakuliah : [],
            id_jurusan : '',
            id_tahun_ajaran : '',
            editnama : '',
            editaturan_lulus : '',
            editaturan_wajib : '',
            editaturan_pilihan : '',
            editid_jurusan : '',
            editid_tahun_ajaran : '',
            editid : '',
            updated_by : '',
            created_by : '',
            search :'',
            search5 :'',
            namamodal : '',
            list: [],
            filter: '',
            fields: [
                {
                    key: 'index',
                    label: 'No'
                },
                {
                    key: 'nama',
                    label: 'Nama',
                    sortable: true,
                },
                {
                    key: 'get_jurusan.nama',
                    label: 'Program Studi',
                    sortable: true,
                },
                {
                    key: 'get_tahun_ajaran.tahun_ajaran',
                    label: 'Mulai Berlaku',
                    sortable: true,
                },
                {
                    key: 'aturanjumlahsks',
                    label: 'Aturan Jumlah SKS\n(Lulus-Wajib-Pilihan)',
                    sortable: true,
                },
                {
                    key: 'aksi',
                    label: 'Aksi',
                },
            ],

            perPage: 10,
            pageOptions: [10, 15, 20],
            totalRows: 1,
            currentPage: 1,
            fields2: [
                {
                    key: 'index',
                    label: 'No'
                },
                {
                    key: 'kode',
                    label: 'Kode MK',
                    sortable: true,
                },
                {
                    key: 'nama',
                    label: 'Nama',
                    sortable: true,
                },
                {
                    key: 'bobot',
                    label: 'Bobot',
                    sortable: true,
                },
                {
                    key: 'jenis',
                    label: 'Jenis',
                    sortable: true,
                },
                {
                    key: 'aksi',
                    label: 'Aksi',
                },
            ],
            perPage2: 10,
            pageOptions2: [10, 15, 20],
            totalRows2: 1,
            currentPage2: 1,
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            toastr.options = {"closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
            this.all();
            this.allJurusan();
            this.allTahunAjaran();
        },
        methods: {
            create: function () {
                axios.post('/kurikulum/create',{nama : this.nama, aturan_lulus : this.aturan_lulus, aturan_wajib : this.aturan_wajib, aturan_pilihan : this.aturan_pilihan, id_jurusan : this.id_jurusan, id_tahun_ajaran : this.id_tahun_ajaran})
                    .then(function (response) {
                        Command: toastr["success"](response.data.pesan, "Sukses")
                        vm.all();
                        vm.nama = "";
                        vm.aturan_lulus = "";
                        vm.aturan_wajib = "";
                        vm.aturan_pilihan = "";
                        vm.id_jurusan = "";
                        vm.id_tahun_ajaran = "";
                        vm.matakuliah = "";
                        $('#modaltambah').modal('hide');
                    })
                    .catch(function (error) {
                        Command: toastr["error"]("Terjadi Kesalahan", "Error")
                    })
                    .then(function () {
                        // always executed
                    });
            },
            update: function () {
                axios.post('/kurikulum/update/'+this.editid,{nama : this.editnama, aturan_lulus : this.editaturan_lulus, aturan_wajib : this.editaturan_wajib, aturan_pilihan : this.editaturan_pilihan, id_jurusan : this.editid_jurusan, id_tahun_ajaran : this.editid_tahun_ajaran})
                    .then(function (response) {
                        Command: toastr["success"](response.data.pesan, "Sukses")
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editaturan_lulus = "";
                        vm.editaturan_wajib = "";
                        vm.editaturan_pilihan = "";
                        vm.editid_jurusan = "";
                        vm.editid_tahun_ajaran = "";
                        $('#modaledit').modal('hide');
                    })
                    .catch(function (error) {
                        Command: toastr["error"]("Terjadi Kesalahan", "Error")
                    })
                    .then(function () {
                        // always executed
                    });
            },
            hapus: function () {
                axios.delete('/kurikulum/' + this.editid)
                    .then(function (response) {
                        Command: toastr["success"](response.data.pesan, "Sukses")
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        $("#modalhapus").modal('hide');
                    })
                    .catch(function (error) {
                        Command: toastr["error"]("Terjadi Kesalahan", "Error")
                    })
                    .then(function () {
                        // always executed
                    });
            },
            all: function () {
                axios.get('/kurikulum/all')
                    .then(function (response) {
                        // handle success
                        console.log(response);
                        vm.list = response.data;
                        vm.totalRows = vm.list.length;
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            allRincianKelas: function (id) {
                axios.get('/kurikulum/allrincianmatkul/' + id)
                    .then(function (response) {
                        vm.allrincianmatkul = response.data;
                    }).catch(function (error) {
                }).then(function () {

                });

            },
            lihatRincian: function (id) {
                axios.get("/kurikulum/"+id)
                    .then(function (response) {
                        // vm.id = response.data[0]['id'];

                        vm.rincianmatkul = response.data;
                        vm.totalRows2 = vm.rincianmatkul[0]['matakuliah'].length;
                        vm.namamodal = vm.rincianmatkul[0]['nama'] + " - " + vm.rincianmatkul[0]['get_jurusan']['nama'];
                        if (vm.rincianmatkul[0]['matakuliah'].length != 0) {
                            vm.allRincianKelas(id);
                        }

                        $("#modalRincian").modal('show');

                    }).catch(function (error) {

                }).then(function () {


                });

            },
            editRincian: function (id) {
                axios.get('/mata-kuliah/get/' + id)
                    .then(function (response) {
                        vm.editnama = response.data.data[0]['nama'];
                        vm.editid = id;
                    }).catch(function (error) {
                }).then(function () {
                    $("#modalhapus").modal('show');
                });

            },
            allJurusan: function () {
                axios.get('/jurusan/all')
                    .then(function (response) {
                        // handle success
                        vm.datajurusan = response.data;
                    })
                    .catch(function (error) {
                        // handle error
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
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            edit: function (id) {
                axios.get("/kurikulum/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data['data'][0]['nama'];
                        vm.editaturan_lulus = response.data['data'][0]['aturan_lulus'];
                        vm.editaturan_wajib = response.data['data'][0]['aturan_wajib'];
                        vm.editaturan_pilihan = response.data['data'][0]['aturan_pilihan'];
                        vm.editid_jurusan = response.data['data'][0]['id_jurusan'];
                        vm.editid_tahun_ajaran = response.data['data'][0]['id_tahun_ajaran'];
                        vm.editid = id;
                        vm.updated_by = response.data['updatedby'];
                        vm.created_by = response.data['createdby'];
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
                $("#modaledit").modal('show');
            },
            hapusdata: function (id) {
                axios.get("/kurikulum/get/"+id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data['data'][0]['nama'];
                        vm.editid = id;
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
                $("#modalhapus").modal('show');
            }
        },
        computed: {
            filteredItems() {
                return this.list.filter(kurikulum => {
                    return (kurikulum.nama.toLowerCase().indexOf(this.search.toLowerCase()) > -1)
                })
            },
            filteredItems2() {
                return this.allrincianmatkul.filter(rincian => {
                    return (rincian.nama.toLowerCase().indexOf(this.search5.toLowerCase()) > -1)
                })
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

/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datamahasiswa : [],
            datajurusan : [],
            nama : '',
            nim : '',
            nik : '',
            rincian: [],
            rinciannama: '',
            rinciannim: '',
            rinciannik: '',
            rincianjurusan: '',
            rincianjenisdaftar: '',
            rincianjeniskelamin: '',
            rinciantempattanggallahir: '',
            rincianagama: '',
            rincianalamat: '',
            allrincian: [],
            id_jurusan : '',
            jenis_pendaftaran : '',
            jenis_kelamin : '',
            tempat_lahir : '',
            tanggal_lahir : '',
            agama : '',
            alamat : '',
            editnama : '',
            editnim : '',
            editnik : '',
            editid_jurusan : '',
            editjenis_pendaftaran : '',
            editjenis_kelamin : '',
            edittempat_lahir : '',
            edittanggal_lahir : '',
            editagama : '',
            editalamat : '',
            editid : '',
            idmodal : '',
            updated_by : '',
            created_by : '',
            search :'',
            search2 :'',
            search3 :'',
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
                    key: 'nomor_induk',
                    label: 'NIM',
                    sortable: true,
                },
                {
                    key: 'get_jurusan.nama',
                    label: 'Program Studi',
                    sortable: true,
                },
                {
                    key: 'jenis_kelamin',
                    label: 'Jenis Kelamin',
                    sortable: true,
                },
                {
                    key: 'tempattanggal',
                    label: 'Tempat,Tanggal Lahir',
                    sortable: true,
                },
                {
                    key: 'agama',
                    label: 'Agama',
                    sortable: true,
                },
                {
                    key: 'aksi',
                    label: 'Aksi',
                },
            ],
            perPage: 10,
            pageOptions: [10, 15, 20, 30, 50, 100],
            totalRows: 1,
            currentPage: 1,
            fields2: [
                {
                    key: 'semester',
                    label: 'Semester',
                    sortable: true,
                },
                {
                    key: 'status',
                    label: 'Status Mahasiswa',
                    sortable: true,
                },
            ],
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            toastr.options = {"closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
            this.all();
            this.allJurusan();
        },
        methods: {
            create: function () {
                axios.post('/mahasiswa/create',{nama : this.nama, nomor_induk : this.nim, id_jurusan : this.id_jurusan, jenis_pendaftaran : this.jenis_pendaftaran, jenis_kelamin : this.jenis_kelamin, tempat_lahir : this.tempat_lahir, tanggal_lahir : this.tanggal_lahir, agama : this.agama, nomor_induk_kependudukan : this.nik, alamat : this.alamat})
                    .then(function (response) {
                        if (response.data.pesan == 'Data sudah ada'){
                            Command: toastr["warning"](response.data.pesan, "Error")
                        }
                        else {
                            Command: toastr["success"](response.data.pesan, "Sukses")
                            vm.all();
                            vm.nama = "";
                            vm.nim = "";
                            vm.nik = "";
                            vm.id_jurusan = "";
                            vm.jenis_pendaftaran = "";
                            vm.jenis_kelamin = "";
                            vm.tempat_lahir = "";
                            vm.tanggal_lahir = "";
                            vm.agama = "";
                            vm.alamat = "";
                            $('#modaltambah').modal('hide');
                        }
                    })
                    .catch(function (error) {
                        Command: toastr["error"]("Terjadi Kesalahan", "Error")
                    })
                    .then(function () {
                        // always executed
                    });
            },
            update: function () {
                axios.post('/mahasiswa/update/'+this.editid,{nama : this.editnama, nomor_induk : this.editnim, id_jurusan : this.editid_jurusan, jenis_pendaftaran : this.editjenis_pendaftaran, jenis_kelamin : this.editjenis_kelamin, tempat_lahir : this.edittempat_lahir, tanggal_lahir : this.edittanggal_lahir, agama : this.editagama, nomor_induk_kependudukan : this.editnik, alamat : this.editalamat})
                    .then(function (response) {
                        Command: toastr["success"](response.data.pesan, "Sukses")
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editnim = "";
                        vm.editnik = "";
                        vm.editid_jurusan = "";
                        vm.editjenis_pendaftaran = "";
                        vm.editjenis_kelamin = "";
                        vm.edittempat_lahir = "";
                        vm.edittanggal_lahir = "";
                        vm.editagama = "";
                        vm.editalamat = "";
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
                axios.delete('/mahasiswa/' + this.editid)
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
                axios.get('/mahasiswa/all')
                    .then(function (response) {
                        // handle success
                        vm.list = response.data;
                        for (var i = 0; i < vm.list.length; i++){
                            vm.list[i]['tanggal_lahir'] = moment(vm.list[i]['tanggal_lahir'], 'YYYY-MM-DD').format('DD/MM/YYYY');
                        }
                        vm.totalRows = vm.list.length;
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
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
            allRincian: function (id) {
                axios.get('/mahasiswa/allrincian/' + id)
                    .then(function (response) {
                        vm.allrincian = response.data;
                    }).catch(function (error) {
                }).then(function () {

                });

            },
            lihatRincian: function (id) {
                axios.get("/mahasiswa/"+id)
                    .then(function (response) {
                        vm.idmodal = id;
                        vm.allrincian = [];
                        vm.rincian = response.data;
                        vm.rinciannama = vm.rincian[0]['nama'];
                        vm.rinciannim = vm.rincian[0]['nomor_induk'];
                        vm.rinciannik = vm.rincian[0]['nomor_induk_kependudukan'];
                        vm.rincianjurusan = vm.rincian[0]['get_jurusan']['nama'];
                        vm.rincianjenisdaftar = vm.rincian[0]['jenis_pendaftaran'];
                        vm.rincianjeniskelamin = vm.rincian[0]['jenis_kelamin'];
                        vm.rincian[0]['tanggal_lahir'] = moment(vm.rincian[0]['tanggal_lahir'], 'YYYY-MM-DD').format('DD/MM/YYYY');
                        vm.rinciantempattanggallahir = vm.rincian[0]['tempat_lahir'] + ", " + vm.rincian[0]['tanggal_lahir'];
                        vm.rincianagama = vm.rincian[0]['agama'];
                        vm.rincianalamat = vm.rincian[0]['alamat'];
                        if (vm.rincian[0]['status_aktif'].length != 0) {
                            vm.allRincian(id);
                        }
                        $("#modalRincian").modal('show');

                    }).catch(function (error) {

                }).then(function () {


                });

            },
            edit: function (id) {
                axios.get("/mahasiswa/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data['data'][0]['nama'];
                        vm.editnim = response.data['data'][0]['nomor_induk'];
                        vm.editnik = response.data['data'][0]['nomor_induk_kependudukan'];
                        vm.editid_jurusan = response.data['data'][0]['id_jurusan'];
                        vm.editjenis_pendaftaran = response.data['data'][0]['jenis_pendaftaran'];
                        vm.editjenis_kelamin = response.data['data'][0]['jenis_kelamin'];
                        vm.edittempat_lahir = response.data['data'][0]['tempat_lahir'];
                        vm.edittanggal_lahir = response.data['data'][0]['tanggal_lahir'];
                        vm.editagama = response.data['data'][0]['agama'];
                        vm.editalamat = response.data['data'][0]['alamat'];
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
                axios.get("/mahasiswa/get/"+id)
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
                return this.list.filter(mahasiswa => {
                    return (mahasiswa.get_jurusan.nama.toLowerCase().indexOf(this.search.toLowerCase()) > -1 && mahasiswa.nama.toLowerCase().indexOf(this.search2.toLowerCase()) > -1 && mahasiswa.nomor_induk.toLowerCase().indexOf(this.search3.toLowerCase()) > -1)
                })
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

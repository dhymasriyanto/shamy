/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datadosen : [],
            datajurusan : [],
            nama : '',
            nip : '',
            id_jurusan : '',
            jenis_kelamin : '',
            tempat_lahir : '',
            tanggal_lahir : '',
            agama : '',
            editnama : '',
            editnip : '',
            editid_jurusan : '',
            editjenis_kelamin : '',
            edittempat_lahir : '',
            edittanggal_lahir : '',
            editagama : '',
            editid : '',
            search :'',
            search2 :'',
            list: [],
            filter: '',
            fields: [
                {
                key: 'index',
                label: 'No'
                },
                {
                    key: 'nomor_induk',
                    label: 'NIDN',
                    sortable: true,
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
                    key: 'jenis_kelamin',
                    label: 'Jenis Kelamin',
                    sortable: true,
                },
                {
                    key: 'tempattanggal',
                    label: 'Tempat Lahir',
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
            pageOptions: [10, 15, 20],
            totalRows: 1,
            currentPage: 1,
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
        },
        methods: {
            create: function () {
                axios.post('/dosen/create',{nama : this.nama, nomor_induk : this.nip, id_jurusan : this.id_jurusan, jenis_kelamin : this.jenis_kelamin, tempat_lahir : this.tempat_lahir, tanggal_lahir : this.tanggal_lahir, agama : this.agama})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.nama = "";
                        vm.nip = "";
                        vm.id_jurusan = "";
                        vm.jenis_kelamin = "";
                        vm.tempat_lahir = "";
                        vm.tanggal_lahir = "";
                        vm.agama = "";
                        $('#modaltambah').modal('hide');
                        toastr.options = {
                            "closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["success"]("Data berhasil di tambah", "Sukses")
                    })
                    .catch(function (error) {
                        // handle error
                        toastr.options = {
                            "closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["error"]("Terjadi Kesalahan", "Error")
                    })
                    .then(function () {
                        // always executed
                    });
            },
            update: function () {
                axios.post('/dosen/update/'+this.editid,{nama : this.editnama, nomor_induk : this.editnip, id_jurusan : this.editid_jurusan, jenis_kelamin : this.editjenis_kelamin, tempat_lahir : this.edittempat_lahir, tanggal_lahir : this.edittanggal_lahir, agama : this.editagama})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editnip = "";
                        vm.editid_jurusan = "";
                        vm.editjenis_kelamin = "";
                        vm.edittempat_lahir = "";
                        vm.edittanggal_lahir = "";
                        vm.editagama = "";
                        $('#modaledit').modal('hide');
                        toastr.options = {"closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["success"]("Data berhasil di edit", "Sukses")
                    })
                    .catch(function (error) {
                        // handle error
                        toastr.options = {"closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["error"]("Terjadi Kesalahan", "Error")
                    })
                    .then(function () {
                        // always executed
                    });
            },
            hapus: function () {
                axios.delete('/dosen/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        $("#modalhapus").modal('hide');
                        toastr.options = {"closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["success"]("Data berhasil di hapus", "Sukses")
                    })
                    .catch(function (error) {
                        // handle error
                        toastr.options = {"closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["error"]("Terjadi Kesalahan", "Error")
                    })
                    .then(function () {
                        // always executed
                    });
            },
            all: function () {
                axios.get('/dosen/all')
                    .then(function (response) {
                        // handle success
                        vm.list = response.data;
                        vm.totalRows = vm.list.length;
                        vm.allJurusan();
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
            edit: function (id) {
                axios.get("/dosen/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data[0]['nama'];
                        vm.editnip = response.data[0]['nomor_induk'];
                        vm.editid_jurusan = response.data[0]['id_jurusan'];
                        vm.editjenis_kelamin = response.data[0]['jenis_kelamin'];
                        vm.edittempat_lahir = response.data[0]['tempat_lahir'];
                        vm.edittanggal_lahir = response.data[0]['tanggal_lahir'];
                        vm.editagama = response.data[0]['agama'];
                        vm.editid = id;
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
                axios.get("/dosen/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data[0]['nama'];
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
                return this.list.filter(dosen => {
                    return (dosen.get_jurusan.nama.toLowerCase().indexOf(this.search.toLowerCase()) > -1 && dosen.nama.toLowerCase().indexOf(this.search2.toLowerCase()) > -1)
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

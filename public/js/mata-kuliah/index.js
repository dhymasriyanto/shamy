/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datamatakuliah : [],
            datajurusan : [],
            datakurikulum : [],
            nama : '',
            kode : '',
            singkatan : '',
            id_jurusan : '',
            id_kurikulum : '',
            jenis : '',
            bobot : '',
            editnama : '',
            editkode : '',
            editsingkatan : '',
            editid_jurusan : '',
            editid_kurikulum : '',
            editjenis : '',
            editbobot : '',
            editid : '',
            search :'',
            search2 :'',
            search3 :'',
            search4 :''
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
        },
        methods: {
            create: function () {
                axios.post('/mata-kuliah/create',{nama : this.nama, kode : this.kode, singkatan : this.singkatan, id_jurusan : this.id_jurusan, id_kurikulum : this.id_kurikulum, bobot : this.bobot, jenis : this.jenis})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.nama = "";
                        vm.kode = "";
                        vm.singkatan = "";
                        vm.id_jurusan = "";
                        vm.id_kurikulum = "";
                        vm.bobot = "";
                        vm.jenis = "";
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
                axios.post('/mata-kuliah/update/'+this.editid,{nama : this.editnama, kode : this.editkode, singkatan : this.editsingkatan, id_jurusan : this.editid_jurusan, id_kurikulum : this.editid_kurikulum, bobot : this.editbobot, jenis : this.editjenis})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editkode = "";
                        vm.editsingkatan = "";
                        vm.editid_jurusan = "";
                        vm.editid_kurikulum = "";
                        vm.editbobot = "";
                        vm.editjenis = "";
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
                axios.delete('/mata-kuliah/' + this.editid)
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
                axios.get('/mata-kuliah/all')
                    .then(function (response) {
                        // handle success
                        vm.datamatakuliah = response.data;
                        vm.allDosen();
                        vm.allKurikulum();
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            allDosen: function () {
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
            allKurikulum: function () {
                axios.get('/kurikulum/all')
                    .then(function (response) {
                        // handle success
                        vm.datakurikulum = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            edit: function (id) {
                axios.get("/mata-kuliah/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data[0]['nama'];
                        vm.editkode = response.data[0]['kode'];
                        vm.editsingkatan = response.data[0]['singkatan'];
                        vm.editid_jurusan = response.data[0]['id_jurusan'];
                        vm.editid_kurikulum = response.data[0]['id_kurikulum'];
                        vm.editbobot = response.data[0]['bobot'];
                        vm.editjenis = response.data[0]['jenis'];
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
                axios.get("/mata-kuliah/get/"+id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
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
                return this.datamatakuliah.filter(matakuliah => {
                    return (matakuliah.get_jurusan.nama.toLowerCase().indexOf(this.search.toLowerCase()) > -1 && matakuliah.nama.toLowerCase().indexOf(this.search2.toLowerCase()) > -1 && matakuliah.bobot.toString().indexOf(this.search3) > -1 && matakuliah.jenis.toLowerCase().indexOf(this.search4.toLowerCase()) > -1)
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

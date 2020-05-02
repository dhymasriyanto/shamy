/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datafakultas : [],
            nama : '',
            singkatan : '',
            editnama : '',
            editsingkatan : '',
            editid : '',
            search :'',
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
                    key: 'singkatan',
                    label: 'Singkatan',
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
                axios.post('/fakultas/create',{nama : this.nama, singkatan : this.singkatan})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.nama = "";
                        vm.singkatan = "";
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
                axios.post('/fakultas/update/'+this.editid,{nama : this.editnama, singkatan : this.editsingkatan})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editsingkatan = "";
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
                axios.delete('/fakultas/' + this.editid)
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
                axios.get('/fakultas/all')
                    .then(function (response) {
                        // handle success
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
            edit: function (id) {
                axios.get("/fakultas/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data[0]['nama'];
                        vm.editsingkatan = response.data[0]['singkatan'];
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
                axios.get("/fakultas/get/"+id)
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
                return this.list.filter(fakultas => {
                    return (fakultas.nama.toLowerCase().indexOf(this.search.toLowerCase()) > -1)
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

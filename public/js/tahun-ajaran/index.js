/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datatahunajaran : [],
            tahun_ajaran : '',
            edittahun_ajaran : '',
            editid : '',
            updated_by : '',
            created_by : '',
            search :'',
            list: [],
            filter: '',
            fields: [
                {
                    key: 'index',
                    label: 'No'
                },
                {
                    key: 'tahun_ajaran',
                    label: 'Tahun Ajaran',
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
            toastr.options = {"closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
            this.all();
        },
        methods: {
            create: function () {
                axios.post('/tahun-ajaran/create',{tahun_ajaran : this.tahun_ajaran})
                    .then(function (response) {
                        Command: toastr["success"](response.data.pesan, "Sukses")
                        vm.all();
                        vm.tahun_ajaran = "";
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
                axios.post('/tahun-ajaran/update/'+this.editid,{tahun_ajaran : this.edittahun_ajaran})
                    .then(function (response) {
                        Command: toastr["success"](response.data.pesan, "Sukses")
                        vm.all();
                        vm.editid = "";
                        vm.edittahun_ajaran = "";
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
                axios.delete('/tahun-ajaran/' + this.editid)
                    .then(function (response) {
                        Command: toastr["success"](response.data.pesan, "Sukses")
                        vm.all();
                        vm.editid = "";
                        vm.edittahun_ajaran = "";
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
                axios.get('/tahun-ajaran/all')
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
                axios.get("/tahun-ajaran/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.edittahun_ajaran = response.data['data'][0]['tahun_ajaran'];
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
                axios.get("/tahun-ajaran/get/"+id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.edittahun_ajaran = response.data['data'][0]['tahun_ajaran'];
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
                return this.list.filter(tahunajaran => {
                    return (tahunajaran.tahun_ajaran.toLowerCase().indexOf(this.search.toLowerCase()) > -1)
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

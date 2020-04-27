/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datapegawai : [],
            nama : '',
            editnama : '',
            editid : ''
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
        },
        methods: {
            create: function () {
                axios.post('/pegawai/create',{nama : this.nama})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.nama = "";
                        $('#modaltambah').modal('hide');
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            update: function () {
                axios.post('/pegawai/update/'+this.editid,{nama : this.editnama})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        $('#modaledit').modal('hide');
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            hapus: function () {
                axios.delete('/pegawai/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        $("#modalhapus").modal('hide');
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            all: function () {
                axios.get('/pegawai/all')
                    .then(function (response) {
                        // handle success
                        vm.datapegawai = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            edit: function (id) {
                axios.get("/pegawai/get/"+id)
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
                $("#modaledit").modal('show');
            },
            hapusdata: function (id) {
                axios.get("/pegawai/get/"+id)
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

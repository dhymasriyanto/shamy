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
                axios.post('/fakultas/create',{nama : this.nama, singkatan : this.singkatan})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.nama = "";
                        vm.singkatan = "";
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
                axios.post('/fakultas/update/'+this.editid,{nama : this.editnama, singkatan : this.editsingkatan})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editsingkatan = "";
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
                axios.delete('/fakultas/' + this.editid)
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
                axios.get('/fakultas/all')
                    .then(function (response) {
                        // handle success
                        vm.datafakultas = response.data;
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

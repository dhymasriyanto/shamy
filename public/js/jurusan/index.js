/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datajurusan : [],
            datafakultas : [],
            nama : '',
            kode : '',
            singkatan : '',
            id_fakultas : '',
            editnama : '',
            editkode : '',
            editsingkatan : '',
            editid_fakultas : '',
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
                axios.post('/jurusan/create',{nama : this.nama, kode : this.kode, singkatan : this.singkatan, id_fakultas : this.id_fakultas})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.nama = "";
                        vm.kode = "";
                        vm.singkatan = "";
                        vm.id_fakultas = "";
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
                axios.post('/jurusan/update/'+this.editid,{nama : this.editnama, kode : this.editkode, singkatan : this.editsingkatan, id_fakultas : this.editid_fakultas})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editkode = "";
                        vm.editsingkatan = "";
                        vm.editid_fakultas = "";
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
                axios.delete('/jurusan/' + this.editid)
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
                axios.get('/jurusan/all')
                    .then(function (response) {
                        // handle success
                        vm.datajurusan = response.data;
                        vm.allFakultas();
                    })
                    .catch(function (error) {
                        // handle error
                    })
                    .then(function () {
                        // always executed
                    });
            },
            allFakultas: function () {
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
                axios.get("/jurusan/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data[0]['nama'];
                        vm.editkode = response.data[0]['kode'];
                        vm.editsingkatan = response.data[0]['singkatan'];
                        vm.editid_fakultas = response.data[0]['id_fakultas'];
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
                axios.get("/jurusan/get/"+id)
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

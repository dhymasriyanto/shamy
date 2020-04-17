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
                // console.log(this.nama)
                axios.post('/tahun-ajaran/create',{tahun_ajaran : this.tahun_ajaran})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        // console.log(response);
                        vm.tahun_ajaran = "";
                        $('#modaltambah').modal('hide');
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
            update: function () {
                // console.log(this.nama)
                axios.post('/tahun-ajaran/update/'+this.editid,{tahun_ajaran : this.edittahun_ajaran})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        // console.log(response);
                        vm.editid = "";
                        vm.edittahun_ajaran = "";
                        $('#modaledit').modal('hide');
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
            hapus: function () {
                axios.delete('/tahun-ajaran/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        // console.log(response);
                        vm.editid = "";
                        vm.edittahun_ajaran = "";
                        $("#modalhapus").modal('hide');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            all: function () {
                axios.get('/tahun-ajaran/all')
                    .then(function (response) {
                        // handle success
                        vm.datatahunajaran = response.data;
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
            edit: function (id) {
                axios.get("/tahun-ajaran/get/"+id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.edittahun_ajaran = response.data[0]['tahun_ajaran'];
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
                $("#modaledit").modal('show');
            },
            hapusdata: function (id) {
                axios.get("/tahun-ajaran/get/"+id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.edittahun_ajaran = response.data[0]['tahun_ajaran'];
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

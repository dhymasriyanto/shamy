/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datamahasiswa : [],
            nama : '',
            nim : '',
            editnama : '',
            editnim : '',
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
                axios.post('/mahasiswa/create',{nama : this.nama, nomor_induk : this.nim})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        console.log(response);
                        vm.nama = "";
                        vm.nim = "";
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
                axios.post('/mahasiswa/update/'+this.editid,{nama : this.editnama, nomor_induk : this.editnim})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        console.log(response);
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editnim = "";
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
                axios.delete('/mahasiswa/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        console.log(response);
                        vm.editid = "";
                        vm.editnama = "";
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
                axios.get('/mahasiswa/all')
                    .then(function (response) {
                        // handle success
                        vm.datamahasiswa = response.data;
                        console.log(response);
                        // const ayam = response.data;
                        // ayam.forEach(function(element) {
                        //     console.log(element);
                        // });
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
                axios.get("/mahasiswa/get/"+id)
                    .then(function (response) {
                        // handle success
                        vm.editnama = response.data[0]['nama'];
                        vm.editnim = response.data[0]['nomor_induk'];
                        vm.editid = id;
                        console.log(response.data[0]['nama']);
                        console.log(response.data[0]['nomor_induk']);
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
                axios.get("/mahasiswa/get/"+id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.editnama = response.data[0]['nama'];
                        vm.editid = id;
                        console.log(response.data);
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

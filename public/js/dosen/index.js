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
                axios.post('/dosen/create',{nama : this.nama, nomor_induk : this.nip, id_jurusan : this.id_jurusan, jenis_kelamin : this.jenis_kelamin, tempat_lahir : this.tempat_lahir, tanggal_lahir : this.tanggal_lahir, agama : this.agama})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        console.log(response);
                        vm.nama = "";
                        vm.nip = "";
                        vm.id_jurusan = "";
                        vm.jenis_kelamin = "";
                        vm.tempat_lahir = "";
                        vm.tanggal_lahir = "";
                        vm.agama = "";
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
                axios.post('/dosen/update/'+this.editid,{nama : this.editnama, nomor_induk : this.editnip, id_jurusan : this.editid_jurusan, jenis_kelamin : this.editjenis_kelamin, tempat_lahir : this.edittempat_lahir, tanggal_lahir : this.edittanggal_lahir, agama : this.editagama})
                    .then(function (response) {
                        // handle success
                        vm.all();
                        console.log(response);
                        vm.editid = "";
                        vm.editnama = "";
                        vm.editnip = "";
                        vm.editid_jurusan = "";
                        vm.editjenis_kelamin = "";
                        vm.edittempat_lahir = "";
                        vm.edittanggal_lahir = "";
                        vm.editagama = "";
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
                axios.delete('/dosen/' + this.editid)
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
                axios.get('/dosen/all')
                    .then(function (response) {
                        // handle success
                        vm.datadosen = response.data;
                        vm.allJurusan();
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
            allJurusan: function () {
                axios.get('/jurusan/all')
                    .then(function (response) {
                        // handle success
                        vm.datajurusan = response.data;
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
                axios.get("/dosen/get/"+id)
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

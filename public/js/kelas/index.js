/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datakelas: [],
            // datamahasiswa: [],
            rinciankelas: [],
            allrinciankelas: [],
            datajurusan: [],
            datatahunajaran: [],
            nama: '',
            id: '',
            semester: '',
            id_tahun_ajaran: '',
            id_jurusan: '',
            mahasiswa: []


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
                axios.post('/kelas', {
                    nama: this.nama,
                    semester: this.semester,
                    id_jurusan: this.id_jurusan,
                    id_tahun_ajaran: this.id_tahun_ajaran,
                    mahasiswa: this.mahasiswa
                    // _method: 'put'
                })
                    .then(function (response) {
                        // handle success
                        console.log(response);
                        vm.nama = "";
                        vm.semester = "";
                        vm.id_tahun_ajaran = "";
                        vm.id_jurusan = "";
                        vm.all();

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
            edit: function (id) {
                // console.log(this.nama)
                axios.get('/kelas/' + id)
                    .then(function (response) {
                        // handle success
                        // console.log(response);
                        vm.nama = response.data[0]['nama'];
                        vm.semester = response.data[0]['semester'];
                        vm.id_tahun_ajaran = response.data[0]['id_tahun_ajaran'];
                        vm.id_jurusan = response.data[0]['id_jurusan'];
                        vm.mahasiswa = response.data[0]['mahasiswa'];
                        vm.id = id;

                    })
                    .catch(function (error) {
                        // handle error
                        $("#pesan").text("Ada kesalahan");
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
                $("#modaledit").modal('show');
            },
            update: function () {
                // console.log(this.nama)
                axios.put('/kelas/' + this.id, {
                    nama: this.nama,
                    semester: this.semester,
                    id_jurusan: this.id_jurusan,
                    id_tahun_ajaran: this.id_tahun_ajaran,
                    mahasiswa: this.mahasiswa
                    // _method: 'put'
                })
                    .then(function (response) {
                        // handle success
                        // console.log(response);

                        $('#modaledit').modal('hide');
                        vm.all();
                        vm.nama = "";
                        vm.semester = "";
                        vm.id_tahun_ajaran = "";
                        vm.id_jurusan = "";
                        vm.id = "";
                        vm.mahasiswa = [];

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
                axios.delete('/kelas/' + this.id)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.nama = '';
                        vm.id = '';
                        $("#modalhapus").modal('hide');

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
            all: function () {
                axios.get('/kelas/all/')
                    .then(function (response) {
                        // handle success
                        vm.datakelas = response.data;
                        vm.allJurusan();
                        vm.allTahunAjaran();

                        // vm.allMahasiswa();
                        // console.log(vm.allJurusan());
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            // allMahasiswa: function () {
            //     axios.get('/kelas/allmahasiswa')
            //         .then(function (response) {
            //             vm.datamahasiswa = response.data;
            //         }).catch(function (error) {
            //         console.log(error);
            //     }).then(function () {
            //
            //     });
            //
            // },
            allRincianKelas: function (id) {
                axios.get('/kelas/allrinciankelas/' + id)
                    .then(function (response) {
                        // console.log(response.data);
                        // if (response.data != null) {
                        vm.allrinciankelas = response.data;
                        // console.log(vm.allrinciankelas);

                        // } else {
                        //     vm.allrinciankelas = [];
                        // }

                    }).catch(function (error) {
                    console.log(error);
                }).then(function () {

                });

            },
            lihatRincian: function (id) {
                axios.get('/kelas/' + id)
                    .then(function (response) {
                        // vm.id = response.data[0]['id'];

                        vm.rinciankelas = response.data;
                        console.log(vm.rinciankelas[0]['mahasiswa'].length);
                        if (vm.rinciankelas[0]['mahasiswa'].length != 0) {

                            vm.allRincianKelas(id);
                        }

                        $("#modalRincian").modal('show');

                    }).catch(function (error) {

                }).then(function () {


                });

            },
            allJurusan: function () {
                axios.get('/jurusan/all')
                    .then(function (response) {
                        // handle success
                        vm.datajurusan = response.data;
                        // console.log(response);
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
            allTahunAjaran: function () {
                axios.get('/tahun-ajaran/all')
                    .then(function (response) {
                        // handle success
                        vm.datatahunajaran = response.data;
                        // console.log(response);
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
            hapusdata: function (id) {
                axios.get("/kelas/" + id)
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.nama = response.data[0]['nama'];
                        vm.id = id;
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
            },
            hapusmahasiswa: function (kelasid, mahasiswaid) {
                axios.delete("/kelas/hapusmahasiswa",{
                    data :{
                        id: kelasid,
                        mahasiswaid : mahasiswaid
                    }
                })
                    .then(function (response) {
                        // handle success
                        // this.editnama = response.data;
                        vm.all();

                            vm.lihatRincian(kelasid);

                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },

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

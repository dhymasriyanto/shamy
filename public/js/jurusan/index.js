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
            editid : '',
            search :'',
            comments : []
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
                        toastr.options = {
                            "closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["success"]("Data berhasil di edit", "Sukses")
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
            hapus: function () {
                axios.delete('/jurusan/' + this.editid)
                    .then(function (response) {
                        // handle success
                        vm.all();
                        vm.editid = "";
                        vm.editnama = "";
                        $("#modalhapus").modal('hide');
                        toastr.options = {
                            "closeButton": true, "debug": false, "newestOnTop": true, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
                        }
                        Command: toastr["success"]("Data berhasil di hapus", "Sukses")
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
            all: function () {
                axios.get('/jurusan/all')
                    .then(function (response) {
                        // handle success
                        vm.comments = response.data;
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
        computed: {
            filteredComments: function () {
                let self = this
                let search = self.search.toLowerCase()
                return self.comments.filter(function (comments) {
                    return  comments.name.toLowerCase().indexOf(search) !== -1 ||
                        comments.email.toLowerCase().indexOf(search) !== -1 ||
                        comments.body.toLowerCase().indexOf(search) !== -1
                })
            }
        },
        components: {}
    });
    $('.app-placeholder').addClass('d-none');
    $('.main_content_app').removeClass('d-none');
}

Vue.component('data-table', {
    render: function (createElement) {
        return createElement(
            "table", {
                "id": "datatable",
                "class": ["table", "table-bordered", "dt-responsive", "nowrap", "dataTable", "no-footer", "dtr-inline", "collapsed"],
                "role": "grid"
            }, []
        )
    },
    props: ['comments'],
    data() {
        return {
            headers: [
                { title: 'No' },
                { title: 'Nama' },
                { title: 'Kode' },
                { title: 'Fakultas' },
                { title: 'Singkatan' },
                { title: 'Aksi' },
            ],
            rows: [] ,
            dtHandle: null
        }
    },
    watch: {
        comments(val, oldVal) {
            let vm2 = this;
            vm2.rows = [];
            var nomor = 0;
            val.forEach(function (item) {
                let row = [];
                row.push(nomor += 1);
                row.push(item.nama);
                row.push(item.kode);
                row.push(item.get_fakultas.nama);
                row.push(item.singkatan);
                row.push('<button type="button" @click.native="edit(1)" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit mr-1" ></i>Edit</button>');
                vm2.rows.push(row);
            });
            vm2.dtHandle.clear();
            vm2.dtHandle.rows.add(vm2.rows);
            vm2.dtHandle.draw();
        }
    },
    mounted() {
        let vm2 = this;
        vm2.dtHandle = $(this.$el).DataTable({
            columns: vm2.headers,
            data: vm2.rows,
            searching: true,
            paging: true,
            info: false
        });
    }
});

try {
    initVue();
} catch (e) {
    window.location.reload();
}

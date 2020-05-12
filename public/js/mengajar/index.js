/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            sampai: 0,
            tampil: 0,
            filter: '',
            perPage: 10,
            currentPage: 1,
            pageOptions: [10, 15, 20],
            showData: '',
            totalRows: 0,
            fields: [
                {
                    key: 'no',
                    sortable: false,
                    // sortByFormatted : true
                },
                {
                    key: 'get_jurusan',
                    label: 'Nama Jurusan',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_kelas',
                    label: 'Nama Kelas',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_dosen',
                    label: 'Nama Dosen',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_mata_kuliah',
                    label: 'Nama Mata Kuliah',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_tahun_ajaran',
                    label: 'Nama Tahun Ajaran',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'created_at',
                    label: 'Dibuat Tanggal',
                    sortable: true
                },
                {
                    key: 'aksi',
                    sortable: false,
                    // sortByFormatted : true

                }
            ],
            isBusy: true,
            datamengajar: [],

        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
        },
        methods: {
            hapus: function (id) {
                axios.delete('/mengajar/' + id)
                    .then(function (response) {
                        // handle success
                        vm.all();
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
            all: function () {
                axios.get('/mengajar/all')
                    .then(function (response) {
                        // handle success
                        vm.datamengajar = response.data;
                        vm.totalRows = vm.datamengajar.length;
                        // vm.items = response.data;
                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                        vm.isBusy = false;

                    });
            },
            onFiltered: function (filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }

        },
        computed: {
            showingData() {
                this.sampai = this.currentPage * this.perPage;
                if (this.totalRows != 0) {
                    this.tampil = (this.currentPage * this.perPage + 1) - this.perPage;
                }else{
                    this.tampil =0;
                }
                if (this.totalRows < this.sampai) {
                    this.sampai = this.totalRows;
                }
                this.showData = "Menampilkan " + (this.tampil) + " sampai " + (this.sampai) + " dari " + this.totalRows + " data";
                return this.showData;
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

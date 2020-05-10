/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            keyword:'',
            perPage:10,
            currentPage:1,
            pageOptions: [10, 15, 20],
            showData:'',
            fields: [
                {
                    key: 'no',
                    sortable: false,
                    // sortByFormatted : true
                },
                {
                    key: 'get_jurusan',
                    label : 'Nama Jurusan',
                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_kelas',
                    label : 'Nama Kelas',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_dosen',
                    label : 'Nama Dosen',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_mata_kuliah',
                    label : 'Nama Mata Kuliah',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key: 'get_tahun_ajaran',
                    label : 'Nama Tahun Ajaran',

                    sortable: true,
                    // sortByFormatted : true

                },
                {
                    key:'created_at',
                    label:'Dibuat Tanggal',
                    sortable:true
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

        },
        computed: {
            showingData(){
                this.showData = "Menampilkan " + ((this.currentPage*this.perPage+1)-this.perPage) + " sampai " + (this.currentPage*this.perPage) + " dari " + this.datamengajar.length;
                return this.showData;
            },
            rows() {
                return this.datamengajar.length
            },
            items () {
                return this.keyword
                    ? this.datamengajar.filter(item => item.get_jurusan.nama.toLowerCase().includes(this.keyword) || item.get_kelas.nama.toLowerCase().includes(this.keyword) || item.get_dosen.nama.toLowerCase().includes(this.keyword) || item.get_mata_kuliah.nama.toLowerCase().includes(this.keyword) || item.get_tahun_ajaran.tahun_ajaran.toLowerCase().includes(this.keyword))
                    : this.datamengajar
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

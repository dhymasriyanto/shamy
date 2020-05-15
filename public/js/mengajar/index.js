/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            selected:null,
            sampai: 0,
            tampil: 0,
            filter: '',
            perPage: 10,
            currentPage: 1,
            pageOptions: [10, 15, 20],
            showData: '',
            totalRows: 0,
            isBusy: true,
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

            
            datamengajar: [],
            datajurusan:[],
            datakelas:[],
            datadosen:[],
            datamatakuliah:[],
            datatahunajaran:[],
            id_jurusan:'',
            id_kelas:'',
            id_dosen:'',
            id_matakuliah:'',
            id_tahunajaran:'',
            coba:[]

            
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
                        vm.allJurusan();
                        vm.allKelas();
                        vm.allDosen();
                        vm.allMataKuliah();
                        vm.allTahunAjaran();

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
            allKelas:function(){
                axios.get('/kelas/all')
                .then(function(response){
                    vm.datakelas = response.data;
                }).catch(function(error){
                    console.log(error);
                }).then(function(){

                });
            },
            allDosen:function() {
                axios.get('/dosen/all')
                .then(function(response){
                    vm.datadosen=response.data;
                }).catch(function(error){
                    console.log(error);
                }).then(function(){

                });
            },
            allMataKuliah:function() {
                axios.get('/mata-kuliah/all')
                .then(function(response){
                    vm.datamatakuliah=response.data;
                }).catch(function(error) {
                    console.log(error);
                }).then(function(){

                });
            },
            allTahunAjaran:function(){
                axios.get('/tahun-ajaran/all')
                .then(function(response){
                    vm.datatahunajaran=response.data;
                }).catch(function(error) {
                    console.log(error);
                }).then(function(){

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

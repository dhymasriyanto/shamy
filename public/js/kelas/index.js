/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datakelas: [],
            datamahasiswa: [],


        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
        },
        methods: {
            hapus: function (id) {
                axios.delete('/kelas/' + id)
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
                axios.get('/kelas/all')
                    .then(function (response) {
                        // handle success
                        vm.datakelas = response.data;

                        vm.allMahasiswa();
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
            allMahasiswa: function () {
                axios.get('/kelas/allmahasiswa ')
                    .then(function (response) {
                        vm.datamahasiswa = response.data;
                    }).catch(function (error) {
                    console.log(error);
                }).then(function () {

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

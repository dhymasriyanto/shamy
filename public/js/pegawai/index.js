/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datapegawai : [],
            formData: {
                nama:''
            }
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
        },
        methods: {
            create: function () {
                const formData = new FormData();
                formData.set('nama', 'nama');
                axios.post('/pegawai/create',{nama : 'nama'})
                    .then(function (response) {
                        // handle success
                        // vm.all();
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
            hapus: function (id) {
                axios.delete('/pegawai/' + id)
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
                axios.get('/pegawai/all')
                    .then(function (response) {
                        // handle success
                        vm.datapegawai = response.data;
                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
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

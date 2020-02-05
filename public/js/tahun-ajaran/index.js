/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datatahunajaran : []
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.all();
        },
        methods: {
            hapus: function (id) {
                axios.delete('/tahun-ajaran/' + id)
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
                axios.get('/tahun-ajaran/all')
                    .then(function (response) {
                        // handle success
                        vm.datatahunajaran= response.data;
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

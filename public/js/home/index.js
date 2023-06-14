/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        data: {
            datakelas: [],
            datamengajar: [],
            kelaskosong: []

        },
        mounted: function() {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            this.allKelas();
            this.allAktaAjar()
        },
        methods: {
            allKelas: function() {
                axios.get('kelas/all')
                    .then(function(response) {
                        // console.log(response.data);
                        vm.datakelas = response.data;
                        var j = 0;
                        for (var i = 0; i < vm.datakelas.length; i++) {
                            if (vm.datakelas[i].mahasiswa == '') {
                                vm.kelaskosong[j] = vm.datakelas[i]
                                j++;
                            }
                        }

                    })
                    .catch(function(error) {

                    })
                    .then(function() {

                    });
            },
            allAktaAjar: function() {
                axios.get('mengajar/all')
                    .then(function(response) {
                        // console.log(response.data);
                        vm.datamengajar = response.data;
                        // console.log("test"+vm.datakelas.length);
                    })
                    .catch(function(error) {

                    })
                    .then(function() {

                    });
            }
        },
        components: {

        }
    });
    $('.app-placeholder').addClass('d-none');
    $('.main_content_app').removeClass('d-none');
}
try {
    initVue();
} catch (e) {
    window.location.reload();
}
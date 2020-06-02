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
            isBusy: true,
            fields: [],
            datanilai: [],



        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            // this.start();
            // this.all();

        },
        methods: {
            start: function () {
                this.$Progress.start()
            },
            set: function (num) {
                this.$Progress.set(num)
            },
            increase: function (num) {
                this.$Progress.increase(num)
            },
            decrease: function (num) {
                this.$Progress.decrease(num)
            },
            finish: function (type, message) {
                this.$Progress.finish();
                if (type && message)
                    this.flash(type, message);
            },
            fail: function () {
                this.$Progress.fail()
            },
            flash: function (type, message) {
                if (type == "success") {
                    toastr.success(message);
                } else if (type == "error") {
                    toastr.error(message);
                } else if (type == "warning") {
                    toastr.warning(message);
                } else {
                    toastr.error("Ada kesalahan!")
                }
            },
            // checkFormValidity: function () {
            //     const valid = this.$refs.form.checkValidity()
            //     this.id_jurusan = valid
            //     // console.log(valid)
            //     return valid
            // },
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            resetModal: function () {
                // this.name = ''
                // this.nameState = null


            },
            handleOk: function (bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit();
            },
            handleSubmit: async function () {
                // Exit when the form isn't valid
                // if (!this.checkFormValidity()) {
                //     return
                // }

                    const isValid = await this.$refs.observer.validate();
                    if (!isValid) {
                        // ABORT!!
                        return
                    }




                // if (!this.errors) return
                // Push the name to submitted names
                // this.submittedNames.push(this.name)
                // this.create()

                // Hide the modal manually
                this.$nextTick(() => {

                        this.$refs.observer.reset();

                    // this.removeMahasiswa = false;
                    // this.tambahMahasiswa = false;
                })
            },
            onChange: function () {


                // this.$emit('input', value);
            },


            all: function () {
                axios.get('/nilai/all')
                    .then(function (response) {
                        vm.datanilai = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
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
                } else {
                    this.tampil = 0;
                }
                if (this.totalRows < this.sampai) {
                    this.sampai = this.totalRows;
                }
                this.showData = "Menampilkan " + (this.tampil) + " sampai " + (this.sampai) + " dari " + this.totalRows + " data";
                return this.showData;
            },
            selected() {
                return this.value
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

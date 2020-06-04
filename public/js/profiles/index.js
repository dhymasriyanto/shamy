/**
 * init
 */
function initVue() {
    var vm = new Vue({
        el: '#app',
        // props: ['ids'],
        data: {
            // aktip: false,
            profil: [],
            id: '',
            nama: '',
            nomor_induk: '',
            nomor_induk_kependudukan: '',
            jenis_kelamin: '',
            tempat_lahir: '',
            tanggal_lahir: '',
            agama: '',
            alamat: '',
            id_jurusan:'',
            jenis_pendaftaran: '',
            modalShow: false,
            // ids:ids,
        },
        mounted: function () {
            if (typeof pjax !== 'undefined') {
                pjax.refresh();
            }
            // let a = this;
            // this.data=JSON.parse(this.id);
            // console.log(this.ids)
            // this.start();
            // this.set(50);
            // this.finish();
            // datas = JSON.parse(this.data);
            // this.all(datas);

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
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            resetModal: function () {
                // this.name = ''
                // this.nameState = null
                // this.modalShow2 = false;
                this.modalShow = false;
                // this.id_mengajar = '';
                // this.nilaikelas = [];
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

                this.update();
                // router.push('profiles.index');
                // this.$router.push('profiles.index');
                // if (!this.errors) return
                // Push the name to submitted names
                // this.submittedNames.push(this.name)
                // this.create()

                // Hide the modal manually
                this.$nextTick(() => {
                    this.$bvModal.hide('modal-profil');

                    this.$refs.observer.reset();
                    // this.modalShow = false;
                    // this.removeMahasiswa = false;
                    // this.tambahMahasiswa = false;
                })
            },
            onChange: function () {

            },
            onContext(ctx) {
                // The date formatted in the locale, or the `label-no-date-selected` string
                this.formatted = ctx.selectedFormatted
                // The following will be an empty string until a valid date is entered
                this.selected = ctx.selectedYMD
            },

            all: function (id) {
                axios.get('/profiles/' + id)
                    .then(function (response) {
                        vm.profil = response.data;
                    })
                    .catch(function (error) {

                    })
                    .then(function () {
                        vm.finish();
                    });
            },

            update: function () {
                this.start();
                axios.post('/mahasiswa/update/'+this.id,{
                    nama : this.nama,
                    nomor_induk : this.nomor_induk,
                    id_jurusan : this.id_jurusan,
                    jenis_pendaftaran : this.jenis_pendaftaran,
                    jenis_kelamin : this.jenis_kelamin,
                    tempat_lahir : this.tempat_lahir,
                    tanggal_lahir : this.tanggal_lahir,
                    agama : this.agama,
                    nomor_induk_kependudukan : this.nomor_induk_kependudukan,
                    alamat : this.alamat
                })
                    .then(function (response) {
                        // Command: toastr["success"](response.data.pesan, "Sukses")
                        // vm.all();
                        // vm.editid = "";
                        // vm.editnama = "";
                        // vm.editnim = "";
                        // vm.editnik = "";
                        // vm.editid_jurusan = "";
                        // vm.editjenis_pendaftaran = "";
                        // vm.editjenis_kelamin = "";
                        // vm.edittempat_lahir = "";
                        // vm.edittanggal_lahir = "";
                        // vm.editagama = "";
                        // vm.editalamat = "";
                        // $('#modal-').modal('hide');
                        // window.location.href = 'profiles';
                        // window.location.href = 'profiles';
                        pjax.loadUrl("/profiles")
                        // window.location.replace('/profiles')
                        // router.push('/profiles')
                        vm.finish("success", response.data.pesan);
                        // vm.aktip = true;

                        // axios.get('/profiles')
                        //     .then(function (response) {
                        //         vm.profil = response.data;
                        //     })
                        //     .catch(function (error) {
                        //
                        //     })
                        //     .then(function () {
                        //         // vm.finish();
                        //     });
                        // this.$router.push('profiles.index');

                    })
                    .catch(function (error) {
                        // Command: toastr["error"]("Terjadi Kesalahan", "Error")
                        // vm.flash();
                    })
                    .then(function () {
                        // always executed
                        // vm.flash();
                    });

            },

            ubah: function (id) {
                this.start();
                axios.get('/profiles/' + id)
                    .then(function (response) {
                        vm.id = id;

                        // window.location.href = '/profiles/'+id+'/edit';
                        vm.nama = response.data['nama'];
                        vm.nomor_induk = response.data['nomor_induk'];
                        vm.nomor_induk_kependudukan = response.data['nomor_induk_kependudukan'];
                        vm.jenis_kelamin = response.data['jenis_kelamin'];
                        vm.tempat_lahir = response.data['tempat_lahir'];
                        vm.tanggal_lahir = response.data['tanggal_lahir'];
                        vm.agama = response.data['agama'];
                        vm.alamat = response.data['alamat'];
                        vm.id_jurusan = response.data['id_jurusan'];
                        vm.jenis_pendaftaran = response.data['jenis_pendaftaran'];

                    })
                    .catch(function (error) {

                    })
                    .then(function () {
                        vm.modalShow = true;
                        vm.finish();
                    });


            }

        },
        computed: {},
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

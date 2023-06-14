<script>
import {
    Bar
} from "vue-chartjs";
export default {
    extends: Bar,
    data() {
        return {
            url: "/jurusan/all/",
            nama: [],
            jumlahMahasiswa: [],
            data: [],
            coloR: [],
            r: '',
            g: '',
            b: ''
        };
    },

    methods: {
        dynamicColors() {
            this.r = Math.floor(Math.random() * 255);
            this.g = Math.floor(Math.random() * 255);
            this.b = Math.floor(Math.random() * 255);
            return "rgb(" + this.r + "," + this.g + "," + this.b + ")";
        },
        getJumlahDosen(id, nama) {
            axios.get('/kelas/getjumlahdosen/' + id).then(response => {
                this.jumlahMahasiswa.push(response.data);
                this.nama.push(nama);
                this.renderChart({
                    labels: this.nama,
                    datasets: [{
                        label: "Jumlah Dosen",
                        backgroundColor: this.coloR,

                        data: this.jumlahMahasiswa
                    }],
                }, {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                stepSize: 1,
                            }
                        }]
                    },
                });
                // console.log(this.jumlahMahasiswa);
            });
        },
        getKelas() {
            axios.get(this.url).then(response => {
                this.data = response.data;

                for (var i in this.data) {
                    this.coloR.push(this.dynamicColors());
                }
                if (this.data) {
                    this.data.forEach(element => {
                        this.getJumlahDosen(element.id, element.singkatan);
                    });
                } else {
                    console.log("TIDAK ADA DATA");
                }
            });
        }
    },
    mounted() {
        this.getKelas();
    }
};
</script>

<script>
import {
    Doughnut
} from "vue-chartjs";
export default {
    extends: Doughnut,
    data() {
        return {
            url: "/kelas/all/",
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
        getKelas() {
            axios.get(this.url).then(response => {
                this.data = response.data;

                for (var i in this.data) {
                    this.coloR.push(this.dynamicColors());
                }
                if (this.data) {
                    // console.log("Data = " + this.data);
                    this.data.forEach(element => {
                        this.nama.push(element.semester + " " + element.nama + " "+ element.get_mata_kuliah.nama +" " + element.get_jurusan.nama );
                        // console.log(this.years);
                        this.jumlahMahasiswa.push(element.mahasiswa.length);
                        // console.log(this.jumlahMahasiswa)
                    });
                    this.renderChart({
                        labels:this.nama,
                        datasets: [{
                            label: "Jumlah Mahasiswa",
                            backgroundColor: this.coloR,
                            data: this.jumlahMahasiswa
                        }],
                    }, {
                        responsive: true,
                        maintainAspectRatio: false
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

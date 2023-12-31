<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 13/01/2020
 * Time: 13:53
 */
?>
<script>
    function closemenu() {
        $("body").removeClass("sidebar-enable");
    }
</script>
<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title">Menu Utama</li>
        <li>
            <a href="{{route('home')}}">
                <i class="mdi mdi-view-dashboard"></i>
                <span> Beranda </span>
            </a>
        </li>
        {{-- @if(\Illuminate\Support\Facades\Auth::user()->role == "administrator") --}}
            <li class="menu-title">Data Master</li>
            <li onclick="closemenu()">
                <a href="{{route('dosen.index')}}">
                    <i class="mdi mdi-account-box-outline"></i>
                    <span> Data Dosen </span>
                </a>
                <a href="{{route('mahasiswa.index')}}">
                    <i class="mdi mdi-account-group"></i>
                    <span> Data Mahasiswa </span>
                </a>
                {{--            <a href="{{route('pegawai.index')}}">--}}
                {{--                <i class="mdi mdi-account-supervisor-circle"></i>--}}
                {{--                <span> Data Pegawai </span>--}}
                {{--            </a>--}}
                <a href="{{route('fakultas.index')}}">
                    <i class="mdi mdi-office-building"></i>
                    <span> Data Fakultas </span>
                </a>
                <a href="{{route('kurikulum.index')}}">
                    <i class="mdi mdi-book-outline"></i>
                    <span> Data Kurikulum </span>
                </a>
                <a href="{{route('tahun-ajaran.index')}}">
                    <i class="mdi mdi-timetable"></i>
                    <span> Data Tahun Ajaran </span>
                </a>
                <a href="{{route('jurusan.index')}}">
                    <i class="mdi mdi-account-check-outline"></i>
                    <span> Data Program Studi </span>
                </a>
                <a href="{{route('mata-kuliah.index')}}">
                    <i class="mdi mdi-book"></i>
                    <span> Data Mata Kuliah </span>
                </a>
            </li>
            <li class="menu-title">Data Transaksional</li>
            <li>
                <a href="{{route('kelas.index')}}">
                    <i class="mdi mdi-table-column"></i>
                    <span> Kelas </span>
                </a>
                <a href="{{route('mengajar.index')}}">
                    <i class="mdi mdi-clipboard-account"></i>
                    <span>Akta Ajar</span>
                </a>
                <a href="{{route('nilai.index')}}">
                    <i class="mdi mdi-file"></i>
                    <span>Nilai</span>
                </a>
            </li>
        {{-- @endif --}}
        {{-- @if(Auth::user()->role == 'mahasiswa') --}}
            <li class="menu-title">Menu Lainnya</li>

            <li>
                {{-- <a href="{{url('kelas/lihatkelas/'.Auth::user()->id_mahasiswa)}}">
                    <i class="mdi mdi-table-column"></i>
                    <span> Kelas </span>
                </a> --}}
                <a href="{{route('mengajar.index')}}">
                    <i class="mdi mdi-clipboard-account"></i>
                    <span>Akta Ajar</span>
                </a>
                {{-- <a href="{{url('nilai/lihatdaftarnilai/'.Auth::user()->id_mahasiswa)}}">
                    <i class="mdi mdi-file"></i>
                    <span>Lihat Nilai</span>
                </a> --}}
            </li>
        {{-- @endif --}}

    </ul>
</div>

<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 13/01/2020
 * Time: 13:53
 */
?>
<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title">Menu Utama</li>
        <li>
            <a href="{{route('home')}}">
                <i class="mdi mdi-view-dashboard"></i>
                <span> Dashboard </span>
            </a>
        </li>
        <li class="menu-title">Data Master</li>
        <li>
            <a href="{{route('dosen.index')}}">
                <i class="mdi mdi-account-box-outline"></i>
                <span> Data Dosen </span>
            </a>
            <a href="{{route('mahasiswa.index')}}">
                <i class="mdi mdi-account-group"></i>
                <span> Data Mahasiswa </span>
            </a>
            <a href="{{route('pegawai.index')}}">
                <i class="mdi mdi-account-supervisor-circle"></i>
                <span> Data Pegawai </span>
            </a>
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
                <span> Data Kelas </span>
            </a>
            <a href="{{route('mengajar.index')}}">
                <i class="mdi mdi-clipboard-account"></i>
                <span>Jadwal</span>
            </a>
            <a href="{{route('mengajar.index')}}">
                <i class="mdi mdi-clipboard-account"></i>
                <span> Riwayat KRS </span>
            </a>

            <a href="{{route('mengajar.index')}}">
                <i class="mdi mdi-clipboard-account"></i>
                <span> Info Pembayaran </span>
            </a>
        </li>

    </ul>
</div>

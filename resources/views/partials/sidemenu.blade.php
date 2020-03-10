<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 13/01/2020
 * Time: 13:53
 */
?>
<div class="user-box text-center">
    <img src="" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-lg">
    <div class="dropdown">
        <a href="#" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Nowak Helme</a>
        <div class="dropdown-menu user-pro-dropdown">

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-user mr-1"></i>
                <span>My Account</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-settings mr-1"></i>
                <span>Settings</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-lock mr-1"></i>
                <span>Lock Screen</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-log-out mr-1"></i>
                <span>Logout</span>
            </a>

        </div>
    </div>
    <p class="text-muted">Admin Head</p>
    <ul class="list-inline">
        <li class="list-inline-item">
            <a href="#" class="text-muted">
                <i class="mdi mdi-settings"></i>
            </a>
        </li>

        <li class="list-inline-item">
            <a href="#" class="text-custom">
                <i class="mdi mdi-power"></i>
            </a>
        </li>
    </ul>
</div>
<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title">Data</li>
        <li>
            <a href="{{route('home')}}">
                <i class="mdi mdi-view-dashboard"></i>
                <span> Dashboard </span>
            </a>
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
                <span> Data Jurusan </span>
            </a>
            <a href="{{route('kelas.index')}}">
                <i class="mdi mdi-table-column"></i>
                <span> Data Kelas </span>
            </a>
            <a href="{{route('mata-kuliah.index')}}">
                <i class="mdi mdi-book"></i>
                <span> Data Mata Kuliah </span>
            </a>
            <a href="{{route('mengajar.index')}}">
                <i class="mdi mdi-clipboard-account"></i>
                <span> Data Mengajar </span>
            </a>
        </li>
    </ul>
</div>

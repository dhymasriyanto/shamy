<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 13/01/2020
 * Time: 13:53
 */
?>
<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title">Navigation</li>
        <li>
            <a href="{{route('home')}}">
                <i class="mdi mdi-view-dashboard"></i>
                <span> Dashboard </span>
            </a>
            <a href="{{route('datadosen')}}">
                <i class="mdi mdi-account"></i>
                <span> Data Dosen </span>
            </a>
            <a href="{{route('datamahasiswa')}}">
                <i class="mdi mdi-account"></i>
                <span> Data Mahasiswa </span>
            </a>
            <a href="{{route('datapegawai')}}">
                <i class="mdi mdi-account"></i>
                <span> Data Pegawai </span>
            </a>
            <a href="{{route('datafakultas')}}">
                <i class="mdi mdi-account"></i>
                <span> Data Fakultas </span>
            </a>
            <a href="{{route('datakurikulum')}}">
                <i class="mdi mdi-account"></i>
                <span> Data Kurikulum </span>
            </a>
            <a href="{{route('datatahunajaran')}}">
                <i class="mdi mdi-account"></i>
                <span> Data Tahun Ajaran </span>
            </a>
            <a href="{{route('datajurusan')}}">
                <i class="mdi mdi-account"></i>
                <span> Data Jurusan </span>
            </a>
        </li>
    </ul>
</div>

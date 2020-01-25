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
        </li>
    </ul>
</div>

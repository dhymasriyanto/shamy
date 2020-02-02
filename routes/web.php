<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

/**
 * Home controller
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 * Data Dosen controller
 */
Route::get('/dosen', 'DosenController@index')->name('dosen');
Route::get('/dosen/hapus/{id}', 'DosenController@hapus');

/**
 * Data Pegawai controller
 */
Route::get('/pegawai', 'PegawaiController@index')->name('pegawai');
Route::get('/pegawai/hapus/{id}', 'PegawaiController@hapus');

/**
 * Data Fakultas controller
 */
Route::get('/fakultas', 'FakultasController@index')->name('fakultas');
Route::get('/fakultas/hapus/{id}', 'FakultasController@hapus');

/**
 * Data Kurikulum controller
 */
Route::get('/kurikulum', 'KurikulumController@index')->name('kurikulum');
Route::get('/kurikulum/hapus/{id}', 'KurikulumController@hapus');

/**
 * Data TahunAjaran controller
 */
Route::get('/tahunajaran', 'TahunAjaranController@index')->name('tahunajaran');
Route::get('/tahunajaran/hapus/{id}', 'TahunAjaranController@hapus');

/**
 * Data Jurusan controller
 */
Route::get('/jurusan', 'JurusanController@index')->name('jurusan');
Route::get('/jurusan/hapus/{id}', 'JurusanController@hapus');

/**
 * Data Kelas controller
 */
Route::get('/kelas', 'KelasController@index')->name('kelas');
Route::get('/kelas/hapus/{id}', 'KelasController@hapus');

/**
 * Data Mahasiswa controller
 */
Route::get('/mahasiswa', 'MahasiswaController@index')->name('mahasiswa');
Route::get('/mahasiswa/hapus/{id}', 'MahasiswaController@hapus');

/**
 * Data MataKuliah controller
 */
Route::get('/matakuliah', 'MataKuliahController@index')->name('matakuliah');
Route::get('/matakuliah/hapus/{id}', 'MataKuliahController@hapus');

/**
 * Data Mengajar controller
 */
Route::get('/mengajar', 'MengajarController@index')->name('mengajar');
Route::get('/mengajar/hapus/{id}', 'MengajarController@hapus');





// Authentication Routes...
Route::prefix('auth')->name('auth.')->group(function (){
    Route::get('/', 'Auth\LoginController@showIndexForm')->name('index');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    /**
     * Registration Routes
     * DISABLED
     */
//    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
//    Route::post('register', 'Auth\RegisterController@register')->name('register');

    /**
     * Oauth2
     */
    Route::get('/login/aulia-id', 'Auth\LoginController@auliaIdRedirect')->name('login.redirect');
    Route::get('/login/callback', 'Auth\LoginController@callback')->name('login.callback');
});

// Password Reset Routes...
//Route::prefix('password')->name('password.')->group(function (){
//    Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('request');
//    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
//    Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset');
//    Route::post('reset', 'Auth\ResetPasswordController@reset')->name('update');
//});


// Email Verification Routes...
//Route::prefix('email')->name('email.')->group(function (){
//    Route::get('verify', 'Auth\VerificationController@show')->name('notice');
//    Route::get('verify/{id}', 'Auth\VerificationController@verify')->name('verify');
//    Route::get('resend', 'Auth\VerificationController@resend')->name('resend');
//});

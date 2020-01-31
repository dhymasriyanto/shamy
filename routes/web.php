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
Route::get('/datadosen', 'DosenController@index')->name('datadosen');
Route::get('/datadosen/hapus/{id}', 'DosenController@hapus');

/**
 * Data Pegawai controller
 */
Route::get('/datapegawai', 'PegawaiController@index')->name('datapegawai');
Route::get('/datapegawai/hapus/{id}', 'PegawaiController@hapus');

/**
 * Data Fakultas controller
 */
Route::get('/datafakultas', 'FakultasController@index')->name('datafakultas');
Route::get('/datafakultas/hapus/{id}', 'FakultasController@hapus');

/**
 * Data Kurikulum controller
 */
Route::get('/datakurikulum', 'KurikulumController@index')->name('datakurikulum');
Route::get('/datakurikulum/hapus/{id}', 'KurikulumController@hapus');

/**
 * Data TahunAjaran controller
 */
Route::get('/datatahunajaran', 'TahunAjaranController@index')->name('datatahunajaran');
Route::get('/datatahunajaran/hapus/{id}', 'TahunAjaranController@hapus');

/**
 * Data Jurusan controller
 */
Route::get('/datajurusan', 'JurusanController@index')->name('datajurusan');
Route::get('/datajurusan/hapus/{id}', 'JurusanController@hapus');

/**
 * Data Kelas controller
 */
Route::get('/datakelas', 'KelasController@index')->name('datakelas');
Route::get('/datakelas/hapus/{id}', 'KelasController@hapus');

/**
 * Data Mahasiswa controller
 */
Route::get('/datamahasiswa', 'MahasiswaController@index')->name('datamahasiswa');
Route::get('/datamahasiswa/hapus/{id}', 'MahasiswaController@hapus');

/**
 * Data MataKuliah controller
 */
Route::get('/datamatakuliah', 'MataKuliahController@index')->name('datamatakuliah');
Route::get('/datamatakuliah/hapus/{id}', 'MataKuliahController@hapus');

/**
 * Data Mengajar controller
 */
Route::get('/datamengajar', 'MengajarController@index')->name('datamengajar');
Route::get('/datamengajar/hapus/{id}', 'MengajarController@hapus');





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

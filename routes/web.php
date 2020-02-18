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

Route::get('/dosen/all', 'DosenController@all')->name('dosen.all');
Route::get('/fakultas/all', 'FakultasController@all')->name('fakultas.all');
Route::get('/jurusan/all', 'JurusanController@all')->name('jurusan.all');
Route::get('/kelas/all', 'KelasController@all')->name('kelas.all');
Route::get('/kurikulum/all', 'KurikulumController@all')->name('kurikulum.all');
Route::get('/mahasiswa/all', 'MahasiswaController@all')->name('mahasiswa.all');
Route::get('/mata-kuliah/all', 'MataKuliahController@all')->name('mata-kuliah.all');
Route::get('/mengajar/all', 'MengajarController@all')->name('mengajar.all');
Route::get('/pegawai/all', 'PegawaiController@all')->name('pegawai.all');
Route::post('/pegawai/create', 'PegawaiController@create')->name('pegawai.create');
Route::get('/tahun-ajaran/all', 'TahunAjaranController@all')->name('tahun-ajaran.all');


Route::resources([
    'dosen' => 'DosenController',
    'mahasiswa'  => 'MahasiswaController',
    'fakultas' => 'FakultasController',
    'jurusan' => 'JurusanController',
    'kelas' => 'KelasController',
    'kurikulum' => 'KurikulumController',
    'mata-kuliah' => 'MataKuliahController',
    'mengajar' => 'MengajarController',
    'pegawai' => 'PegawaiController',
    'tahun-ajaran' => 'TahunAjaranController'
]);

// Authentication Routes...
Route::prefix('auth')->name('auth.')->group(function () {
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

/**
 * Account
 */
Route::prefix('account')->name('account.')->group(function (){
    Route::get('/profil', 'AccountController@profil')->name('profil.show');
    Route::get('/oauth/personal-access-token', 'AccountController@oauthPersonalToken')->name('oauth.token');
});

// Email Verification Routes...
//Route::prefix('email')->name('email.')->group(function (){
//    Route::get('verify', 'Auth\VerificationController@show')->name('notice');
//    Route::get('verify/{id}', 'Auth\VerificationController@verify')->name('verify');
//    Route::get('resend', 'Auth\VerificationController@resend')->name('resend');
//});

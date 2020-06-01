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

Route::post('daftarulang/{id}', 'Auth\LoginController@daftarulang')->name('daftarulang');

//Dosen Controller
Route::get('/dosen/all', 'DosenController@all')->name('dosen.all');
Route::post('/dosen/create', 'DosenController@create')->name('dosen.create');
Route::post('/dosen/update/{id}', 'DosenController@update')->name('dosen.update');
Route::get('/dosen/get/{id}', 'DosenController@edit')->name('dosen.edit');

//Fakultas Controller
Route::get('/fakultas/all', 'FakultasController@all')->name('fakultas.all');
Route::post('/fakultas/create', 'FakultasController@create')->name('fakultas.create');
Route::post('/fakultas/update/{id}', 'FakultasController@update')->name('fakultas.update');
Route::get('/fakultas/get/{id}', 'FakultasController@edit')->name('fakultas.edit');

//Jurusan Controller
Route::get('/jurusan/all', 'JurusanController@all')->name('jurusan.all');
Route::post('/jurusan/create', 'JurusanController@create')->name('jurusan.create');
Route::post('/jurusan/update/{id}', 'JurusanController@update')->name('jurusan.update');
Route::get('/jurusan/get/{id}', 'JurusanController@edit')->name('jurusan.edit');

//Route::put('/kelas/store', 'KelasController@store')->name('kelas.store');
Route::get('/kelas/all', 'KelasController@all')->name('kelas.all');
Route::get('/kelas/allmahasiswa', 'KelasController@allmahasiswa')->name('kelas.allmahasiswa');
Route::get('/kelas/allrinciankelas/{id}', 'KelasController@allrinciankelas')->name('kelas.allrinciankelas');
Route::delete('/kelas/hapusmahasiswa', 'KelasController@hapusmahasiswa')->name('kelas.hapusmahasiswa');
Route::put('/kelas/tambahmahasiswa', 'KelasController@tambahmahasiswa')->name('kelas.tambahmahasiswa');
Route::get('/kelas/mahasiswa/{id}', 'KelasController@mahasiswa')->name('kelas.mahasiswa');

//Kurikulum Controller
Route::get('/kurikulum/all', 'KurikulumController@all')->name('kurikulum.all');
Route::post('/kurikulum/create', 'KurikulumController@create')->name('kurikulum.create');
Route::post('/kurikulum/update/{id}', 'KurikulumController@update')->name('kurikulum.update');
Route::get('/kurikulum/get/{id}', 'KurikulumController@edit')->name('kurikulum.edit');
Route::get('/kurikulum/allrincianmatkul/{id}', 'KurikulumController@allRincianMatkul')->name('kurikulum.allrincianmatkul');
Route::get('/kurikulum/matakuliah/{id}', 'KurikulumController@mataKuliah')->name('kurikulum.matakuliah');
Route::post('/kurikulum/tambahrincianmatkul', 'KurikulumController@tambahRincianMatkul')->name('kurikulum.tambahrincianmatkul');
Route::post('/kurikulum/hapusrincianmatkul', 'KurikulumController@hapusRincianMatkul')->name('kurikulum.hapusrincianmatkul');

//Mahasiswa Controller
Route::get('/mahasiswa/all', 'MahasiswaController@all')->name('mahasiswa.all');
Route::post('/mahasiswa/create', 'MahasiswaController@create')->name('mahasiswa.create');
Route::post('/mahasiswa/update/{id}', 'MahasiswaController@update')->name('mahasiswa.update');
Route::get('/mahasiswa/get/{id}', 'MahasiswaController@edit')->name('mahasiswa.edit');
Route::get('/mahasiswa/allrincian/{id}', 'MahasiswaController@allRincian')->name('kurikulum.allrincian');

//Mata Kuliah Controller
Route::get('/mata-kuliah/all', 'MataKuliahController@all')->name('mata-kuliah.all');
Route::post('/mata-kuliah/create', 'MataKuliahController@create')->name('mata-kuliah.create');
Route::post('/mata-kuliah/update/{id}', 'MataKuliahController@update')->name('mata-kuliah.update');
Route::get('/mata-kuliah/get/{id}', 'MataKuliahController@edit')->name('mata-kuliah.edit');

Route::get('/mengajar/all', 'MengajarController@all')->name('mengajar.all');

//Pegawai Controller
Route::get('/pegawai/all', 'PegawaiController@all')->name('pegawai.all');
Route::post('/pegawai/create', 'PegawaiController@create')->name('pegawai.create');
Route::post('/pegawai/update/{id}', 'PegawaiController@update')->name('pegawai.update');
Route::get('/pegawai/get/{id}', 'PegawaiController@edit')->name('pegawai.edit');

//Tahun Ajaran Controller
Route::get('/tahun-ajaran/all', 'TahunAjaranController@all')->name('tahun-tahun-ajaran.all');
Route::post('/tahun-ajaran/create', 'TahunAjaranController@create')->name('tahun-ajaran.create');
Route::post('/tahun-ajaran/update/{id}', 'TahunAjaranController@update')->name('tahun-ajaran.update');
Route::get('/tahun-ajaran/get/{id}', 'TahunAjaranController@edit')->name('tahun-ajaran.edit');


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
    'tahun-ajaran' => 'TahunAjaranController',
    'nilai'=> 'NilaiController'
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

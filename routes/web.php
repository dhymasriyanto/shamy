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

Route::resources([
    'dosen' => 'DosenController',
    'mahasiswa'  => 'MahasiswaController',
    'fakultas' => 'FakultasController',
    'jurusan' => 'JurusanController',
    'kelas' => 'KelasController',
    'kurikulum' => 'KurikulumController',
    'matakuliah' => 'MataKuliahController',
    'mengajar' => 'MengajarController',
    'pegawai' => 'PegawaiController',
    'tahunajaran' => 'TahunAjaranController'
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

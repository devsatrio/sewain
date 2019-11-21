<?php

//main
Route::get('/','frontend\homecontroller@index');

//auth
Auth::routes();

//admin
Route::resource('admin','backend\admincontroller');

//barang
Route::resource('barang','backend\barangcontroller');
Route::get('carisubkategori/{id}','backend\barangcontroller@carisubkategori');

//kota
Route::resource('kota','backend\kotacontroller');

//provinsi
Route::resource('provinsi','backend\provinsicontroller');

//kategori
Route::resource('kategori','backend\kategoricontroller');

//sub kategori
Route::resource('sub-kategori','backend\subkategoricontroller');

//setting
Route::resource('setting','backend\settingcontroller');

//toko
Route::resource('toko','backend\tokocontroller');
Route::post('toko/caridata','backend\tokocontroller@caridata')
->name('cari-data-toko');
Route::get('carikota/{id}','backend\tokocontroller@caridatakota');

//pengguna
Route::resource('pengguna','backend\penggunacontroller');
Route::post('pengguna/caridata','backend\penggunacontroller@caridata')
->name('cari-data-pengguna');

//dashboard
Route::get('/dashboard', 'backend\dashboardcontroller@index');

//home
Route::get('/home', 'frontend\homecontroller@index');

//login user
Route::get('pengguna-login','Auth\PenggunaLoginController@showLoginForm');
Route::post('pengguna-login', ['as' => 'pengguna-login', 'uses' => 'Auth\PenggunaLoginController@login']);
Route::get('pengguna-register','Auth\PenggunaLoginController@showRegisterPage');
Route::post('pengguna-register', 'Auth\PenggunaLoginController@register')->name('pengguna.register');

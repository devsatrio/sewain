<?php

//main
Route::get('/','frontend\homecontroller@index');

//auth
Auth::routes();

//admin
Route::resource('admin','backend\admincontroller');

//slider
Route::resource('slider','backend\slidercontroller');

//barang
Route::resource('barang','backend\barangcontroller');
Route::post('barang/cari','backend\barangcontroller@caridata')
->name('cari-data-barang');
Route::post('barang/editdetail','backend\barangcontroller@updatedetail')
->name('edit-detail-barang');
Route::post('barang/editdetailfoto','backend\barangcontroller@perbaruidetailfoto')
->name('edit-foto-barang');
Route::post('barang/tambahdetail','backend\barangcontroller@tambahdetail')
->name('tambah-detail-barang');
Route::post('barang/updatestatus','backend\barangcontroller@updatestatus')
->name('edit-status-barang');
Route::post('barang/updatefoto','backend\barangcontroller@updatedetailfoto');
Route::get('barang/hapusdetail/{id}','backend\barangcontroller@destroydetail');
Route::get('carisubkategori/{id}','backend\barangcontroller@carisubkategori');
Route::get('barang/hapusfoto/{id}','backend\barangcontroller@destroyfoto');

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
Route::post('pengguna/editstatus','backend\penggunacontroller@editstatus')
->name('edit-status-pengguna');

//dashboard
Route::get('/dashboard', 'backend\dashboardcontroller@index');

//home
Route::get('/home', 'frontend\homecontroller@index');

//login user
Route::get('pengguna-login','Auth\PenggunaLoginController@showLoginForm');
Route::post('pengguna-login', ['as' => 'pengguna-login', 'uses' => 'Auth\PenggunaLoginController@login']);
Route::get('pengguna-register','Auth\PenggunaLoginController@showRegisterPage');
Route::post('pengguna-register', 'Auth\PenggunaLoginController@register')->name('pengguna.register');

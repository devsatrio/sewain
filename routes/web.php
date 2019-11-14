<?php

//main
Route::get('/','frontend\homecontroller@index');

//auth
Auth::routes();

//admin
Route::resource('admin','backend\admincontroller');

//kategori
Route::resource('kategori','backend\kategoricontroller');

//kategori
Route::resource('sub-kategori','backend\subkategoricontroller');

//kategori
Route::resource('pengguna','backend\penggunacontroller');

//dashboard
Route::get('/dashboard', 'backend\dashboardcontroller@index');

//home
Route::get('/home', 'frontend\homecontroller@index');

//login user
Route::get('pengguna-login','Auth\PenggunaLoginController@showLoginForm');
Route::post('pengguna-login', ['as' => 'pengguna-login', 'uses' => 'Auth\PenggunaLoginController@login']);
Route::get('pengguna-register','Auth\PenggunaLoginController@showRegisterPage');
Route::post('pengguna-register', 'Auth\PenggunaLoginController@register')->name('pengguna.register');

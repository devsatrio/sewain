<?php

//main
Route::get('/','frontend\homecontroller@index');

//auth
Auth::routes();

//artikel
Route::resource('artikel','backend\artikelcontroller');
Route::post('artikel/caridata','backend\artikelcontroller@caridata')
->name('cari-data-artikel');

//kategori artikel
Route::resource('kategori-artikel','backend\kategoriartikelcontroller');

//akses
Route::resource('akses','backend\aksescontroller');

//permission
Route::resource('permission','backend\permissionscontroller');

//roles
Route::resource('roles','backend\rolescontroller');

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
Route::get('/dashboard/editprofile','backend\dashboardcontroller@editprofile')
->name('edit-profile');
Route::post('editprofile/{id}','backend\dashboardcontroller@aksieditprofile');

//============================================================================
//home
Route::get('/home', 'frontend\homecontroller@index');

//semua produk
Route::get('/semua-produk','frontend\semuaprodukcontroller@index');
Route::get('detail-produk/{kode}','frontend\semuaprodukcontroller@show');
Route::get('/semua-produk/{kategori}','frontend\semuaprodukcontroller@kategori');
Route::get('/semua-produk/kota/{kota}','frontend\semuaprodukcontroller@kota');
Route::get('/semua-produk-diskon','frontend\semuaprodukcontroller@diskon');

//semua toko
Route::get('/semua-toko', 'frontend\semuatokocontroller@index');
Route::get('/semua-toko/{toko}', 'frontend\semuatokocontroller@show');
Route::get('/semua-toko/kota/{kota}', 'frontend\semuatokocontroller@kota');

//Tips menyewa
Route::get('/tips-menyewa', 'frontend\halamanlaincontroller@tipssewa');

//List Artikel
Route::get('/list-artikel', 'frontend\halamanlaincontroller@artikel');
Route::get('/list-artikel/{kategori}', 'frontend\halamanlaincontroller@kategoriartikel');
Route::get('/detail-artikel/{judul}', 'frontend\halamanlaincontroller@detailartikel');

//produk saya
Route::get('/produk-saya', 'frontend\produksayacontroller@index');
Route::get('/detail-produk-saya/{kode}', 'frontend\produksayacontroller@show');
Route::get('/edit-produk/{kode}', 'frontend\produksayacontroller@edit');
Route::get('/buat-produk', 'frontend\produksayacontroller@create');
Route::post('buat-produk', 'frontend\produksayacontroller@store');
Route::get('carisubkategoriuser/{id}', 'frontend\produksayacontroller@carisubkategori');
Route::post('hapus-barang', 'frontend\produksayacontroller@destroy');
Route::post('edit-detail-produk/{kode}', 'frontend\produksayacontroller@updatedetail');
Route::post('tambah-detail-produk/{kode}','frontend\produksayacontroller@tambahharga');
Route::post('ubah-detail-produk','frontend\produksayacontroller@ubahharga');
Route::post('hapus-detail-produk','frontend\produksayacontroller@hapusharga');
Route::post('tambah-foto-produk/{kode}','frontend\produksayacontroller@tambahfoto');
Route::post('hapus-foto-produk','frontend\produksayacontroller@hapusfoto');
Route::post('ubah-foto-produk','frontend\produksayacontroller@ubahfoto');


//Toko saya
Route::get('/edit-toko', 'frontend\tokosayacontroller@edittoko');
Route::get('/buat-toko', 'frontend\tokosayacontroller@buattoko');
Route::get('carikotauser/{id}','frontend\tokosayacontroller@caridatakota');
Route::post('/buat-toko', 'frontend\tokosayacontroller@store');
Route::post('edit-toko/{kode}','frontend\tokosayacontroller@updatetoko');
Route::post('hapus-toko','frontend\tokosayacontroller@destroy');

//akun
Route::get('/detail-akun', 'frontend\akuncontroller@index');
Route::get('/edit-akun', 'frontend\akuncontroller@edit');
Route::get('/edit-password', 'frontend\akuncontroller@editpassword');
Route::post('/edit-akun/{kode}', 'frontend\akuncontroller@update');
Route::post('/edit-password/{kode}', 'frontend\akuncontroller@updatepassword');

//login user
Route::get('pengguna-login','Auth\PenggunaLoginController@showLoginForm');
Route::post('pengguna-login', ['as' => 'pengguna-login', 'uses' => 'Auth\PenggunaLoginController@login']);
Route::post('pengguna-register', 'Auth\PenggunaLoginController@register')->name('pengguna.register');

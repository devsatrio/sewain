@extends('layouts.app_user')
@section('title')
@foreach($websetting as $ws)
<title>{{$ws->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$ws->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('head')
@foreach($websetting as $ws)
<a href="{{url('/')}}" class="js-logo-clone">{{$ws->nama}}</a>
@endforeach
@endsection
@section('customcss')
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/select2/dist/css/select2.min.css')}}">
<link href="{{asset('admin_assets/custom/loading.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 mb-md-0">
                <div class="loading-div" id="panelnya">
                    <h2 class="h3 mb-3 text-black">Buat Produk</h2>
                    <div class="p-3 p-lg-5 border">
                        @if (session('msg'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Info!</h4>
                            {{ session('msg') }}
                        </div>
                        @endif
                        <form action="{{url('buat-produk')}}" method="post" onsubmit="return validasiform()" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="c_country" class="text-black">Kode Produk</label>
                                <input type="text" value="{{$kode}}" class="form-control" name="kode" readonly>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Nama Produk</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Kategori</label>
                                <select name="kategori" class="form-control select2" style="width: 100%;" id="kategori">
                                    <option selected disabled>pilih kategori</option>
                                    @foreach($kategori as $dpv)
                                    <option value="{{$dpv->id}}">{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Sub Kategori</label>
                                <select name="subkategori" class="form-control select2" style="width: 100%;" id="subkategori">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jaminan</label>
                                <textarea name="jaminan" class="form-control"></textarea>
                            </div>
                            <br>
                            <h4>List Paket Harga</h4>
                            <hr>
                            <div id="listpaket">
                                <div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="text-black">Nama Paket</label>
                                        <input type="text" class="form-control" name="namapaket[]" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="c_fname" class="text-black">Durasi</label>
                                            <input type="number" min="0" class="form-control" name="durasipaket[]" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="c_lname" class="text-black">Satuan</label>
                                            <select name="satuanpaket[]" class="form-control">
                                                <option value="Jam">Jam</option>
                                                <option value="Hari">Hari</option>
                                                <option value="Bulan">Bulan</option>
                                                <option value="Tahun">Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="text-black">Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp. </span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="hargapaket[]" required>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="text-black">Diskon</label>
                                        <div class="input-group">
                                            <input type="number" min="0" max="99" class="form-control" value="0" name="diskonpaket[]" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="button" class="btn btn-xs btn-success" onclick="addInput('listpaket');"><i class="icon icon-plus"></i> Tambah Paket</button>
                            </div>
                            <br>
                            <h4>Gambar Produk</h4>
                            <hr>
                            <div id="listfoto">
                                <div>
                                    <div class="form-group">
                                        <label for="inputEmail3">Foto Utama (wajib diisi)</label>
                                        <div id="tempatfoto1"></div><br>
                                        <button type="button" class="btn btn-primary" onclick="carifoto(1)">
                                        <i class="icon icon-upload"></i> Upload Gambar    
                                        </button>
                                        <input type="file" id="foto1" class="form-control" onchange="imgToDatabarang(this,1)" accept="image/*" name="fotoutama" required style="display: none;"><br>
                                        <span class="help-block text-danger" id="errorfoto1"></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <hr>
                                <button type="button" class="btn btn-xs btn-success" onclick="addInputfoto('listfoto');"><i class="icon icon-plus"></i> Tambah Foto Lain</button>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="submitbutton">Simpan Perubahan</button>
                                <button class="btn btn-danger" type="button" onclick="history.go(-1)">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
<script src="{{asset('user_assets/custom/buatproduk.js')}}"></script>
@endsection
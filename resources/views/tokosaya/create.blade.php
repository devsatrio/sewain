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
                    <h2 class="h3 mb-3 text-black">Buat Toko</h2>
                    <div class="p-3 p-lg-5 border">
                        @if (session('msg'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Info!</h4>
                            {{ session('msg') }}
                        </div>
                        @endif
                        @php
                        $kode = Crypt::encrypt(Auth::guard('pengguna')->user()->id);
                        @endphp
                        <form action="{{url('buat-toko')}}" method="post" enctype="multipart/form-data" onsubmit="return validasiform()">
                            @csrf
                            <div class="form-group">
                                <label for="c_country" class="text-black">Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">No.Telpon</label>
                                <input type="number" min="0" class="form-control" name="telp" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Provinsi</label>
                                <select name="provinsi" class="form-control select2" style="width: 100%;" id="provinsi">
                                    <option selected disabled>pilih provinsi</option>
                                    @foreach($dataprovinsi as $dpv)
                                    <option value="{{$dpv->id}}">{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Kota</label>
                                <select name="kota" class="form-control select2" style="width: 100%;" id="kota">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Hari Buka</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="senin"> Senin
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="selasa"> Selasa
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="rabu"> Rabu
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="kamis"> Kamis
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="jumat"> Jumat
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="sabtu"> Sabtu
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="minggu"> Minggu
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jam Buka</label>
                                <input type="time" class="form-control" name="jambuka" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jam Tutup</label>
                                <input type="time" class="form-control" name="jamtutup" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Logo Toko (wajib diisi)</label><br>
                                <div id="tempatfoto"></div>
                                <button type="button" class="btn btn-success" onclick="document.getElementById('photo').click();">
                                <i class="icon icon-upload"></i> Upload Logo
                                </button>
                                <input type="file" class="form-control" name="foto" accept="image/*" id="photo" required style="display: none;" onchange="photouploaded(this)"><br>
                                <span class="help-block text-danger" id="errorfoto"></span>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="submitbutton">Simpan</button>
                                <button class="btn btn-danger" type="button" onclick="history.go(-1)">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
<script src="{{asset('user_assets/custom/usertoko.js')}}"></script>
@endsection
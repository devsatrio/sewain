@extends('layouts.app_admin')
@section('header')
@foreach($websetting as $ws)
<title>{{$ws->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$ws->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('nameapps')
@foreach($websetting as $wss)
<span class="logo-mini">{{$wss->singkatan}}</span>
<span class="logo-lg">{{$wss->nama}}</span>
@endforeach
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link href="{{asset('admin_assets/custom/loading.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Toko
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Toko</h3>
            </div>
            <div class="loading-div" id="panelnya">
                <form class="form-horizontal" method="post" action="{{url('toko')}}" onsubmit="return validasiform()" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Toko</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Pemilik Toko</label>
                            <div class="col-sm-10">
                                <select name="pemilik" class="form-control select2" style="width: 100%;" id="pemilik">
                                    @foreach($datapengguna as $dp)
                                    <option value="{{$dp->id}}">{{$dp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select name="provinsi" class="form-control select2" style="width: 100%;" id="provinsi">
                                    <option selected disabled>pilih provinsi</option>
                                    @foreach($dataprovinsi as $dpv)
                                    <option value="{{$dpv->id}}">{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kota</label>
                            <div class="col-sm-10">
                                <select name="kota" class="form-control select2" style="width: 100%;" id="kota">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Alamat Lengkap</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Hari Buka</label>
                            <div class="col-sm-10">
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
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jam Buka</label>
                            <div class="col-sm-10">
                                <input type="text" name="jambuka" class="form-control timepicker" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jam Tutup</label>
                            <div class="col-sm-10">
                                <input type="text" name="jamtutup" class="form-control timepicker" required>
                            </div>
                        </div>
                        <div class="form-group" id="grubfoto">
                            <label for="inputEmail3" class="col-sm-2 control-label">Logo Toko</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="foto" accept="image/*" id="photo" required>
                                <span class="help-block" id="errorfoto"></span>
                            </div>
                        </div>
                        @csrf
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
<script src="{{asset('admin_assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/toko.js')}}"></script>
@endsection
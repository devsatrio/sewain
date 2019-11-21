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
        Barang
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Barang</h3>
            </div>
            <div class="loading-div" id="panelnya">
                <form class="form-horizontal" method="post" action="{{url('toko')}}" onsubmit="return validasiform()" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$kode}}" class="form-control" name="kode" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Toko</label>
                            <div class="col-sm-10">
                                <select name="toko" class="form-control select2" style="width: 100%;" id="toko">
                                    @foreach($toko as $dp)
                                    <option value="{{$dp->id}}">{{$dp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
                            <div class="col-sm-10">
                                <select name="kategori" class="form-control select2" style="width: 100%;" id="kategori">
                                    <option selected disabled>pilih kategori</option>
                                    @foreach($kategori as $dpv)
                                    <option value="{{$dpv->id}}">{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sub Kategori</label>
                            <div class="col-sm-10">
                                <select name="subkategori" class="form-control select2" style="width: 100%;" id="subkategori">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>
                        @csrf
                    </div>
                    <div class="box-body" id="listpaket">
                        <div>
                            <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Paket</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="namapaket[]">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Durasi</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" class="form-control" name="durasipaket[]">
                            </div>
                            <div class="col-sm-4">
                                <select name="satuanpaket[]" class="form-control"><option value="Jam">Jam</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" name="hargapaket[]">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Diskon</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" max="99" class="form-control" name="diskonpaket[]">
                            </div>
                        </div>
                        </div>
                        
                    </div>
                    <div class="box-body text-right">
                        <button type="button" class="btn btn-xs btn-success" onclick="addInput('listpaket');"><i class="fa fa-plus"></i> Tambah Paket</button>
                    </div>
                    <div class="box-body">
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
<script src="{{asset('admin_assets/custom/barang.js')}}"></script>
@endsection
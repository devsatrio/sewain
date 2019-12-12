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
                <h3 class="box-title">Detail Data Toko</h3>
            </div>
            @foreach($data as $row)
            
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Toko</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->nama}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">No.Telp</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->telp}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pemilik Toko</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namapengguna}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->deskripsi}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namaprovinsi}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kota</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namakota}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Alamat Lengkap</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->alamat}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hari Buka</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{substr($row->hari_buka,0,-1)}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jam Buka</label>
                    <div class="col-sm-10">
                       <p>&nbsp;:&nbsp;{{$row->jam_buka}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jam Tutup</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->jam_tutup}}</p>
                    </div>
                </div>
                <div class="form-group" id="grubfoto">
                    <label for="inputEmail3" class="col-sm-2 control-label">Logo Toko</label>
                    <div class="col-sm-10">
                        <img src="{{asset('image/toko/thumbnail/'.$row->logo)}}" alt="">
                      
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
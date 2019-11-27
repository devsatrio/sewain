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
        Artikel
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Data Artikel</h3>
            </div>
            @foreach($data as $row)
            
            <div class="box-body">
                <img src="{{asset('image/artikel/thumbnail/'.$row->gambar)}}" alt="">
                <br><br>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->judul}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namakategori}}</p>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Buat</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->tgl}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pembuat</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namauser}}</p>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                        {!!$row->isi!!}
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
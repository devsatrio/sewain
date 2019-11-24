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
                <h3 class="box-title">Detail Data Barang</h3>
            </div>
            @foreach($data as $row)
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->kode}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Toko</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namatoko}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->nama}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namakategori}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Sub Kategori</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->namasubkategori}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->deskripsi}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jaminan</label>
                    <div class="col-sm-10">
                        <p>&nbsp;:&nbsp;{{$row->jaminan}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Paket</th>
                            <th>Durasi</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Diskon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($datadetail as $row2)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td>
                                {{$row2->nama}}
                            </td>
                            <td>
                                {{$row2->durasi}} {{$row2->satuan}}
                            </td>
                            <td class="text-center">
                                {{"Rp ".number_format($row2->harga,0,',','.')}}
                            </td>
                            <td class="text-center">
                                {{$row2->diskon}} %
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-body" id="listfoto">
                @foreach($datafoto as $foto)
                <img src="{{asset('image/barang/thumbnail/'.$foto->nama)}}" alt="">
                @endforeach
            </div>
            <div class="box-footer">
                <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
            </div>
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
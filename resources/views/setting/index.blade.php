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
        Setting
        </h1>
    </section>
    <section class="content">
        @if (session('msg'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Info!</h4>
            {{ session('msg') }}
        </div>
        @endif
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Data Setting</h3>
            </div>
            @foreach($data as $row)
            @php
              $kode = Crypt::encrypt($row->id);
             @endphp
            <form class="form-horizontal" method="post" action="{{url('setting/'.$kode)}}" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" required value="{{$row->nama}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Singkatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="singkatan" required value="{{$row->singkatan}}">
                        </div>
                    </div>
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="deskripsi" id="editor1" class="form-control" cols="30" rows="10">{!!$row->deskripsi!!}</textarea>
                        </div>
                    </div>
                    <div class="form-group" id="grubfoto">
                        <label for="inputEmail3" class="col-sm-2 control-label">*Logo(kondisional)</label>
                        <div class="col-sm-10">
                            <img src="{{asset('image/setting/thumbnail/'.$row->logo)}}" alt="">
                            <input type="file" class="form-control" name="logo" accept="image/*" id="photo">
                            <input type="hidden" name="logolama" value="{{$row->logo}}">
                            <span class="help-block" id="errorfoto"></span>
                        </div>
                    </div>
                    <div class="form-group" id="grubfotodua">
                        <label for="inputEmail3" class="col-sm-2 control-label">*Icon(Kondisional)</label>
                        <div class="col-sm-10">
                            <img src="{{asset('image/setting/thumbnail/'.$row->icon)}}" alt="">
                            <input type="file" class="form-control" name="icon" accept="image/*" id="photodua">
                             <input type="hidden" name="iconlama" value="{{$row->icon}}">
                            <span class="help-block" id="errorfotodua"></span>
                        </div>
                    </div>
                    @csrf
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
            </form>
            @endforeach
        </div>
    </section>
</div>
@endsection

@section('js')
<script src="{{asset('admin_assets/bower_components/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/setting.js')}}"></script>
@endsection
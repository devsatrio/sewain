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
                <h3 class="box-title">Tambah Data Artikel</h3>
            </div>
            <div class="loading-div" id="panelnya">
                <form class="form-horizontal" method="post" action="{{url('artikel')}}" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
                            <div class="col-sm-10">
                                <select name="kategori" class="form-control select2" style="width: 100%;" id="pemilik">
                                    @foreach($datakategori as $dp)
                                    <option value="{{$dp->id}}">{{$dp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Isi</label>
                            <div class="col-sm-10">
                                <textarea name="isi" id="editor1" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="grubfoto">
                            <label for="inputEmail3" class="col-sm-2 control-label">Gambar Artikel</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="foto" accept="image/*" required>
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
<script src="{{asset('admin_assets/bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- <script src="https://cdn.ckeditor.com/4.13.0/basic/ckeditor.js"></script> -->
@endsection
@section('customjs')
<script>
    $(function () {
    CKEDITOR.replace('editor1')
  })
</script>
@endsection
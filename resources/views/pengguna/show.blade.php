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
        Pengguna
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">View Data Pengguna</h3>
            </div>
            @foreach($data as $row)
            
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->name}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->username}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->email}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">No. Telp</label>
                        <div class="col-sm-10">
                           <p>&nbsp;:&nbsp;{{$row->telp}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->alamat}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->tgl_lahir}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->gender}}</p>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->status}} - {{$row->keterangan_status}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Status Verivikasi</label>
                        <div class="col-sm-10">
                            <p>&nbsp;:&nbsp;{{$row->verivikasi}}</p>
                        </div>
                    </div>
                    <div class="form-group" id="grubfoto">
                        <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-10">
                            <img src="{{asset('image/pengguna/thumbnail/'.$row->foto)}}" alt="avatar">
                        </div>
                    </div>
                    
                    <div class="form-group" id="grubktpfoto">
                       <label for="inputEmail3" class="col-sm-2 control-label"><br>Foto KTP</label>
                        <div class="col-sm-10">
                          <br>
                            <img src="{{asset('image/ktp/thumbnail/'.$row->foto_ktp)}}" alt="avatar"><br>
                        </div>
                    </div>
                    <div class="form-group" id="grubktpfoto">
                    <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
</div>
@endsection
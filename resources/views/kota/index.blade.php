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
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/select2/dist/css/select2.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Kota
        </h1>
    </section>
    <section class="content">
        <div class="row">
            @if($aksescreate>0)
            <div class="col-md-8">
            @else
            <div class="col-md-12">
            @endif
                @if (session('msg'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('msg') }}
                </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">List Data Kota</h3>
                    </div>
                    <div class="box-body"><table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach($data as $row)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td>{{$row->nama}}</td>
                                <td class="text-center">
                                    @php
                                    $kode = Crypt::encrypt($row->id);
                                    @endphp
                                    <form action="{{url('/kota/'.$kode)}}" method="post">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-default{{$row->id}}">
                                        <i class="fa fa-wrench"></i>
                                        </button>
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if($aksescreate>0)
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Data Kota</h3>
                </div>
                <form role="form" method="post" action="{{url('kota')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Provinsi</label>
                            <select name="provinsi" class="form-control select2">
                                @foreach($dataprovinsi as $dtp)
                                <option value="{{$dtp->id}}">{{$dtp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Kota</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</section>
</div>
@if($aksesedit>0)
@foreach($data as $row2)
@php
$newkode = Crypt::encrypt($row2->id);
@endphp
<div class="modal fade" id="modal-default{{$row2->id}}" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Edit Data</h4>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="{{url('kota/'.$newkode)}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="put">
                
                <div class="box-body">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control select2" style="width: 100%;">
                            @foreach($dataprovinsi as $dtps)
                            <option value="{{$dtps->id}}" @if($row2->id_provinsi==$dtps->id) selected @endif >{{$dtps->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kota</label>
                        <input type="text" value="{{$row2->nama}}" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="box-footer text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@endif
@endsection
@section('js')
<script src="{{asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/kota.js')}}"></script>
@endsection
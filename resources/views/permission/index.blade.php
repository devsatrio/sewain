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
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Permission
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                @if (session('msg'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('msg') }}
                </div>
                @endif
                @if (session('msgerror'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('msgerror') }}
                </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">List Data Permission</h3>
                    </div>
                    <div class="box-body"><table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Modul</th>
                                <th>Permission</th>
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
                                <td>{{$row->modul}}</td>
                                <td>{{$row->aksi}}</td>
                                <td class="text-center">
                                    @php
                                    $kode = Crypt::encrypt($row->id);
                                    @endphp
                                    <form action="{{url('/permission/'.$kode)}}" method="post">
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
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Data Permission</h3>
                </div>
                <form role="form" method="post" action="{{url('permission')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Modul</label>
                            <select name="modul" class="form-control">
                                <option value="Admin">Admin</option>
                                <option value="Pengguna">Pengguna</option>
                                <option value="Kategori">Kategori</option>
                                <option value="Sub Kategori">Sub Kategori</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Kota">Kota</option>
                                <option value="Toko">Toko</option>
                                <option value="Barang">Barang</option>
                                <option value="Kategori Artikel">Kategori Artikel</option>
                                <option value="Artikel">Artikel</option>
                                <option value="Slider">Slider</option>
                                <option value="Setting">Setting</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Permission Utama</label>
                            <select name="nama" class="form-control">
                                <option value="View Data">View Data</option>
                                <option value="Tambah Data">Tambah Data</option>
                                <option value="Edit Data">Edit Data</option>
                                <option value="Hapus Data">Hapus Data</option>
                                <option value="Update Status">Update Status</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Custom Permission</label>
                            <input type="text" class="form-control" name="namalain">
                        </div>
                        
                    </div>
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</section>
</div>
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
            <form role="form" method="post" action="{{url('permission/'.$newkode)}}">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                     <div class="form-group">
                            <label for="exampleInputPassword1">Modul</label>
                            <select name="modul" class="form-control">
                                <option value="Admin" @if($row2->modul=='Admin') selected @endif>Admin</option>
                                <option value="Pengguna" @if($row2->modul=='Pengguna') selected @endif>Pengguna</option>
                                <option value="Kategori" @if($row2->modul=='Kategori') selected @endif>Kategori</option>
                                <option value="Sub Kategori" @if($row2->modul=='Sub Kategori') selected @endif>Sub Kategori</option>
                                <option value="Provinsi" @if($row2->modul=='Provinsi') selected @endif>Provinsi</option>
                                <option value="Kota" @if($row2->modul=='Kota') selected @endif>Kota</option>
                                <option value="Toko" @if($row2->modul=='Toko') selected @endif>Toko</option>
                                <option value="Barang" @if($row2->modul=='Barang') selected @endif>Barang</option>
                                <option value="Kategori Artikel" @if($row2->modul=='Kategori Artikel') selected @endif>Kategori Artikel</option>
                                <option value="Artikel" @if($row2->modul=='Artikel') selected @endif>Artikel</option>
                                <option value="Slider" @if($row2->modul=='Slider') selected @endif>Slider</option>
                                <option value="Setting" @if($row2->modul=='Setting') selected @endif>Setting</option>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Sub Kategori</label>
                        <input type="text" value="{{$row2->aksi}}" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="box-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection
@section('js')
<script src="{{asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/subkategori.js')}}"></script>
@endsection
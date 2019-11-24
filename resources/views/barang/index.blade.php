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
        Barang
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
            <div class="box-header">
                <h3 class="box-title">List Data Barang</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cari">
                    Cari Dari Semua Data
                    </button>
                    <a href="{{url('barang/create')}}" class="btn btn-success">Tambah Data</a>
                </div></div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th class="text-center">Tanggal Post</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach($data as $row)
                            @php
                            $kode = Crypt::encrypt($row->id);
                            @endphp
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td>
                                    <a href="{{url('barang/'.$row->kode)}}" class="btn btn-default btn-xs">
                                        <i class="fa fa-eye"></i> {{$row->nama}}
                                    </a>
                                </td>
                                <td>
                                    {{$row->namakategori}} - {{$row->namasubkategori}}
                                </td>
                                <td class="text-center">
                                    {{$row->tgl_post}}
                                </td>
                                <td class="text-center">
                                    {{$row->status}}
                                </td>
                                <td class="text-center">
                                    <form action="{{url('/barang/'.$kode)}}" method="post">
                                        <a href="{{url('barang/'.$row->kode.'/edit')}}" class="btn btn-primary btn-xs"><i class="fa fa-wrench"></i></a>
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-cari" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" action="{{Route('cari-data-barang')}}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Cari Dari Semua Data </h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="cari" required placeholder="cari berdasarkan nama barang" id="fieldcari">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script src="{{asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    @endsection
    @section('customjs')
    <script src="{{asset('admin_assets/custom/pengguna_view.js')}}"></script>
    @endsection
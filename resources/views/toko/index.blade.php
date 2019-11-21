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
@section('css')
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Toko
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
                <h3 class="box-title">List Data Toko</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cari">
                    Cari Dari Semua Data
                    </button>
                    <a href="{{url('toko/create')}}" class="btn btn-success">Tambah Data</a>
                </div></div>
                <div class="box-body"><table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Toko</th>
                            <th>Pemilik</th>
                            <th>Status</th>
                            <th>Kota/Kab</th>
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
                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('toko/'.$kode)}}" class="btn btn-default btn-xs">
                                <i class="fa fa-eye"></i> {{$row->nama}}
                                </a>
                            </td>
                            <td>{{$row->namapengguna}}</td>
                            <td>{{$row->status}}</td>
                            <td>{{$row->namakota}}</td>
                            <td class="text-center">
                               
                                
                                <form action="{{url('/toko/'.$kode)}}" method="post">
                                    <a href="{{url('toko/'.$kode.'/edit')}}" class="btn btn-primary btn-xs"><i class="fa fa-wrench"></i></a>
                                    
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
            <form role="form" method="post" action="{{Route('cari-data-toko')}}" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Cari Dari Semua Data </h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="cari" required placeholder="cari berdasarkan nama toko" id="fieldcari">
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
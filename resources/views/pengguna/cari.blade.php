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
        Pengguna
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
                <h3 class="box-title">Hasil Pencarian "<b>{{$datacari}}</b>"</h3>
                </div>
                <div class="box-body"><table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No.Telpon</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($data as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->telp}}</td>
                            <td>{{$row->gender}}</td>
                            <td>{{$row->status}}</td>
                            <td class="text-center">
                                @php
                                $kode = Crypt::encrypt($row->id);
                                @endphp
                                
                                <form action="{{url('/pengguna/'.$kode)}}" method="post">
                                    <a href="{{url('pengguna/'.$kode.'/edit')}}" class="btn btn-primary btn-xs"><i class="fa fa-wrench"></i></a>
                                    
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
<script src="{{asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/pengguna_view_cari.js')}}"></script>
@endsection
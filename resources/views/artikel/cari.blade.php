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
        Artikel
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
                <h3 class="box-title">Hasil Pencarian "<b>{{$cari}}</b>"</h3>
            </div>
            <div class="box-body"><table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pembuat</th>
                        <th>Kategori</th>
                        <th>Tanggal Buat</th>
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
                            <a href="{{url('artikel/'.$kode)}}" class="btn btn-default btn-xs">
                                <i class="fa fa-eye"></i> {{$row->judul}}
                            </a>
                        </td>
                        <td>{{$row->namauser}}</td>
                        <td>{{$row->namakategori}}</td>
                        <td>{{$row->tgl}}</td>
                        <td class="text-center">
                                <form action="{{url('/artikel/'.$kode)}}" method="post">
                                    @if($aksesedit>0)
                                    <a href="{{url('artikel/'.$kode.'/edit')}}" class="btn btn-primary btn-xs"><i class="fa fa-wrench"></i></a>
                                    @endif
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
                                    @if($aksesdelete>0)
                                    <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    @endif
                                </form>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
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
<script>
$(function () {
$('#example1').DataTable()
})
</script>
@endsection
@extends('layouts.app_user')
@section('title')
@foreach($websetting as $ws)
<title>{{$ws->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$ws->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('head')
@foreach($websetting as $ws)
<a href="{{url('/')}}" class="js-logo-clone">{{$ws->nama}}</a>
@endforeach
@endsection
@section('customcss')
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/select2/dist/css/select2.min.css')}}">
<link href="{{asset('admin_assets/custom/loading.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="site-section">
    <div class="container">
        @if (session('msg'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Info!</h4>
            {{ session('msg') }}
        </div>
        @endif
        <div class="row">
            @if($jumlahbarang>0)
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">List Produk</h2>
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Gambar</th>
                                <th class="product-name">Kode</th>
                                <th class="product-name">Produk</th>
                                <th class="product-quantity">Tanggal Buat</th>
                                <th class="product-remove">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($databarang as $row)
                            <tr>
                                <td class="product-thumbnail">
                                    @php
                    $fotobrg = DB::table('fotobarang')->where([['kode_barang',$row->kode],['default','Y']])->get();
                    @endphp
                    @foreach($fotobrg as $ft)
                                    <img src="{{asset('image/barang/thumbnail/'.$ft->nama)}}" alt="Image" class="img-fluid">
                                    @endforeach
                                </td>
                                <td class="product-name">
                                    {{$row->kode}}
                                </td>
                                <td>
                                    <a href="{{url('/detail-produk/'.$row->kode)}}"><h2 class="h5 text-black">{{$row->nama}}</h2></a></td>
                                <td>{{$row->tgl_post}}</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm"><span class="icon icon-trash"></span></a>
                                    <a href="#" class="btn btn-success btn-sm"><span class="icon icon-wrench"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="col-md-12 text-center">
                <span class="icon-frown-o display-3 text-danger"></span>
                <h2 class="display-3 text-black">Oops!</h2>
                <p class="lead mb-5">Kamu belum punya produk sama sekali.</p>
                <p><a href="{{url('buat-produk')}}" class="btn btn-sm btn-primary">Buat Produk</a></p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
<script src="{{asset('user_assets/custom/useredittoko.js')}}"></script>
@endsection
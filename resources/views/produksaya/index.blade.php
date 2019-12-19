@extends('layouts.app_user')
@section('title')
<title>{{$websetting->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$websetting->icon)}}" rel="icon" type="image/png">
@endsection
@section('head')
<a href="{{url('/')}}" class="js-logo-clone">{{$websetting->nama}}</a>
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
                    <a href="{{url('buat-produk')}}" class="btn btn-sm btn-primary">Tambah Produk</a>
                    <br><br>
                    <table class="table table-bordered" id="example1" >
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
                                    <a href="{{url('/detail-produk-saya/'.$row->kode)}}"><h2 class="h5 text-black">{{$row->nama}}</h2></a></td>
                                    <td>{{$row->tgl_post}}</td>
                                    <td>
                                        <a href="{{url('edit-produk/'.$row->kode)}}" class="btn btn-success btn-sm"><span class="icon icon-wrench"></span></a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{$row->kode}}"><span class="icon icon-trash"></span></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    {{ $databarang->links() }}
                </div>
                <br>
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
    @foreach($databarang as $row)
    <div class="modal fade" id="hapus{{$row->kode}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{url('hapus-barang')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus produk <b>{{$row->nama}}</b> ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Kami tidak dapat mengembalikan data produk yang telah di hapus, jadi yakin nih mau hapus produk ?
                        <input type="hidden" name="kode" value="{{$row->kode}}">
                        @csrf
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Ya, Aku yakin</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    @endforeach
    @endsection
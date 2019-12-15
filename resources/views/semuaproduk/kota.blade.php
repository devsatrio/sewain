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
        <div class="row mb-5">
            <div class="col-md-12 order-1">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="text-center mb-4"><h2 class="text-black h5">Semua Produk Dari Kota {{ucwords($kota)}}</h2></div>
                    </div>
                </div>
                <div class="row mb-5">
                    @foreach($barang as $brg)
                    @php
                    $fotobrg = DB::table('fotobarang')
                    ->where([['kode_barang',$brg->kode],['default','Y']])
                    ->first();
                    $detailbarang = DB::table('detail_barang')
                    ->where('kode_barang',$brg->kode)
                    ->orderby('harga','asc')->limit(1)->first();
                    $jumlahdiskon = DB::table('detail_barang')
                    ->where([['kode_barang',$brg->kode],['diskon','>',0]])
                    ->count();
                    @endphp
                    <div class="col-sm-6 col-lg-3 mb-3" data-aos="fade-up">
                        <div class="block-4 text-center border">
                            <figure class="block-4-image">
                                <a href="{{url('/detail-produk/'.$brg->kode)}}">
                                    <img src="{{asset('image/barang/'.$fotobrg->nama)}}" alt="Image placeholder" class="img-fluid">
                                </a>
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="{{url('/detail-produk/'.$brg->kode)}}">{{$brg->nama}}</a></h3>
                                <p class="mb-0">{{$brg->namakategori}} - {{$brg->namasubkategori}}</p>
                                <p class="text-primary font-weight-bold" style="margin-bottom: 0px;">{{"Rp ".number_format($detailbarang->harga,0,',','.')}} / {{$detailbarang->durasi." ".$detailbarang->satuan}}</p>
                                @if($jumlahdiskon >0)
                                <span class="badge badge-pill badge-success pull-right">Lagi Diskon</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                       {{ $barang->links() }}
                       <br>
                       <button type="button" class="btn btn-danger" onclick="history.go(-1)">Kembali</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
    <div class="row">
      <div class="col-md-6 order-2">
        <div class="row">
          <div class="col-md-12 mb-5">
            <div class="text-center mb-4"><h2 class="text-black h5">Semua Produk Toko</h2></div>
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
          <div class="col-sm-6 col-lg-6 mb-6" data-aos="fade-up">
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
      <div class="col-md-6 order-1">
        <div class="col-md-12">
          <div class="p-3 p-lg-5 border">
            <div class="block-38 text-center">
              <div class="block-38-img">
                <div class="block-38-header">
                  <img src="{{asset('image/toko/'.$toko->logo)}}" alt="Image placeholder" class="mb-4">
                  <h3 class="block-38-heading h4">{{ucwords($toko->nama)}}</h3>
                  <p class="block-38-subheading">{{$toko->namakota}}-{{$toko->namaprovinsi}} <br>

                  @if($toko->verivikasi_status=='Ya')
                                <span class="badge badge-pill badge-success pull-right">Terverivikasi</span>
                                @endif
                  </p>
                </div>
                <div class="block-38-body">
                  <p>
                    <b><span class="icon-phone"></span> {{$toko->telp}}</b><br>
                    <b><span class="icon-map-marker"></span> {{$toko->alamat}}</b>
                  </p>
                  <p>{{$toko->deskripsi}}</p>
                  <hr>
                  <p class="text-center">
                    <button class="btn btn-block btn-danger btn-sm" type="button" onclick="history.go(-1)">Kembali</button>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
</div>
@endsection
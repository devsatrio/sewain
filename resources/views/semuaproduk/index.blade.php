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
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 order-1">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left mb-4"><h2 class="text-black h5">Semua Produk</h2></div>
                        <div class="d-flex">
                            <div class="dropdown mr-1 ml-md-auto">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Saring Berdasarkan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    <a class="dropdown-item" href="#">Iklan</a>
                                    <a class="dropdown-item" href="#">Lagi Diskon</a>
                                    <a class="dropdown-item" href="#">Toko Terverivikasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    @foreach($barang as $brg)
                    @php
                    $fotobrg = DB::table('fotobarang')->where([['kode_barang',$brg->kode],['default','Y']])->get();
                    $detailbarang = DB::table('detail_barang')->where('kode_barang',$brg->kode)->orderby('harga','asc')->limit(1)->get();
                    @endphp
                    <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                        <div class="block-4 text-center border">
                            <figure class="block-4-image">
                                @foreach($fotobrg as $ft)
                                <a href="#"><img src="{{asset('image/barang/'.$ft->nama)}}" alt="Image placeholder" class="img-fluid"></a>
                                @endforeach
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="#">{{$brg->nama}}</a></h3>
                                <p class="mb-0">{{$brg->namakategori}} - {{$brg->namasubkategori}}</p>
                                @foreach($detailbarang as $dbrg)
                                <p class="text-primary font-weight-bold">{{"Rp ".number_format($dbrg->harga,0,',','.')}} / {{$dbrg->durasi." ".$dbrg->satuan}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                        <div class="site-block-27">
                            <ul>
                                <li><a href="#">&lt;</a></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">&gt;</a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-md-3 order-2 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategori</h3>
                    <ul class="list-unstyled mb-0">
                        @foreach($kategori as $ktg)
                        <li class="mb-1"><a href="#" class="d-flex"><span>{{ucfirst($ktg->nama)}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Berdasarkan Kota</h3>
                    <ul class="list-unstyled mb-0">
                        @foreach($kota as $kot)
                        <li class="mb-1"><a href="#" class="d-flex"><span>{{ ucfirst($kot->nama)}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
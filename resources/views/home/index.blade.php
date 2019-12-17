@extends('layouts.app_user')

@section('title')
<title>{{$websetting->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$websetting->icon)}}" rel="icon" type="image/png">
@endsection

@section('head')
<a href="{{url('/')}}" class="js-logo-clone">{{$websetting->nama}}</a>
@endsection

@section('content')
@foreach($slider as $sld)
<div class="site-blocks-cover" style="background-image: url({{asset('image/slider/'.$sld->nama)}});" data-aos="fade">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                <h1 class="mb-2">{{$sld->header}}</h1>
                <div class="intro-text text-center text-md-left">
                    <p class="mb-4">{{$sld->deskripsi}} </p>
                    <p>
                        <a href="#" class="btn btn-sm btn-primary">Sewa Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="site-section site-section-sm site-blocks-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-magic"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Terlengkap</h2>
                    <p>Mulai dari persewaan micro sampai persewaan raksasa, dengan pilihan produk yang luas dan beraneka ragam.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-star"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Terpercaya</h2>
                    <p>Semua toko yang telah terdaftar kami jamin keamanan nya, dan apabila ada penipuan atau kegiatan toko yang merugikan anda, segera laporkan pada kami.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-heart"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Produk Bangsa</h2>
                    <p>Dengan anda menjadi bagian dari ekosistem kami, kami ucapkan terima kasih, karena secara tidak langsung anda mendukung produk kami, dan ratusan produk wirausahawan lain :D</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row">
            @foreach($kategori as $ktg)
            <div class="col-sm-3 col-md-3 col-lg-3 mb-3 mb-lg-3" data-aos="fade" data-aos-delay="">
                <a class="block-2-item" href="{{url('/semua-produk/'.$ktg->nama)}}">
                    <figure class="image">
                        <img src="{{asset('image/kategori/'.$ktg->gambar)}}" alt="" class="img-fluid" width="100%">
                    </figure>
                    <div class="text">
                        <span class="text-uppercase">Kategori</span>
                        <h3>{{$ktg->nama}}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Produk Terbaru</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    @foreach($barang as $brg)
                    @php
                    $fotobrg = DB::table('fotobarang')->where([['kode_barang',$brg->kode],['default','Y']])->get();
                    $detailbarang = DB::table('detail_barang')->where('kode_barang',$brg->kode)->orderby('harga','asc')->limit(1)->get();
                    @endphp
                    <div class="item">
                        <div class="block-4 text-center">
                            <figure class="block-4-image">
                                @foreach($fotobrg as $ft)
                                <a href="{{url('/detail-produk/'.$brg->kode)}}">
                                    <img src="{{asset('image/barang/'.$ft->nama)}}" alt="Image placeholder" class="img-fluid">
                                </a>
                                @endforeach
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="{{url('/detail-produk/'.$brg->kode)}}">{{$brg->nama}}</a></h3>
                                <p class="mb-0">{{$brg->namakategori}} - {{$brg->namasubkategori}}</p>
                                @foreach($detailbarang as $dbrg)
                                <p class="text-primary font-weight-bold">{{"Rp ".number_format($dbrg->harga,0,',','.')}} / {{$dbrg->durasi." ".$dbrg->satuan}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section block-8">
    <div class="container">
        <div class="row justify-content-center  mb-5">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Artikel Terbaru</h2>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 mb-5">
                <a href="#"><img src="{{asset('image/artikel/'.$artikel->gambar)}}" alt="Image placeholder" class="img-fluid rounded"></a>
            </div>
            <div class="col-md-12 col-lg-5 text-center pl-md-5">
                <h2><a href="#">{{ucwords($artikel->judul)}}</a></h2>
                <p class="post-meta mb-4">{{$artikel->username}} <span class="block-8-sep">&bullet;</span>{{$artikel->tgl}}</p>
                {!!$artikel->isi!!}
                <p><a href="{{url('detail-artikel/'.$artikel->link)}}" class="btn btn-primary btn-sm">Lanjut Baca</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
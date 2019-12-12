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
      <div class="col-md-6">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @php $no=1; @endphp
            @foreach($fotobrg as $ft)
            @if($no==1)
            <div class="carousel-item active">
              @else
              <div class="carousel-item">
                @endif
                <img class="d-block w-100" src="{{asset('image/barang/'.$ft->nama)}}" width="75%" alt="Third slide">
              </div>
              @php $no++; @endphp
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <br>
        </div>
        <div class="col-md-6">
          <div class="col-md-12">
            <div class="p-3 p-lg-5 border">
              <h2 class="text-black">{{$databarang->nama}}</h2>
              <p><span class="badge badge-primary">{{$databarang->namakategori}}</span> - <span class="badge badge-primary">{{$databarang->namasubkategori}}</span></p>
              <p>{{$databarang->deskripsi}}</p>
              <p class="mb-4"><strong class="text-primary">Jaminan : </strong>{{$databarang->jaminan}} <br>
              <strong class="text-primary">Tanggal Posting : </strong>{{$databarang->tgl_post}}</p>
              <p>
                <ul>
                  @foreach($detailbarang as $dbrg)
                  @if($dbrg->diskon>0)
                  <li>
                    <strong class="text-primary h4">
                    <strike class="text-muted">{{"Rp ".number_format($dbrg->harga,0,',','.')}}</strike> {{"Rp ".number_format($dbrg->harga-($dbrg->harga*$dbrg->diskon/100),0,',','.')}} / {{$dbrg->durasi." ".$dbrg->satuan}}
                    </strong> <br>{{$dbrg->nama}} <span class="badge badge-pill badge-success">Diskon {{$dbrg->diskon}}%</span>
                  </li>
                  @else
                  <li>
                    <strong class="text-primary h4">
                    {{"Rp ".number_format($dbrg->harga,0,',','.')}} / {{$dbrg->durasi." ".$dbrg->satuan}}
                    </strong> <br>{{$dbrg->nama}}
                  </li>
                  @endif
                  @endforeach
                </ul>
              </p>
              <hr>
              <p class="text-center">
                <a href="#" class="btn btn-sm btn-primary"><span class="icon-share-alt"></span></a>
                <a href="#" class="btn btn-sm btn-primary text-white"><span class="icon-thumb_up"></span></a>
                <a href="#" class="btn btn-sm btn-primary text-white"><span class="icon-bookmark"></span></a>
                <a href="#" class="btn btn-sm btn-primary text-white"><span class="icon-chat"></span></a>
              </p>
            </div>
          </div>
          <br>
          <div class="col-md-12">
            <div class="p-3 p-lg-5 border">
             <div class="block-38 text-center">
              <div class="block-38-img">
                <div class="block-38-header">
                  <img src="{{asset('image/toko/'.$toko->logo)}}" alt="Image placeholder" class="mb-4">
                  <h3 class="block-38-heading h4">{{$toko->nama}}</h3>
                  <p class="block-38-subheading">{{$toko->namakota}}-{{$toko->namaprovinsi}}</p>
                </div>
                <div class="block-38-body">
                  <p>{{$toko->deskripsi}}</p>
                  <hr>
                    <p class="text-center">
                      <a href="#" class="btn btn-block btn-sm btn-primary">Lihat Toko</a>
                      <button class="btn btn-block btn-danger btn-sm" type="button" onclick="history.go(-1)">Kembali</button>
                    </p>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
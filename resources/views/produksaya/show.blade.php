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
                  <li>
                    <strong class="text-primary h4">
                    {{"Rp ".number_format($dbrg->harga,0,',','.')}} / {{$dbrg->durasi." ".$dbrg->satuan}}
                    </strong> - {{$dbrg->nama}}
                  </li>
                  @endforeach
                </ul>
              </p>
              <hr>
              <p class="text-center">
                      <button type="button" onclick="history.go(-1)" class="btn btn-block btn-sm btn-danger">Kembali</button>
                    </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
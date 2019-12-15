@extends('layouts.app_user')
@section('title')
<title>{{$websetting->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$websetting->icon)}}" rel="icon" type="image/png">
@endsection
@section('head')
<a href="{{url('/')}}" class="js-logo-clone">{{$websetting->nama}}</a>
@endsection
@section('content')
<div class="site-section border-bottom" data-aos="fade">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="block-16 text-center">
                    <figure>
                        <img src="{{asset('image/artikel/'.$artikel->gambar)}}" alt="Image Artikel" class="img-fluid rounded" style="max-width: 100%;">
                    </figure>
                </div>
                <div class="site-section-heading pt-3 mb-4">
                    <h2 class="text-black">{{ucwords($artikel->judul)}}</h2>
                </div>
                <span class="badge badge-pill badge-success pull-right"><i class="icon-calendar"></i> {{$artikel->tgl}}</span>
                <span class="badge badge-pill badge-success pull-right"><i class="icon-user"></i> {{$artikel->username}}</span> <span class="badge badge-pill badge-success pull-right"><i class="icon-tags"></i> {{$artikel->namakategori}}</span> <br>
                {!!$artikel->isi!!}
                <div class="text-center">
                    <button class="btn btn-danger btn-sm" type="button" onclick="history.go(-1)">Kembali</button>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
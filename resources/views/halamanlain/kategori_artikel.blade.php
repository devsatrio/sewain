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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left mb-4"><h2 class="text-black h5">Artikel Berkategori {{ucwords($kategori)}}</h2></div>
                    </div>
                </div>
                <div class="row mb-5">
                    @foreach($artikel as $row)
                    <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('image/artikel/thumbnail/'.$row->gambar)}}" alt="Artikel image">
                            <div class="card-body">
                                <h5 class="card-title">{{ucwords($row->judul)}}</h5>
                                <div class="card-text">{!!$row->isi!!}</div>
                                <span class="icon-calendar"></span> {{$row->tgl}} 
                                <span class="icon-user"></span> {{$row->username}} <span class="icon-tags"></span> {{$row->namakategori}} 
                                
                            </div>
                            <div class="card-body text-center">
                                <a href="{{url('detail-artikel/'.$row->link)}}" class="btn btn-primary btn-block">Lanjut Baca</a>
                                
                            </div>
                        </div>
                        <br>
                    </div>
                    @endforeach
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                        {{ $artikel->links() }}
                        <br>
                        <button class="btn btn-danger btn-sm" type="button" onclick="history.go(-1)">Kembali</button>
                    </div>
                </div>
                <br>
            </div>
        </div>
        
    </div>
</div>
@endsection
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
            <div class="col-md-9 order-1">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left mb-4"><h2 class="text-black h5">Artikel</h2></div>
                    </div>
                </div>
                <div class="row mb-5">
                    @foreach($artikel as $row)
                    <div class="col-sm-6 col-lg-6 mb-6" data-aos="fade-up">
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
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-3 order-2 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategori</h3>
                    <ul class="list-unstyled mb-0">
                        @foreach($kategori as $ktg)
                        <li class="mb-1"><a href="{{url('list-artikel/'.$ktg->nama)}}" class="d-flex"><span>{{$ktg->nama}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
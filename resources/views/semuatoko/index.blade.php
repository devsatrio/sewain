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
                        <div class="float-md-left mb-4"><h2 class="text-black h5">Semua Toko</h2></div>
                        <div class="d-flex">
                            <div class="dropdown mr-1 ml-md-auto">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Saring Berdasarkan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    <a class="dropdown-item" href="{{url('/semua-toko-terverivikasi')}}">Toko Terverivikasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    @foreach($toko as $tk)
                    <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                        <div class="block-4 text-center border">
                            <figure class="block-4-image">
                                <a href="{{url('semua-toko/'.$tk->link)}}"><img src="{{asset('image/toko/'.$tk->logo)}}" alt="Image placeholder" class="img-fluid"></a>
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="{{url('semua-toko/'.$tk->link)}}">{{ucwords($tk->nama)}}</a></h3>
                                <p class="mb-0">{{ucwords($tk->namakota)}} - {{ucwords($tk->namaprovinsi)}}</p>
                                @if($tk->verivikasi_status=='Ya')
                                <span class="badge badge-pill badge-success pull-right">Terverivikasi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                        {{ $toko->links() }}
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-3 order-2 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Berdasarkan Kota</h3>
                    <ul class="list-unstyled mb-0">
                        @foreach($kota as $kot)
                        <li class="mb-1"><a href="{{url('semua-toko/kota/'.$kot->nama)}}" class="d-flex"><span>{{ ucwords($kot->nama)}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
            <div class="col-md-12 order">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left mb-4"><h2 class="text-black h5">Semua Toko Dari Kota {{$kota}}</h2></div>
                    </div>
                </div>
                <div class="row mb-5">
                    @foreach($toko as $tk)
                    <div class="col-sm-6 col-lg-3 mb-3" data-aos="fade-up">
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
        </div>
    </div>
</div>
@endsection
@extends('layouts.app_admin')
@section('header')
@foreach($websetting as $ws)
<title>{{$ws->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$ws->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('nameapps')
@foreach($websetting as $wss)
<span class="logo-mini">{{$wss->singkatan}}</span>
<span class="logo-lg">{{$wss->nama}}</span>
@endforeach
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
    Akses
    </h1>
  </section>
  <section class="content">
    @if (session('msg'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Info!</h4>
      {{ session('msg') }}
    </div>
    @endif
    <div class="box box-primary">
      
      <div class="box-body">
        <div class="row">
          @foreach($data as $row)
          @php
          $kode = Crypt::encrypt($row->id);
          @endphp
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>
                  <?php $akses = DB::table('akses')->where('id_roles',$row->id)->count();
                  echo $akses." akses";
                  ?>
                </h3>
                <p>{{$row->nama}}</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <a href="{{url('akses/'.$kode)}}" class="small-box-footer">
                Ubah Akses <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
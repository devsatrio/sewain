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
        Dashboard
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
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$jumlahuser}}</h3>

              <p>Pengguna</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$jumlahtoko}}</h3>

              <p>Toko</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$jumlahadmin}}</h3>

              <p>Admin</p>
            </div>
            <div class="icon">
              <i class="fa fa-child"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>-</h3>

              <p>Ulasan</p>
            </div>
            <div class="icon">
              <i class="fa fa-heart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    	<div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>
			  <h3 class="box-title">To Do List</h3>
			</div>
            <div class="box-body">
              <ul class="todo-list ui-sortable">
                <li>
                  <span class="text">Halaman User</span>
                </li>
              </ul>
            </div>
          </div>
    </section>
</div>
@endsection
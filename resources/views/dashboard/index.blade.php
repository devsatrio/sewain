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
    	<div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>
			  <h3 class="box-title">To Do List</h3>
			</div>
            <div class="box-body">
              <ul class="todo-list ui-sortable">
                <li>
                  <span class="text">Update profile admin</span>
                </li>
                <li>
                  <span class="text">CRUD Artikel</span>
                </li>
                <li>
                  <span class="text">About Us</span>
                </li>
              </ul>
            </div>
          </div>
    </section>
</div>
@endsection
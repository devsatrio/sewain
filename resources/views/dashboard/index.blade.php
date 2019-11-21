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
    </section>
</div>
@endsection
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
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content"><br>
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
            <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="{{url('dashboard')}}">return to dashboard</a> or try using the search form.
          </p>
        </div>
      </div>
    </section>
  </div>
@endsection
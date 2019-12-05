@extends('layouts.app_user')
@section('title')
@foreach($websetting as $ws)
<title>{{$ws->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$ws->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('head')
@foreach($websetting as $ws)
<a href="{{url('/')}}" class="js-logo-clone">{{$ws->nama}}</a>
@endforeach
@endsection
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Edit Password</h2>
                <div class="p-3 p-lg-5 border">
                    @if (session('msg'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>Info!</h4>
                        {{ session('msg') }}
                    </div>
                    @endif
                    @php
                    $kode = Crypt::encrypt(Auth::guard('pengguna')->user()->id);
                    @endphp
                    <form action="{{url('/edit-password/'.$kode)}}" method="post" onsubmit="return validasiform()">
                        @csrf
                        <div class="form-group">
                            <label for="c_country" class="text-black">Password Lama</label>
                            <input type="password" class="form-control" name="oldpass" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Password Baru</label>
                            <input type="password" class="form-control" name="newpass" id="pass" minlength="6" pattern="[a-zA-Z0-9]+" required>
                            <span class="help-block">*minimal 6 karakter dan berupa huruf atau angka</span>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Konfirmasi Password Baru</label>
                            <input type="password" id="kpass" class="form-control" name="knewpass" required>
                            <span class="help-block text-danger" id="errorkpass"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                            <button class="btn btn-danger" type="button" onclick="history.go(-1)">Kembali</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
@endsection
@section('customjs')
<script src="{{asset('user_assets/custom/editpassword.js')}}"></script>
@endsection
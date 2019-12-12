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
            
            <div class="col-md-5">
                <h2 class="h3 mb-3 text-black">Login</h2>
                @error('username')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                    Maaf Username atau Password Salah.
                </div>
                @enderror
                @error('password')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                    Maaf Username atau Password Salah.
                </div>
                @enderror
                <form method="POST" action="{{ route('pengguna-login')}}">
                    @csrf
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_lname" class="text-black">Username</label>
                                <input type="text" class="form-control" id="c_lname" name="username" autocomplete="new-username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_email" class="text-black">Password</label>
                                <input type="password" class="form-control" id="c_email" name="password" autocomplete="new-password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7 ml-auto">
                <h2 class="h3 mb-3 text-black">Buat Akun Baru</h2>
                @if(session('successmsg'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('successmsg') }}
                </div>
                @endif
                <form method="POST" action="{{route('pengguna.register')}}" onsubmit="return validasiform()">
                    @csrf
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_fname" class="text-black">Nama</label>
                                <input type="text" class="form-control" id="c_fname" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_fname" class="text-black">Username</label>
                                <input type="text" class="form-control" id="c_fname" name="username" minlength="6" pattern="[a-zA-Z0-9]+" required>
                                <span class="help-block">*Gunakan huruf atau angka saja & min 6 karakter</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_email" class="text-black">Email</label>
                                <input type="email" class="form-control" id="c_email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_subject" class="text-black">Password </label>
                                <input type="password" class="form-control" id="pass" autocomplete="new-password" minlength="8" name="password" required>
                                <span class="help-block">*minimal 8 karakter</span>
                            </div>
                        </div>
                        <div class="form-group row" id="grubkpass">
                            <div class="col-md-12">
                                <label for="c_subject" class="text-black">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="kpass" name="password_confirmation" required>
                                <span class="help-block text-danger" id="errorkpass"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button type="submit" id="submitbutton" class="btn btn-primary btn-lg btn-block">Daftar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
 <script src="{{asset('user_assets/custom/login.js')}}"></script>
@endsection
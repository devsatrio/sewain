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
                <h2 class="h3 mb-3 text-black">Edit Akun</h2>
                <div class="p-3 p-lg-5 border">
                    <form action="">
                        <div class="form-group">
                            <label for="c_country" class="text-black">Nama</label>
                            <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->name}}" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Username</label>
                            <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->username}}" name="useraname" minlength="6" pattern="[a-zA-Z0-9]+" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Email</label>
                            <input type="email" class="form-control" value="{{Auth::guard('pengguna')->user()->email}}" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Alamat</label>
                            <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->alamat}}" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">No.Telpon</label>
                            <input type="number" min="0" class="form-control" value="{{Auth::guard('pengguna')->user()->telp}}" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{Auth::guard('pengguna')->user()->tgl_lahir}}" name="tgl" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Jenis Kelamin</label><br>
                            <label>
                                <input type="radio" name="jekel" value="Pria" @if(Auth::guard('pengguna')->user()->gender=='Pria')checked @endif> Pria
                            </label>&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="jekel" value="Wanita" @if(Auth::guard('pengguna')->user()->gender=='Wanita')checked @endif> Wanita
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Foto Profile</label>
                            <input type="file" id="photo" name="foto" class="form-control" accept="image/*">
                            <span class="help-block" id="errorfoto">*Isi apabila ingin mengganti foto profile</span>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">*Foto KTP</label>
                            <input type="file" id="ktpphoto" class="form-control" accept="image/*">
                            <span class="help-block" id="errorktpfoto">*Isi apabila ingin mengganti</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Simpan Perubahan</button>

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
<script src="{{asset('user_assets/custom/editakun.js')}}"></script>
@endsection
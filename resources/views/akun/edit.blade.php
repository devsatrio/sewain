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
@section('customcss')
<link href="{{asset('admin_assets/custom/loading.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 mb-md-0">
                <div class="loading-div" id="panelnya">
                    <h2 class="h3 mb-3 text-black">Edit Akun</h2>
                    <div class="p-3 p-lg-5 border">
                        @php
                        $kode = Crypt::encrypt(Auth::guard('pengguna')->user()->id);
                        @endphp
                        <form action="{{url('/edit-akun/'.$kode)}}" method="post" enctype="multipart/form-data" onsubmit="return checkform(this);">
                            @csrf
                            <div class="form-group">
                                <label for="c_country" class="text-black">Nama</label>
                                <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->name}}" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Username</label>
                                <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->username}}" name="usern" minlength="6" pattern="[a-zA-Z0-9]+" required>
                                <span class="help-block">*minimal 6 karakter & alphanumerik</span>
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
                                <input type="number" min="0" class="form-control" value="{{Auth::guard('pengguna')->user()->telp}}" name="telp" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Tanggal Lahir</label>
                                <input type="date" class="form-control" value="{{Auth::guard('pengguna')->user()->tgl_lahir}}" name="tgllahir" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jenis Kelamin</label><br>
                                <label>
                                    <input type="radio" name="gender" value="Pria" @if(Auth::guard('pengguna')->user()->gender=='Pria')checked @endif>  <i class="icon icon-male"></i> Pria
                                </label>&nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="gender" value="Wanita" @if(Auth::guard('pengguna')->user()->gender=='Wanita')checked @endif> <i class="icon icon-female"></i> Wanita
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="text-black">*Foto Profile</label><br>
                                <div id="tempatfoto">
                                    @if(Auth::guard('pengguna')->user()->foto!='')
                                    <br>
                                    <img src="{{asset('image/pengguna/'.Auth::guard('pengguna')->user()->foto)}}" style="max-width: 100%;">
                                    <br><br>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-success" onclick="document.getElementById('photo').click();">
                                <i class="icon icon-upload"></i> Upload Gambar
                                </button>
                                <input type="file" id="photo" name="foto" class="form-control" accept="image/*" onchange="photouploaded(this)" style="display: none;">
                                <input type="hidden" name="fotolama" value="{{Auth::guard('pengguna')->user()->foto}}">
                                <br>
                                <span class="help-block" id="errorfoto">*Isi apabila ingin mengganti foto profile</span>
                            </div>
                            <div class="form-group">
                                <label class="text-black">*Foto KTP</label>
                                <div id="tempatfotoktp">
                                @if(Auth::guard('pengguna')->user()->foto_ktp!='')
                                <br>
                                <img src="{{asset('image/ktp/'.Auth::guard('pengguna')->user()->foto_ktp)}}" style="max-width: 100%;">
                                <br><br>
                                @endif
                                </div>
                                <button type="button" class="btn btn-success" onclick="document.getElementById('ktpphoto').click();">
                                <i class="icon icon-upload"></i> Upload Gambar KTP
                                </button>
                                <input type="file" id="ktpphoto" class="form-control" accept="image/*" name="ktpfoto" style="display: none;" onchange="photoktpuploaded(this)">
                                <input type="hidden" name="ktpfotolama" value="{{Auth::guard('pengguna')->user()->foto_ktp}}">
                                <br><span class="help-block" id="errorktpfoto">*Isi apabila ingin mengganti foto KTP</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary" name="submitbutton" id="submitbutton" type="submit">Simpan Perubahan</button>
                                <button class="btn btn-danger" type="button" onclick="history.go(-1)">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
<script src="{{asset('user_assets/custom/editakun.js')}}"></script>
@endsection
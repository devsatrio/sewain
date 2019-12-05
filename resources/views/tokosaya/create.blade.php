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
                <h2 class="h3 mb-3 text-black">Buat Toko</h2>
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
                            <label for="c_country" class="text-black">Nama</label>
                            <input type="text" class="form-control" name="oldpass" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Deskripsi</label>
                            <textarea name="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Provinsi</label>
                            <select name="provinsi" class="form-control" id="provinsi">
                                    <option selected disabled>pilih provinsi</option>
                                    @foreach($dataprovinsi as $dpv)
                                    <option value="{{$dpv->id}}">{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Kota</label>
                            <select name="kota" class="form-control select2" style="width: 100%;" id="kota">
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Hari Buka</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="senin"> Senin
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="selasa"> Selasa
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="rabu"> Rabu
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="kamis"> Kamis
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="jumat"> Jumat
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="sabtu"> Sabtu
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="haribuka[]" value="minggu"> Minggu
                                    </label>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Jam Buka</label>
                            <input type="text" class="form-control" name="oldpass" required>
                        </div>
                       <div class="form-group">
                            <label for="c_country" class="text-black">Jam Tutup</label>
                            <input type="text" class="form-control" name="oldpass" required>
                        </div>
                        <div class="form-group">
                            <label for="c_country" class="text-black">Logo Toko</label>
                            <input type="file" class="form-control" name="oldpass" required>
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
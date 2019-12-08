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
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/select2/dist/css/select2.min.css')}}">
<link href="{{asset('admin_assets/custom/loading.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 mb-md-0">
                <div class="loading-div" id="panelnya">
                    <h2 class="h3 mb-3 text-black">Edit Informasi Toko</h2>
                    <div class="p-3 p-lg-5 border">
                        @if(session('msg'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Info!</h4>
                            {{ session('msg') }}
                        </div>
                        @endif
                        @foreach($data as $row)
                        @php
                        $kode = Crypt::encrypt($row->id);
                        @endphp
                        <form action="{{url('edit-toko/'.$kode)}}" method="post" enctype="multipart/form-data" onsubmit="return validasiform()">
                            @csrf
                            <div class="form-group">
                                <label for="c_country" class="text-black">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{$row->nama}}" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control">{!!$row->deskripsi!!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Provinsi</label>
                                <select name="provinsi" class="form-control select2" style="width: 100%;" id="provinsi">
                                    <option selected disabled>pilih provinsi</option>
                                    @foreach($dataprovinsi as $dpv)
                                    <option value="{{$dpv->id}}" @if($row->provinsi==$dpv->id) selected @endif>{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Kota</label>
                                <select name="kota" class="form-control select2" style="width: 100%;" id="kota">
                                    @foreach($datakota as $dk)
                                    <option value="{{$dk->id}}" @if($row->kota==$dk->id) selected @endif>{{$dk->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control">{!!$row->alamat!!}</textarea>
                            </div>
                            <div class="form-group">
                                <?php
                            $hari = explode(',',$row->hari_buka);
                            ?>
                                <label for="c_country" class="text-black">Hari Buka</label>
                                <div class="checkbox">
                                    <label>
                                        <?php
                                        $senin = 'n';
                                        for ($i=0; $i < count($hari); $i++) {
                                        if ($hari[$i]=='senin'){
                                        $senin='y';
                                        }
                                        }
                                        if ($senin!='y') { ?>
                                        <input type="checkbox" name="haribuka[]" value="senin"> Senin
                                        <?php }else{ ?>
                                        <input type="checkbox" name="haribuka[]" value="senin" checked> Senin
                                        <?php } ?>
                                        
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php
                                        $selasa = 'n';
                                        for ($i=0; $i < count($hari); $i++) {
                                        if ($hari[$i]=='selasa'){
                                        $selasa='y';
                                        }
                                        }
                                        if ($selasa!='y') { ?>
                                        <input type="checkbox" name="haribuka[]" value="selasa"> Selasa
                                        <?php }else{ ?>
                                        <input type="checkbox" name="haribuka[]" value="selasa" checked> Selasa
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php
                                        $rabu = 'n';
                                        for ($i=0; $i < count($hari); $i++) {
                                        if ($hari[$i]=='rabu'){
                                        $rabu='y';
                                        }
                                        }
                                        if ($rabu!='y') { ?>
                                        <input type="checkbox" name="haribuka[]" value="rabu"> Rabu
                                        <?php }else{ ?>
                                        <input type="checkbox" name="haribuka[]" value="rabu" checked> Rabu
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php
                                        $kamis = 'n';
                                        for ($i=0; $i < count($hari); $i++) {
                                        if ($hari[$i]=='kamis'){
                                        $kamis='y';
                                        }
                                        }
                                        if ($kamis!='y') { ?>
                                        <input type="checkbox" name="haribuka[]" value="kamis"> Kamis
                                        <?php }else{ ?>
                                        <input type="checkbox" name="haribuka[]" value="kamis" checked> Kamis
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php
                                        $jumat = 'n';
                                        for ($i=0; $i < count($hari); $i++) {
                                        if ($hari[$i]=='jumat'){
                                        $jumat='y';
                                        }
                                        }
                                        if ($jumat!='y') { ?>
                                        <input type="checkbox" name="haribuka[]" value="jumat"> Jumat
                                        <?php }else{ ?>
                                        <input type="checkbox" name="haribuka[]" value="jumat" checked> Jumat
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php
                                        $sabtu = 'n';
                                        for ($i=0; $i < count($hari); $i++) {
                                        if ($hari[$i]=='sabtu'){
                                        $sabtu='y';
                                        }
                                        }
                                        if ($sabtu!='y') { ?>
                                        <input type="checkbox" name="haribuka[]" value="sabtu"> Sabtu
                                        <?php }else{ ?>
                                        <input type="checkbox" name="haribuka[]" value="sabtu" checked> Sabtu
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php
                                        $minggu = 'n';
                                        for ($i=0; $i < count($hari); $i++) {
                                        if ($hari[$i]=='minggu'){
                                        $minggu='y';
                                        }
                                        }
                                        if ($minggu!='y') { ?>
                                        <input type="checkbox" name="haribuka[]" value="minggu"> Minggu
                                        <?php }else{ ?>
                                        <input type="checkbox" name="haribuka[]" value="minggu" checked> Minggu
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jam Buka</label>
                                <input type="time" class="form-control" name="jambuka" value="{{$row->jam_buka}}" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jam Tutup</label>
                                <input type="time" class="form-control" name="jamtutup" value="{{$row->jam_tutup}}" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">*Logo Toko Baru</label>
                                @if($row->logo!='')
                                <br>
                                <img src="{{asset('image/toko/'.$row->logo)}}" style="max-width: 100%;">
                                <br><br>
                                @endif
                                <input type="file" class="form-control" name="foto" accept="image/*" id="photo">
                                <input type="hidden" name="oldlogo" value="{{$row->logo}}">
                                <span class="help-block" id="errorfoto">*Isi apabila ingin mengganti logo foto</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="submitbutton">Simpan</button>
                                <button class="btn btn-danger" type="button" onclick="history.go(-1)">Kembali</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
<script src="{{asset('user_assets/custom/useredittoko.js')}}"></script>
@endsection
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
@section('css')
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link href="{{asset('admin_assets/custom/loading.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Toko
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Toko</h3>
            </div>
            @foreach($data as $row)
            @php
            $kode = Crypt::encrypt($row->id);
            @endphp
            <div class="loading-div" id="panelnya">
                <form class="form-horizontal" method="post" action="{{url('toko/'.$kode)}}" onsubmit="return validasiform()" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Toko</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$row->nama}}" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Pemilik Toko</label>
                            <div class="col-sm-10">
                                <select name="pemilik" class="form-control select2" style="width: 100%;" id="pemilik">
                                    @foreach($datapengguna as $dp)
                                    <option value="{{$dp->id}}" @if($row->id_pengguna==$dp->id) selected @endif>{{$dp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control">{!!$row->deskripsi!!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select name="provinsi" class="form-control select2" style="width: 100%;" id="provinsi">
                                    @foreach($dataprovinsi as $dpv)
                                    <option value="{{$dpv->id}}" @if($row->provinsi==$dpv->id) selected @endif>{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kota</label>
                            <div class="col-sm-10">
                                <select name="kota" class="form-control select2" style="width: 100%;" id="kota">
                                    @foreach($datakota as $dk)
                                    <option value="{{$dk->id}}" @if($row->kota==$dk->id) selected @endif>{{$dk->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Alamat Lengkap</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" class="form-control">{!!$row->alamat!!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $hari = explode(',',$row->hari_buka);
                            ?>
                            <label for="inputEmail3" class="col-sm-2 control-label">Hari Buka</label>
                            <div class="col-sm-10">
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
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jam Buka</label>
                            <div class="col-sm-10">
                                <input type="text" name="jambuka" value="{{$row->jam_buka}}" class="form-control timepicker" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jam Tutup</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$row->jam_tutup}}" name="jamtutup" class="form-control timepicker" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Verivikasi</label>
                            <div class="col-sm-10">
                                <select name="verivikasi" class="form-control">
                                    <option value="Ya" @if($row->verivikasi_status=='Ya') selected @endif>Ya</option>
                                    <option value="Tidak" @if($row->verivikasi_status=='Tidak') selected @endif>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control">
                                    <option value="Aktif" @if($row->status=='Aktif') selected @endif>Aktif</option>
                                    <option value="Tidak Aktif" @if($row->status=='Tidak Aktif') selected @endif>
                                    Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Status</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan_status" class="form-control">{{$row->deskripsi_status}}</textarea>
                            </div>
                        </div>
                        <div class="form-group" id="grubfoto">
                            <label for="inputEmail3" class="col-sm-2 control-label">Logo Toko</label>
                            <div class="col-sm-10">
                                <img src="{{asset('image/toko/thumbnail/'.$row->logo)}}" alt="">
                                <input type="file" class="form-control" name="foto" accept="image/*" id="photo">
                                <input type="hidden" name="oldlogo" value="{{$row->logo}}">
                                <span class="help-block" id="errorfoto"></span>
                            </div>
                        </div>
                        <input type="hidden" name="_method" value="put">
                        @csrf
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
@section('js')
<script src="{{asset('admin_assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/toko.js')}}"></script>
@endsection
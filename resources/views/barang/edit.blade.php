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
        Barang
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Data Barang</h3>
            </div>
            <div class="loading-div" id="panelnya">
                @foreach($databarang as $row)
                @php
                $kodebarangnya = $row->kode;
                @endphp
                <form class="form-horizontal" method="post" action="{{url('barang/'.$row->kode)}}">
                    <div class="box-body">
                        <h4>Detail Barang</h4>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$row->kode}}" class="form-control" name="kode" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Toko</label>
                            <div class="col-sm-10">
                                <select name="toko" class="form-control select2" style="width: 100%;" id="toko">
                                    @foreach($toko as $dp)
                                    <option value="{{$dp->id}}" @if($row->id_toko==$dp->id) selected @endif>{{$dp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$row->nama}}" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
                            <div class="col-sm-10">
                                <select name="kategori" class="form-control select2" style="width: 100%;" id="kategori">
                                    @foreach($kategori as $dpv)
                                    <option value="{{$dpv->id}}" @if($row->kategori==$dpv->id) selected @endif>{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sub Kategori</label>
                            <div class="col-sm-10">
                                <select name="subkategori" class="form-control select2" style="width: 100%;" id="subkategori">
                                    @foreach($datasubkategori as $dsk)
                                    <option value="{{$dsk->id}}" @if($row->sub_kategori==$dsk->id) selected @endif>{{$dsk->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control">{{$row->deskripsi}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jaminan</label>
                            <div class="col-sm-10">
                                <textarea name="jaminan" class="form-control">{{$row->jaminan}}</textarea>
                            </div>
                        </div>
                        @csrf
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Paket Harga</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Paket</th>
                            <th>Durasi</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Diskon</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($datadetail as $row2)
                        @php
                        $newkode = Crypt::encrypt($row2->id);
                        @endphp
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td>
                                {{$row2->nama}}
                            </td>
                            <td>
                                {{$row2->durasi}} {{$row2->satuan}}
                            </td>
                            <td class="text-center">
                                {{"Rp ".number_format($row2->harga,0,',','.')}}
                            </td>
                            <td class="text-center">
                                {{$row2->diskon}} %
                            </td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#modal-edit{{$row2->id}}"><i class="fa fa-wrench"></i>
                                </button>
                                <a onclick="return confirm('Hapus Data ?')" class="btn btn-xs btn-danger" href="{{url('barang/hapusdetail/'.$newkode)}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @foreach($datadetail as $row3)
            <div class="modal fade" id="modal-edit{{$row3->id}}" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" method="post" action="{{Route('edit-detail-barang')}}">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Edit Data Paket</h4>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Nama Paket</label>
                                        <input type="text" class="form-control" name="nama" value="{{$row3->nama}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Durasi</label>
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="durasi" value="{{$row3->durasi}}">
                                            </div>
                                            <div class="col-xs-5">
                                                <select name="satuanpaket" class="form-control">
                                                    <option value="Jam" @if($row3->satuan=="Jam") selected @endif>Jam
                                                    </option>
                                                    <option value="Hari" @if($row3->satuan=="Hari") selected @endif>Hari</option>
                                                    <option value="Bulan" @if($row3->satuan=="Bulan") selected @endif>Bulan</option>
                                                    <option value="Tahun" @if($row3->satuan=="Tahun") selected @endif>Tahun</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga" value="{{$row3->harga}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Diskon</label>
                                        <input type="number" class="form-control" name="diskon" value="{{$row3->diskon}}" required>
                                    </div>
                                    <input type="hidden" value="{{$row3->id}}" name="kodeb">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Edit Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">List Foto</h3>
            </div>
            <div class="box-body">
                @if (session('msgfoto'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('msg') }}
                </div>
                @endif
                <ul class="todo-list ui-sortable">
                    @foreach($datafoto as $foto)
                    <li>
                        <img src="{{asset('image/barang/thumbnail/'.$foto->nama)}}" alt="">
                        <span class="text">{{$foto->nama}}</span>
                        @if($foto->default=='Y')
                        <small class="label label-success">Foto Utama</small>
                        @endif
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="box-footer clearfix no-border">
                <button type="button" class="btn btn-default pull-right"  data-toggle="modal" data-target="#modal-tambahfoto"><i class="fa fa-plus"></i> Tambah Foto</button>
            </div>
        </div>
        <div class="modal fade" id="modal-tambahfoto" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" action="{{url('barang/updatefoto')}}" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Tambah foto</h4>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" accept="image/*" required>
                                </div>
                                <input type="hidden" value="{{$kodebarangnya}}" name="kodeb">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Edit Data</button>
                        </div>
                    </form>
                </div>
            </div>
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
<script src="{{asset('admin_assets/custom/editbarang.js')}}"></script>
@endsection
@extends('layouts.app_user')
@section('title')
<title>{{$websetting->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$websetting->icon)}}" rel="icon" type="image/png">
@endsection
@section('head')
<a href="{{url('/')}}" class="js-logo-clone">{{$websetting->nama}}</a>
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
                    <h2 class="h3 mb-3 text-black">Edit Produk</h2>
                    <div class="p-3 p-lg-5 border">
                        @if (session('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Info!</h4>
                            {{ session('msg') }}
                        </div>
                        @endif
                        <h4>Detail Barang</h4>
                        <form action="{{url('edit-detail-produk/'.$databarang->kode)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="c_country" class="text-black">Kode Produk</label>
                                <input type="text" value="{{$databarang->kode}}" class="form-control" name="kode" readonly>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Nama Produk</label>
                                <input type="text" class="form-control" name="nama" value="{{$databarang->nama}}" required>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Kategori</label>
                                <select name="kategori" class="form-control select2" style="width: 100%;" id="kategori">
                                    <option selected disabled>pilih kategori</option>
                                    @foreach($kategori as $dpv)
                                    <option value="{{$dpv->id}}" @if($dpv->id==$databarang->kategori) selected @endif>{{$dpv->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Sub Kategori</label>
                                <select name="subkategori" class="form-control select2" style="width: 100%;" id="subkategori">
                                    @foreach($datasubkategori as $dsk)
                                    <option value="{{$dsk->id}}" @if($databarang->sub_kategori==$dsk->id) selected @endif>{{$dsk->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control">{!!$databarang->deskripsi!!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jaminan</label>
                                <textarea name="jaminan" class="form-control">{!!$databarang->jaminan!!}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="submitbutton">Simpan Perubahan</button>
                                <a class="btn btn-danger" href="{{url('produk-saya')}}">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="p-3 p-lg-5 border">
                    <h4>Detail harga</h4>
                    @if (session('msgdetail'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>Info!</h4>
                        {{ session('msgdetail') }}
                    </div>
                    @endif
                    @if($jumlahdetail<5)
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahpaket">Tambah Paket</button>
                    <br><br>
                    @endif
                    <div class="site-blocks-table">
                        <table class="table table-bordered" style="max-width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Paket</th>
                                    <th>Durasi</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datadetail as $dtl)
                                <tr>
                                    <td>
                                        {{$dtl->nama}}
                                    </td>
                                    <td>
                                        {{$dtl->durasi}} {{$dtl->satuan}}
                                    </td>
                                    <td>
                                        {{$dtl->harga}}
                                    </td>
                                    <td>{{$dtl->diskon}}%</td>
                                    <td>
                                        
                                        <button
                                        type="button"
                                        class="btn btn-success btn-sm tomboledit"
                                        data-kode="{{$dtl->id}}"
                                        data-nama="{{$dtl->nama}}"
                                        data-durasi="{{$dtl->durasi}}"
                                        data-satuan="{{$dtl->satuan}}"
                                        data-harga="{{$dtl->harga}}"
                                        data-diskon="{{$dtl->diskon}}">
                                        <span class="icon icon-wrench"></span>
                                        </button>
                                        <button
                                        type="button"
                                        class="btn btn-danger btn-sm tombolhapus"
                                        data-kode="{{$dtl->id}}">
                                        <span class="icon icon-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <h4>Detail Foto</h4><hr>
                @if (session('msgfoto'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('msgfoto') }}
                </div>
                @endif
                @if($jumlahfoto < 4)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambahfoto">Tambah Foto</button><br><br>
                @endif
                <div class="row mb-5">
                    @foreach($datafoto as $dft)
                    <div class="col-sm-6 col-lg-3 mb-3" data-aos="fade-up">
                        <div class="block-4 text-center border">
                            <figure class="block-4-image">
                                <img src="{{asset('image/barang/'.$dft->nama)}}" alt="Image placeholder" class="img-fluid" style="max-width: 100%;">
                            </figure>
                            <div class="block-4-text p-4">
                                @if($dft->default=='Y')
                                <button type="button" 
                                class="btn btn-success btn-sm tomboleditfoto"
                                data-kode="{{$dft->id}}"
                                data-nama="{{$dft->nama}}"
                                data-status="{{$dft->default}}">
                                    <span class="icon icon-wrench"></span>
                                </button>
                                
                                @else
                                <button type="button" 
                                class="btn btn-success btn-sm tomboleditfoto"
                                data-kode="{{$dft->id}}"
                                data-nama="{{$dft->nama}}"
                                data-status="{{$dft->default}}">
                                    <span class="icon icon-wrench"></span>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm tombolhapusfoto" data-kode="{{$dft->id}}"><span class="icon icon-trash"></span></button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a class="btn btn-danger" href="{{url('produk-saya')}}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-tambahpaket" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="{{url('tambah-detail-produk/'.$databarang->kode)}}" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Paket</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="text-black">Nama Paket</label>
                            <input type="text" class="form-control" name="namapaket" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">Durasi</label>
                                <input type="number" min="0" class="form-control" name="durasipaket" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Satuan</label>
                                <select name="satuanpaket" class="form-control">
                                    <option value="Jam">Jam</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="text-black">Harga</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="number" min="0" class="form-control" name="hargapaket" required>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="text-black">Diskon</label>
                            <div class="input-group">
                                <input type="number" min="0" max="99" class="form-control" value="0" name="diskonpaket" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-ubahpaket" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="{{url('ubah-detail-produk')}}" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Paket</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="text-black">Nama Paket</label>
                            <input type="text" class="form-control" name="namapaket" id="namapaket" required>
                            <input type="hidden" name="kodepaket" id="kodepaket" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">Durasi</label>
                                <input type="number" min="0" class="form-control" name="durasipaket" id="durasipaket" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Satuan</label>
                                <select name="satuanpaket" id="satuanpaket" class="form-control">
                                    <option value="Jam">Jam</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="text-black">Harga</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="number" id="hargapaket" min="0" class="form-control" name="hargapaket" required>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="text-black">Diskon</label>
                            <div class="input-group">
                                <input type="number" min="0" max="99" class="form-control" value="0" id="diskonpaket" name="diskonpaket" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-hapuspaket" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="{{url('hapus-detail-produk')}}" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Paket ?</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="box-body text-center">
                        <h1 class="text-danger"><span class="icon icon-warning"></span></h1>
                        <p>Kami tidak dapat memulihkan kembali data ini, Jadi yakin nih mau hapus data ?</p>
                        <input type="hidden" name="kodepaket" id="kodepakethapus" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Ya, Saya Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-tambahfoto" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="{{url('tambah-foto-produk/'.$databarang->kode)}}" enctype="multipart/form-data" onsubmit="return validtambahfoto()">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Foto</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="box-body text-center">
                        <div class="form-group">
                            <div id="tempatfoto"></div><br>
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('photo').click();">
                            <i class="icon icon-upload"></i> Upload Gambar
                            </button><br>
                            <span class="help-block text-danger" id="errorfoto"></span>
                            <input type="file" id="photo" name="photo" onchange="imgphoto(this)" style="display:none;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-hapusfoto" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="{{url('hapus-foto-produk')}}">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Foto ?</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="box-body text-center">
                        <h1 class="text-danger"><span class="icon icon-warning"></span></h1>
                        <p>Kami tidak dapat memulihkan foto ini, Jadi yakin nih mau hapus foto ?</p>
                        <input type="hidden" name="kodefoto" id="kodefotohapus" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Ya, Saya Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-editfoto" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="{{url('ubah-foto-produk')}}" onsubmit="return valideditfoto()" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Foto</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="box-body text-center">
                        <div class="form-group">
                            <div id="tempateditfoto"></div><br>
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('photoedit').click();">
                            <i class="icon icon-upload"></i> Upload Gambar
                            </button><br>
                            <span class="help-block text-danger" id="errorfotoedit"></span>
                            <input type="file" id="photoedit" name="photo" onchange="imgphotoedit(this)" style="display:none;">
                            <input type="hidden" id="kodeedit" name="kode">
                            <input type="hidden" id="oldfoto" name="oldfoto">
                            <input type="hidden" id="statusfoto" name="status">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin_assets/custom/loading.js')}}"></script>
<script src="{{asset('user_assets/custom/ubahproduk.js')}}"></script>
@endsection
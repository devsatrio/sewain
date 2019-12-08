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
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Detail Akun</h2>
                <div class="p-3 p-lg-5 border">
                    @if (session('msg'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>Info!</h4>
                        {{ session('msg') }}
                    </div>
                    @endif
                    @if(Auth::guard('pengguna')->user()->alamat=='')
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                        Silahkan melengkapi identitas, anda tidak dapat membuat toko tanpa identitas lengkap.
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Nama</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Username</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->username}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Email</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->email}}" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <a class="btn btn-primary btn-lg py-3 btn-block" href="{{url('edit-akun')}}">Edit Profile</a>
                    </div>
                    @else
                    <div class="block-38 text-center">
                        <div class="block-38-img">
                            <div class="block-38-header">
                                @if(Auth::guard('pengguna')->user()->foto!='')
                                <img src="{{asset('image/pengguna/thumbnail/'.Auth::guard('pengguna')->user()->foto)}}" alt="Image placeholder" class="mb-4">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Nama</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Username</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->username}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Email</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">No. Telfon</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->telp}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Alamat</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->alamat}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Tanggal Lahir</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->tgl_lahir}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{Auth::guard('pengguna')->user()->gender}}" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <a class="btn btn-primary btn-lg py-3 btn-block" href="{{url('edit-akun')}}">Edit Profile</a>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-warning btn-lg py-3 btn-block" href="{{url('edit-password')}}">Ganti Password</a>
                    </div>
                    @endif
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Detail Toko</h2>
                        <div class="p-3 p-lg-5 border">
                            @if (session('msgtoko'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>Info!</h4>
                                {{ session('msgtoko') }}
                            </div>
                            @endif
                            @if(Auth::guard('pengguna')->user()->alamat=='')
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                                Silahkan melengkapi identitas terlebih dahulu.
                            </div>
                            @else
                            @if($jumlahtoko>0)
                            @php
                            $tokonya = DB::table('toko')
                            ->select(DB::raw('toko.*,provinsi.nama as namaprov,kota.nama as namakota'))
                            ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
                            ->leftjoin('kota','kota.id','=','toko.kota')
                            ->where('toko.id_pengguna',Auth::guard('pengguna')->user()->id)
                            ->get();
                            @endphp
                            @foreach($tokonya as $tky)
                            @php
                            $kodetoko = Crypt::encrypt($tky->id);
                            @endphp
                            <div class="block-38 text-center">
                                <div class="block-38-img">
                                    <div class="block-38-header">
                                        @if($tky->logo!='')
                                        <img src="{{asset('image/toko/thumbnail/'.$tky->logo)}}" alt="Image placeholder" class="mb-4">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Nama Toko</label>
                                <input type="text" class="form-control" value="{{$tky->nama}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Provinsi</label>
                                <input type="text" class="form-control" value="{{$tky->namaprov}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Kota</label>
                                <input type="text" class="form-control" value="{{$tky->namakota}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Alamat</label>
                                <textarea class="form-control" readonly>{{$tky->alamat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Hari Buka</label>
                                <textarea class="form-control" readonly>{{substr($tky->hari_buka,0,-1)}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_country" class="text-black">Jam Buka</label>
                                <input type="text" class="form-control" value="{{$tky->jam_buka}} - {{$tky->jam_tutup}}" readonly>
                            </div>
                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Deskripsi Toko</a></h3>
                                <div class="collapse" id="collapsebank">
                                    <div class="py-2">
                                        <p class="mb-0">{{$tky->deskripsi}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary btn-lg py-3 btn-block" href="{{url('/edit-toko')}}">Edit Informasi Toko</a>
                                <button class="btn btn-danger btn-lg py-3 btn-block" type="button" data-toggle="modal" data-target="#hapustoko">Hapus Toko</button>
                            </div>
                            <div class="modal fade" id="hapustoko" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{url('hapus-toko')}}" method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus data ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Kami tidak dapat mengembalikan data toko, data barang atau kenangan toko anda, jadi yakin nih hapus toko ?
                                                <input type="hidden" name="kode" value="{{$kodetoko}}">
                                                @csrf
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Ya, Aku yakin</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="alert alert-info alert-dismissible">
                                <h4><i class="icon fa fa-ban"></i> Info!</h4>
                                Anda belum memiliki toko, buat toko sekarang.
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary btn-lg py-3 btn-block" href="{{url('buat-toko')}}">Buat Toko Sekarang!</a>
                            </div>
                            @endif
                            
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
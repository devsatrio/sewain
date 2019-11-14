@extends('layouts.app_admin')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Admin
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Admin</h3>
            </div>
            @foreach($data as $row)
             @php
              $kode = Crypt::encrypt($row->id);
             @endphp
            <form class="form-horizontal" method="post" action="{{url('admin/'.$kode)}}" onsubmit="return validasiform()">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{$row->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="usern" autocomplete="new-username" minlength="6" pattern="[a-zA-Z0-9]+"  placeholder="gunakan huruf atau angka saja & min 6 karakter" value="{{$row->username}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" value="{{$row->email}}" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">No. Telp</label>
                        <div class="col-sm-10">
                            <input type="number" value="{{$row->telp}}" class="form-control" name="telp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$row->alamat}}" class="form-control" name="alamat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level" class="form-control">
                                <option value="Admin" @if($row->level=='Admin') selected @endif>Admin</option>
                                <option value="Super Admin" @if($row->level=='Super Admin') selected @endif>Super Admin</option>
                                <option value="Programmer" @if($row->level=='Programmer') selected @endif>Programmer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">*Password Baru</label>
                        <div class="col-sm-10">
                            <input type="password" minlength="8" id="pass" class="form-control" name="pass" placeholder="minimal 8 karakter">
                            <span class="help-block">Isi apabila ingin mengganti password</span>
                        </div>
                    </div>
                    <div id="grubkpass" class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">*Konfirmasi Password Baru</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="kpass" autocomplete="new-password" id="kpass">
                            <span class="help-block" id="errorkpass"></span>
                        </div>
                    </div>
                    <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" onclick="tampilpassword()"> Tampilkan Password
                      </label>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="_method" value="PUT">
                    @csrf
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
        @endforeach
        </div>
    </section>
</div>
@endsection

@section('customjs')
 <script src="{{asset('admin_assets/custom/admin.js')}}"></script>
@endsection
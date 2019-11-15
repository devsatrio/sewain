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
            <form class="form-horizontal" method="post" action="{{url('admin')}}" onsubmit="return validasiform()" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="usern" autocomplete="new-username" minlength="6" pattern="[a-zA-Z0-9]+"  placeholder="gunakan huruf atau angka saja & min 6 karakter" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">No. Telp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="telp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level" class="form-control">
                                <option value="Admin">Admin</option>
                                <option value="Super Admin">Super Admin</option>
                                <option value="Programmer">Programmer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="grubfoto">
                        <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="foto" accept="image/*" id="photo" required>
                            <span class="help-block" id="errorfoto"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" minlength="8" id="pass" class="form-control" name="pass" placeholder="minimal 8 karakter" required>
                        </div>
                    </div>
                    <div id="grubkpass" class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="kpass" autocomplete="new-password" id="kpass" required>
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
                    @csrf
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('customjs')
 <script src="{{asset('admin_assets/custom/admin.js')}}"></script>
@endsection
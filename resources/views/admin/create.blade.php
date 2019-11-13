@extends('layouts.app_admin')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Admin
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Admin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
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
                            <input type="text" class="form-control" name="usern" autocomplete="new-username" required>
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
                            <input type="number" class="form-control" name="telp" required>
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
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="pass" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="kpass" autocomplete="new-password" required>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </section>
</div>
@endsection
@extends('layouts.app_admin')
@section('css')
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Admin
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Data Admin</h3>
                <div class="box-tools">
                <a href="{{url('admin/create')}}" class="btn btn-success">Tambah Data</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>No.Telp</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($data as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-default">
                                {{$row->username}}
                                </button>
                            </td>
                            <td>{{$row->telp}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->level}}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-xs"><i class="fa fa-wrench"></i></button>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    @endsection
    @section('js')
    <script src="{{asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    @endsection
    @section('customjs')
    <script>
    $(function () {
    $('#example1').DataTable()
    })
    </script>
    @endsection
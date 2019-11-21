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
        @if (session('msg'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Info!</h4>
            {{ session('msg') }}
        </div>
        @endif
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">List Data Admin</h3>
                <div class="box-tools">
                    <a href="{{url('admin/create')}}" class="btn btn-success">Tambah Data</a>
                </div></div>
                <div class="box-body"><table id="example1" class="table table-bordered table-striped">
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
                                <button
                                type="button"
                                class="btn btn-default btn-xs tampil-modal"
                                data-nama="{{$row->name}}"
                                data-username="{{$row->username}}"
                                data-telp="{{$row->telp}}"
                                data-email="{{$row->email}}"
                                data-alamat="{{$row->alamat}}"
                                data-level="{{$row->level}}"
                                data-foto="{{$row->foto}}">
                                {{$row->username}}
                                </button>
                            </td>
                            <td>{{$row->telp}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->level}}</td>
                            <td class="text-center">
                                @php
                                $kode = Crypt::encrypt($row->id);
                                @endphp
                                
                                <form action="{{url('/admin/'.$kode)}}" method="post">
                                    <a href="{{url('admin/'.$kode.'/edit')}}" class="btn btn-primary btn-xs"><i class="fa fa-wrench"></i></a>
                                    
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-detail" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-widget widget-user-2">
                    
                    <div class="widget-user-header bg-red">
                        <div class="widget-user-image">
                            <img id="fotonya" class="img-circle" src="{{asset('admin_assets/dist/img/user7-128x128.jpg')}}" alt="User Avatar">
                        </div>
                        <h3 class="widget-user-username" id="tampil_username"></h3>
                        <h5 class="widget-user-desc" id="tampil_nama"></h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li id="tampil_level"></li>
                            <li id="tampil_email"></li>
                            <li id="tampil_telp"></li>
                            <li id="tampil_alamat"></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/admin_view.js')}}"></script>
@endsection
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
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/select2/dist/css/select2.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Managemen Akses
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                @if (session('msg'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('msg') }}
                </div>
                @endif
                @if (session('msgerror'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('msgerror') }}
                </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        @foreach($dataroles as $dr)
                        <h3 class="box-title">List Akses {{$dr->nama}}</h3>
                        @endforeach
                    </div>
                    <div class="box-body"><table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                
                                <th>Modul</th>
                                <th>Permission</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach($data as $row)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td>{{$row->modul}}</td>
                                <td>{{$row->aksi}}</td>
                                <td class="text-center">
                                    @php
                                    $kode = Crypt::encrypt($row->id);
                                    @endphp
                                    
                                    <form action="{{url('/akses/'.$kode)}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{url('akses')}}" class="btn btn-danger">kembali</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                   @foreach($dataroles as $dr)
                        <h3 class="box-title">Tambah Akses {{$dr->nama}}</h3>
                        <?php $koderoles = $dr->id;?>
                    @endforeach
                </div>
                <form role="form" method="post" action="{{url('akses')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" name="roles" value="{{$koderoles}}">
                            <label for="exampleInputPassword1">permission</label>
                            <select name="permission" class="form-control select2">
                                @foreach($permission as $prm)
                                <option value="{{$prm->id}}">{{$prm->modul}} - {{$prm->aksi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</section>
</div>
@endsection
@section('js')
<script src="{{asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
@endsection
@section('customjs')
<script src="{{asset('admin_assets/custom/subkategori.js')}}"></script>
<script>
    $('.select2').select2();

</script>
@endsection
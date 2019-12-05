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
                    @else
                    <div class="block-38 text-center">
                    <div class="block-38-img">
                        <div class="block-38-header">
                            <img src="{{asset('image/pengguna/thumbnail/'.Auth::guard('pengguna')->user()->foto)}}" alt="Image placeholder" class="mb-4">
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
                    @endif
                    <br>
                    <div class="form-group">
                        <a class="btn btn-primary btn-lg py-3 btn-block" href="{{url('edit-akun')}}">Edit Profile</a>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-warning btn-lg py-3 btn-block" href="{{url('edit-password')}}">Ganti Password</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Detail Toko</h2>
                        <div class="p-3 p-lg-5 border">
                            @if(Auth::guard('pengguna')->user()->alamat=='')
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                                Silahkan melengkapi identitas terlebih dahulu.
                            </div>
                            @else
                            @if($jumlahtoko>0)

                            @else
                            <div class="alert alert-info alert-dismissible">
                                <h4><i class="icon fa fa-ban"></i> Info!</h4>
                                Anda belum memiliki toko, buat toko sekarang.
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary btn-lg py-3 btn-block" href="{{url('buat-toko')}}">Buat Toko Sekarang!</a>
                            </div>
                            @endif
                            <!-- <table class="table site-block-order-table mb-5">
                                <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Top Up T-Shirt <strong class="mx-2">x</strong> 1</td>
                                        <td>$250.00</td>
                                    </tr>
                                    <tr>
                                        <td>Polo Shirt <strong class="mx-2">x</strong>   1</td>
                                        <td>$100.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                        <td class="text-black">$350.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                        <td class="text-black font-weight-bold"><strong>$350.00</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>
                                <div class="collapse" id="collapsebank">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>
                                <div class="collapse" id="collapsecheque">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 mb-5">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>
                                <div class="collapse" id="collapsepaypal">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.html'">Place Order</button>
                            </div> -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
@endsection
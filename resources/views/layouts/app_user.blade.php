<!DOCTYPE html>
<html lang="en">
    <head>
        @yield('title')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
        <link rel="stylesheet" href="{{asset('user_assets/fonts/icomoon/style.css')}}">
        <link rel="stylesheet" href="{{asset('user_assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('user_assets/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('user_assets/css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{asset('user_assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('user_assets/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('user_assets/css/aos.css')}}">
        <link rel="stylesheet" href="{{asset('user_assets/css/style.css')}}">
        @yield('customcss')
    </head>
    <body>
        
        <div class="site-wrap">
            <header class="site-navbar" role="banner">
                <div class="site-navbar-top">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                                <form action="" class="site-block-top-search">
                                    <span class="icon icon-search2"></span>
                                    <input type="text" class="form-control border-0" placeholder="Cari Sesuatu">
                                </form>
                            </div>
                            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                                <div class="site-logo">
                                    @yield('head')
                                </div>
                            </div>
                            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                                <div class="site-top-icons">
                                    <ul>
                                        @if(Auth::guard('pengguna')->check())
                                        <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                                        @if(Auth::guard('pengguna')->user()->alamat=='')
                                        <li><a href="{{url('detail-akun')}}" class="site-cart"><span class="icon icon-person"></span>
                                         <span class="count">1</span>
                                        </a></li>
                                        @else
                                         <li><a href="{{url('detail-akun')}}"><span class="icon icon-person"></span>
                                        </a></li>
                                        @endif
                                        <li><a href="{{ url('logoutpengguna') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span class="icon icon-sign-out"></span></a>
                                                     <form id="logout-form" action="{{ route('admlogout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                        @else
                                        <li><a href="{{url('pengguna-login')}}"><span class="icon icon-sign-in"></span></a></li>
                                        @endif
                                        <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="site-navigation text-right text-md-center" role="navigation">
                    <div class="container">
                        <ul class="site-menu js-clone-nav d-none d-md-block">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('semua-produk')}}">Semua Produk</a></li>
                            <li><a href="{{url('semua-toko')}}">Semua Toko</a></li>
                            <li><a href="{{url('tips-menyewa')}}">Tips Menyewa</a></li>
                            <li><a href="{{url('/list-artikel')}}">Artikel</a></li>
                            @if(Auth::guard('pengguna')->check())
                            @php
                            $tokosaya = DB::table('toko')->where('id_pengguna',Auth::guard('pengguna')->user()->id)->count();
                            @endphp
                            @if($tokosaya>0)
                            <li class="has-children">
                                <a href="#">Toko Saya</a>
                                <ul class="dropdown">
                                    <li><a href="{{url('produk-saya')}}">Produk Saya</a></li>
                                    <!-- <li><a href="#">Iklan</a></li> -->
                                </ul>
                            </li>
                            @endif
                            @endif
                        </ul>
                    </div>
                </nav>
            </header>
            @yield('content')
           
            <footer class="site-footer border-top">
                <div class="container">
                    <!-- <div class="row">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="footer-heading mb-4">Navigations</h3>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Sell online</a></li>
                                        <li><a href="#">Features</a></li>
                                        <li><a href="#">Shopping cart</a></li>
                                        <li><a href="#">Store builder</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Mobile commerce</a></li>
                                        <li><a href="#">Dropshipping</a></li>
                                        <li><a href="#">Website development</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Point of sale</a></li>
                                        <li><a href="#">Hardware</a></li>
                                        <li><a href="#">Software</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <h3 class="footer-heading mb-4">Promo</h3>
                            <a href="#" class="block-6">
                                <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
                                <h3 class="font-weight-light  mb-0">Finding Your Perfect Shoes</h3>
                                <p>Promo from  nuary 15 &mdash; 25, 2019</p>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="block-5 mb-5">
                                <h3 class="footer-heading mb-4">Contact Info</h3>
                                <ul class="list-unstyled">
                                    <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                                    <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                                    <li class="email">emailaddress@domain.com</li>
                                </ul>
                            </div>
                            <div class="block-7">
                                <form action="#" method="post">
                                    <label for="email_subscribe" class="footer-heading">Subscribe</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Send">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <div class="row pt-5 mt-5 text-center">
                        <div class="col-md-12">
                            <p>
                               Template Ini Dibuat <i class="icon-heart" aria-hidden="true"></i> Oleh <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
                            </p>
                        </div>
                        
                    </div>
                </div>
            </footer>
        </div>
        <script src="{{asset('user_assets/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('user_assets/js/jquery-ui.js')}}"></script>
        <script src="{{asset('user_assets/js/popper.min.js')}}"></script>
        <script src="{{asset('user_assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('user_assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('user_assets/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('user_assets/js/aos.js')}}"></script>
        <script src="{{asset('user_assets/js/main.js')}}"></script>
        @yield('customjs')
    </body>
</html>
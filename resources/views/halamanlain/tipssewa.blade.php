@extends('layouts.app_user')

@section('title')
<title>{{$websetting->nama}}</title>
<link href="{{asset('image/setting/thumbnail/'.$websetting->icon)}}" rel="icon" type="image/png">
@endsection

@section('head')
<a href="{{url('/')}}" class="js-logo-clone">{{$websetting->nama}}</a>
@endsection

@section('content')
<div class="site-section border-bottom" data-aos="fade">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="block-16">
                    <figure>
                        <img src="images/blog_1.jpg" alt="Image placeholder" class="img-fluid rounded">
                        <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="ion-md-play"></span></a>
                    </figure>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                
                
                <div class="site-section-heading pt-3 mb-4">
                    <h2 class="text-black">Tips Menyewa Yang Benar</h2>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius repellat, dicta at laboriosam, nemo exercitationem itaque eveniet architecto cumque, deleniti commodi molestias repellendus quos sequi hic fugiat asperiores illum. Atque, in, fuga excepturi corrupti error corporis aliquam unde nostrum quas.</p>
                <p>Accusantium dolor ratione maiores est deleniti nihil? Dignissimos est, sunt nulla illum autem in, quibusdam cumque recusandae, laudantium minima repellendus.</p>
                
            </div>
        </div>
    </div>
</div>
<div class="site-section border-bottom" data-aos="fade">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Alur Menyewa Yang Benar</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                
                <div class="block-38 text-center">
                    <div class="block-38-img">
                        <div class="block-38-header">
                            <img src="images/person_1.jpg" alt="Image placeholder" class="mb-4">
                            <h3 class="block-38-heading h4">Cari Produknya</h3>
                            <!-- <p class="block-38-subheading">CEO/Co-Founder</p> -->
                        </div>
                        <div class="block-38-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio recusandae doloribus ut fugit officia voluptate soluta. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="block-38 text-center">
                    <div class="block-38-img">
                        <div class="block-38-header">
                            <img src="images/person_2.jpg" alt="Image placeholder" class="mb-4">
                            <h3 class="block-38-heading h4">Pastikan Penyewanya</h3>
                          
                        </div>
                        <div class="block-38-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio recusandae doloribus ut fugit officia voluptate soluta. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="block-38 text-center">
                    <div class="block-38-img">
                        <div class="block-38-header">
                            <img src="images/person_3.jpg" alt="Image placeholder" class="mb-4">
                            <h3 class="block-38-heading h4">Bertemu Di Tempat Nyawan & Aman</h3>
                            <p class="block-38-subheading">Marketing</p>
                        </div>
                        <div class="block-38-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio recusandae doloribus ut fugit officia voluptate soluta. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="block-38 text-center">
                    <div class="block-38-img">
                        <div class="block-38-header">
                            <img src="images/person_4.jpg" alt="Image placeholder" class="mb-4">
                            <h3 class="block-38-heading h4">Jangan Lupa Jaminannya</h3>
                        </div>
                        <div class="block-38-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio recusandae doloribus ut fugit officia voluptate soluta. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
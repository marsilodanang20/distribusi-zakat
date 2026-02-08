@extends('layouts.frontend.master')

@section('content')
    <div class="wrapper">
        <!-- ========================
                               page title
                            =========================== -->
        <section class="page-title page-title-layout1 bg-overlay bg-overlay-2 bg-parallax text-center">
            <div class="bg-img"><img src="{{ url('solatec/assets/images/page-titles/11.jpg') }}" alt="background"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="pagetitle__heading mb-0">Artikel dan Berita Acara</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Artikel</li>
                            </ol>
                        </nav>
                        <a href="#gallery" class="scroll-down">
                            <i class="icon-arrow-down"></i>
                        </a>
                    </div><!-- /.col-xl-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.page-title -->

        <!-- ======================
                                Blog Grid
                              ========================= -->
        <section class="post-grid">
            <div class="container">
               <div class="row">
                    @forelse ($articles as $artcls)
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="post-item">
                                <div class="post__img">
                                    <a href="{{ route('article.show', $artcls->id) }}">
                                        <img
                                            style="width:100%; height:320px; object-fit:cover;"
                                            src="{{ asset('storage/images/' . $artcls->thumbnail) }}"
                                            alt="{{ $artcls->judul }}">
                                    </a>
                                    <span class="post__date">{{ $artcls->tanggal }}</span>
                                </div>

                                <div class="post__body">
                                    <div class="post__meta d-flex align-items-center">
                                        <div class="post__cat">
                                            <a href="#">Berita Terkini</a>
                                        </div>
                                        <a class="post__author" href="#">Administrator</a>
                                    </div>

                                    <h4 class="post__title">
                                        <a href="{{ route('article.show', $artcls->id) }}">
                                            {{ $artcls->judul }}
                                        </a>
                                    </h4>

                                    <p class="post__desc">
                                        {{ Str::limit(strip_tags(htmlspecialchars_decode($artcls->content)), 100) }}
                                    </p>

                                    <a href="{{ route('article.show', $artcls->id) }}"
                                    class="btn btn__secondary btn__outlined btn__custom">
                                        <i class="icon-arrow-right"></i>
                                        <span>Baca Selengkapnya</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12 text-center mx-auto mt-3">
                            <h1 class="mb-2">Tidak ada artikel</h1>
                            <p>Kami sedang menyiapkan artikel atau berita untuk Anda.</p>
                        </div>
                    @endforelse
                </div><!-- /.row -->
            </section><!-- /.blog Grid -->
    </div>
@endsection

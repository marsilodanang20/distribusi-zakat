@extends('layouts.frontend.master')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
    <div class="wrapper">
        <!-- ============================
                                                                                                                                                Slider
                                                                                                                                            ============================== -->
                <section class="slider">
            <div class="slick-carousel carousel-arrows-light carousel-dots-light m-slides-0"
                data-slick='{
                    "slidesToShow": 1,
                    "arrows": true,
                    "dots": true,
                    "speed": 700,
                    "fade": true,
                    "cssEase": "linear",
                    "autoplay": true,
                    "autoplaySpeed": 4500,
                    "pauseOnHover": false
                }'>

                <!-- SLIDE 1 -->
                <div class="slide-item bg-overlay bg-overlay-2">
                <div class="bg-img">
                    <img src="{{ url('solatec/assets/images/sliders/8.jpg') }}" alt="slide img">
                </div>

                <div class="slide__centered">
                    <span class="slide__subtitle" style="font-size: clamp(18px, 2.2vw, 26px); font-weight:600;">
                    Selamat Datang di Baznas Kabupaten Cirebon
                    </span>

                    <h2 class="slide__title" style="font-size: clamp(32px, 5.3vw, 62px);">
                    Melayani Distribusi Zakat dengan Amanah & Transparan
                    </h2>

                    <div class="slide__buttons">
                    <a href="{{ url('/about') }}" class="btn btn__primary">
                        <i class="icon-arrow-right"></i>
                        <span>Tentang Kami</span>
                    </a>

                    <a href="https://baznascirebonkab.or.id/bayarzakat"
                        class="btn btn__white">
                        Bayar Zakat
                    </a>
                    </div>
                </div>
                </div>


                <!-- SLIDE 2 -->
                <div class="slide-item bg-overlay bg-overlay-2">
                <div class="bg-img">
                    <img src="{{ url('solatec/assets/images/sliders/9.jpg') }}" alt="slide img">
                </div>

                <div class="slide__centered">
                    <span class="slide__subtitle" style="font-size: clamp(18px, 2.2vw, 26px); font-weight:600;">
                    Dari Hati untuk Umat di Cirebon
                    </span>

                    <h2 class="slide__title" style="font-size: clamp(32px, 5.3vw, 62px);">
                    Bantu Wujudkan Kesejahteraan melalui Zakat Tepat Sasaran
                    </h2>

                    <div class="slide__buttons">
                    <a href="{{ url('/about') }}" class="btn btn__primary">
                        <i class="icon-arrow-right"></i>
                        <span>Tentang Kami</span>
                    </a>

                    <a href="https://baznascirebonkab.or.id/bayarzakat"
                        class="btn btn__white">
                        Bayar Zakat
                    </a>
                    </div>
                </div>
                </div>


            </div>
        </section>


        <!-- ======================
                                                                                                                                              services Layout 2
                                                                                                                                              ========================= -->
        <section class="services-layout2 pt-120">
            <div class="bg-img"><img src="{{ url('solatec/assets/images/backgrounds/5.jpg') }}" alt="background"></div>
            <div class="container">
                <div class="row mb-70">
                    <div class="col-12">
                        <h2 class="heading__subtitle color-primary">Kategori mustahik yang kami terima</h2>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5">
                        <h3 class="heading__title color-white">Berikut adalah kategori mustahik yang berhak mendapatkan
                            zakat fitrah.</h3>
                    </div><!-- /col-lg-5 -->
                    <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-1">
                        <p class="heading__desc font-weight-bold color-gray mb-30">Bagi muslim yang tidak mampu mencukupi
                            biaya hidup, mereka tidak wajib membayar zakat, sebaliknya, mereka malah harus diberikan zakat.

                            Siapa saja orang-orang yang berhak menerima zakat?</p>
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="slick-carousel carousel-arrows-light"
                            data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "arrows": true, "dots": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2, "slidesToScroll": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1, "slidesToScroll": 1}}]}'>
                            <!-- service item #1 -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/1.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Fakir</h4>
                                    <p class="service__desc">Fakir ialah orang-orang yang punya harta tapi sedikit. Mereka
                                        tak punya penghasilan, jarang bisa memenuhi kebutuhan sehari-hari.</p>
                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                            <!-- service item #2 -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/2.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Miskin</h4>
                                    <p class="service__desc">Orang-orang dengan harta sedikit, penghasilan pas-pasan. Cukup
                                        untuk makan, minum dan tak lebih. Namun, kebutuhan lain harus ditunda.</p>

                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                            <!-- service item #3 -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/3.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Amil</h4>
                                    <p class="service__desc">Mereka mengurus zakat mulai dari penerimaan hingga menyalurkan
                                        ke orang yang membutuhkan. Berupaya agar zakat sampai ke penerima yang tepat. </p>
                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                            <!-- service item #4 -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/4.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Mu'allaf </h4>
                                    <p class="service__desc">Mu'allaf dan yang baru masuk Islam berhak menerima zakat. Agar
                                        semakin mantap dalam memeluk agama dan meningkatkan ketaqwaan.</p>

                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                            <!-- service item #5 -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/5.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Riqab</h4>
                                    <p class="service__desc">Dahulu zakat membayar atau menebus budak yang dijadikan oleh
                                        saudagar kaya. Mereka dimerdekakan dengan zakat.</p>
                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                            <!-- service item #6 -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/6.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Gharim</h4>
                                    <p class="service__desc">Gharim berhak menerima zakat. Namun, berhutang untuk maksiat
                                        dan bangkrut, hak zakat gugur. Agar zakat tepat sasaran.</p>
                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/6.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Fi Sabilillah</h4>
                                    <p class="service__desc">Sabilillah adalah kegiatan untuk kepentingan di jalan Allah.
                                        Misalnya pengembangan pendidikan, dakwah, kesehatan, panti asuhan, madrasah diniyah.
                                    </p>
                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                            <div class="service-item">
                                <div class="service__img">
                                    <img src="{{ url('solatec/assets/images/services/6.jpg') }}" alt="service"
                                        loading="lazy">
                                </div><!-- /.service__img -->
                                <div class="service__body">
                                    <h4 class="service__title">Ibnu Sabil</h4>
                                    <p class="service__desc">Ibnu Sabil atau musaffir, termasuk pekerja dan pelajar di
                                        tanah perantauan. Mereka mendapat hak sama seperti yang lain, agar bisa beraktivitas
                                        dengan baik.
                                    </p>
                                </div><!-- /.service__body -->
                            </div><!-- /.service-item -->
                        </div><!-- /.carousel-->
                    </div><!-- /.col-12 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-5">
                        <p class="read-note__text">
                            <strong class="color-white">Sumber yang saya terima merupakan golongan yang berhak menerima
                                zakat dari website, </strong>
                            <a href="#" class="text-underlined-primary color-primary font-weight-bold">
                                <span>Indonesiabaik.id </span> <i class="icon-arrow-right"></i>
                            </a>
                        </p>
                    </div><!-- /.col-lg-5 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.services Layout 2 -->

        <!-- ======================
                                                                                                                                                Blog Grid
                                                                                                                                              ========================= -->
        <section class="post-grid pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                        <div class="heading text-center mb-50">
                            <h2 class="heading__subtitle">Berita Acara & Pengumuman</h2>
                            <h3 class="heading__title">Artikel Terbaru</h3>
                        </div><!-- /.heading -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                <div class="row">
                    @forelse ($articles as $artcls)
                        <!-- Post Item #1 -->
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="post-item">
                                <div class="post__img">
                                    <a href="blog-single-post.html">
                                        <img style=" width: 100%;
                                        height: 320px;
                                        object-fit: cover;"
                                            src="{{ url('storage/images/' . $artcls->thumbnail) }}" alt="blog">
                                    </a>
                                    <span class="post__date">{{ $artcls->tanggal }}</span>
                                </div><!-- /.post-img -->
                                <div class="post__body">
                                    <div class="post__meta d-flex align-items-center">
                                        <div class="post__cat">
                                            <a href="#">Berita Terkini</a>
                                        </div><!-- /.post-meta-cat -->
                                        <a class="post__author" href="#">Administrator</a>
                                    </div><!-- /.post-meta -->
                                    <h4 class="post__title"><a href="#">{{ $artcls->judul }}
                                        </a></h4>
                                    <p class="post__desc">
                                        {{ substr(strip_tags(htmlspecialchars_decode($artcls->content)), 0, 100) }} ...</a>
                                    </p>
                                    <a href="{{ route('article.show', $artcls->id) }}"
                                        class="btn btn__secondary btn__outlined btn__custom">
                                        <i class="icon-arrow-right"></i>
                                        <span>Baca Selengkapnya</span>
                                    </a>
                                </div><!-- /.post-content -->
                            </div><!-- /.post-item -->
                        </div><!-- /.col-lg-4 -->
                    @empty
                        <div class="col-lg-12 text-center mx-auto mt-3">
                            <h1 class="mb-2">Tidak ada artikel yang ada disini</h1>
                            <p class="mb-4">Kami sedang menyiapkan artikel atau berita bagi anda.
                            </p>
                        </div>
                    @endforelse
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.blog Grid -->
    </div>
@endsection

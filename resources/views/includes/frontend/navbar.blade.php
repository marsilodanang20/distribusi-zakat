<!-- ========================= Header =========================== -->
<header class="header header-layout1">

    <!-- TOP BAR -->
    <div class="header-topbar py-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">

                <!-- Left info -->
                <ul class="contact__list d-flex flex-wrap align-items-center list-unstyled mb-0">
                    <li class="mr-4 d-flex align-items-center">
                        <i class="icon-location mr-1"></i>
                        <a href="https://maps.app.goo.gl/Y4D5i9cTQd3yiRMQ6">BAZNAS KABUPATEN CIREBON</a>
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="icon-mail mr-1"></i>
                        <a href="mailto:baznaskab.cirebon@baznas.go.id">baznaskab.cirebon@baznas.go.id</a>
                    </li>
                </ul>

                <!-- Social -->
                <ul class="social-icons list-unstyled mb-0 d-flex">
                    <li><a href="https://www.facebook.com/badanamilzakat" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://instagram.com/baznas.cirebon" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://wa.me/628112223136" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                </ul>

            </div>
        </div>
    </div>
    <!-- END TOP BAR -->


    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-navbar" 
         x-data="{ open:false }">

        <div class="container-fluid d-flex align-items-center justify-content-between">

            <!-- LOGO + TEXT -->
            <a class="navbar-brand d-flex align-items-center order-0"
            href="/"
            style="gap: 20px; margin-left: 0 !important;">
                <img src="{{ url('solatec/assets/images/logo/logo2.png') }}"
                    alt="logo baznas"
                    style="height: 55px; width: auto; object-fit: contain;">

                <div class="d-flex flex-column" style="line-height: 1.1;">
                    <span style="font-size: 1.85rem; font-weight: 800; color: #2f6b3c; letter-spacing: 6px; margin-bottom: 1px;">
                        BAZNAS
                    </span>
                    <span style="font-size: 0.82rem; font-weight: 400; color: #000000; margin-bottom: -2px;">
                        BADAN AMIL ZAKAT NASIONAL
                    </span>
                    <span style="font-size: 0.95rem; font-weight: 400; color: #2f6b3c;">
                        KABUPATEN CIREBON
                    </span>
                </div>
            </a>

            <!-- Mobile Menu Button -->
            <button class="navbar-toggler order-1 ml-2" type="button"
                    @click="open = !open">
                <span class="menu-lines"><span></span></span>
            </button>

            <!-- NAVIGATION -->
            <div id="mainNavigation"
                class="collapse navbar-collapse"
                :class="open ? 'show' : ''">

                <ul class="navbar-nav mr-auto">

                    <li class="nav__item">
                        <a href="{{ url('/') }}" class="nav__item-link">Beranda</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('about') }}" class="nav__item-link">Tentang Kami</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('article') }}" class="nav__item-link">Artikel</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('gallery') }}" class="nav__item-link">Galeri</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('contact') }}" class="nav__item-link">Hubungi Kami</a>
                    </li>

                </ul>

                <!-- Close button (mobile only) -->
                <button class="close-mobile-menu d-block d-lg-none"
                        @click="open = false">
                    <i class="fas fa-times"></i>
                </button>
            </div>


            <!-- CONTACT PHONE -->
            {{-- <div class="contact__number d-none d-xl-flex align-items-center ml-3">
                <i class="icon-phone mr-1"></i>
                <a href="tel:08112223136">08112223136</a>
            </div> --}}

            <!-- CTA BUTTON -->
            <ul class="navbar-actions d-none d-xl-flex list-unstyled mb-0 ml-4 align-items-center justify-content-center">
                <li class="d-flex align-items-center">
                    <a href="https://baznascirebonkab.or.id/sedekah"
                       class="btn btn__primary d-flex align-items-center" style="padding: 10px 24px;">
                        <i class="fas fa-hand-holding-usd me-2"></i>
                        <span style="margin-right: 8px;">Donasi Sekarang</span>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</header>
<!-- ========================= Header End ========================= -->

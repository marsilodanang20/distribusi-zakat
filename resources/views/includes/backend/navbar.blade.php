<style>
/* ==========================================
   FIX FINAL — BUTTON PENGUMPULAN ZAKAT
   ========================================== */

/* LIGHT MODE */
.page-header .btn-zakat,
body.light-only .page-header .btn-zakat {
    background: #a8d894 !important; /* hijau clean */
    color: #3d7b27 !important;
    border: none !important;
    padding: 10px 18px !important;
    border-radius: 10px !important;
    display: flex !important;
    gap: 8px !important;
    align-items: center !important;
    font-weight: 600 !important;
}

.page-header .btn-zakat i {
    stroke: currentColor !important;
}


/* DARK MODE — PAKAI CLASS YANG MEMANG DIPAKAI TEMPLATE: 
   biasanya: .dark-only atau .dark-mode 
*/
body.dark-mode .page-header .btn-zakat,
body.dark-only .page-header .btn-zakat,
.dark-only .page-header .btn-zakat {
    background: rgba(255, 255, 255, 0.18) !important;
    color: #ffffff !important;
}

body.dark-mode .page-header .btn-zakat i,
body.dark-only .page-header .btn-zakat i,
.dark-only .page-header .btn-zakat i {
    stroke: #ffffff !important;
}

/* Paksa semua feather icon dalam tombol zakat ikut warna teks */
.btn-zakat svg,
.btn-zakat i {
    stroke: currentColor !important;
}

/* DARK MODE */
body.dark-mode .btn-zakat svg,
body.dark-only .btn-zakat svg,
.dark-only .btn-zakat svg {
    stroke: #ffffff !important;
}


</style>


<div class="page-header">
    <div class="header-wrapper row m-0">

        <!-- Logo + Toggle Sidebar -->
        <div class="header-logo-wrapper">
            <div class="logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid" src="../assets/images/logo/logo.png" alt="">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="sliders"></i>
            </div>
        </div>

        <!-- LEFT MENU -->
        <div class="left-header col horizontal-wrapper pl-0">
            <ul class="horizontal-menu">

                <!-- Logout mobile -->
                <li class="mega-menu outside d-block d-md-none">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"></i>
                        <span>Log out</span>
                    </a>
                </li>

                <!-- PENGUMPULAN ZAKAT BUTTON -->
                <li class="level-menu outside">
                    <a class="nav-link btn-zakat"
                       href="{{ '/dashboard/pengumpulan_zakat/create' }}">
                        <i data-feather="plus-square"></i>
                        <span>Zakat</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- RIGHT MENU -->
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">

                <!-- DARK MODE -->
                <li>
                    <div class="mode">
                        <a href="#" data-toggle="tooltip" title="Dark Mode">
                            <i data-feather="moon"></i>
                        </a>
                    </div>
                </li>

                <!-- Fullscreen -->
                <li class="maximize">
                    <a data-toggle="tooltip" title="Full Screen" href="#!"
                        onclick="javascript:toggleFullScreen()">
                        <i data-feather="maximize"></i>
                    </a>
                </li>

                <!-- PROFILE -->
                <li class="profile-nav onhover-dropdown p-0 ml-2 mr-0">
                    <div class="media profile-media">
                        <img class="b-r-10"
                             src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=5a983f&color=fff"
                             width="40px">
                        <div class="media-body">
                            <span>{{ Auth::user()->name }}</span>
                            <p class="mb-0 font-roboto">
                                Administrator <i class="middle fa fa-angle-down"></i>
                            </p>
                        </div>
                    </div>

                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i>
                                <span>Log out</span>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>

<style>
    /* Background Header Putih */
    .th-header,
    .menu-area,
    .sticky-wrapper {
        background-color: #ffffff !important;
    }

    /* Text Menu Hitam */
    .main-menu ul li a {
        color: #000 !important;
    }

    /* Icon Dropdown (arrow menu) */
    .main-menu ul li.menu-item-has-children>a::after {
        color: #000 !important;
    }

    /* Hover Menu */
    .main-menu ul li a:hover {
        color: #0d6efd !important;
    }

    /* Submenu Background */
    .sub-menu {
        background-color: #ffffff !important;
    }

    /* Submenu Text */
    .sub-menu li a {
        color: #000 !important;
    }

    /* Toggle Menu Mobile (Hamburger) */
    .th-menu-toggle {
        color: #000 !important;
    }

    /* Toggle Icon */
    .th-menu-toggle i {
        color: #000 !important;
    }

    /* Icon menu kanan */
    .simple-btn img {
        filter: brightness(0);
        /* jadi hitam */
    }

    /* Sticky saat scroll */
    .sticky-wrapper.sticky {
        background-color: #fff !important;
    }

    /* Optional Shadow biar elegan */
    .menu-area {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .header-button .th-btn.style2 {
        background: linear-gradient(45deg, #091098, #ffffff);
        color: #000;
        border: none;
    }
</style>
<div class="sidemenu-wrapper sidemenu-info">
    <div class="sidemenu-content"><button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget">
            <div class="th-widget-about">
                <div class="about-logo"><a href="/"><img src="frontend/bprbhaktiriyadi/assets/img/logo/logo.png"
                            style="width: 270px" alt="Logo"></a></div>
                <p class="about-text">BPR Bhaktiriyadi merupakan lembaga keuangan yang berkomitmen
                    memberikan layanan perbankan terpercaya dengan produk tabungan, deposito,
                    dan kredit untuk mendukung pertumbuhan ekonomi masyarakat.</p>
                <div class="th-social">
                    <a href="https://web.facebook.com/bprbhaktiriyadiklaten/?_rdc=1&_rdr"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://x.com/bprbhaktiriyadi"><i class="fab fa-twitter"></i></a>
                    {{-- <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a> --}}
                    <a href="https://api.whatsapp.com/send/?phone=6281393630003&text&type=phone_number&app_absent=0"><i
                            class="fab fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/bprbhaktiriyadi/?hl=id"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="widget">
            <h3 class="widget_title">Informasi</h3>

            <div style="margin-bottom:15px;">
                <a href="#">
                    <img src="frontend/bprbhaktiriyadi/assets/img/bg/breadcumb-bg.jpg"
                        style="width:100%; border-radius:8px;" alt="Banner">
                </a>
            </div>



        </div>
    </div>
</div>
<div class="popup-search-box"><button class="searchClose"><i class="fal fa-times"></i></button>
    <form action="#"><input type="text" placeholder="What are you looking for?"> <button type="submit"><i
                class="fal fa-search"></i></button></form>
</div>
<div class="th-menu-wrapper onepage-nav">
    <div class="th-menu-area text-center"><button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo"><a href="/"><img src="frontend/bprbhaktiriyadi/assets/img/logo/logo.png"
                    style="width: 170px" alt="Atek"></a></div>
        <div class="th-mobile-menu allow-natural-scroll">
            <ul>

                <li><a href="/" style="c">Beranda</a></li>
                <li class="menu-item-has-children"><a href="#">Tentang Kami</a>
                    <ul class="sub-menu">

                        <li><a href="/visimisi">Visimisi</a></li>
                        <li><a href="/sejarah">Sejarah</a></li>
                        <li><a href="/pengurus">Pengurus</a></li>
                        <li><a href="/organisasi">Struktur Organisasi</a></li>
                        <li><a href="/galery">Galery</a></li>
                        <li><a href="#">Piagam Audit</a></li>
                        <li><a href="#">Whistleblowing System</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children"><a href="#">Produk</a>
                    <ul class="sub-menu">
                        <li><a href="/kredit">Kredit</a></li>
                        <li><a href="/deposito">Deposito</a></li>
                        <li><a href="/tabungan">Tabungan</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children"><a href="#">Laporan</a>
                    <ul class="sub-menu">
                        <li><a href="/publikasi">Laporan Publikasi</a></li>
                        <li><a href="/tahunan">Laporan Tahunan</a></li>
                        <li><a href="/tatakelola">Laporan Tata Kelola</a></li>
                        <li><a href="/keberlanjutan">Laporan Keberlanjutan</a></li>
                    </ul>
                </li>
                <li><a href="/lelang-jualaset">Lelang</a></li>
                <li><a href="/pengajuanonline">Pengajuan Online</a></li>
            </ul>
        </div>
    </div>
</div>
<header class="th-header header-layout1 header-layout12" style="background-color: #ffffff">
    <div class="sticky-wrapper">
        <div class="menu-area">
            <div class="container th-container3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo ml-25"><a href="/"><img
                                    src="{{ asset('frontend/bprbhaktiriyadi/assets/img/logo/logo.png') }}"
                                    style="width: 270px" alt="Logo"></a></div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu d-none d-xl-inline-block">
                            <ul>

                                <li><a href="/" style="c">Beranda</a></li>
                                <li class="menu-item-has-children"><a href="#">Tentang Kami</a>
                                    <ul class="sub-menu">

                                        <li><a href="/visimisi">Visimisi</a></li>
                                        <li><a href="/sejarah">Sejarah</a></li>
                                        <li><a href="/pengurus">Pengurus</a></li>
                                        <li><a href="/organisasi">Struktur Organisasi</a></li>
                                        <li><a href="/galery">Galery</a></li>

                                    </ul>
                                </li>

                                <li class="menu-item-has-children"><a href="#">Produk</a>
                                    <ul class="sub-menu">
                                        <li><a href="/kredit">Kredit</a></li>
                                        <li><a href="/deposito">Deposito</a></li>
                                        <li><a href="/tabungan">Tabungan</a></li>
                                    </ul>
                                </li>
                                {{-- <li class="menu-item-has-children"><a href="#">Laporan</a>
                                    <ul class="sub-menu">
                                        <li><a href="/publikasi">Laporan Publikasi</a></li>
                                        <li><a href="/tahunan">Laporan Tahunan</a></li>
                                        <li><a href="/tatakelola">Laporan Tata Kelola</a></li>
                                        <li><a href="/keberlanjutan">Laporan Keberlanjutan</a></li>
                                    </ul>
                                </li> --}}
                                <li><a href="/laporanall" style="c">Laporan</a></li>
                                <li><a href="/lelang-jualaset">Lelang</a></li>
                                <li><a href="/pengajuanonline">Pengajuan Online</a></li>

                            </ul>
                        </nav><button type="button" class="th-menu-toggle d-block d-xl-none"><i
                                class="far fa-bars"></i></button>
                    </div>
                    <div class="col-auto d-none d-xl-block">
                        <div class="header-button">

                            <div style="position:relative; display:inline-block;"
                                onmouseover="this.children[1].style.display='block'"
                                onmouseout="this.children[1].style.display='none'">

                                <a href="#" class="th-btn style2 th-radius th-icon">
                                    Simulasi <i class="fa-light fa-angle-down"></i>
                                </a>

                                <ul style="
                                        position:absolute;
                                        top:100%;
                                        right:0;
                                        background:#fff;
                                        min-width:220px;
                                        box-shadow:0 10px 30px rgba(0,0,0,0.1);
                                        border-radius:8px;
                                        padding:10px 0;
                                        display:none;
                                        z-index:999;
                                        list-style:none;
                                        margin:0;
                                    ">

                                    <li>
                                        <a href="/simulasi-kredit"
                                            style="display:block;padding:10px 20px;color:#333;text-decoration:none;">
                                            Simulasi Kredit
                                        </a>
                                    </li>

                                    <li>
                                        <a href="/simulasi-deposito"
                                            style="display:block;padding:10px 20px;color:#333;text-decoration:none;">
                                            Simulasi Deposito
                                        </a>
                                    </li>

                                    <li>
                                        <a href="/simulasi-tabungan"
                                            style="display:block;padding:10px 20px;color:#333;text-decoration:none;">
                                            Simulasi Tabungan
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            <a href="#" class="simple-btn sideMenuToggler d-none d-xl-block">
                                <img src="frontend/bprbhaktiriyadi/assets/img/icon/menu.svg" alt="">
                            </a>

                            <button type="button" class="th-menu-toggle d-block d-xl-none">
                                <i class="far fa-bars"></i>
                            </button>
                            <li>
                                @auth
                                @if (auth()->user()->role == 1)
                                <div class="account-icon" style="margin-left: 10px;" alt="Profile">
                                    <a href="/dashboarduser" style="font-size: 25px; color: #333;">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </a>
                                </div>
                                @endif
                                @endauth
                            </li>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    .navbar .dropdown-menu {
        margin-top: 0;
    }

    .navbar .dropdown:hover>.dropdown-menu {
        display: block;
    }
</style>
<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12">
                <div class="logo">
                    <a href="/">

                        <img src="{{ asset('frontend/bprstaja/img/logo/logo.png') }}" alt="Logo"
                            style="max-height: 70px">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 d-none d-lg-block">
                <div class="row">
                    <div class="col-4">
                        <div class="top-bar-item">
                            <div class="top-bar-icon">
                                <i class="flaticon-calendar"></i>
                            </div>
                            <div class="top-bar-text">
                                <h3>Jam Buka</h3>
                                <p>8:00 - 15:00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="top-bar-item">
                            <div class="top-bar-icon">
                                <i class="flaticon-call"></i>
                            </div>
                            <div class="top-bar-text">
                                <h3>No Telp</h3>
                                <p>(0354) 681755</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="top-bar-item">
                            <div class="top-bar-icon">
                                <i class="flaticon-send-mail"></i>
                            </div>
                            <div class="top-bar-text">
                                <h3>Email</h3>
                                <p>bprstaja@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="/" class="nav-item nav-link  {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle   {{ request()->is('visimisi', 'sejarah', 'pengurus', 'organisasi', 'galery') ? 'active' : '' }}"
                            data-toggle="dropdown">Tentang Kami</a>
                        <div class="dropdown-menu">
                            <a href="/visimisi"
                                class="dropdown-item {{ request()->is('visimisi') ? 'active' : '' }}">Profil</a>
                            <a href="/sejarah"
                                class="dropdown-item {{ request()->is('sejarah') ? 'active' : '' }}">Sejarah</a>
                            <a href="/pengurus"
                                class="dropdown-item {{ request()->is('pengurus') ? 'active' : '' }}">Pengurus</a>
                            <a href="/organisasi"
                                class="dropdown-item {{ request()->is('organisasi') ? 'active' : '' }}">Struktur
                                Organisasi</a>
                            <a href="/galery"
                                class="dropdown-item {{ request()->is('galery') ? 'active' : '' }}">Gallery</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle {{ request()->is('kredit', 'deposito', 'tabungan') ? 'active' : '' }}"
                            data-toggle="dropdown">Produk</a>
                        <div class="dropdown-menu">
                            <a href="/kredit" class="dropdown-item {{ request()->is('kredit') ? 'active' : '' }}">Pembiayaan
                            </a>
                            <a href="/deposito"
                                class="dropdown-item {{ request()->is('deposito') ? 'active' : '' }}">Deposito</a>
                            <a href="/tabungan"
                                class="dropdown-item {{ request()->is('tabungan') ? 'active' : '' }}">Tabungan</a>
                        </div>
                    </div>
                    <a href="/lelang-jualaset"
                        class="nav-item nav-link {{ request()->is('pengajuanonline') ? 'active' : '' }}">Lelang</a>
                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle {{ request()->is('publikasi', 'tahunan', 'tatakelola', 'keberlanjutan') ? 'active' : '' }}"
                            data-toggle="dropdown">Laporan</a>
                        <div class="dropdown-menu">
                            <a href="/publikasi"
                                class="dropdown-item {{ request()->is('publikasi') ? 'active' : '' }}">Laporan
                                Publikasi </a>
                            <a href="/tahunan"
                                class="dropdown-item {{ request()->is('tahunan') ? 'active' : '' }}">Laporan
                                Tahunan</a>
                            <a href="/tatakelola"
                                class="dropdown-item {{ request()->is('tatakelola') ? 'active' : '' }}">Laporan Tata
                                Kelola</a>
                            <a href="/keberlanjutan"
                                class="dropdown-item {{ request()->is('keberlanjutan') ? 'active' : '' }}">Laporan
                                RAKB</a>
                            {{-- <a href="single.html" class="dropdown-item"></a> --}}

                        </div>
                    </div>
                    <a href="/pengajuanonline"
                        class="nav-item nav-link {{ request()->is('pengajuanonline') ? 'active' : '' }}">Pengajuan
                        Online</a>

                </div>
                <div class="ml-auto nav-item dropdown">
                    <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                        Simulasi
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/simulasi-kredit" class="dropdown-item">Simulasi Kredit</a>
                        <a href="/simulasi-deposito" class="dropdown-item">Simulasi Deposito</a>
                        <a href="/simulasi-tabungan" class="dropdown-item">Simulasi Tabungan</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
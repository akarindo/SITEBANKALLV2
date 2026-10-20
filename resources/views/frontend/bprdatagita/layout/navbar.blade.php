<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 d-flex align-items-center justify-content-between top-header-content">
                    <!-- Logo Area -->
                    <div class="logo">
                        <a href="/" aria-label="BPR Datagita Mustika">
                            <img src="{{ asset('frontend/bprdatagita/img/logo/logo.png') }}"
                                alt="BPR Datagita Mustika">
                        </a>
                    </div>

                    <div class="top-header-actions d-flex align-items-center">
                        <!-- Top Contact Info -->
                        <div class="top-contact-info d-flex align-items-center">
                            <a href="#" data-toggle="tooltip" data-placement="bottom"
                                title="Jl. Raya Karehkel No.1 Leuwiliang, Kabupaten Bogor">
                                <img src="{{ asset('frontend/bprdatagita/img/core-img/placeholder.png') }}"
                                    alt="">
                                <span>Jl. Raya Karehkel No.1 Leuwiliang, Kabupaten Bogor</span>
                            </a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom"
                                title="bprdatagita@gmail.com">
                                <img src="{{ asset('frontend/bprdatagita/img/core-img/message.png') }}" alt="">
                                <span>bprdatagita@gmail.com</span>
                            </a>
                        </div>

                        @auth
                            @if (auth()->user()->role == 1)
                                <div class="account-icon">
                                    <a href="/dashboarduser" aria-label="Profil pengguna">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="credit-main-menu" id="sticker">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="creditNav" aria-label="Navigasi utama">

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="/">Beranda</a></li>
                                {{-- <li><a href="about.html">About Us</a></li> --}}
                                <li><a href="#">Tentang Kami</a>
                                    <ul class="dropdown">
                                        <li><a href="/visimisi">Profil</a></li>
                                        <li><a href="/sejarah">Sejarah</a></li>
                                        <li><a href="/pengurus">Pengurus</a></li>
                                        <li><a href="/organisasi">Struktur Organisasi</a></li>
                                        <li><a href="/galery">Gallery</a></li>
                                    </ul>
                                </li>

                                <li><a href="#">Produk</a>
                                    <div class="megamenu">
                                        <ul class="dropdown">
                                            <li><a href="/kredit">Kredit</a></li>
                                            <li><a href="/deposito">Deposito</a></li>
                                            <li><a href="/tabungan">Tabungan</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li><a href="/rekrutmen">Karir</a></li>
                                <li><a href="#">Laporan</a>
                                    <div class="megamenu">
                                        <ul class="dropdown">
                                            <li><a href="/publikasi">Publikasi</a></li>
                                            <li><a href="/tahunan">Tahunan</a></li>
                                            <li><a href="/tatakelola">Tata Kelola</a></li>
                                            <li><a href="/keberlanjutan">Keberlanjutan</a></li>
                                            {{-- <li><a href="services.html">Tata Kelola</a></li> --}}

                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Simulasi</a>
                                    <div class="megamenu">
                                        <ul class="dropdown">
                                            <li><a href="/simulasi-kredit">Kredit</a></li>
                                            <li><a href="/simulasi-deposito">Deposito</a></li>
                                            <li><a href="/simulasi-tabungan">Tabungan</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li><a href="/pengajuanonline">Pengajuan Online</a></li>
                                <li><a href="/pengaduan">Pengaduan</a></li>
                                {{-- <li><a href="contact.html">Contact</a></li> --}}
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>

                    <!-- Contact -->
                    <div class="contact">
                        <a href="tel:+6281314791447">
                            <img src="{{ asset('frontend/bprdatagita/img/core-img/call2.png') }}"
                                alt=""> +6281314791447
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->

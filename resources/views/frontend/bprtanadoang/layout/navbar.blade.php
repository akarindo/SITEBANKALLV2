<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-11 d-flex justify-content-between">
                    <!-- Logo Area -->
                    <div class="logo">
                        <a href="/"><img src="{{asset('frontend/bprtanadoang/img/logo/logo.png')}}" alt=""
                                width="70px;"></a>
                    </div>

                    <!-- Top Contact Info -->
                    <div class="top-contact-info d-flex align-items-center">
                        <a href="#" data-toggle="tooltip" data-placement="bottom"
                            title="25 th Street Avenue, Los Angeles, CA"><img
                                src="{{asset('frontend/bprtanadoang/img/core-img/placeholder.png')}}" alt=""> <span>Jl.
                                Hamang DM No 45 Benteng Kepulauan Selayar</span></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="bprtanadoang@gmail.com"><img
                                src="{{asset('frontend/bprtanadoang/img/core-img/message.png')}}" alt="">
                            <span>bprtanadoang@gmail.com</span></a>
                    </div>
                </div>
                <div class="col-1 d-flex justify-content-between">@auth
                    @if (auth()->user()->role == 1)
                    <div class="account-icon" style="margin-left: 40px;" alt="Profile">
                        <a href="/dashboarduser" style="font-size: 25px; color: #333;">
                            <i class="fa-solid fa-user-tie"></i>
                        </a>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="credit-main-menu" id="sticker">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="creditNav">

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
                                        <li><a href="/dokumen">Dokumen</a></li>
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
                                {{-- <li><a href="contact.html">Contact</a></li> --}}
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>

                    <!-- Contact -->
                    <div class="contact">
                        <a href="tel:+041422810">
                            <img src="frontend/bprtanadoang/img/core-img/call2.png" alt=""> +041422810
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->
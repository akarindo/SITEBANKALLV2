@extends('frontend.bprapm.layout.main')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <div id="smooth-wrapper">
        <div class="space-for-header"></div>

        <!-- start: Banner Section -->
        <section class="h4-banner-section" style="padding:15px; margin-top:0px; margin-right: 15px; margin-left: 15px; background-color: #ffff;">
            <div class="swiper h4-banner-slider">
                <div class="swiper-wrapper">

                    @foreach ($baner as $item)
                        @if (!empty($item->url) || !empty($item->url_mobile))
                            <div class="swiper-slide">

                                {{-- DESKTOP --}}
                                @if (!empty($item->url))
                                    <img src="/recfil?display=true&rf={{ $item->url }}" alt="Banner Desktop"
                                        class="d-none d-md-block"
                                        style="width:100%; height:550px; object-fit:fill; display:block; border-radius:10px;">
                                @endif

                                {{-- MOBILE --}}
                                @if (!empty($item->url_mobile))
                                    <img src="/recfil?display=true&rf={{ $item->url_mobile }}" alt="Banner Mobile"
                                        class="d-block d-md-none"
                                        style="width:100%; height:auto; object-fit:contain; display:block; border-radius:10px;">
                                @endif

                            </div>
                        @endif
                    @endforeach

                </div>

                {{-- Pagination --}}
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <script>
            var swiper = new Swiper(".h4-banner-slider", {
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        </script>
        <!-- end: Banner Section -->
        @if ($deposito->count() || $tabungan->count() || $kredit->count())

            <section class="rate section" style="margin-top: 100px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-4">
                                <b class="head-title" style="font-size:30px; font-weight:bold">
                                    Counter Rate
                                </b>
                            </div>
                        </div>

                        <div class="col-12">
                            <!-- TAB HEADER -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                @if ($deposito->count())
                                    <li class="nav-item mr-2">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#tabratedeposit" type="button">
                                            Deposito
                                        </button>
                                    </li>
                                @endif

                                @if ($tabungan->count())
                                    <li class="nav-item mr-2">
                                        <button class="nav-link {{ !$deposito->count() ? 'active' : '' }}"
                                            data-bs-toggle="tab" data-bs-target="#tabratetabungan" type="button">
                                            Tabungan
                                        </button>
                                    </li>
                                @endif

                                @if ($kredit->count())
                                    <li class="nav-item">
                                        <button
                                            class="nav-link {{ !$deposito->count() && !$tabungan->count() ? 'active' : '' }}"
                                            data-bs-toggle="tab" data-bs-target="#tabratekredit" type="button">
                                            Kredit
                                        </button>
                                    </li>
                                @endif

                            </ul>

                            <br>

                            <!-- TAB CONTENT -->
                            <div class="tab-content">

                                @if ($deposito->count())
                                    <div class="tab-pane fade show active" id="tabratedeposit">
                                        @foreach ($deposito as $item)
                                            <div class="mb-3">
                                                <img src="/recfil?rf={{ $item->image }}" class="w-100"
                                                    style="height:500px; object-fit:fill; border-radius:10px;">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($tabungan->count())
                                    <div class="tab-pane fade {{ !$deposito->count() ? 'show active' : '' }}"
                                        id="tabratetabungan">
                                        @foreach ($tabungan as $item)
                                            <div class="mb-3">
                                                <img src="/recfil?rf={{ $item->image }}" class="w-100"
                                                    style="height:500px; object-fit:fill; border-radius:10px;">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($kredit->count())
                                    <div class="tab-pane fade {{ !$deposito->count() && !$tabungan->count() ? 'show active' : '' }}"
                                        id="tabratekredit">
                                        @foreach ($kredit as $item)
                                            <div class="mb-3">
                                                <img src="/recfil?rf={{ $item->image }}" class="w-100"
                                                    style="height:500px; object-fit:fill; border-radius:10px;">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        @endif

        <section class="about section">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-4 mb-4">
                        <b class="head-title" style="font-size: 30px; font-weigth:bold">Kenapa memilih kami</b>
                        <br>
                        <br>
                        <img src="{{ asset('frontend/bprtaruna/assets/img/profil/stars.webp') }}" alt="STARS"
                            style="width: 50%;">
                    </div>
                </div>
                <div class="flex-container-produk">
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <div class="block">
                                <img src="{{ asset('frontend/bprtaruna/assets/img/profil/service.webp') }}" alt="Img">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-lg-7 mb-4">
                            <div class="block">
                                <div class="section-title">
                                    <p style="font-style: italic;">Service Excellence</p>

                                    <b style="color: #1f4fa3; font-size: 37px;">Pelayanan prima <br>
                                        kepada nasabah
                                    </b>
                                </div>
                                <br>
                                <p>Perbaikan berkelanjutan didukung oleh proaktivitas tinggi mengacu kepada pembangunan
                                    karakter,
                                    pengembangan keterampilan dan keahlian spesifik melalui pembelajaran sistematis, terarah
                                    dan terukur.</p>
                                <!-- <button class="myButton" href="#">SELENGKAPNYA</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-container-produk">
                    <div class="row produk">
                        <div class="col-lg-7 mb-4">
                            <div class="block">
                                <div class="section-title">
                                    <p style="font-style: italic;">Target Oriented</p>
                                    <b style="color: #1f4fa3; font-size: 37px;">Orientasi pencapaian <br>
                                        target perusahaan</b>
                                </div>
                                <p>Menekankan pada ketajaman bisnis yang kuat dalam melihat peluang dan dinamika pasar
                                    dengan orientasi
                                    sebagai yang terdepan dan mendorong pengembangan usaha berdaya saing tinggi.</p>
                                <!-- <button class="myButton" href="#">SELENGKAPNYA</button> -->
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <div class="block">
                                <img src="{{ asset('frontend/bprtaruna/assets/img/profil/target.webp') }}" alt="Img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-container-produk">
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <div class="block">
                                <img src="{{ asset('frontend/bprtaruna/assets/img/profil/accountablity.webp') }}"
                                    alt="Img">
                            </div>
                        </div>
                        <div class="col-lg-7 mb-4">
                            <div class="block">
                                <div class="section-title">
                                    <p style="font-style: italic;">Accountability</p>
                                    <b style="color: #1f4fa3; font-size: 37px;">Bertanggung jawab dalam bekerja<br>
                                        sesuai dengan ketentuan</b>
                                </div>
                                <p>
                                    Pengelolaan organisasi profesional dan terintegrasi melalui pengelolaan kinerja handal
                                    dalam upaya
                                    mencapai produktifitas tinggi.
                                </p>
                                <!-- <button class="myButton" href="#">SELENGKAPNYA</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-container-produk">
                    <div class="row produk">
                        <div class="col-lg-7 mb-4">
                            <div class="block">
                                <div class="section-title">
                                    <p style="font-style: italic;">Realiable</p>
                                    <b style="color: #1f4fa3; font-size: 37px;">Dapat diandalkan untuk <br>
                                        menyelesaikan pekerjaan</b>
                                </div>
                                <p>
                                    Kepemimpinan dengan visi memberdayakan organisasi untuk senantiasa bertumbuh dan
                                    berkembang, dengan
                                    integritas, keteladanan, kebersamaan, dan kepercayaan untuk melangkah maju bersama.
                                </p>
                                <!-- <button class="myButton" href="#">SELENGKAPNYA</button> -->
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <div class="block">
                                <img src="{{ asset('frontend/bprtaruna/assets/img/profil/realiable.webp') }}"
                                    alt="Img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-container-produk">
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <div class="block">
                                <img src="{{ asset('frontend/bprtaruna/assets/img/profil/synergi.webp') }}"
                                    alt="Img">
                            </div>
                        </div>
                        <div class="col-lg-7 mb-4">
                            <div class="block">
                                <div class="section-title">
                                    <p style="font-style: italic;">Synergy</p>
                                    <b style="color: #1f4fa3; font-size: 37px;">Membangun kerjasama <br>
                                        yang baik</b>
                                </div>
                                <p>
                                    Senantiasa mengedepankan pelayanan unggul, melalui hubungan kerja mutualistis, membangun
                                    jaringan luas dan
                                    kokoh, serta menjunjung tinggi nilai kepercayaan bagi seluruh pemangku kepentingan
                                </p>
                                <!-- <button class="myButton" href="#">SELENGKAPNYA</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- start: Project Section -->
        <section class="tj-project-section-4 section-gap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-heading style-4 text-center">
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Produk &
                                Layanan</span>
                            <h2 class="sec-title title-anim">Produk & Layanan BPR Artha Puspa Mega.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="project-wrapper wow fadeInUp" data-wow-delay=".5s">
                            <div class="swiper project-slider-3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="project-item h4-project-item">
                                            <div class="project-content">
                                                <div class="project-text">
                                                    <h3 class="title"><a href="/kredit">Kredit</a></h3>
                                                    <a class="tji-icon-btn" href="/kredit">
                                                        <i class="tji-arrow-right-long"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="project-img">
                                                <img src="frontend/bprapm/assets/images/product/kredit-icon.jpg"
                                                    alt="Image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="project-item h4-project-item">
                                            <div class="project-content">
                                                <div class="project-text">
                                                    <h3 class="title"><a href="/deposito">Deposito</a>
                                                    </h3>
                                                    <a class="tji-icon-btn" href="/deposito">
                                                        <i class="tji-arrow-right-long"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="project-img">
                                                <img src="frontend/bprapm/assets/images/product/deposito-icon.jpg"
                                                    alt="Image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="project-item h4-project-item">
                                            <div class="project-content">
                                                <div class="project-text">
                                                    <h3 class="title"><a href="/tabungan">Tabungan</a></h3>
                                                    <a class="tji-icon-btn" href="/tabungan">
                                                        <i class="tji-arrow-right-long"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="project-img">
                                                <img src="frontend/bprapm/assets/images/product/tabungan-icon.jpg"
                                                    alt="Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination-area"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Project Section -->


        <section class="tj-contact-section h4-contact-section section-gap section-gap-x">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-10">
                        <div class="wow fadeInUp" data-wow-delay=".4s">

                            <div class="sec-heading style-4 text-center mb-4">
                                <span class="sub-title">
                                    <i class="tji-box"></i>Video
                                </span>
                                <h2 class="sec-title title-anim">
                                    Arthapuspa Video
                                </h2>
                            </div>
                            <div class="row g-4 justify-content-center">

                                <!-- Video 1 -->
                                <div class="col-md-6">
                                    <div style="border-radius:20px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.15);">
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/F037p6zEgsI" 
                                                    title="YouTube video"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="border-radius:20px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.15);">
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/Lc1X3tJAZNg?si=AHWlVaGwG3PA31VA" 
                                                    title="YouTube video"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-shape-1">
                <img src="frontend/bprapm/assets/images/shape/pattern-2.svg" alt="">
            </div>

            <div class="bg-shape-2">
                <img src="frontend/bprapm/assets/images/shape/pattern-3.svg" alt="">
            </div>
        </section>

        <!-- start: Blog Section -->
        <section class="tj-blog-section-2 section-gap">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="sec-heading-wrap">
                  <span class="sub-title wow fadeInUp" data-wow-delay=".3s">BERITA DAN EVENT</span>
                  <div class="heading-wrap-content">
                    <div class="sec-heading style-2">
                      <h2 class="sec-title text-anim">Temukan berita dan event terbaru kami</h2>
                    </div>
                    <!-- <div class="wow fadeInUp" data-wow-delay=".5s">
                      <p class="desc">Developing personalized customer journeys to increase satisfaction and loyalty.
                      </p>
                    </div> -->
                    <div class="slider-navigation d-none d-md-inline-flex wow fadeInUp" data-wow-delay=".7s">
                      <div class="slider-prev">
                        <span class="anim-icon">
                          <i class="tji-arrow-left"></i>
                          <i class="tji-arrow-left"></i>
                        </span>
                      </div>
                      <div class="slider-next">
                        <span class="anim-icon">
                          <i class="tji-arrow-right"></i>
                          <i class="tji-arrow-right"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                    <div class="col-12">
                        <div class="h4-blog-wrap">
                            @foreach ($allinfo->take(3) as $item)
                            <div class="blog-item style-3 wow fadeInUp" data-wow-delay=".3s">
                                <div class="blog-thumb">
                                    <img src="/recfil?display=true&rf={{ $item->thumbnail }}" alt="{{ $item->title }}">
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="categories">Berita</span>
                                    </div>
                                    <h4 class="title" style="min-height:70px;"><a href="{{ route('detberita', $item->id) }}">
                                        {{ \Illuminate\Support\Str::limit($item->title, 60) }}</a>
                                    </h4>
                                    <span style="color: white;">{{ \Carbon\Carbon::parse($item->tanggal_tampil)->translatedFormat('d M, Y') }}</span>
                                    <a class="text-btn" href="{{ route('detberita', $item->id) }}">
                                        <span class="btn-text"><span>Baca Selengkapnya</span></span>
                                        <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/informasi"><button class="btn btn-primary mt-3">Berita Lainnya</button></a>
                </div>
          </div>
        </section>
        <section class="tj-blog-section-4 section-gap" style="padding-top: 0;">
            <div class="text-center mt-3">
                <h4>INFORMASI PENJAMINAN LPS</h4>
                <p>Bank APM merupakan peserta penjaminan LPS. <br>Maksimum nilai simpanan yang dijamin oleh LPS adalah Rp. 2 Miliar per nasabah per bank. <br>Untuk informasi tingkat suku bunga penjamin LPS dapat diakses di <a href="https://apps.lps.go.id/BankPesertaLPSRate" style="color: gray; text-decoration: none;">https://apps.lps.go.id/BankPesertaLPSRate</a></p>
            </div>
        </section>
    </div>
@endsection
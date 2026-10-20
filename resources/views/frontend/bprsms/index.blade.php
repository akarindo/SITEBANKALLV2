@extends('frontend.bprsms.layout.main')

@section('content')
    <style>
        .hero-12 {
            position: relative;
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .hero-12 .swiper-slide,
        .hero-12 .hero-inner,
        .hero-12 .th-hero-bg {
            height: 550px;
        }

        .hero-12 .th-hero-bg {
            background-size: 100% 100%;
            /* fill full kanan kiri bawah */
            background-position: center;
            background-repeat: no-repeat;
        }

        .blog-grid4 .blog-img {
            width: 420px;
            min-width: 420px;
        }

        .blog-grid4 .blog-img img {
            width: 420px;
            height: 230px;
            /* tinggi sama semua */
            object-fit: cover;
            border-radius: 8px;
        }

        .berita-desc {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5;
            max-height: 3em;
            /* 2 baris */
            white-space: normal;
        }
        /* Kunci ukuran outer ring, JANGAN biarkan ikut ukuran gambar */
.choose-card .box-img.global-img {
    width: 300px;
    height: 300px;
    flex-shrink: 0;
    border-radius: 50%;
    overflow: hidden;
    box-sizing: border-box;
}

.choose-card .box-img.global-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    max-width: none;
    margin: 0;
}

/* Mobile: ring tetap konsisten, cuma ukurannya diperkecil proporsional — TIDAK ikut gambar */
@media (max-width: 576px) {
    .choose-card .box-img.global-img {
        position: relative;
        width: 70vw;
        max-width: 260px;
        height: 0;
        padding-top: 70vw;          /* samain persis dgn width */
        max-height: 260px;
        border-radius: 50%;
        overflow: hidden;
        box-sizing: border-box;
        margin-left: auto;
        margin-right: auto;
    }

    .choose-card .box-img.global-img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        max-width: none;
        margin: 0;
    }
}
    </style>
    <div class="hero-12 " style="background-color: #ff5a1e" id="hero">
        <div class="swiper th-slider overflow-hidden" id="heroSlide12"
            data-slider-options='{"effect":"fade","autoHeight":false,"autoplay":{"delay":3000}}'>

            <div class="swiper-wrapper">

                @foreach ($baner as $item)
                    @if (!empty($item->url) || !empty($item->url_mobile))
                        <div class="swiper-slide">
                            <div class="hero-inner">

                                <!-- Desktop -->
                                @if (!empty($item->url))
                                    <div class="th-hero-bg d-none d-md-block"
                                        style="background-image: url('/recfil?display=true&rf={{ $item->url }}');">
                                    </div>
                                @endif

                                <!-- Mobile -->
                                @if (!empty($item->url_mobile))
                                    <div class="th-hero-bg d-block d-md-none"
                                        style="background-image: url('/recfil?display=true&rf={{ $item->url_mobile }}');">
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>

        <!-- Arrow -->
        <button data-slider-prev="#heroSlide12" class="slider-arrow slider-prev">
            <img src="frontend/bprsms/assets/img/icon/right-arrow2.svg" alt="">
        </button>

        <button data-slider-next="#heroSlide12" class="slider-arrow slider-next">
            <img src="frontend/bprsms/assets/img/icon/left-arrow2.svg" alt="">
        </button>

    </div>

    @if ($umkm->isNotEmpty())
        <div class="blog sp">
            <div class="container" style="margin-top: 50px">
                <div class="title-area about-12-titlebox mb-20 pe-xxl-1 me-xxl-1">
                    <span class="sub-title style1 text-anime-style-2">UMKM</span>
                    <h2 class="sec-title mb-20 text-anime-style-3">UMKM BPR Baja</h2>

                </div>

                <div class="space30"></div>

                <div class="row">
                    @foreach ($umkm as $item)
                        @php
                            // badge
                            $badge = '';
                            $badgeColor = '';

                            if ($item->type_pilihan == 0) {
                                $badge = '⭐ Rekomendasi';
                                $badgeColor = '#28a745';
                            } elseif ($item->type_pilihan == 1) {
                                $badge = '🔥 Terlaris';
                                $badgeColor = '#dc3545';
                            } elseif ($item->type_pilihan == 2) {
                                $badge = '🏆 Top Rating';
                                $badgeColor = '#ffc107';
                            }

                            // layanan json
                            $layanan = json_decode($item->layanan, true);
                            $layananText = is_array($layanan) ? implode(', ', $layanan) : $item->layanan;
                        @endphp

                        <div class="col-md-3 col-12 mb-3">
                            <div style="
                                            border-radius:10px;
                                            overflow:hidden;
                                            box-shadow:0 4px 12px rgba(0,0,0,0.1);
                                            background:#fff;
                                            transition:0.3s;
                                            height:100%;
                                        "
                                onmouseover="this.style.transform='translateY(-5px)'"
                                onmouseout="this.style.transform='translateY(0)'">

                                <!-- gambar -->
                                <div style="position:relative;">
                                    <img src="/recfil?display=true&rf={{ $item->thumbnail }}"
                                        style="height:200px;width:100%;object-fit:fill;">

                                    @if ($badge)
                                        <span
                                            style="
                                                        position:absolute;
                                                        top:10px;
                                                        left:10px;
                                                        background:{{ $badgeColor }};
                                                        color:#fff;
                                                        padding:4px 10px;
                                                        font-size:12px;
                                                        border-radius:20px;
                                                        font-weight:bold;
                                                    ">
                                            {{ $badge }}
                                        </span>
                                    @endif

                                    @if ($item->nilai_discount > 0)
                                        <span
                                            style="
                                                        position:absolute;
                                                        top:10px;
                                                        right:10px;
                                                        background:#ff5a1e;
                                                        color:#fff;
                                                        padding:4px 10px;
                                                        font-size:12px;
                                                        border-radius:20px;
                                                        font-weight:bold;
                                                    ">
                                            Diskon {{ $item->nilai_discount }}
                                        </span>
                                    @endif
                                </div>

                                <!-- content -->
                                <div style="padding:12px;">

                                    <!-- title -->
                                    <h5
                                        style="
                                                    font-size:15px;
                                                    font-weight:bold;
                                                    margin-bottom:5px;
                                                    height:40px;
                                                    overflow:hidden;
                                                    text-align:center;
                                                ">
                                        {{ \Illuminate\Support\Str::limit($item->title, 45) }}
                                    </h5>

                                    <!-- rating -->
                                    <div style="font-size:13px;color:#ffc107;margin-bottom:5px;">
                                        ⭐ {{ $item->rating }}
                                    </div>

                                    <!-- lokasi -->
                                    <div style="font-size:13px;color:#666;margin-bottom:4px;">
                                        ⏰ Buka: {{ substr($item->jam_buka, 0, 5) }} -
                                        {{ substr($item->jam_tutup, 0, 5) }}
                                    </div>

                                    <!-- layanan -->
                                    <div
                                        style="
                                                    font-size:12px;
                                                    color:#444;
                                                    margin-bottom:10px;
                                                    height:30px;
                                                    overflow:hidden;
                                                ">
                                        🛍️ {{ \Illuminate\Support\Str::limit($layananText, 40) }}
                                    </div>

                                    <!-- button -->
                                    <a href="{{ route('detumkm', $item->id) }}"
                                        style="
                                                    display:block;
                                                    text-align:center;
                                                     background-color : #ff5a1e;
                                                    color:#fff;
                                                    padding:6px;
                                                    border-radius:20px;
                                                    font-size:13px;
                                                    text-decoration:none;
                                                    font-weight:bold;
                                                ">
                                        Lihat Detail
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="display:flex; justify-content:flex-end; margin-top:15px;">
                    <a href="umkm"
                        style="
                                    background-color : #ff5a1e;
                                    color:#fff;
                                    padding:8px 20px;
                                    border-radius:20px;
                                    font-weight:bold;
                                    text-decoration:none;
                                ">
                        Selengkapnya..
                    </a>
                </div>

            </div>
        </div>
    @endif

    <section class="choose-area5 space space-extra">

        <div class="container container-choose">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-8 col-lg-7 col-md-9">
                    <div class="title-area text-center">
                        <span class="sub-title text-anime-style-2">Produk</span>
                        <h2 class="sec-title text-anime-style-3">
                            Produk & Layanan BPR SMS
                        </h2>
                    </div>
                </div>
            </div>

            <div class="slider-area">
                <div class="swiper th-slider has-shadow chooseSlider" id="chooseSlider"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"},"1400":{"slidesPerView":"4"},"1600":{"slidesPerView":"5"}}}'>

                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="choose-card style5 text-center"
                                style="display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; min-height:420px;">

                                <div class="box-img global-img mb-30"
                                    style="display:flex; justify-content:center; align-items:center;">
                                    <img src="frontend/bprsms/assets/img/produk/kredit.png" alt="Image">
                                     
                                </div>

                                <h3 class="box-title">
                                    <a href="service-details.html">Kredit</a>
                                </h3>

                                <p class="sec-text">
                                     Solusi pembiayaan mudah dan cepat untuk kebutuhan usaha maupun pribadi dengan proses yang aman dan terpercaya.
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="choose-card style5 text-center"
                                style="display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; min-height:420px;">

                                <div class="box-img global-img mb-30"
                                    style="display:flex; justify-content:center; align-items:center;">
                                    <img src="frontend/bprsms/assets/img/produk/tabungan.png" alt="Image">
                                       
                                </div>

                                <h3 class="box-title">
                                    <a href="service-details.html">Deposito</a>
                                </h3>

                                <p class="sec-text">
                                    Simpanan berjangka dengan bunga kompetitif dan pilihan tenor fleksibel untuk investasi yang lebih menguntungkan.
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="choose-card style5 text-center"
                                style="display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; min-height:420px;">

                                <div class="box-img global-img mb-30"
                                    style="display:flex; justify-content:center; align-items:center;">
                                    <img src="frontend/bprsms/assets/img/produk/deposito.png" alt="Image">
                                      
                                </div>

                                <h3 class="box-title">
                                    <a href="service-details.html">Tabungan</a>
                                </h3>

                                <p class="sec-text">
                                    Produk tabungan aman dan praktis untuk membantu mengelola keuangan serta memenuhi kebutuhan masa depan.
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>





    <div class="contact-area3 bg-top-center space-top overflow-hidden"
        style="margin-top:50px;
           background-image:url('frontend/bprsms/assets/img/bg/bgcenter.jpg');
           background-size:cover;
           background-position:center;
           background-repeat:no-repeat;
           width:100vw;
           margin-left:calc(-50vw + 50%);
           margin-right:calc(-50vw + 50%);">
        <div class="container">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-6">
                    <div class="title-area contact8-titlebox">
                        <span class="sub-title text-white text-anime-style-2">
                            Rate Deposito
                        </span>

                        <h2 class="sec-title text-white text-anime-style-3">
                            Nikmati Suku Bunga Deposito Kompetitif dan Investasi Aman Bersama BPR Baja
                        </h2>

                        <p class="text-white mt-3">
                            BPR Baja menawarkan produk deposito dengan suku bunga menarik dan jangka waktu fleksibel
                            untuk membantu Anda mengembangkan dana secara optimal.
                    </div>

                    <div class="contact-action wow fadeInUp">
                        <a href="/deposito" class="th-btn style7 th-radius th-icon" style="margin-bottom: 20px">
                            Ajukan Deposito
                            <i class="fa-light fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact8-form-area ms-xl-5">
                        <table class="table table-bordered rate-table h-100 mb-0" style="border-color: #3b87f9;">
                            <thead style="background: linear-gradient(135deg, #0d2b5e, #3b87f9);">
                                <tr>
                                    <th
                                        style="color: #f5c518; font-weight: 700; letter-spacing: 0.5px; padding: 14px 16px; border-color: #3b87f9;">
                                        Nominal</th>
                                    <th
                                        style="color: #f5c518; font-weight: 700; letter-spacing: 0.5px; padding: 14px 16px; border-color: #3b87f9;">
                                        Produk</th>
                                    <th
                                        style="color: #f5c518; font-weight: 700; letter-spacing: 0.5px; padding: 14px 16px; border-color: #3b87f9;">
                                        Bunga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #eef4fb;">
                                    <td
                                        style="color: #3b87f9; font-weight: 600; padding: 13px 16px; border-color: #c4d6ed;">
                                        < Rp. 50jt</td>
                                    <td
                                        style="color: #b8860b; font-weight: 700; padding: 13px 16px; border-color: #c4d6ed;">
                                        Deposito 1, 3, 6, 12 Bulan</td>
                                    <td
                                        style="color: #b8860b; font-weight: 700; padding: 13px 16px; border-color: #c4d6ed;">
                                        6,00 %</td>
                                </tr>
                                <tr style="background-color: #eef4fb;">
                                    <td
                                        style="color: #3b87f9; font-weight: 600; padding: 13px 16px; border-color: #c4d6ed;">
                                        >= Rp. 50jt -< Rp. 1M</td>
                                    <td
                                        style="color: #b8860b; font-weight: 700; padding: 13px 16px; border-color: #c4d6ed;">
                                       </td>
                                    <td
                                        style="color: #b8860b; font-weight: 700; padding: 13px 16px; border-color: #c4d6ed;">
                                        6,00 %</td>
                                </tr>
                                <tr style="background-color: #eef4fb;">
                                    <td
                                        style="color: #3b87f9; font-weight: 600; padding: 13px 16px; border-color: #c4d6ed;">
                                        >= Rp.1 Miliar</td>
                                    <td
                                        style="color: #b8860b; font-weight: 700; padding: 13px 16px; border-color: #c4d6ed;">
                                        </td>
                                    <td
                                        style="color: #b8860b; font-weight: 700; padding: 13px 16px; border-color: #c4d6ed;">
                                        6,00 %</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="text-white mt-2 small" style="font-size: 13px; opacity: 0.9;">
                        *Tingkat bunga pinjaman ini berlaku mulai <strong>1 Oktober 2026</strong> sampai dengan <strong>31 Januari 2027</strong> (dapat berubah sewaktu-waktu sesuai ketentuan bank).
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="overflow-hidden space">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-end">
                <div class="col-lg">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title text-anime-style-2">Informasi</span>
                        <h2 class="sec-title text-anime-style-3">Berita Terbaru</h2>
                    </div>
                </div>

                <div class="col-lg-auto d-none d-lg-block">
                    <div class="sec-btn wow fadeInUp" data-wow-delay=".4s">
                        <a href="/informasi" class="th-btn style4 th-radius th-icon">
                            Lihat Semua..
                            <i class="fa-light fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row gx-24 gy-30">

                <!-- Kiri (2 besar) -->
                <div class="col-xl-8">

                    @foreach ($allinfo->take(2) as $item)
                        <div class="blog-grid2 style2 th-ani {{ !$loop->first ? 'mt-24' : '' }}">

                            <div class="blog-img global-img">
                                <img src="/recfil?display=true&rf={{ $item->thumbnail }}" style="object-fit: fill"
                                    alt="{{ $item->title }}">
                            </div>

                            <div class="blog-grid2_content">
                                <div class="blog-meta">
                                    <a class="author" href="#">
                                        {{ \Carbon\Carbon::parse($item->tanggal_tampil)->translatedFormat('d M Y') }}
                                    </a>

                                    <a href="#">
                                        {{ ceil(str_word_count(strip_tags($item->content)) / 200) }} min read
                                    </a>
                                </div>

                                <h3 class="box-title">
                                    <a href="{{ route('detberita', $item->id) }}">
                                        {{ \Illuminate\Support\Str::limit($item->title, 70) }}
                                    </a>
                                </h3>

                                <a href="{{ route('detberita', $item->id) }}" class="th-btn style4 th-radius th-icon">
                                    Read More
                                    <i class="fa-light fa-arrow-right-long"></i>
                                </a>

                            </div>
                        </div>
                    @endforeach

                </div>


                <!-- Kanan (1 besar) -->
                <div class="col-xl-4">

                    @foreach ($allinfo->skip(2)->take(1) as $item)
                        <div class="blog-grid2 th-ani">

                            <div class="blog-img global-img">
                                <img src="/recfil?display=true&rf={{ $item->thumbnail }}" alt="{{ $item->title }}">
                            </div>

                            <div class="blog-grid2_content">

                                <div class="blog-meta">
                                    <a class="author" href="#">
                                        {{ \Carbon\Carbon::parse($item->tanggal_tampil)->translatedFormat('d M Y') }}
                                    </a>

                                    <a href="#">
                                        {{ ceil(str_word_count(strip_tags($item->content)) / 200) }} min read
                                    </a>
                                </div>

                                <h3 class="box-title">
                                    <a href="{{ route('detberita', $item->id) }}">
                                        {{ \Illuminate\Support\Str::limit($item->title, 70) }}
                                    </a>
                                </h3>

                                <a href="{{ route('detberita', $item->id) }}" class="th-btn style4 th-radius th-icon">
                                    Read More
                                    <i class="fa-light fa-arrow-right-long"></i>
                                </a>

                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>

@endsection

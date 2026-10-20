@extends('frontend.bprstaja.layout.main')

@section('content')
    <style>
        @media (max-width: 768px) {

            .cta-flex {
                flex-direction: column;
                text-align: center;
            }

            .cta-flex div {
                padding: 15px;
            }

            .cta-flex img {
                max-width: 80%;
                margin: 20px auto;
            }

            .cta-flex h2 {
                font-size: 1.6rem;
            }

            .cta-flex h3 {
                font-size: 1.4rem;
            }

        }
    </style>

    <body>
        <div class="wrapper">

            <div id="carousel" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                    @php $indicatorIndex = 0; @endphp
                    @foreach ($baner as $item)
                        @if (!empty($item->url) || !empty($item->url_mobile))
                            <li data-target="#carousel" data-slide-to="{{ $indicatorIndex }}"
                                class="{{ $indicatorIndex == 0 ? 'active' : '' }}"></li>
                            @php $indicatorIndex++; @endphp
                        @endif
                    @endforeach
                </ol>

                <div class="carousel-inner">
                    @php $activeSet = false; @endphp

                    @foreach ($baner as $item)
                        @if (!empty($item->url) || !empty($item->url_mobile))
                            <div class="carousel-item {{ !$activeSet ? 'active' : '' }}">

                                {{-- DESKTOP --}}
                                @if (!empty($item->url))
                                    <img src="/recfil?display=true&rf={{ $item->url }}" class="d-none d-md-block w-100"
                                        alt="Slide">
                                @endif

                                {{-- MOBILE --}}
                                @if (!empty($item->url_mobile))
                                    <img src="/recfil?display=true&rf={{ $item->url_mobile }}"
                                        class="d-block d-md-none w-100" alt="Slide">
                                @endif

                            </div>

                            @php $activeSet = true; @endphp
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


            @if ($umkm->isNotEmpty())
                <div class="blog sp">
                    <div class="container">
                        <div class="section-header text-center">
                            <p>UMKM</p>
                            <h2>UMKM BPRS Taja</h2>
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
                                                        background:#ff5722;
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
                                                    background:#0a6e22;
                                                    color:#fff;
                                                    padding:6px;
                                                    border-radius:5px;
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
                                    background:#0a6e22;
                                    color:#fff;
                                    padding:8px 20px;
                                    border-radius:5px;
                                    font-weight:bold;
                                    text-decoration:none;
                                ">
                                Selengkapnya..
                            </a>
                        </div>

                    </div>
                </div>
            @endif


            <div
                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #ffffff; padding: 60px 0; position: relative; overflow: hidden;">
                <div class="cta-section"
                    style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%); z-index: 0;">
                </div>

                <div class="cta-flex"
                    style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; max-width: 1140px; margin: 0 auto; padding: 0 15px;">
                    <div style="flex: 1; padding: 20px;">
                        <h2
                            style="font-size: 2.2rem; font-weight: 700; color: #2e7d32; margin-bottom: 20px; line-height: 1.3;">
                            Ajukan Pinjaman Proses Mudah & Cepat</h2>
                        <a href="/pengajuanonline"
                            style="display: inline-flex; align-items: center; background-color: #2e7d32; color: white; padding: 12px 25px; border-radius: 30px; text-decoration: none; font-weight: 600; border: none; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#1b5e20'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(46, 125, 50, 0.3)';"
                            onmouseout="this.style.backgroundColor='#2e7d32'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            Selengkapnya
                        </a>
                    </div>

                    <div style="flex: 1.2; display: flex; justify-content: center; align-items: center; padding: 20px;">
                        <img src="frontend/bprstaja/img/centertop.png" alt="Layanan Pinjaman"
                            style="max-width: 100%; height: auto; border-radius: 10px;">
                    </div>

                    <div style="flex: 1; padding: 20px; text-align: right;">
                        <h3 style="font-size: 1.8rem; color: #333; margin-bottom: 15px; font-weight: 600;">Ada Pertanyaan?
                        </h3>
                        <p style="font-size: 1.1rem; color: #555; margin-bottom: 20px; line-height: 1.5;">Tanya langsung
                            untuk mendapat jawaban segera.</p>
                        <a href="https://wa.me/6281234567890"
                            style="display: inline-flex; align-items: center; background-color: transparent; color: #2e7d32; padding: 12px 25px; border-radius: 30px; text-decoration: none; font-weight: 600; border: 2px solid #2e7d32; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#2e7d32'; this.style.color='white'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(46, 125, 50, 0.3)';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#2e7d32'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            Kontak Kami
                        </a>
                    </div>
                </div>

                <!-- Elemen Dekoratif -->
                <div
                    style="position: absolute; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(46, 125, 50, 0.1) 0%, rgba(46, 125, 50, 0) 70%); z-index: 0; top: -100px; left: -100px;">
                </div>
                <div
                    style="position: absolute; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(46, 125, 50, 0.1) 0%, rgba(46, 125, 50, 0) 70%); z-index: 0; bottom: -100px; right: -100px;">
                </div>
            </div>





            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    {{-- <div class="section-header text-center">
                        <p>Our Services</p>
                        <h2>We Provide Services</h2>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="frontend/bprstaja/img/kredit.png" alt="Image">
                                    <div class="service-overlay">
                                        <p>
                                            Kredit adalah produk bank berupa fasilitas pinjaman dana yang diberikan kepada
                                            nasabah dengan kewajiban pengembalian dalam jangka waktu tertentu. Nasabah
                                            mengembalikan pinjaman tersebut secara angsuran sesuai perjanjian yang telah
                                            disepakati bersama bank.
                                        </p>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3>Kredit</h3>
                                    <a class="btn" href="frontend/bprstaja/img/kredit.png" data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="frontend/bprstaja/img/tabungan.png" alt="Image">
                                    <div class="service-overlay">
                                        <p>
                                            Tabungan adalah produk simpanan bank yang memungkinkan nasabah menyimpan uang
                                            dan melakukan penarikan sesuai ketentuan bank. Tabungan digunakan untuk membantu
                                            nasabah mengelola dan menyimpan dana secara aman.
                                        </p>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3>Tabungan</h3>
                                    <a class="btn" href="frontend/bprstaja/img/tabungan.png"
                                        data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="frontend/bprstaja/img/deposito.png" alt="Image">
                                    <div class="service-overlay">
                                        <p>
                                            Deposito adalah produk simpanan berjangka di bank yang penarikannya hanya dapat
                                            dilakukan pada waktu tertentu sesuai perjanjian. Deposito biasanya memberikan
                                            tingkat bunga lebih tinggi dibandingkan tabungan.
                                        </p>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3>Deposito</h3>
                                    <a class="btn" href="frontend/bprstaja/img/deposito.png"
                                        data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Service End -->


            <!-- Video Start -->
            <div class="video wow fadeIn" data-wow-delay="0.1s">
                <div class="container">
                    <button type="button" class="btn-play" data-toggle="modal"
                        data-src="https://www.youtube.com/embed/iUTZX2sUiHg" data-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="" id="video"
                                    allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video End -->


            {{-- <!-- Team Start -->
            <div class="team">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Our Team</p>
                        <h2>Meet Our Engineer</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="frontend/bprstaja/img/team-1.jpg" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Adam Phillips</h2>
                                    <p>CEO & Founder</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="frontend/bprstaja/img/team-2.jpg" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Dylan Adams</h2>
                                    <p>Civil Engineer</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="frontend/bprstaja/img/team-3.jpg" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Jhon Doe</h2>
                                    <p>Interior Designer</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="frontend/bprstaja/img/team-4.jpg" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Josh Dunn</h2>
                                    <p>Painter</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team End --> --}}


            {{-- <!-- FAQs Start -->
            <div class="faqs">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Frequently Asked Question</p>
                        <h2>You May Ask</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="accordion-1">
                                <div class="card wow fadeInLeft" data-wow-delay="0.1s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.2s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseTwo">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.3s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseThree">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.4s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseFour">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.5s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseFive">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="accordion-2">
                                <div class="card wow fadeInRight" data-wow-delay="0.1s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseSix">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseSix" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.2s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseSeven">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseSeven" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseEight">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseEight" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.4s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseNine">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseNine" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.5s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseTen">
                                            Lorem ipsum dolor sit amet?
                                        </a>
                                    </div>
                                    <div id="collapseTen" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FAQs End --> --}}


            {{-- <!-- Testimonial Start -->
            <div class="testimonial wow fadeIn" data-wow-delay="0.1s">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="testimonial-slider-nav">
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-1.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-2.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-3.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-4.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-1.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-2.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-3.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="frontend/bprstaja/img/testimonial-4.jpg" alt="Testimonial"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="testimonial-slider">
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial End --> --}}


            <!-- Blog Start -->
            <div class="blog">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Informasi</p>
                        <h2>Berita Terbaru</h2>
                    </div>
                    <div class="row">
                        @foreach ($allinfo as $item)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="blog-item">

                                    <div class="blog-img">
                                        <a href="{{ route('detberita', $item->slug) }}">
                                            <img src="/recfil?display=true&rf={{ $item->thumbnail }}"
                                                alt="{{ $item->title }}"
                                                style="width:100%; height:220px; object-fit:fill;">
                                        </a>
                                    </div>

                                    <div class="blog-meta">
                                        <p>
                                            <i class="far fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal_tampil)->translatedFormat('d M Y') }}
                                        </p>

                                        <p class="ml-3">
                                            <i class="fas fa-tag"></i>
                                            {{ implode(', ', json_decode($item->tag, true) ?? []) }}
                                        </p>
                                    </div>

                                    <div class="blog-text">
                                        <h4>
                                            <a href="{{ route('detberita', $item->id) }}"
                                                style="font-weight:bold; color:#000; text-decoration:none; font-size: 20px;">
                                                {{ \Illuminate\Support\Str::limit($item->title, 80) }}
                                            </a>
                                        </h4>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="display:flex; justify-content:flex-end; margin-top:15px;">
                        <a href="informasi"
                            style="
                                background:#0a6e22;
                                color:#fff;
                                padding:8px 20px;
                                border-radius:5px;
                                font-weight:bold;
                                text-decoration:none;
                            ">
                            Selengkapnya..
                        </a>
                    </div>
                </div>
            </div>
            <!-- Blog End -->



        </div>

    </body>
@endsection

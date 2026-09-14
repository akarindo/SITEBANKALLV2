@extends('frontend.bprtemanggung.layout.main')

@section('content')
    <style id="clear-banner-shadow">
        /* Hilangkan semua overlay bayangan */
        .header-carousel .header-carousel-item::before,
        .header-carousel .header-carousel-item::after,
        .header-carousel .header-carousel-item-img-1::before,
        .header-carousel .header-carousel-item-img-1::after,
        .header-carousel .header-carousel-item-img-2::before,
        .header-carousel .header-carousel-item-img-2::after,
        .header-carousel .header-carousel-item-img-3::before,
        .header-carousel .header-carousel-item-img-3::after {
            display: none !important;
            content: none !important;
            background: transparent !important;
            opacity: 0 !important;
        }
        
        .header-carousel-item {
            height: 650px;
            overflow: hidden;
        }
        
        @media (max-width: 767px) {
            .header-carousel-item {
                height: 220px; /* sesuaikan sama tinggi banner mobile kamu */
            }
        }
    </style>

    <body>
      <div class="header-carousel owl-carousel">
            @foreach ($baner as $item)
                @if (!empty($item->url) || !empty($item->url_mobile))
                    <div class="header-carousel-item">

                        {{-- DESKTOP --}}
                        @if (!empty($item->url))
                            <div class="d-none d-md-block w-100 h-100">
                                <img src="/recfil?display=true&rf={{ $item->url }}" class="img-fluid"
                                    alt="Banner Desktop" loading="lazy"
                                    style="width: 100%; height: 100%; object-fit: fill;">
                            </div>
                        @endif

                        {{-- MOBILE --}}
                        @if (!empty($item->url_mobile))
                            <div class="d-block d-md-none w-100 h-100">
                                <img src="/recfil?display=true&rf={{ $item->url_mobile }}" class="img-fluid"
                                    alt="Banner Mobile" loading="lazy" style="width: 100%; object-fit: fill;">
                            </div>
                        @endif

                        <div class="carousel-caption">
                            <div class="carousel-caption-inner text-center p-3"></div>
                        </div>

                    </div>
                @endif
            @endforeach
        </div>

      

      <section id="services" class="services section">
         <div class="row" style="padding: 50px;">
            <div class="col-8">
               <img src="frontend/bprtemanggung/assets/img/banner/info.png" alt="">
            </div>
            <div class="col-4">
               <a href="https://wa.me/6282138148690">
                  <img src="frontend/bprtemanggung/assets/img/banner/kontak.jpg" alt="">
               </a>
            </div>

         </div>
         <!-- Section Title -->
         <div class="container section-title" data-aos="fade-up">
            <h2>Layanan</h2>
            <p><span>Lihat </span> <span class="description-title">Layanan</span> <span> Kami</span></p>
         </div><!-- End Section Title -->
         <div class="container">
         <div class="row gy-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
               <div class="service-item position-relative">
               <div class="icon">
                  <i class="bi bi-credit-card"></i>
               </div>
               <a href="#" class="stretched-link">
                  <h3>Kredit</h3>
               </a>
               <p>BPR BKK Temanggung menyediakan beragam jenis produk Kredit untuk mewujudkan impian Anda, dan juga untuk para pebisnis dan pengusaha.</p>
               </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
               <div class="service-item position-relative">
               <div class="icon">
                  <i class="bi bi-cash-coin"></i>
               </div>
               <a href="#" class="stretched-link">
                  <h3>Deposito</h3>
               </a>
               <p>Investasikan uang Anda secara aman di Deposito BPR BKK Temanggung yang dilindungi oleh Lembaga Penjaminan Simpanan (LPS).</p>
               </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
               <div class="service-item position-relative">
               <div class="icon">
                  <i class="bi bi-piggy-bank"></i>
               </div>
               <a href="#" class="stretched-link">
                  <h3>Tabungan</h3>
               </a>
               <p>Tabungan BPR BKK Temanggung dirancang untuk Anda yang menginginkan program Tabungan menarik, berkualitas dan berhadiah langsung.</p>
               </div>
            </div><!-- End Service Item -->
         </div>

         </div>
      </section>

 
      <section id="featured-services" class="featured-services section">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <h3 class="stitle">Mengapa memilih <br> PT. BPR BKK Temanggung (Perseroda)?</h3>
               <p>PT. BPR BKK Temanggung merupakan BPR milik Pemprov Jateng dan Pemkab Temanggung yang sehat, aman, dan menguntungkan, serta berkomitmen untuk pemberdayaan UMKM dan didukung SDM yang berintegritas dan profesional. Jaringan Kantor dan Mobil Kas Keliling menyebar di wilayah Kabupaten Temanggung.</p>
            </div>
            <div class="container">
               <div class="row gy-4">
                  <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                     <div class="service-item position-relative">
                     <div class="icon"><i class="bi bi-bandaid"></i></div>
                     <h4><a href="" class="stretched-link">Sehat</a></h4>
                     <p>Kinerja keuangannya SEHAT hasil Audit OJK dan Kantor Akuntan Publik setiap tahun, serta penilaian Lembaga Independent mendapatkan predikat SANGAT BAGUS</p>
                     </div>
                  </div>

                  <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                     <div class="service-item position-relative">
                     <div class="icon"><i class="bi bi-key"></i></div>
                     <h4><a href="" class="stretched-link">Aman</a></h4>
                     <p>Tabungan dan Deposito dijamin LPS serta Tata Kelola Perusahaan dilaksanakan dengan baik sesuai regulasi GCG</p>
                     </div>
                  </div>

                  <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                     <div class="service-item position-relative">
                     <div class="icon"><i class="bi bi-coin"></i></div>
                     <h4><a href="" class="stretched-link">Menguntungkan</a></h4>
                     <p>Suku bunga tabungan dan deposito kompetitif mengacu pergerakan bunga penjaminan LPS. Suku bunga Kredit bersaing dengan lembaga perbankan dan keuangan lainnya</p>
                     </div>
                  </div>

                  <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                     <div class="service-item position-relative">
                     <div class="icon"><i class="bi bi-heart"></i></div>
                     <h4><a href="" class="stretched-link">Peduli</a></h4>
                     <p>Sebagai keseimbangan fungsi pelayanan Perbankan, juga melakukan misi sosial dalam program peduli dan berbagi kepada masyarakat yang kurang beruntung dilingkungan kantor dan sekitarnya</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>


      <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Berita & Event</h2>
        <p><span>Lihat&nbsp;</span><span class="description-title">Berita & Event</span> <span> Kami</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <!-- <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-product">Card</li>
            <li data-filter=".filter-branding">Web</li>
          </ul> -->

         <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($berita as $item)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
               <a href="{{ route('detberita', $item->id) }}" class="text-decoration-none text-dark">
                  <img src="/recfil?display=true&rf={{ $item->thumbnail }}" class="img-fluid" alt="{{ $item->title }}">
                  <div class="portfolio-info">
                     <h4>{{ $item->title }}</h4>
                     <p>{{ \Carbon\Carbon::parse($item->tanggal_tampil)->format('d M Y') }}</p>
                  </div>
               </a>
            </div><!-- End Portfolio Item -->
            @endforeach
         </div>
         <div class="text-center mt-4">
            <a href="" class="btn btn-primary">Lihat Semua Berita & Event</a>
        </div>

      </div>

    </section>
    </body>


@endsection

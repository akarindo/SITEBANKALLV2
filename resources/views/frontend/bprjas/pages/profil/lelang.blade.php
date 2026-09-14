@extends('frontend.bprjas.layout.main')

@section('content')
<style>
  .common-hero {
    background: url('{{ asset(env(' GLOBAL_TOPPAGE')) }}') no-repeat center center;
    background-size: contain;
    /* default untuk desktop */
    background-position: center;
    color: #fff;
    padding: 40px 0;
    position: relative;
    margin-top: 70px;
    /* jarak dari navbar */
    text-align: center;
    /* teks ke tengah */
  }

  /* Versi Mobile */
  @media (max-width: 768px) {
    .common-hero {
      background: url('{{ asset(env(' GLOBAL_TOPMOBILE')) }}') no-repeat center center;
      background-size: cover;
      /* gambar diperbesar biar penuh */
      min-height: 180px;
      /* tinggi hero agar kelihatan besar */
      display: flex;
      align-items: center;
      /* teks di tengah vertikal */
      justify-content: center;
      /* teks di tengah horizontal */
      padding: 0;
      /* hilangkan padding default */
    }

    .common-hero h1,
    .common-hero h2,
    .common-hero .title {
      font-size: 20px;
      /* sesuaikan ukuran teks agar pas di mobile */
      font-weight: bold;
      color: #000;
      /* atau putih jika kontras dengan background */
    }

    argin-top: 80px;
    /* Jarak dari navbar */
  }

  .auction-card {
    background: #fff;
    border-radius: 10px;
    border: 2px solid #ddd;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
  }

  .auction-card:hover {
    background: #0d6efd;
    /* biru */
    color: #fff !important;
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  .auction-card:hover * {
    color: #fff !important;
  }

  .auction-card:hover .btn {
    background: #198754 !important;
    border-color: #198754 !important;
    color: #fff !important;
  }

  /* Gambar */
  .main-img-wrapper {
    padding: 8px;
  }

  .main-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 8px;
  }

  .thumb {
    width: 32%;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
  }

  .thumb-more {
    width: 32%;
    height: 70px;
    border-radius: 6px;
    background: #333;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
  }

  .countdown-box {
    position: absolute;
    bottom: 0;
    left: 0;
    margin: 8px;
    padding: 4px 8px;
    background: red;
    color: white;
    border-radius: 6px;
    font-size: 12px;
  }
</style>

<!--=====HERO AREA START=======-->

<div class="common-hero">
  <div class="container">
    <div class="row align-items-center text-center">
      <div class="col-lg-8 m-auto">
        <div class="main-heading">
          <h1 style="font-size: 35px;">Lelang</h1>
          <span class="span"><img src="frontend/bprjas/assets/img/icons/span1.png" alt=""> <a href="/">Home</a> <span
              class="arrow"><i class="fa-regular fa-angle-right"></i></span> Lelang <span class="arrow">
        </div>
      </div>
    </div>
  </div>
</div>

<!--=====BLOG AREA START=======-->
<div class="col-lg-12">
  <div class="blog blog-page sp">
    <div class="container">
      <div class="row">
        <!-- Sidebar Produk Terkait -->
        <div class="col-lg-4">
          <div class="sidebar-box-area sidebar-bg mb-40">
            <h3>Tautan Terkait</h3>
            <ul class="features-list">
              <li><a href="lelang">Lelang <span><i class="fa-regular fa-angle-right"></i></span></a></li>
              <li><a href="#">Jual Aset <span><i class="fa-regular fa-angle-right"></i></span></a></li>
              <li><a href="rekrutmen">E-Recruitment <span><i class="fa-regular fa-angle-right"></i></span></a></li>
              <li><a href="pengaduan">Pengaduan Pelanggaran <span><i class="fa-regular fa-angle-right"></i></span></a>
              </li>
              <li><a
                  href="https://docs.google.com/forms/d/e/1FAIpQLSfO340OmQU84nottx330Gphj8vQbtgVhJa2Wx46YAjS4u_Ajw/viewform?pli=1">Survey
                  Kepuasan Pelanggan <span><i class="fa-regular fa-angle-right"></i></span></a></li>
            </ul>
          </div>
        </div>

        <!-- Konten Gambar Artikel -->
        <div class="col-lg-8">
          <div class="row">
            @foreach ($lelang as $item)
            <div class="col-lg-6 col-md-6 mb-4">
              <a href="{{ route('detlelang', $item->id) }}" class="text-decoration-none text-dark">
                <div class="auction-card shadow-sm border-0">

                  <!-- Gambar -->
                  <div class="position-relative main-img-wrapper">
                    <img src="/recfil?display=true&rf={{ $item->thumbnail}}" alt="Rumah Lelang"
                      style="height: 400px; object-fit:cover; width:100%;" class="main-img">
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">LIVE</span>
                  </div>

                  <!-- Detail -->
                  <div class="p-3 text-center">
                    <h6 class="fw-bold mb-2">
                      <i class="fa-solid fa-building me-1"></i> {{ $item->title }}
                    </h6>
                    <p class="small mb-2 text-muted">{{ $item->type_text }}</p>

                    <div class="d-flex justify-content-between small mb-2">
                      <span>Nilai Limit<br><strong class="text-warning">{{ number_format($item->limit, 0, ',', '.')
                          }}</strong></span>
                      <span>Uang Jaminan<br><strong>{{ number_format($item->jaminan, 0, ',', '.') }}</strong></span>
                    </div>

                    <p class="small mb-2">{{ $item->deskripsi }}</p>
                    <p class="small fw-bold text-primary mb-2">
                      Batas Akhir Setor Uang Jaminan<br>{{ \Carbon\Carbon::parse($item->selesai)->format('d-m-Y') }}
                    </p>
                    <span class="btn btn-sm btn-success w-100 fw-bold">DETAIL</span>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          </div>

        </div>

      </div>

    </div>
  </div>

  <!--=====BLOG AREA END=======-->

  @endsection
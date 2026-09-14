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
  }
</style>


<body>


  <div class="common-hero">
    <div class="container">
      <div class="row align-items-center text-center">
        <div class="col-lg-8 m-auto">
          <div class="main-heading">
            <h1 style="font-size: 35px">LAPORAN PUBLIKASI</h1>
            <span class="span">
              <img src="frontend/bprjas/assets/img/icons/span1.png" alt="">
              <a href="/">Home</a>
              <span class="arrow"><i class="fa-regular fa-angle-right"></i></span>
              Laporan Publikasi

            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== HERO AREA END =====-->

  <!-- BEGIN CONTENT PART -->
  <div id="superParentContainer" class="container pb-3">
    <div class="row readContent">
      <div class="col-lg-12 mt-3 mb-3">
        <div class="row d-flex justify-content-center">
          @foreach ($publikasi as $tahun => $laporanTahun)
          <div class="col-lg-4 mt-3 mb-3">
            <div class="card h-100 text-center border-0 shadow">

              <img src="/recfil?display=true&rf={{ $laporanTahun->first()->thumbnail }}"
                alt="Laporan Publikasi {{ $tahun }}" class="card-img-top rounded-3"
                style="width: 200px; height: 280px; object-fit: cover; margin: 0 auto;">

              <div class="card-body">
                <h6 class="text-muted" style="margin-bottom:5px;">Laporan Publikasi</h6>
                <h6 class="fw-bold">{{ config('subdomain.APP_NAME')}} {{ $tahun }}</h6>
                <br>
                <div class="d-grid gap-2">
                  @foreach ($laporanTahun->groupBy('triwulan') as $triwulan => $items)
                  <a href="/recfil?display=true&rf={{ $items->first()->url }}" target="_blank"
                    class="btn btn-danger text-white fw-bold">
                    {{ $triwulan }}
                  </a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div> <!-- End Row -->
      </div>
    </div>
  </div>
  <!-- END CONTENT PART -->

</body>
@endsection
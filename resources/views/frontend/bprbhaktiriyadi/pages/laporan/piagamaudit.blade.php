@extends('frontend.bprbhaktiriyadi.layout.main')

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
            <h1 style="font-size: 35px">PIAGAM AUDIT INTERNAL</h1>
            <span class="span">
              <img src="frontend/bprjas/assets/img/icons/span1.png" alt="">
              <a href="/">Home</a>
              <span class="arrow"><i class="fa-regular fa-angle-right"></i></span>
              Piagam Audit Internal

            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== HERO AREA END =====-->

  <div id="superParentContainer" class="container pb-3" style="margin-top:40px;">
    <div class="row readContent">
      <div class="col-lg-12 mt-3 mb-3">
        <div class="row d-flex justify-content-center">
          @foreach ($piagamaudit as $item)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 text-center border-0">
              <img src="/recfil?display=true&rf={{ $item->thumbnail}}" class="card-img-top rounded-3"
                alt="{{ $item->title }}" style="width: 200px; height: 300px; object-fit: cover; margin: 0 auto;">
              <div class="card-body">
                <h6 class="text-muted">Laporan</h6>
                <h6 class="fw-bold">{{ strtoupper($item->title) }}</h6>
                <br>
                <a href="/recfil?display=true&rf={{ $item->url }}" target="_blank"
                  class="btn btn-danger text-white fw-bold px-4">
                  Download
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div> <!-- End Row -->
      </div>
    </div>
  </div>


</body>
@endsection
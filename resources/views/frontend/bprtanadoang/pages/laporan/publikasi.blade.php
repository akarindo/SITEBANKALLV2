@extends('frontend.bprtanadoang.layout.main')

@section('content')
<section class="breadcrumb-area bg-img bg-overlay jarallax"
    style="background-image: url(frontend/bprtanadoang/img/profil/top.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2>Laporan Publikasi</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Publikasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<body class="body tg-heading-subheading animation-style3">


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
                                <h6 class="fw-bold">{{ config('subdomain.APP_NAME') }} {{ $tahun }}</h6>
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

    <!--=====CTA AREA START=======-->



    <!--=====CTA AREA END=======-->

</body>
@endsection
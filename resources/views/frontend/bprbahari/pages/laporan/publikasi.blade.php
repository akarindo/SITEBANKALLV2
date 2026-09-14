@extends('frontend.bprbahari.layout.main')

<style>
    .breadcrumb-area {
        margin-top: 90px;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .breadcrumb-area {
            margin-top: 0;
        }
    }
</style>
@section('content')
<div class="breadcrumb-area text-center shadow dark bg-fixed text-light"
    style="background-image: url(frontend/bprbahari/assets/img/profil/banertop.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Publikasi</h2>
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fas fa-home"></i> laporan</a></li>
                    <li class="active">Publikasi</li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
                                style="width: 200px; height: 280px; object-fit: fill; margin: 0 auto;">

                            <div class="card-body">
                                <h6 class="text-muted" style="margin-bottom:5px;">Laporan Publikasi</h6>
                                <h6 class="fw-bold">{{ config('subdomain.APP_NAME') }} {{ $tahun }}</h6>
                                <br>
                                <div class="d-grid gap-2">
                                    @foreach ($laporanTahun->groupBy('triwulan') as $triwulan => $items)
                                    <a href="/recfil?display=true&rf={{ $items->first()->url }}" target="_blank"
                                        class="btn btn-warning text-white fw-bold">
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


</body>
@endsection
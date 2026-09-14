@extends('frontend.bprkotamagelang.layout.main')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <img src="{{asset('frontend/bprkotamagelang/assets/img/banner/profile.jpeg')}}" alt="Breadcrumb"
        class="breadcrumb-img" />
</div>

<body class="body tg-heading-subheading animation-style3">
    <!-- BEGIN CONTENT PART -->
    <div id="superParentContainer" class="container" style="padding-top: 50px; padding-bottom: 60px;">
        <h5 class="display-4 wow fadeInDown" style="color: #000; text-align: center; font-size: 40px;"
            data-wow-delay="0.1s">LAPORAN PUBLIKASI</h5>
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


</body>
@endsection
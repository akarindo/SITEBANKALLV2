@extends('frontend.bprtanadoang.layout.main')

@section('content')
    <!-- CSS untuk menyamakan tinggi dan tampilan kartu dokumen -->
    <style>
        .portfolio-warp {
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .portfolio-warp:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .portfolio-img {
            height: 220px;
            overflow: hidden;
            background-color: #f4f5f7;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .portfolio-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .portfolio-warp:hover .portfolio-img img {
            transform: scale(1.05);
        }

        .portfolio-text {
            padding: 20px 15px;
            text-align: center;
            margin-top: auto;
            background-color: #f8f9fa;
        }

        .portfolio-text h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .btn-pdf {
            display: inline-block;
            padding: 8px 16px;
            font-size: 13px;
            color: #fff;
            background-color: #dc3545;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-pdf:hover {
            background-color: #bd2130;
            color: #fff;
        }

        @media (min-width: 768px) {
            .row {
                display: flex;
                flex-wrap: wrap;
            }

            .portfolio-item {
                display: flex;
            }
        }
    </style>

    <section class="breadcrumb-area bg-img bg-overlay jarallax"
        style="background-image: url({{ asset('frontend/bprtanadoang/img/profil/top.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>Dokumen</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dokumen</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="portfolio" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item wow fadeInUp mb-4" data-wow-delay="0.2s">
                    <div class="portfolio-warp">
                        <div class="portfolio-img">
                            <a href="{{ asset('laporan/sertifikatlaps123.png') }}" target="_blank">
                                <img src="{{ asset('laporan/sertifikatlaps123.png') }}" alt="Sertifikat LAPS">
                            </a>
                        </div>
                        <div class="portfolio-text">
                            <h3>Sertifikat LAPS</h3>
                               <a href="/recfil?display=true&rf=/staslaporan/sertifikatlaps123.pdf" target="_blank"
                                            class="btn btn-danger text-white fw-bold px-4">
                                            Download
                                        </a>
                        </div>
                    </div>
                </div>

                <!-- Dokumen 3 -->
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item wow fadeInUp mb-4" data-wow-delay="0.3s">
                    <div class="portfolio-warp">
                        <div class="portfolio-img">
                           <a href="{{ asset('laporan/piagamauditinternal123.png') }}" target="_blank">
                                <img src="{{ asset('laporan/piagamauditinternal123.png') }}" alt="Sertifikat LAPS">
                            </a>
                        </div>
                        <div class="portfolio-text">
                            <h3>Piagam Audit Internal</h3>
                             <a href="/recfil?display=true&rf=/staslaporan/piagamauditinternal123.pdf" target="_blank"
                                            class="btn btn-danger text-white fw-bold px-4">
                                            Download
                                        </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
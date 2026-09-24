@extends('frontend.bprbhaktiriyadi.layout.main')

@section('content')
<!-- Tambahkan CSS ini untuk menyamakan tinggi -->
<style>
    .portfolio-warp {
        display: flex;
        flex-direction: column;
        height: 100%;
        /* Pastikan elemen mengisi tinggi kolom */
        border: 1px solid #e0e0e0;
        /* Opsional: tambahkan border untuk melihat batas kartu */
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .portfolio-warp:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .portfolio-img {
        height: 250px;
        /* TINGGI TETAP untuk gambar utama */
        overflow: hidden;
    }

    .portfolio-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Agar gambar memenuhi kotak tanpa distorsi */
        transition: transform 0.5s ease;
    }

    .portfolio-warp:hover .portfolio-img img {
        transform: scale(1.1);
        /* Efek zoom saat hover */
    }

    .portfolio-thumbnails {
        padding: 10px;
    }

    .portfolio-thumbnails .row {
        margin: 0;
    }

    .portfolio-thumbnails .col-4 {
        padding: 2px;
        /* Jarak kecil antar thumbnail */
    }

    .portfolio-thumbnails img {
        transition: opacity 0.3s ease;
    }

    .portfolio-thumbnails a:hover img {
        opacity: 0.8;
    }

    .portfolio-text {
        padding: 15px;
        text-align: center;
        margin-top: auto;
        /* Mendorong bagian teks ke bawah */
        background-color: #f8f9fa;
        /* Opsional: warna latar teks */
    }

    /* Menyamakan tinggi untuk semua item di baris yang sama */
    @media (min-width: 768px) {
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .portfolio-item {
            display: flex;

        }

    }

    .portfolio-thumbnails .col-4 {
        padding: 3px;
    }

    .portfolio-thumbnails img {
        width: 100%;
        height: 80px;
        /* Tinggi thumbnail sama */
        object-fit: fill;
        border-radius: 4px;
    }
</style>

<div class="breadcumb-area style2 bg-smoke4">
    <div class="breadcumb-wrapper" data-bg-src="frontend/bprbhaktiriyadi/assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Piagam Audit</h1>
                <ul class="breadcumb-menu">
                    <li><a href="/">Profil</a></li>
                    <li>Piagam Audit</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="portfolio" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="container">
        <div class="row">
            
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
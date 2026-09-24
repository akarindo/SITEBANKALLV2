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
</style>

<!--=====HERO AREA START=======-->

<div class="common-hero">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-8 m-auto">
                <div class="main-heading">
                    <h1 style="font-size: 35px">Informasi LPS</h1>
                    <span class="span"><img src="frontend/bprjas/assets/img/icons/span1.png" alt=""> <a
                            href="/">Home</a> <span class="arrow"><i class="fa-regular fa-angle-right"></i></span>
                        Informasi LPS <span class="arrow">
                </div>
            </div>
        </div>
    </div>
</div>


<!--===== INFORMASI LPS START =====-->
<div class="container" style="margin-top:60px; font-family:'Archivo', sans-serif;">
    <div class="row text-center">
        <div class="col-12">
            <h3 style="color:#1a22f7; font-weight:600;">Informasi Lembaga Penjamin Simpanan (LPS)</h3>
            <p style="margin-top:10px; font-size:15px; color:#333;">
                Berikut merupakan nilai besaran simpanan dan tingkat bunga yang dijamin oleh
                <b>Lembaga Penjamin Simpanan (LPS)</b> per tanggal
                <b>01 Oktober 2025 sampai dengan 31 Januari 2026</b>.<br>
                Selengkapnya mengenai tingkat bunga penjamin <b><a href="https://apps.lps.go.id/BankPesertaLPSRate"
                        style="color:#000;">Klik Disini</a></b> :
            </p>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top:30px;">
        <!-- Kolom 1 -->
        <div class="col-md-5 text-center" style="margin-bottom:20px;">
            <button
                style="background:#1a22f7; color:#ffcc00; border:none; padding:10px 20px; border-radius:6px; font-weight:600; font-size:14px; margin-bottom:15px;">
                BATAS NOMINAL PENJAMINAN
            </button>
            <h3 style="font-weight:600; margin-bottom:10px;">Rp 2.000.000.000,00</h3>
            <p style="font-size:15px; color:#000;">(Dua Miliar Rupiah)</p>
        </div>

        <!-- Kolom 2 -->
        <div class="col-md-5 text-center" style="margin-bottom:20px;">
            <button
                style="background:#1a22f7; color:#ffcc00; border:none; padding:10px 20px; border-radius:6px; font-weight:600; font-size:14px; margin-bottom:15px;">
                TINGKAT BUNGA PENJAMINAN
            </button>
            <h3 style="font-weight:600; margin-bottom:10px;">6,25%</h3>
        </div>
    </div>
</div>
<!--===== INFORMASI LPS END =====-->
@endsection
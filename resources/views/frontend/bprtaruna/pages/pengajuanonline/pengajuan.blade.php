@extends('frontend.bprtaruna.layout.main')

@section('content')
    <style>
        .banner-img {
            width: 100%;
            height: 650px;
            object-fit: fill;
            display: block;
        }

        @media(max-width:768px) {
            .banner-img {
                height: 260px;
                object-fit: cover;
            }
        }

        .running-text {
            color: rgb(250, 109, 109);
            font-size: 58px;
            font-weight: bold;
            padding-right: 80px;
            white-space: nowrap;
        }

        .team-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>

    <div style="width:100%; overflow:hidden; ">
        <img src="{{ asset('frontend/bprtaruna/assets/img/profil/tarunav2.png') }}" style="object-fit: fill; margin-top: 75px;" alt="Banner" 
            class="banner-img">
    </div>

 
    <div class="team2 team-page sp" style="padding-top:0px">
        <div class="container" style="margin-top: 50px">
            <br>

            {{-- <h4 style=" text-align:center; color:#e53935; font-weight:600; margin-bottom:20px;">
                Pengajuan Online
            </h4> --}}

            <div style=" border:1.5px solid #ff0000; border-radius:8px; padding:30px 15px;">

                <h5 style=" text-align:center; font-weight:600; margin-bottom:30px; ">
                    Pilih Layanan
                </h5>

                <div class="row justify-content-center">

                    <!-- Kredit -->
                    <div class="col-lg-4 col-md-6">
                        <a href="/formpengajuankredit" style="text-decoration:none;color:inherit;">
                            <div class="team-box"
                                style="background:#6591e8;border-radius:8px;padding:25px 15px;text-align:center;margin-bottom:20px;cursor:pointer;transition:.3s;">
                                <div class="image-area">
                                    <div class="image">
                                        <img src="{{ asset('frontend/bprrudo/assets/img/profil/kredit.png') }}"
                                            style="width:70px;margin-bottom:15px;">
                                    </div>
                                </div>
                                <h5 style="margin-bottom:5px;">Kredit</h5>
                                <p style="font-size:15px;color:#555;">Klik disini untuk mengisi formulir <br> pengajuan
                                    Kredit</p>
                            </div>
                        </a>
                    </div>


                    <!-- Tabungan -->
                    <div class="col-lg-4 col-md-6">
                        <a href="/formpengajuantabungan" style="text-decoration:none;color:inherit;">
                            <div class="team-box"
                                style="background:#d7d3e8;border-radius:8px;padding:25px 15px;text-align:center;margin-bottom:20px;cursor:pointer;transition:.3s;">
                                <div class="image-area">
                                    <div class="image">
                                        <img src="{{ asset('frontend/bprrudo/assets/img/profil/tabungan.png') }}"
                                            style="width:70px;margin-bottom:15px;">
                                    </div>
                                </div>
                                <h5 style="margin-bottom:5px;">Tabungan</h5>
                                <p style="font-size:15px;color:#555;">Klik disini untuk mengisi formulir <br> pengajuan
                                    Tabungan</p>
                            </div>
                        </a>
                    </div>



                    <!-- Deposito -->
                    <div class="col-lg-4 col-md-6">
                        <a href="/formpengajuandeposito" style="text-decoration:none;color:inherit;">
                            <div class="team-box"
                                style="background:#d7d3e8;border-radius:8px;padding:25px 15px;text-align:center;margin-bottom:20px;cursor:pointer;transition:.3s;">
                                <div class="image-area">
                                    <div class="image">
                                        <img src="{{ asset('frontend/bprrudo/assets/img/profil/deposito.png') }}"
                                            style="width:70px;margin-bottom:15px;">
                                    </div>
                                </div>

                                <h5 style="margin-bottom:5px;">Deposito</h5>
                                <p style="font-size:15px;color:#555;">
                                    Klik disini untuk mengisi formulir <br>
                                    pengajuan Deposito
                                </p>
                            </div>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

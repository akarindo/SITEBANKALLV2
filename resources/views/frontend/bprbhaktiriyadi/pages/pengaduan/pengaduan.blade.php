@extends('frontend.bprbhaktiriyadi.layout.main')

@section('content')
<style>
    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 15px;
        position: relative;
    }

    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #6c757d;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .step.active .step-number {
        background-color: #007bff;
        color: white;
    }

    .step.completed .step-number {
        background-color: #28a745;
        color: white;
    }

    .step-label {
        font-size: 12px;
        text-align: center;
    }

    .step-line {
        position: absolute;
        top: 15px;
        left: 50%;
        width: 30px;
        height: 2px;
        background-color: #e9ecef;
    }

    .step.completed .step-line {
        background-color: #28a745;
    }

    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #343a40;
        color: white;
        padding: 15px 20px;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        max-width: 300px;
    }

    .toast-notification.success {
        background-color: #28a745;
    }

    /* Style untuk bagian form yang dinamis */
    .form-section-dinamis {
        display: none;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #dee2e6;
    }

    .alur-icon {
        width: 80px;
        height: 80px;
        object-fit: contain;
        opacity: 0.9;
        transition: 0.3s;
    }

    .alur-icon:hover {
        transform: scale(1.1);
        opacity: 1;
    }

    file-list {
        margin-top: 10px;
        padding-left: 0;
    }

    /* setiap item file */
    .file-list li {
        list-style: none;
        background: #f4f6f9;
        margin-bottom: 6px;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #e2e6ea;
    }

    /* icon */
    .file-list li::before {
        content: "•";
        font-size: 20px;
    }

    /* Running text animation */
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* Responsive Banner */
    .banner-img {
        width: 100%;
        height: 500px;
        object-fit: fill;
        display: block;
    }

    @media(max-width:768px) {
        .banner-img {
            height: 260px;
            object-fit: cover;
        }
    }

    /* css untuk form login */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }

    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .form-control:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 0 0.25rem rgba(106, 17, 203, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a0dbb 0%, #1575ec 100%);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .btn-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #0a8b7e 0%, #28de6d 100%);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .step-indicator {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;
        width: 33.33%;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .step.active .step-number {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        box-shadow: 0 4px 8px rgba(106, 17, 203, 0.3);
    }

    .step-label {
        font-size: 0.8rem;
        text-align: center;
        color: #6c757d;
    }

    .step.active .step-label {
        color: #495057;
        font-weight: 600;
    }

    .step-line {
        position: absolute;
        top: 20px;
        left: 50%;
        width: 100%;
        height: 2px;
        background-color: #e9ecef;
        z-index: -1;
    }

    .step:last-child .step-line {
        display: none;
    }

    .form-control {
        transition: all 0.3s ease;
    }

    .form-control:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #otp_code {
        letter-spacing: 0.5em;
        font-family: monospace;
    }
</style>

<div class="breadcumb-area style2 bg-smoke4">
    <div class="breadcumb-wrapper" data-bg-src="frontend/bprbhaktiriyadi/assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Pengaduan Nasabah</h1>
                <ul class="breadcumb-menu">
                    <li><a href="#">Beranda</a></li>
                    <li>Pengaduan Nasabah</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<body class="body tg-heading-subheading animation-style3">


    <!--===== LAYANAN PENGADUAN =====-->
    <section class="py-5 text-center">

        <div class="row justify-content-center mb-4" style="margin-top: 40px;">
            <div class="col-lg-8">
                <p style="color: black; font-size: 23px;">
                    Kami menyediakan sarana bagi masyarakat untuk menyampaikan pengaduan dan pelanggaran yang terjadi di
                    lingkungan sekitar secara cepat dan mudah.
                </p>
            </div>
        </div>
        <!-- TEKS + IKON ARAH -->
        <div class="row justify-content-center mb-3" style="margin-top: 50px">
            <div class="col-md-6 text-center">
                <div style="font-size:18px;  color:#333;">
                    Klik pengaduan di bawah ini
                </div>
                <div style="font-size:30px; margin-top:5px;">
                    👇
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <a href="#" class="btn btn-lg" id="btnPengaduan"
                    style=" width: 80%; padding: 15px 7px;  background: linear-gradient(45deg, #091098, #ffffff); color: #ffffff;font-size: 25px; border-radius: 30px;">
                    <i class="fas fa-edit mr-2"></i> Pengaduan Nasabah
                </a>

            </div>
        </div>


        </div>
    </section>



    <!--===== MODAL AUTHENTICATION =====-->
    <div class="modal fade" id="modalAuth" tabindex="-1" role="dialog" aria-labelledby="modalAuthLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-primary text-white border-0 py-4">
                    <h5 class="modal-title"><i class="fas fa-user-lock mr-2"></i> Masuk / Daftar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        style="font-size: 15px;"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Step Indicator -->
                    <div class="step-indicator mb-4">
                        <div class="step active" id="step1">
                            <div class="step-number">1</div>
                            <div class="step-label">Login / Daftar</div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step" id="step2">
                            <div class="step-number">2</div>
                            <div class="step-label">Verifikasi OTP</div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step" id="step3">
                            <div class="step-number">3</div>
                            <div class="step-label">Form Pengaduan</div>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content pt-3">
                        <!-- LOGIN -->
                        <div class="tab-pane active" id="loginTab" role="tabpanel">
                            <form id="formLoginxx" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-pill" id="login_identifier"
                                        name="email" placeholder="Email / Nomor HP" required>
                                    <label for="login_identifier">Email / Nomor HP</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control rounded-pill" id="login_password"
                                        name="password" placeholder="Password" required>
                                    <label for="login_password">Password</label>
                                </div>
                                <div id="login_errors" class="text-danger mb-3 px-3" style="display:none"></div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary rounded-pill py-2" id="btnLoginx">
                                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                    </button>
                                </div>
                            </form>

                            <div class="text-center mt-4">
                                <p class="mb-0">Belum punya akun? <a href="#" id="showRegister"
                                        class="text-decoration-none fw-bold" style="color: #f63030 ">Daftar sekarang</a>
                                </p>
                            </div>
                        </div>

                        <!-- REGISTER -->
                        <div class="tab-pane" id="registerTab" role="tabpanel">
                            <form id="formRegister" method="POST" action="{{ route('register.process') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-pill" id="reg_name" name="name"
                                        placeholder="Nama Lengkap" required>
                                    {{-- <label for="reg_name">Nama Lengkap</label> --}}
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control rounded-pill" id="reg_email" name="email"
                                        placeholder="Email" required>
                                    {{-- <label for="reg_email">Email</label> --}}
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-pill" id="reg_phone" name="phone"
                                        placeholder="Nomor HP" required>
                                    {{-- <label for="reg_phone">Nomor HP</label> --}}
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control rounded-3" id="reg_alamat" name="alamat"
                                        placeholder="Alamat" required style="height: 100px"></textarea>
                                    {{-- <label for="reg_alamat">Alamat</label> --}}
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control rounded-pill" id="reg_password"
                                        name="password" placeholder="Password" required>
                                    {{-- <label for="reg_password">Password</label> --}}
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control rounded-pill"
                                        id="reg_password_confirmation" name="password_confirmation"
                                        placeholder="Konfirmasi Password" required>
                                    {{-- <label for="reg_password_confirmation">Konfirmasi Password</label> --}}
                                </div>
                                <div id="reg_errors" class="text-danger mb-3 px-3" style="display:none"></div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success rounded-pill py-2" id="btnRegister">
                                        <i class="fas fa-user-plus me-2"></i>Daftar
                                    </button>
                                </div>
                            </form>

                            <div class="text-center mt-4">
                                <p class="mb-0">Sudah punya akun? <a href="#" id="showLogin"
                                        class="text-decoration-none fw-bold" style="color: #f63030 ">Masuk</a></p>
                            </div>
                        </div>

                        <!-- OTP VERIFICATION -->
                        <div class="tab-pane" id="otpTab" role="tabpanel">
                            <div class="text-center mb-4 p-3 bg-light rounded-3">
                                <i class="fas fa-envelope-open-text fa-3x text-primary mb-3"></i>
                                <p class="mb-2">Kami telah mengirim kode OTP ke email Anda.</p>
                                <p>Silakan masukkan kode tersebut di bawah ini:</p>
                                <p class="font-weight-bold" id="otpEmail"></p>
                            </div>

                            <form id="formOtp">
                                <!-- OTP Input - Centered -->
                                <div class="text-center mb-3">
                                    <div class="d-inline-block" style="width: 300px;">
                                        <input type="text" class="form-control text-center fs-5 fw-bold rounded-pill"
                                            id="otp_code" placeholder="Masukkan 6 digit kode OTP" maxlength="6" required
                                            style="letter-spacing: 0.5em; font-family: monospace; text-align: center;">
                                        <label for="otp_code" class="text-center w-100" style="margin-left: -12px;">Kode
                                            OTP</label>
                                    </div>
                                </div>
                                <div id="otp_errors" class="text-danger mb-3 px-3 text-center" style="display:none">
                                </div>

                                <!-- Buttons - Centered -->
                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 mx-2"
                                        id="btnResendOtp">
                                        <i class="fas fa-redo me-2"></i>Kirim Ulang OTP
                                    </button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 mx-2"
                                        id="btnVerifyOtp">
                                        <i class="fas fa-check-circle me-2"></i>Verifikasi
                                    </button>
                                </div>
                            </form>

                            <div class="text-center mt-4">
                                <p class="mb-0">Tidak menerima email? Periksa folder spam atau <a href="#"
                                        id="btnResendOtpLink" class="text-decoration-none fw-bold">kirim ulang OTP</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Setelah masuk, Anda akan
                        diarahkan kembali ke form pengaduan.</small>
                </div>
            </div>
        </div>
    </div>



    <!--===== MODAL FORM PENGADUAN =====-->
    <div class="modal fade" id="modalFormAduan" tabindex="-1" role="dialog" aria-labelledby="modalFormAduanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg">
                <!-- FORM UTAMA: Semua input yang akan disimpan berada di dalam form ini -->
                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                    id="formPengaduan">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="fas fa-edit mr-2"></i> Form Pengaduan Nasabah</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <!-- Bagian Pemilih Jenis Aduan -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h6 class="card-title fw-bold"><i class="fas fa-list-alt me-2"></i>Kategori Aduan</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_aduan" class="form-label fw-semibold">Jenis Aduan</label>
                                        <select name="jenis_aduan" id="jenis_aduan" class="form-select">
                                            <option value="">Pilih Jenis Aduan</option>
                                            @foreach ($jenis_aduan as $v)
                                            <option value="{{ $v->form }}">{{ $v->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sub_aduan" class="form-label fw-semibold">Sub Aduan</label>
                                        <select name="sub_aduan" id="sub_aduan" class="form-select">
                                            <option value="">Pilih Sub Aduan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Placeholder Informasi Awal -->
                        <div id="form-placeholder" class="text-center text-muted my-5 p-4 bg-light rounded-3">
                            <i class="fas fa-arrow-up fa-2x mb-2"></i>
                            <p>Silakan pilih Jenis Aduan terlebih dahulu untuk melanjutkan pengisian form.</p>
                        </div>

                        <!-- Checkbox Kategori Pelapor -->
                        <div class="col-md-12" id="jenis_opsi_container" style="display:none;">
                            <div class="card border-info mb-4">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold text-info"><i
                                            class="fas fa-user-tag me-2"></i>Kategori Pelapor</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input kategoriCheck" type="checkbox"
                                            id="opsi_perusahaan" name="kategori[]" value="Perusahaan">
                                        <label class="form-check-label" for="opsi_perusahaan">Perusahaan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input kategoriCheck" type="checkbox"
                                            id="opsi_perorangan" name="kategori[]" value="Perorangan">
                                        <label class="form-check-label" for="opsi_perorangan">Perorangan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ============================================================= -->
                        <!-- FORM DINAMIS 1: Pelanggaran. Semua 'name' disamakan dengan kode fungsional -->
                        <!-- ============================================================= -->
                        <div class="form-section-dinamis" data-jenis-id="1" style="display: none;">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Detail
                                        Pelanggaran</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- name="nama" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_1" class="form-label fw-semibold">Pihak Yang
                                                Dilaporkan</label>
                                            <input type="text" name="nama" id="nama_1" class="form-control">
                                        </div>
                                        <!-- name="jbt_plg" -->
                                        <div class="col-md-6 mb-3" id="jabatan_container" style="display:none;">
                                            <label for="jbt_plg" class="form-label fw-semibold">Jabatan</label>
                                            <select name="jbt_plg" id="jbt_plg" class="form-select">
                                                <option value="">Pilih Jabatan</option>
                                                @foreach ($jabatan as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- name="lokasi" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="lokasi_1" class="form-label fw-semibold">Lokasi</label>
                                            <input type="text" name="lokasi" id="lokasi_1" class="form-control">
                                        </div>
                                        <!-- name="waktu_plg" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="waktu_plg" class="form-label fw-semibold">Tanggal & Jam
                                                Pelanggaran</label>
                                            <input type="datetime-local" name="waktu_plg" id="waktu_plg"
                                                class="form-control">
                                        </div>
                                        <!-- name="rugi" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="rugi_1" class="form-label fw-semibold">Kerugian Yang
                                                Dialami</label>
                                            <input type="text" name="rugi" id="rugi_1" class="form-control">
                                        </div>
                                        <!-- name="uraian" -->
                                        <div class="col-md-12 mb-3">
                                            <label for="uraian_1" class="form-label fw-semibold">Uraian
                                                Pengaduan</label>
                                            <textarea name="uraian" id="uraian_1" class="form-control"
                                                rows="3"></textarea>
                                        </div>
                                        <!-- name="bukti1[]" -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Bukti Gambar (maks 5 file)</label>
                                            <input type="file" class="form-control" accept="image/*" name="bukti1[]"
                                                id="bukti1_input" multiple>
                                            <ul id="bukti1_list" class="file-list mt-2"
                                                style="list-style-type: none; padding-left: 0;"></ul>
                                        </div>
                                        <!-- name="bukti2[]" -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Bukti Suara/Video (maks 5
                                                file)</label>
                                            <input type="file" class="form-control" accept="audio/*,video/*"
                                                name="bukti2[]" id="bukti2_input" multiple>
                                            <ul id="bukti2_list" class="file-list mt-2"
                                                style="list-style-type: none; padding-left: 0;"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ============================================================= -->
                        <!-- FORM DINAMIS 2: Produk/Layanan. Semua 'name' disamakan dengan kode fungsional -->
                        <!-- ============================================================= -->
                        <div class="form-section-dinamis" data-jenis-id="2" style="display: none;">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="fas fa-hand-holding-usd me-2"></i>Detail
                                        Produk/Layanan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- name="namaxx" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="namaxx_2" class="form-label fw-semibold">Nama BPR</label>
                                            <input type="text" name="namaxx" id="namaxx_2" class="form-control"
                                                value="{{ config('subdomain.APP_NAME') }}" readonly>
                                        </div>
                                        <!-- name="lokasixx" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="lokasixx_2" class="form-label fw-semibold">Alamat
                                                Kantor</label>
                                            <input type="text" name="lokasixx" id="lokasixx_2" class="form-control">
                                        </div>
                                        <!-- name="jenis_pl" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="jenis_pl" class="form-label fw-semibold">Jenis
                                                Produk/Layanan</label>
                                            <select name="jenis_pl" id="jenis_pl" class="form-select">
                                                <option value="">Pilih Produk/Layanan</option>
                                                @foreach ($produk as $p)
                                                <option value="{{ $p->id }}">{{ $p->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- name="rugixx" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="rugixx_2" class="form-label fw-semibold">Kerugian Yang
                                                Dialami</label>
                                            <input type="text" name="rugixx" id="rugixx_2" class="form-control">
                                        </div>
                                        <!-- name="tuntutan_pl" -->
                                        <div class="col-md-6 mb-3">
                                            <label for="tuntutan_pl" class="form-label fw-semibold">Tuntutan
                                                Nasabah</label>
                                            <input type="text" name="tuntutan_pl" id="tuntutan_pl" class="form-control">
                                        </div>
                                        <!-- name="uraianxx" -->
                                        <div class="col-md-12 mb-3">
                                            <label for="uraianxx_2" class="form-label fw-semibold">Uraian
                                                Pengaduan</label>
                                            <textarea name="uraianxx" id="uraianxx_2" class="form-control"
                                                rows="3"></textarea>
                                        </div>
                                        <!-- name="bukti1xx[]" -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Bukti Gambar (maks 5 file)</label>
                                            <input type="file" class="form-control" accept="image/*" name="bukti1xx[]"
                                                id="bukti1xx_input" multiple>
                                            <ul id="bukti1xx_list" class="file-list mt-2"
                                                style="list-style-type: none; padding-left: 0;"></ul>
                                        </div>
                                        <!-- name="bukti2xx[]" -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Bukti Suara/Video (maks 5
                                                file)</label>
                                            <input type="file" class="form-control" accept="audio/*,video/*"
                                                name="bukti2xx[]" id="bukti2xx_input" multiple>
                                            <ul id="bukti2xx_list" class="file-list mt-2"
                                                style="list-style-type: none; padding-left: 0;"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer berada di dalam form agar tombol submit berfungsi -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <!-- Tombol ini akan submit form di atasnya -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
            let currentUser = null;

            // Event listener untuk tombol pengaduan
            $('#btnPengaduan').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/api/check-auth',
                    method: 'GET',
                    success: function(response) {
                        if (response.authenticated) {
                            $('#modalFormAduan').modal('show');
                        } else {
                            $('#modalAuth').modal('show');
                            resetSteps();
                            showLoginTab();
                        }
                    },
                    error: function() {
                        $('#modalAuth').modal('show');
                        resetSteps();
                        showLoginTab();
                    }
                });
            });

            // JavaScript untuk login, register, OTP tetap sama

            // Toggle antara login dan register
            $('#showRegister').click(function(e) {
                e.preventDefault();
                showRegisterTab();
            });

            $('#showLogin').click(function(e) {
                e.preventDefault();
                showLoginTab();
            });

            // Fungsi untuk menampilkan tab login
            function showLoginTab() {
                $('#loginTab').addClass('active');
                $('#registerTab').removeClass('active');
                $('#otpTab').removeClass('active');
                updateStepIndicator(1);
            }

            // Fungsi untuk menampilkan tab register
            function showRegisterTab() {
                $('#loginTab').removeClass('active');
                $('#registerTab').addClass('active');
                $('#otpTab').removeClass('active');
                updateStepIndicator(1);
            }

            // Fungsi untuk menampilkan tab OTP
            function showOtpTab(email) {
                $('#loginTab').removeClass('active');
                $('#registerTab').removeClass('active');
                $('#otpTab').addClass('active');
                $('#otpEmail').text(email);
                updateStepIndicator(2);
            }

            // Fungsi untuk update step indicator
            function updateStepIndicator(step) {
                $('.step').removeClass('active completed');

                for (let i = 1; i <= step; i++) {
                    if (i < step) {
                        $('#step' + i).addClass('completed');
                    } else {
                        $('#step' + i).addClass('active');
                    }
                }
            }

            // Fungsi untuk reset step indicator
            function resetSteps() {
                $('.step').removeClass('active completed');
                $('#step1').addClass('active');
            }

            // Proses login
            $('#formLogin').on('submit', function(e) {
                e.preventDefault();
                $('#login_errors').hide().text('');
                $('#btnLogin').prop('disabled', true).text('Proses...');
                return $('#formLogin').submit();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json'
                }).done(function(response) {
                    if (response.success) {
                        // Login berhasil, simpan user data
                        currentUser = response.user;

                        // Cek apakah email sudah diverifikasi
                        if (response.user.email_verified_at) {
                            // Email sudah diverifikasi, buka form pengaduan
                            $('#modalAuth').modal('hide');
                            $('#modalFormAduan').modal('show');
                            updateStepIndicator(3);
                        } else {
                            // Email belum diverifikasi, kirim OTP dan tampilkan tab OTP
                            sendOtp(response.user.email);
                            showOtpTab(response.user.email);
                        }
                    } else {
                        // Login gagal
                        $('#login_errors').show().text(response.message ||
                            'Login gagal. Periksa kredensial Anda.');
                    }
                }).fail(function(xhr) {
                    let errorMessage = 'Terjadi kesalahan. Coba lagi.';

                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join(' ');
                        } else if (xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                    }

                    $('#login_errors').show().text(errorMessage);
                }).always(function() {
                    $('#btnLogin').prop('disabled', false).text('Masuk');
                });
            });

            // Proses register
            $('#formRegister').on('submit', function(e) {
                e.preventDefault();
                $('#reg_errors').hide().text('');
                $('#btnRegister').prop('disabled', true).text('Proses...');

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json'
                }).done(function(response) {
                    if (response.success) {
                        // Register berhasil, kirim OTP dan tampilkan tab OTP
                        sendOtp(response.user.email);
                        showOtpTab(response.user.email);
                    } else {
                        // Register gagal
                        $('#reg_errors').show().text(response.message || 'Pendaftaran gagal.');
                    }
                }).fail(function(xhr) {
                    let errorMessage = 'Terjadi kesalahan. Coba lagi.';

                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join(' ');
                        } else if (xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                    }

                    $('#reg_errors').show().text(errorMessage);
                }).always(function() {
                    $('#btnRegister').prop('disabled', false).text('Daftar');
                });
            });

            // Fungsi untuk mengirim OTP
            function sendOtp(email) {
                $.ajax({
                    url: '/api/send-otp',
                    method: 'POST',
                    data: {
                        email: email,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json'
                }).done(function(response) {
                    if (!response.success) {
                        alert('Gagal mengirim OTP: ' + response.message);
                    }
                }).fail(function() {
                    alert('Terjadi kesalahan saat mengirim OTP');
                });
            }

            // Proses verifikasi OTP
            $('#formOtp').on('submit', function(e) {
                e.preventDefault();
                $('#otp_errors').hide().text('');
                $('#btnVerifyOtp').prop('disabled', true).text('Verifikasi...');

                $.ajax({
                    url: '/api/verify-otp',
                    method: 'POST',
                    data: {
                        email: $('#otpEmail').text(),
                        otp_code: $('#otp_code').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json'
                }).done(function(response) {
                    if (response.success) {
                        // OTP berhasil diverifikasi
                        updateStepIndicator(3);

                        // Tunggu sebentar sebelum membuka form pengaduan
                        setTimeout(function() {
                            $('#modalAuth').modal('hide');
                            $('#modalFormAduan').modal('show');
                        }, 1000);
                    } else {
                        // OTP gagal diverifikasi
                        $('#otp_errors').show().text(response.message || 'Kode OTP tidak valid.');
                    }
                }).fail(function(xhr) {
                    let errorMessage = 'Terjadi kesalahan. Coba lagi.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    $('#otp_errors').show().text(errorMessage);
                }).always(function() {
                    $('#btnVerifyOtp').prop('disabled', false).text('Verifikasi');
                });
            });

            // Kirim ulang OTP
            $('#btnResendOtp, #btnResendOtpLink').click(function(e) {
                e.preventDefault();

                const email = $('#otpEmail').text();
                if (email) {
                    sendOtp(email);

                    // Tampilkan notifikasi
                    const toast = $('<div class="toast-notification">OTP telah dikirim ulang ke ' + email +
                        '</div>');
                    $('body').append(toast);

                    // Hilangkan notifikasi setelah 3 detik
                    setTimeout(function() {
                        toast.remove();
                    }, 3000);
                }
            });

            // Proses pengiriman form pengaduan
            $('#formPengaduan').on('submit', function(e) {
                e.preventDefault();

                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.prop('disabled', true).text('Mengirim...');

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: new FormData(this), // FormData akan menangkap semua input, termasuk file
                    processData: false, // Penting untuk FormData
                    contentType: false, // Penting untuk FormData
                    dataType: 'json'
                }).done(function(response) {
                    if (response.success) {
                        // Pengaduan berhasil dikirim
                        $('#modalFormAduan').modal('hide');

                        // Tampilkan notifikasi sukses
                        const toast = $('<div class="toast-notification success">' + response
                            .message + '</div>');
                        $('body').append(toast);

                        // Reset form
                        $('#formPengaduan')[0].reset();
                        $('.form-section-dinamis').hide();
                        $('#form-placeholder').show();
                        $('#jenis_opsi_container').hide();
                        $('.file-list').empty(); // Hapus daftar file

                        // Hilangkan notifikasi setelah 5 detik
                        setTimeout(function() {
                            toast.remove();
                        }, 5000);
                    } else {
                        alert('Gagal mengirim pengaduan: ' + response.message);
                    }
                }).fail(function(xhr) {
                    let errorMessage = 'Terjadi kesalahan saat mengirim pengaduan.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    alert(errorMessage);
                }).always(function() {
                    submitBtn.prop('disabled', false).text('Kirim Pengaduan');
                });
            });

            // Script untuk menampilkan/menyembunyikan form dan mengisi sub aduan
            $('#jenis_aduan').on('change', function() {
                const selectedJenisId = $(this).val();
                $('.form-section-dinamis').hide();
                $('#jenis_opsi_container').hide();
                $('#jabatan_container').hide();

                if (selectedJenisId) {
                    $('#form-placeholder').hide();
                    $(`.form-section-dinamis[data-jenis-id="${selectedJenisId}"]`).show();

                    if (selectedJenisId === "1") {
                        $('#jenis_opsi_container').show();
                    }

                    $.get('/pengaduan/get-sub/' + selectedJenisId, function(res) {
                        if (res && res.sub_tujuan) {
                            $('#sub_aduan').html(
                                `<option value="${res.sub_tujuan}" selected>${res.sub_tujuan}</option>`
                            );
                        } else {
                            $('#sub_aduan').html('<option value="">Tidak ada sub aduan</option>');
                        }
                    }).fail(function() {
                        $('#sub_aduan').html('<option value="">Gagal memuat sub aduan</option>');
                    });
                } else {
                    $('#form-placeholder').show();
                    $('#sub_aduan').html('<option value="">Pilih Sub Aduan</option>');
                }
            });
        });
</script>


{{-- SCRIPT UNTUK MUNCUL CHECKBOX PELANGGARAN --}}
<script>
    $('.kategoriCheck').on('change', function() {
            $('.kategoriCheck').not(this).prop('checked', false);
            const jabatanContainer = $('#jabatan_container');
            if ($('#opsi_perorangan').is(':checked')) {
                jabatanContainer.show();
                $('select[name="jbt_plg"]').prop('required', true);
            } else {
                jabatanContainer.hide();
                $('select[name="jbt_plg"]').prop('required', false).val('');
            }
        });
</script>


<script>
    $(document).ready(function() {
            // Fungsi untuk menampilkan daftar file yang dipilih
            function showFileList(input, listId) {
                const fileList = $(`#${listId}`);
                fileList.empty(); // Kosongkan list sebelumnya

                if (input.files && input.files.length > 0) {
                    for (let i = 0; i < input.files.length; i++) {
                        const file = input.files[i];
                        const listItem = `<li>${file.name} (${(file.size / 1024).toFixed(2)} KB)</li>`;
                        fileList.append(listItem);
                    }
                }
            }

            // Event listener untuk semua input file
            $('input[type="file"]').on('change', function() {
                const listId = $(this).attr('id').replace('_input', '_list');
                showFileList(this, listId);
            });
        });
</script>
<script>
    $(document).ready(function() {

            const MAX_FILES = 5;

            // simpan semua file berdasarkan input id
            let storedFiles = {};

            function updateFileList(inputId) {

                const input = document.getElementById(inputId);
                const listId = inputId.replace("_input", "_list");
                const fileList = $("#" + listId);

                fileList.empty();

                if (!storedFiles[inputId]) return;

                storedFiles[inputId].forEach((file, index) => {

                    const sizeKB = (file.size / 1024).toFixed(2);

                    const li = $(`
                <li style="padding:4px 0;">
                    📎 ${file.name} (${sizeKB} KB)
                    <button type="button" 
                        style="margin-left:10px;color:red;border:none;background:none;cursor:pointer;"
                        data-input="${inputId}" 
                        data-index="${index}">
                        Hapus
                    </button>
                </li>
            `);

                    fileList.append(li);

                });

                // update input files agar bisa dikirim ke server
                const dataTransfer = new DataTransfer();

                storedFiles[inputId].forEach(file => {
                    dataTransfer.items.add(file);
                });

                input.files = dataTransfer.files;
            }


            $('input[type="file"][id$="_input"]').on("change", function() {

                const inputId = this.id;

                if (!storedFiles[inputId]) {
                    storedFiles[inputId] = [];
                }

                const newFiles = Array.from(this.files);

                // gabungkan file lama + baru
                let combined = [...storedFiles[inputId], ...newFiles];

                // batasi max 5
                if (combined.length > MAX_FILES) {
                    alert("Maksimal 5 file saja");
                    combined = combined.slice(0, MAX_FILES);
                }

                storedFiles[inputId] = combined;

                updateFileList(inputId);

            });


            // tombol hapus file
            $(document).on("click", "button[data-input]", function() {

                const inputId = $(this).data("input");
                const index = $(this).data("index");

                storedFiles[inputId].splice(index, 1);

                updateFileList(inputId);

            });

        });
</script>
@endsection
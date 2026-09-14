{{-- @extends('frontend.bprtaruna.layout.main')

@section('content')
<style>
    .common-heros {
        background: url('{{ asset(env(' GLOBAL_BANERTOPPROFIL')) }}') no-repeat center center;
        background-size: contain;
        /* TIDAK terpotong */
        background-color: #fff;
        /* supaya tidak ada hitam */

        height: 170px;
        max-width: 1120px;
        margin: 90px auto 0 auto;
        border-radius: 15px;
    }


    /* Versi Mobile */
    @media (max-width: 768px) {
        .common-heros {
            background: url('{{ asset(env(' GLOBAL_TOPMOBILE')) }}') no-repeat center center;
            background-size: 100% 50%;
            /* isi penuh TANPA ruang kosong */
            height: 180px;
            margin-top: 30px;
            /* tinggi tetap */
            padding: 0;
            object-fit: contain
        }

    }

    .event-content {
        max-width: 100%;
        overflow-x: auto;
        /* biar kalau ada tabel / gambar besar, muncul scroll horizontal */
        word-wrap: break-word;
        /* biar teks panjang gak keluar area */
        line-height: 1.6;
        /* biar enak dibaca */
        text-align: justify;
        font-family: 'Archivo', sans-serif;
    }
</style>

<body class="body tg-heading-subheading animation-style3">


    <!--=====progress END=======-->

    <div class="paginacontainer">

        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

    </div>





    <!--=====HERO AREA START=======-->

    <div class="common-heros">

    </div>

    <br><br>

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
@endsection --}}

@extends('frontend.bprtaruna.layout.main')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    * {
        box-sizing: border-box;
    }

    .common-heros {
        background: url('{{ asset(env(' GLOBAL_BANERTOPPROFIL')) }}') no-repeat center center;
        background-size: contain;
        background-color: #fff;
        height: 170px;
        max-width: 1120px;
        margin: 90px auto 0 auto;
        border-radius: 15px;
    }

    @media (max-width: 768px) {
        .common-heros {
            background: url('{{ asset(env(' GLOBAL_TOPMOBILE')) }}') no-repeat center center;
            background-size: 100% 50%;
            height: 180px;
            margin-top: 30px;
        }
    }

    .lap-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ── PAGE HERO ── */
    .lap-hero {
        background: #ee1a1a;
        padding: 44px 24px 64px;
        text-align: center;
        position: relative;
        overflow: hidden;
        max-width: 1120px;
        /* ← sesuaikan dengan lebar container site */
        margin: 0 auto;
        /* ← center */
        border-radius: 0 0 24px 24px;
        /* ← opsional, biar tidak kotak banget */
    }

    .lap-hero::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(220, 38, 38, 0.1);
        pointer-events: none;
    }

    .lap-hero::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -40px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.03);
        pointer-events: none;
    }

    .lap-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(220, 38, 38, 0.18);
        border: 1px solid rgba(220, 38, 38, 0.35);
        color: #fca5a5;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 100px;
        margin-bottom: 16px;
    }

    .lap-hero-badge span {
        width: 6px;
        height: 6px;
        background: #ef4444;
        border-radius: 50%;
        display: inline-block;
        animation: blink 1.8s ease-in-out infinite;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: 0.3
        }
    }

    .lap-hero h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .lap-hero p {
        font-size: 0.87rem;
        color: #94a3b8;
        margin: 0;
    }

    /* ── FILTER CARD (mengambang di bawah hero) ── */
    .lap-filter-wrap {
        max-width: 980px;
        margin: -30px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    .lap-filter-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 48px rgba(0, 0, 0, 0.14);
        padding: 22px 26px;
        display: grid;
        grid-template-columns: 1.6fr 120px 1fr auto;
        gap: 14px;
        align-items: end;
    }

    @media (max-width: 768px) {
        .lap-filter-card {
            grid-template-columns: 1fr;
        }
    }

    .lap-fg {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .lap-fg label {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .lap-fg select,
    .lap-fg input[type="number"] {
        height: 48px;
        border: 1.5px solid #e8ecf0;
        border-radius: 12px;
        padding: 0 40px 0 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
        background: #f8fafc;
        outline: none;
        width: 100%;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23aab4c0' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }

    .lap-fg input[type="number"] {
        background-image: none;
        padding: 0 14px;
    }

    .lap-fg select:hover,
    .lap-fg input[type="number"]:hover {
        border-color: #cbd5e1;
    }

    .lap-fg select:focus,
    .lap-fg input[type="number"]:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        background: #fff;
    }

    .lap-btn-cari {
        height: 48px;
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 0 26px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        transition: background .18s, transform .12s, box-shadow .18s;
        box-shadow: 0 4px 16px rgba(220, 38, 38, 0.3);
    }

    .lap-btn-cari:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(220, 38, 38, 0.38);
    }

    .lap-btn-cari:active {
        transform: translateY(0);
    }

    /* ── RESULT AREA ── */
    .lap-result-wrap {
        max-width: 980px;
        margin: 32px auto 0;
        padding: 0 20px 60px;
    }

    #lapResult {
        min-height: 200px;
    }

    .lap-state {
        text-align: center;
        padding: 50px 20px;
        background: #fff;
        border-radius: 16px;
        border: 1.5px dashed #e2e8f0;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .lap-state-icon-box {
        width: 56px;
        height: 56px;
        background: #fef2f2;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }

    .lap-state h3 {
        font-size: 15px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 6px;
    }

    .lap-state p {
        font-size: 13px;
        color: #94a3b8;
        margin: 0;
    }

    /* ── PDF VIEWER ── */
    .pdf-viewer-wrapper {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid #e8ecf0;
    }

    .pdf-viewer-header {
        background: #1a1a2e;
        color: #fff;
        padding: 14px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pdf-viewer-header h3 {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .pdf-meta {
        font-size: 0.78rem;
        color: #94a3b8;
        display: flex;
        gap: 16px;
    }

    .pdf-tabs {
        display: flex;
        border-bottom: 2px solid #f1f5f9;
        background: #f8fafc;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .pdf-tabs::-webkit-scrollbar {
        display: none;
    }

    .pdf-tab {
        padding: 12px 20px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        white-space: nowrap;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: color .2s, border-color .2s;
        display: flex;
        align-items: center;
        gap: 6px;
        user-select: none;
    }

    .pdf-tab:hover {
        color: #dc2626;
    }

    .pdf-tab.active {
        color: #dc2626;
        border-bottom-color: #dc2626;
        background: #fff;
    }

    .pdf-tab .tab-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.4;
        flex-shrink: 0;
    }

    .pdf-tab.active .tab-dot {
        opacity: 1;
    }

    .pdf-frame-container {
        background: #f1f5f9;
    }

    .pdf-frame-container iframe {
        display: block;
        width: 100%;
        height: 620px;
        border: none;
        background: #f1f5f9;
    }

    @media (max-width: 768px) {
        .pdf-frame-container iframe {
            height: 420px;
        }
    }

    .pdf-download-bar {
        background: #f8fafc;
        border-top: 1px solid #e8ecf0;
        padding: 12px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pdf-filename {
        font-size: 13px;
        color: #6b7280;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-download {
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .2s;
    }

    .btn-download:hover {
        background: #b91c1c;
        color: #fff;
        text-decoration: none;
    }

    /* ── CARD LIST ── */
    .lap-gabung-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 18px;
        padding: 4px 0 22px;
    }

    .lap-gabung-card {
        border: 1.5px solid #e8ecf0;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        transition: box-shadow .2s, transform .2s, border-color .2s;
        cursor: pointer;
    }

    .lap-gabung-card:hover {
        box-shadow: 0 8px 24px rgba(220, 38, 38, 0.12);
        transform: translateY(-3px);
        border-color: #fca5a5;
    }

    .lap-gabung-card.active-card {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
    }

    .lap-gabung-thumb {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
    }

    .lap-gabung-thumb-placeholder {
        width: 100%;
        height: 160px;
        background: #fef2f2;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lap-gabung-info {
        padding: 14px 16px;
    }

    .lap-gabung-period {
        font-size: 11px;
        font-weight: 700;
        color: #dc2626;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 4px;
    }

    .lap-gabung-title {
        font-size: 14px;
        font-weight: 700;
        color: #1a1a2e;
        line-height: 1.4;
    }
</style>

<body class="body tg-heading-subheading animation-style3 lap-wrap">
    <div class="paginacontainer">
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
    </div>


    <div class="common-heros" style="margin-bottom: 100px"></div>


    {{-- HERO --}}
    <div class="lap-hero">
        <div class="lap-hero-badge"><span></span> Transparansi Publik</div>
        <h1>Laporan BPR Bank Taruna</h1>

    </div>

    {{-- FILTER CARD --}}
    <div class="lap-filter-wrap">
        <div class="lap-filter-card">
            <div class="lap-fg">
                <label>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                    </svg>
                    Jenis Laporan
                </label>
                <select id="fType">
                    <option value="0">Laporan Publikasi</option>
                    <option value="1">Laporan Tahunan</option>
                    <option value="2">Laporan Tata Kelola</option>
                    <option value="3">Laporan Keberlanjutan</option>
                    <option value="4">Laporan AKB</option>
                    <option value="5">Piagam Audit Internal</option>
                    <option value="6">Laporan Lainnya</option>
                </select>
            </div>

            <div class="lap-fg">
                <label>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Tahun
                </label>
                <input type="number" id="fTahun" value="{{ \Carbon\Carbon::now()->year }}" min="2000" max="2099">
            </div>

            <div class="lap-fg">
                <label>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Periode
                </label>
                <select id="fBulan">
                    <option value="">Semua Periode</option>
                    <option value="3">Triwulan I — Maret</option>
                    <option value="6">Triwulan II — Juni</option>
                    <option value="9">Triwulan III — September</option>
                    <option value="12">Triwulan IV — Desember</option>
                </select>
            </div>

            <button class="lap-btn-cari" onclick="cariLaporan()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                Cari
            </button>
        </div>
    </div>

    {{-- RESULT --}}
    <div class="lap-result-wrap">
        <div id="lapResult">
            <div class="lap-state">
                <div class="lap-state-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                </div>
                <h3>Pilih filter untuk menampilkan laporan</h3>
                <p>Tentukan jenis laporan, tahun, dan periode yang ingin dilihat</p>
            </div>
        </div>
    </div>

</body>

<script>
    // Label untuk tab pisah
        var pisahLabels = {
            keuangan: 'Posisi Keuangan',
            laba_rugi: 'Laba Rugi',
            aset: 'Kualitas Aset Produktif',
            komitmen: 'Komitmen & Kontinjensi',
            lainnya: 'Informasi Lainnya'
        };

        var currentPisahUrls = {}; // simpan urls aktif saat mode pisah
        var activeTab = null;

        function getPeriodeLabel(bulan) {
            bulan = parseInt(bulan);
            if (bulan <= 3) return 'Triwulan I — Maret';
            if (bulan <= 6) return 'Triwulan II — Juni';
            if (bulan <= 9) return 'Triwulan III — September';
            return 'Triwulan IV — Desember';
        }

        function cariLaporan() {
            var type = $('#fType').val();
            var tahun = $('#fTahun').val();
            var bulan = $('#fBulan').val();

            $('#lapResult').html(
                '<div class="lap-state">' +
                '<div class="lap-state-icon-box"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>' +
                '<h3>Mencari data...</h3><p>Mohon tunggu sebentar</p></div>'
            );

            $.ajax({
                type: 'POST',
                url: '/getlaporan-pisah',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    type: type,
                    tahun: tahun,
                    bulan: bulan
                },
                success: function(res) {
                    if (!res || !res.length) {
                        $('#lapResult').html(
                            '<div class="lap-state">' +
                            '<div class="lap-state-icon-box"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>' +
                            '<h3>Data tidak ditemukan</h3><p>Tidak ada laporan untuk filter yang dipilih</p></div>'
                        );
                        return;
                    }
                    renderResult(res);
                },
                error: function(xhr) {
                    console.error(xhr);
                    $('#lapResult').html(
                        '<div class="lap-state">' +
                        '<div class="lap-state-icon-box"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>' +
                        '<h3>Terjadi kesalahan</h3><p>' + xhr.status + ' — ' + xhr.statusText + '</p></div>'
                    );
                }
            });
        }

        function renderResult(items) {
            // Cek mayoritas: ada yang pisah?
            var adaPisah = items.some(function(i) {
                return i.urls_json && Object.keys(i.urls_json).length > 0;
            });
            var adaGabung = items.some(function(i) {
                return !i.urls_json && i.url;
            });

            if (adaPisah && items.length === 1) {
                // 1 laporan mode pisah → langsung tampil viewer dengan tabs
                renderPisahViewer(items[0]);
            } else if (!adaPisah && items.length === 1) {
                // 1 laporan mode gabung → langsung tampil viewer 1 PDF
                renderGabungViewer(items[0]);
            } else {
                // Beberapa laporan → tampilkan kartu, klik untuk preview
                renderCardList(items);
            }
        }

        /* ── Viewer mode PISAH (tabs per kategori) ── */
        function renderPisahViewer(item) {
            var urls = item.urls_json || {};
            currentPisahUrls = {};

            // Kumpulkan tab yang tersedia
            var tabs = [];
            Object.keys(pisahLabels).forEach(function(k) {
                if (urls[k]) {
                    currentPisahUrls[k] = '/recfil?display=true&rf=' + urls[k];
                    tabs.push(k);
                }
            });

            if (!tabs.length) {
                $('#lapResult').html(
                    '<div class="lap-state"><span class="lap-state-icon">🗂️</span><p>File PDF belum tersedia.</p></div>'
                );
                return;
            }

            var periodeLabel = getPeriodeLabel(item.bulan);

            var tabsHtml = tabs.map(function(k) {
                return '<div class="pdf-tab" data-key="' + k + '" onclick="switchTab(\'' + k + '\')">' +
                    '<span class="tab-dot"></span>' + pisahLabels[k] + '</div>';
            }).join('');

            var html = '' +
                '<div class="pdf-viewer-wrapper">' +
                '<div class="pdf-viewer-header">' +
                '<h3>' + (item.title || 'Laporan Publikasi') + '</h3>' +
                '<div class="pdf-meta">' +
                '<span>📅 ' + periodeLabel + '</span>' +
                '<span>📆 ' + item.tanggal + '</span>' +
                '</div>' +
                '</div>' +
                '<div class="pdf-tabs">' + tabsHtml + '</div>' +
                '<div class="pdf-frame-container">' +
                '<iframe id="pdfFrame" src="' + currentPisahUrls[tabs[0]] + '" allowfullscreen></iframe>' +
                '</div>' +
                '<div class="pdf-download-bar">' +
                '<span class="pdf-filename" id="pdfFilename">' + pisahLabels[tabs[0]] + '</span>' +
                '<a class="btn-download" id="pdfDownloadBtn" href="' + currentPisahUrls[tabs[0]] + '" target="_blank">' +
                '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>' +
                'Download PDF' +
                '</a>' +
                '</div>' +
                '</div>';

            $('#lapResult').html(html);

            // Aktifkan tab pertama
            activeTab = tabs[0];
            $('.pdf-tab[data-key="' + tabs[0] + '"]').addClass('active');
        }

        function switchTab(key) {
            if (!currentPisahUrls[key]) return;
            activeTab = key;
            $('.pdf-tab').removeClass('active');
            $('.pdf-tab[data-key="' + key + '"]').addClass('active');
            $('#pdfFrame').attr('src', currentPisahUrls[key]);
            $('#pdfFilename').text(pisahLabels[key]);
            $('#pdfDownloadBtn').attr('href', currentPisahUrls[key]);
        }

        /* ── Viewer mode GABUNG (1 PDF) ── */
        function renderGabungViewer(item) {
            var url = '/recfil?display=true&rf=' + item.url;
            var periodeLabel = getPeriodeLabel(item.bulan);

            var html = '' +
                '<div class="pdf-viewer-wrapper">' +
                '<div class="pdf-viewer-header">' +
                '<h3>' + (item.title || 'Laporan') + '</h3>' +
                '<div class="pdf-meta">' +
                '<span>📅 ' + periodeLabel + '</span>' +
                '<span>📆 ' + item.tanggal + '</span>' +
                '</div>' +
                '</div>' +
                '<div class="pdf-frame-container">' +
                '<iframe src="' + url + '" allowfullscreen></iframe>' +
                '</div>' +
                '<div class="pdf-download-bar">' +
                '<span class="pdf-filename">' + (item.title || '') + '</span>' +
                '<a class="btn-download" href="' + url + '" target="_blank">' +
                '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>' +
                'Download PDF' +
                '</a>' +
                '</div>' +
                '</div>';

            $('#lapResult').html(html);
        }

        /* ── Banyak laporan → kartu, klik preview ── */
        function renderCardList(items) {
            var cardsHtml = items.map(function(item, idx) {
                var thumb = item.thumbnail ?
                    '<img class="lap-gabung-thumb" src="/recfil?display=true&rf=' + item.thumbnail + '" alt="' +
                    item.title + '">' :
                    '<div class="lap-gabung-thumb-placeholder">📄</div>';
                return '<div class="lap-gabung-card" id="card_' + idx + '" onclick="previewItem(' + idx + ')">' +
                    thumb +
                    '<div class="lap-gabung-info">' +
                    '<div class="lap-gabung-period">' + getPeriodeLabel(item.bulan) + '</div>' +
                    '<div class="lap-gabung-title">' + item.title + '</div>' +
                    '</div>' +
                    '</div>';
            }).join('');

            var html = '<div class="lap-gabung-list">' + cardsHtml + '</div>' +
                '<div id="lapPreviewArea" style="margin-top:0;"></div>';

            $('#lapResult').html(html);
            window._lapItems = items; // simpan untuk preview
        }

        function previewItem(idx) {
            var item = window._lapItems[idx];
            if (!item) return;

            // highlight kartu aktif
            $('.lap-gabung-card').removeClass('active-card');
            $('#card_' + idx).addClass('active-card');

            // Render viewer di bawah kartu
            var $preview = $('#lapPreviewArea');

            if (item.urls_json && Object.keys(item.urls_json).length > 0) {
                // clone item lalu render pisah ke #lapPreviewArea sementara
                var orig = $('#lapResult').html();
                renderPisahViewer(item); // ini replace #lapResult, kita ambil lalu kembalikan
                var viewerHtml = $('#lapResult').html();
                $('#lapResult').html('<div class="lap-gabung-list">' +
                    window._lapItems.map(function(it, i) {
                        var th = it.thumbnail ?
                            '<img class="lap-gabung-thumb" src="/recfil?display=true&rf=' + it.thumbnail + '">' :
                            '<div class="lap-gabung-thumb-placeholder">📄</div>';
                        return '<div class="lap-gabung-card' + (i === idx ? ' active-card' : '') + '" id="card_' +
                            i + '" onclick="previewItem(' + i + ')">' +
                            th + '<div class="lap-gabung-info"><div class="lap-gabung-period">' + getPeriodeLabel(it
                                .bulan) + '</div>' +
                            '<div class="lap-gabung-title">' + it.title + '</div></div></div>';
                    }).join('') +
                    '</div><div id="lapPreviewArea">' + viewerHtml + '</div>');
            } else if (item.url) {
                var url = '/recfil?display=true&rf=' + item.url;
                $preview.html('' +
                    '<div class="pdf-viewer-wrapper" style="margin-top:16px;">' +
                    '<div class="pdf-viewer-header">' +
                    '<h3>' + (item.title || 'Laporan') + '</h3>' +
                    '<div class="pdf-meta"><span>📅 ' + getPeriodeLabel(item.bulan) + '</span></div>' +
                    '</div>' +
                    '<div class="pdf-frame-container"><iframe src="' + url + '" allowfullscreen></iframe></div>' +
                    '<div class="pdf-download-bar">' +
                    '<span class="pdf-filename">' + item.title + '</span>' +
                    '<a class="btn-download" href="' + url + '" target="_blank">⬇ Download PDF</a>' +
                    '</div>' +
                    '</div>'
                );
                // scroll ke preview
                $('html, body').animate({
                    scrollTop: $preview.offset().top - 80
                }, 400);
            }
        }
</script>
@endsection
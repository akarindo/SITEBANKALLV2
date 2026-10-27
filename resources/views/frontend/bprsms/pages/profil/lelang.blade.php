@extends('frontend.bprsms.layout.main')

@section('content')
@php
    $activeTab = $activeTab ?? 'lelang';
    $lelangItems = $lelangItems ?? collect($lelang ?? [])->where('type', 0);
    $jualAsetItems = $jualAsetItems ?? collect($lelang ?? [])->where('type', 1);
    $activeLabel = $activeTab === 'jual-aset' ? 'Jual Aset' : 'Lelang';
@endphp

<style>
    .sms-auction-page {
        --sms-orange: #f34405;
        --sms-orange-dark: #c83200;
        --sms-ink: #161616;
        background: #f8f9fb;
    }

    .sms-auction-intro {
        position: relative;
        overflow: hidden;
        padding: 72px 0 92px;
        background: linear-gradient(120deg, #fff7f2 0%, #fff 55%, #fff1e9 100%);
    }

    .sms-auction-intro::after {
        position: absolute;
        right: -90px;
        bottom: -160px;
        width: 380px;
        height: 380px;
        border: 70px solid rgba(243, 68, 5, .08);
        border-radius: 50%;
        content: "";
    }

    .sms-auction-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
        color: var(--sms-orange);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .sms-auction-kicker span {
        width: 28px;
        height: 2px;
        background: var(--sms-orange);
    }

    .sms-auction-intro h2 {
        max-width: 660px;
        margin-bottom: 14px;
        color: var(--sms-ink);
        font-size: clamp(30px, 4vw, 48px);
        font-weight: 800;
        line-height: 1.14;
    }

    .sms-auction-intro p {
        max-width: 620px;
        margin-bottom: 0;
        color: #666;
        font-size: 16px;
    }

    .sms-auction-panel {
        position: relative;
        z-index: 2;
        padding: 66px 0 84px;
    }

    .sms-auction-tabs-bar {
        padding: 24px 0;
        border-bottom: 1px solid #f0e5df;
        background: #fff;
        box-shadow: 0 7px 20px rgba(49, 26, 17, .05);
    }

    .sms-auction-switcher {
        display: flex;
        gap: 8px;
        width: 100%;
        max-width: 860px;
        margin: 0 auto;
        padding: 7px;
        border: 1px solid #f1ddd4;
        border-radius: 18px;
        background: rgba(255, 255, 255, .96);
        box-shadow: 0 14px 35px rgba(49, 26, 17, .09);
    }

    .sms-auction-tab {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
        flex: 1;
        justify-content: center;
        padding: 19px 20px;
        border: 0;
        border-radius: 12px;
        background: transparent;
        color: #777;
        font-family: inherit;
        font-size: 16px;
        font-weight: 700;
        transition: .25s ease;
    }

    .sms-auction-tab i {
        font-size: 19px;
    }

    .sms-auction-tab:hover,
    .sms-auction-tab.active {
        background: var(--sms-orange);
        color: #fff;
        box-shadow: 0 7px 16px rgba(243, 68, 5, .22);
    }

    .sms-auction-tab .count {
        display: inline-grid;
        min-width: 28px;
        height: 28px;
        padding: 0 6px;
        place-items: center;
        border-radius: 50px;
        background: #fff0e9;
        color: var(--sms-orange);
        font-size: 12px;
    }

    .sms-auction-tab.active .count {
        background: rgba(255, 255, 255, .2);
        color: #fff;
    }

    .sms-auction-section {
        display: none;
    }

    .sms-auction-section.active {
        display: block;
        animation: smsAuctionFade .35s ease both;
    }

    @keyframes smsAuctionFade {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .sms-auction-section-heading {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .sms-auction-section-heading h3 {
        margin: 0;
        color: var(--sms-ink);
        font-size: 25px;
        font-weight: 800;
    }

    .sms-auction-section-heading p {
        margin: 4px 0 0;
        color: #777;
        font-size: 14px;
    }

    .sms-auction-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid #eee5e1;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 9px 25px rgba(35, 26, 22, .06);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .sms-auction-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 34px rgba(35, 26, 22, .13);
    }

    .sms-auction-image {
        position: relative;
        height: 205px;
        overflow: hidden;
        background: #f5f5f5;
    }

    .sms-auction-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .sms-auction-card:hover .sms-auction-image img {
        transform: scale(1.06);
    }

    .sms-auction-type,
    .sms-auction-live {
        position: absolute;
        top: 15px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .sms-auction-type {
        left: 15px;
        padding: 7px 11px;
        background: rgba(255, 255, 255, .94);
        color: var(--sms-orange);
    }

    .sms-auction-live {
        right: 15px;
        padding: 7px 11px;
        background: #d92d20;
        color: #fff;
    }

    .sms-auction-card-body {
        display: flex;
        min-height: 0;
        flex-direction: column;
        padding: 16px 18px 17px;
    }

    .sms-auction-card-body h4 {
        display: -webkit-box;
        overflow: hidden;
        margin: 0 0 5px;
        color: var(--sms-ink);
        font-size: 16px;
        font-weight: 800;
        line-height: 1.35;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .sms-auction-location {
        margin-bottom: 11px;
        color: #888;
        font-size: 12px;
    }

    .sms-auction-location i {
        margin-right: 5px;
        color: var(--sms-orange);
    }

    .sms-auction-values {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 11px;
    }

    .sms-auction-value {
        padding: 9px 10px;
        border-radius: 10px;
        background: #fff7f3;
    }

    .sms-auction-value small {
        display: block;
        margin-bottom: 3px;
        color: #8e817c;
        font-size: 10px;
    }

    .sms-auction-value strong {
        display: block;
        overflow: hidden;
        color: var(--sms-orange-dark);
        font-size: 13px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .sms-auction-deadline {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: auto;
        margin-bottom: 11px;
        color: #666;
        font-size: 12px;
    }

    .sms-auction-deadline i {
        color: var(--sms-orange);
        font-size: 15px;
    }

    .sms-auction-facts {
        margin-bottom: 11px;
    }

    .sms-auction-fact {
        display: grid;
        grid-template-columns: 18px minmax(100px, .45fr) minmax(0, 1fr);
        align-items: start;
        gap: 6px;
        padding: 5px 0;
        border-bottom: 1px solid #f1eae7;
        color: #968983;
        font-size: 11px;
    }

    .sms-auction-fact i {
        padding-top: 2px;
        color: var(--sms-orange);
        text-align: center;
    }

    .sms-auction-fact strong {
        color: #4d403b;
        font-size: 12px;
        font-weight: 700;
        text-align: right;
        overflow-wrap: anywhere;
    }

    .sms-auction-fact:last-child {
        border-bottom: 0;
    }

    .sms-auction-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 16px;
        border-radius: 9px;
        background: var(--sms-orange);
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .03em;
        transition: background .2s ease;
    }

    .sms-auction-detail:hover {
        background: var(--sms-orange-dark);
        color: #fff;
    }

    .sms-auction-empty {
        padding: 55px 24px;
        border: 1px dashed #e7cfc4;
        border-radius: 16px;
        background: #fff;
        text-align: center;
    }

    .sms-auction-empty i {
        margin-bottom: 13px;
        color: #f2b39c;
        font-size: 35px;
    }

    .sms-auction-empty h4 {
        margin-bottom: 7px;
        color: var(--sms-ink);
        font-size: 18px;
        font-weight: 800;
    }

    .sms-auction-empty p {
        margin: 0;
        color: #888;
        font-size: 13px;
    }

    @media (max-width: 575px) {
        .sms-auction-intro { padding: 52px 0 72px; }
        .sms-auction-panel { padding-top: 48px; }
        .sms-auction-tabs-bar { padding: 16px 0; }
        .sms-auction-switcher { gap: 5px; padding: 5px; }
        .sms-auction-tab { padding: 14px 8px; font-size: 12px; }
        .sms-auction-tab i { font-size: 15px; }
        .sms-auction-tab .count { min-width: 23px; height: 23px; }
        .sms-auction-section-heading { display: block; }
        .sms-auction-section-heading h3 { font-size: 22px; }
    }
</style>

<div class="breadcumb-area style2 bg-smoke4">
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('frontend/bprsms/assets/img/bg/breadcumb-bg.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title" id="sms-breadcrumb-title">{{ $activeLabel }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="/">Profil</a></li>
                    <li id="sms-breadcrumb-current">{{ $activeLabel }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<main class="sms-auction-page">
    <section class="sms-auction-tabs-bar">
        <div class="container">
            <div class="sms-auction-switcher" role="tablist" aria-label="Kategori informasi">
                <button id="sms-tab-lelang" class="sms-auction-tab {{ $activeTab === 'lelang' ? 'active' : '' }}" type="button" role="tab"
                    aria-selected="{{ $activeTab === 'lelang' ? 'true' : 'false' }}" aria-controls="sms-panel-lelang" data-auction-tab="lelang">
                    <i class="fa-solid fa-gavel"></i> Lelang <span class="count">{{ $lelangItems->count() }}</span>
                </button>
                <button id="sms-tab-jual-aset" class="sms-auction-tab {{ $activeTab === 'jual-aset' ? 'active' : '' }}" type="button" role="tab"
                    aria-selected="{{ $activeTab === 'jual-aset' ? 'true' : 'false' }}" aria-controls="sms-panel-jual-aset" data-auction-tab="jual-aset">
                    <i class="fa-solid fa-building-circle-check"></i> Jual Aset <span class="count">{{ $jualAsetItems->count() }}</span>
                </button>
            </div>
        </div>
    </section>

    {{-- <section class="sms-auction-intro">
        <div class="container">
            <div class="sms-auction-kicker"><span></span> Informasi Terbuka BPR SMS</div>
            <h2 id="sms-intro-title">{{ $activeTab === 'jual-aset' ? 'Temukan aset pilihan untuk kebutuhan Anda.' : 'Temukan kesempatan terbaik dari aset pilihan kami.' }}</h2>
            <p>Jelajahi informasi lelang dan aset yang tersedia dengan detail yang jelas, mudah dipahami, dan selalu diperbarui.</p>
        </div>
    </section> --}}

    <section class="sms-auction-panel">
        <div class="container">
            @foreach ([
                'lelang' => ['items' => $lelangItems, 'title' => 'Lelang Berlangsung', 'description' => 'Ikuti proses lelang dan dapatkan aset yang sesuai kebutuhan Anda.', 'label' => 'Lelang', 'icon' => 'fa-gavel'],
                'jual-aset' => ['items' => $jualAsetItems, 'title' => 'Aset Yang Ditawarkan', 'description' => 'Lihat aset pilihan yang tersedia untuk mendapatkan informasi lebih lanjut.', 'label' => 'Jual Aset', 'icon' => 'fa-building-circle-check'],
            ] as $tabKey => $section)
                <section id="sms-panel-{{ $tabKey }}" class="sms-auction-section {{ $activeTab === $tabKey ? 'active' : '' }}" role="tabpanel"
                    aria-labelledby="sms-tab-{{ $tabKey }}" data-auction-panel="{{ $tabKey }}">
                    <div class="sms-auction-section-heading">
                        <div>
                            <h3>{{ $section['title'] }}</h3>
                            <p>{{ $section['description'] }}</p>
                        </div>
                    </div>

                    @if ($section['items']->isEmpty())
                        <div class="sms-auction-empty">
                            <i class="fa-regular fa-folder-open d-block"></i>
                            <h4>Belum ada informasi {{ strtolower($section['label']) }}</h4>
                            <p>Silakan cek kembali secara berkala untuk informasi terbaru dari BPR SMS.</p>
                        </div>
                    @else
                        <div class="row gy-4">
                            @foreach ($section['items'] as $item)
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $isLive = $item->mulai && $item->selesai && $now->between(\Carbon\Carbon::parse($item->mulai), \Carbon\Carbon::parse($item->selesai));
                                    $image = $item->thumbnail ?: $item->banner ?: (($item->album ?? [])[0] ?? null);
                                @endphp
                                <div class="col-xl-4 col-md-6">
                                    <article class="sms-auction-card">
                                        <a href="{{ route('detlelang', $item->id) }}" aria-label="Lihat detail {{ $item->title }}">
                                            <div class="sms-auction-image">
                                                @if ($image)
                                                    <img src="{{ url('/recfil?display=true&rf=' . $image) }}" alt="{{ $item->title }}" loading="lazy">
                                                @else
                                                    <div class="h-100 d-flex align-items-center justify-content-center text-muted"><i class="fa-regular fa-image fa-2x"></i></div>
                                                @endif
                                                <span class="sms-auction-type"><i class="fa-solid {{ $section['icon'] }} me-1"></i> {{ $section['label'] }}</span>
                                                @if ($isLive)
                                                    <span class="sms-auction-live"><i class="fa-solid fa-circle me-1"></i> Live</span>
                                                @endif
                                            </div>
                                        </a>
                                        <div class="sms-auction-card-body">
                                            <h4>{{ $item->title }}</h4>
                                            <div class="sms-auction-location"><i class="fa-solid fa-location-dot"></i>{{ $item->type == 1 && $item->lokasi ? $item->lokasi : ($item->kota ?: 'Lokasi belum tersedia') }}{{ $item->type != 1 && $item->provinsi ? ', ' . $item->provinsi : '' }}</div>
                                             <div class="sms-auction-values">
                                                 @if ($item->type == 1)
                                                     <div class="sms-auction-value" style="grid-column: 1 / -1;">
                                                         <small>Harga Penawaran</small>
                                                         <strong>{{ $item->harga_penawaran ? 'Rp ' . number_format($item->harga_penawaran, 0, ',', '.') : 'Tidak tersedia' }}</strong>
                                                     </div>
                                                 @else
                                                     <div class="sms-auction-value">
                                                         <small>Nilai Limit</small>
                                                         <strong>{{ $item->limit ? 'Rp ' . number_format($item->limit, 0, ',', '.') : 'Tidak tersedia' }}</strong>
                                                     </div>
                                                     <div class="sms-auction-value">
                                                         <small>Uang Jaminan</small>
                                                         <strong>{{ $item->jaminan ? 'Rp ' . number_format($item->jaminan, 0, ',', '.') : 'Tidak tersedia' }}</strong>
                                                     </div>
                                                 @endif
                                             </div>
                                             @if ($item->type == 1)
                                                  <div class="sms-auction-facts" aria-label="Spesifikasi aset">
                                                      <div class="sms-auction-fact">
                                                          <i class="fa-solid fa-ruler-combined"></i>
                                                          <span>Luas tanah</span>
                                                          <strong>{{ $item->luas_tanah ?: '-' }}</strong>
                                                      </div>
                                                      <div class="sms-auction-fact">
                                                          <i class="fa-solid fa-house"></i>
                                                          <span>Luas bangunan</span>
                                                          <strong>{{ $item->luas_bangunan ?: '-' }}</strong>
                                                      </div>
                                                      <div class="sms-auction-fact">
                                                          <i class="fa-solid fa-file"></i>
                                                          <span>Legalitas</span>
                                                          <strong>{{ $item->legalitas ?: '-' }}</strong>
                                                      </div>
                                                  </div>
                                             @endif
                                             <div class="sms-auction-deadline">
                                                <i class="fa-regular fa-calendar-check"></i>
                                                <span>Batas akhir: <strong>{{ $item->selesai ? \Carbon\Carbon::parse($item->selesai)->translatedFormat('d M Y') : '-' }}</strong></span>
                                            </div>
                                            <a href="{{ route('detlelang', $item->id) }}" class="sms-auction-detail">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            @endforeach
        </div>
    </section>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('[data-auction-tab]');
        const panels = document.querySelectorAll('[data-auction-panel]');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                const selected = tab.dataset.auctionTab;
                const label = selected === 'jual-aset' ? 'Jual Aset' : 'Lelang';
                const introTitle = selected === 'jual-aset'
                    ? 'Temukan aset pilihan untuk kebutuhan Anda.'
                    : 'Temukan kesempatan terbaik dari aset pilihan kami.';

                tabs.forEach(function (item) {
                    const isActive = item === tab;
                    item.classList.toggle('active', isActive);
                    item.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });
                panels.forEach(function (panel) {
                    panel.classList.toggle('active', panel.dataset.auctionPanel === selected);
                });
                document.getElementById('sms-breadcrumb-title').textContent = label;
                document.getElementById('sms-breadcrumb-current').textContent = label;
                document.getElementById('sms-intro-title').textContent = introTitle;

                const url = new URL(window.location.href);
                url.searchParams.set('tab', selected);
                window.history.replaceState({}, '', url);
            });
        });
    });
</script>
@endpush
@endsection

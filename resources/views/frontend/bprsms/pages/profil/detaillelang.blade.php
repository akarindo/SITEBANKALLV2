@extends('frontend.bprsms.layout.main')

@section('content')
@php
    $isAsset = (int) $lelang->type === 1;
    $categoryLabel = $isAsset ? 'Jual Aset' : 'Lelang';
    $pageTitle = $isAsset ? 'Detail Jual Aset' : 'Detail Lelang';
    $actionLabel = $isAsset ? 'LIHAT INFORMASI ASET' : 'IKUTI LELANG';
    $actionIcon = $isAsset ? 'fa-arrow-up-right-from-square' : 'fa-gavel';
    $backUrl = url('/lelang-jualaset') . '?tab=' . ($isAsset ? 'jual-aset' : 'lelang');
    $assetImages = [];

    if ($isAsset && $lelang->banner) {
        $assetImages[] = $lelang->banner;
    }
    if ($isAsset && is_array($lelang->album)) {
        $assetImages = array_merge($assetImages, $lelang->album);
    }
    if ($isAsset && empty($assetImages) && $lelang->thumbnail) {
        $assetImages[] = $lelang->thumbnail;
    }
@endphp

<style>
    .sms-detail-page { background: transparent; padding-bottom: 80px; }
    .sms-asset-detail-page { background: linear-gradient(180deg, #fffaf7 0%, #f8f9fb 48%, #f8f9fb 100%); }
    .sms-detail-shell { margin-top: 42px; position: relative; z-index: 2; }
    .sms-asset-detail-page .sms-detail-shell { margin-top: 28px; }
    .sms-detail-card { overflow: hidden; border: 0; border-radius: 20px; background: transparent; box-shadow: none; }
    .sms-detail-image { height: 390px; background: #f5f5f5; }
    .sms-detail-image img { width: 100%; height: 390px; object-fit: cover; }
    .sms-asset-slider { position: relative; height: 390px; overflow: hidden; background: #f5f5f5; }
    .sms-asset-track { width: 100%; height: 100%; }
    .sms-asset-slide { display: none; width: 100%; height: 100%; }
    .sms-asset-slide.active { display: block; animation: smsAssetSlideIn .3s ease both; }
    .sms-asset-slide img { width: 100% !important; height: 100% !important; object-fit: cover; }
    .sms-asset-slider-button { position: absolute; top: 50%; z-index: 2; display: grid; width: 36px; height: 36px; padding: 0; transform: translateY(-50%); place-items: center; border: 0; border-radius: 50%; background: rgba(0, 0, 0, .45); color: #fff; transition: background .2s ease; }
    .sms-asset-slider-button:hover { background: #f34405; }
    .sms-asset-slider-button.previous { left: 14px; }
    .sms-asset-slider-button.next { right: 14px; }
    .sms-asset-dots { position: absolute; right: 0; bottom: 16px; left: 0; z-index: 2; display: flex; justify-content: center; gap: 6px; }
    .sms-asset-dot { width: 7px; height: 7px; padding: 0; border: 0; border-radius: 50%; background: rgba(255, 255, 255, .55); transition: .2s ease; }
    .sms-asset-dot.active { width: 22px; border-radius: 8px; background: #f34405; }
    @keyframes smsAssetSlideIn { from { opacity: .55; transform: scale(1.02); } to { opacity: 1; transform: scale(1); } }
    .sms-detail-side { height: 100%; }
    .sms-detail-copy { padding: 35px 42px 25px; }
    .sms-detail-badge { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 18px; padding: 8px 13px; border-radius: 50px; background: #fff0e9; color: #f34405; font-size: 11px; font-weight: 800; letter-spacing: .06em; text-transform: uppercase; }
    .sms-detail-copy h2 { margin: 0 0 25px; color: #161616; font-size: clamp(25px, 3vw, 36px); font-weight: 800; line-height: 1.2; }
    .sms-detail-metrics { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 24px; }
    .sms-detail-metric { padding: 15px; border-radius: 12px; background: #fff7f3; }
    .sms-detail-metric small { display: block; margin-bottom: 5px; color: #8e817c; font-size: 11px; }
    .sms-detail-metric strong { display: block; color: #c83200; font-size: 15px; }
    .sms-detail-facts { margin-bottom: 25px; }
    .sms-detail-fact { display: flex; gap: 12px; padding: 11px 0; border-bottom: 1px solid #f0ecea; color: #555; font-size: 13px; }
    .sms-detail-fact i { width: 18px; color: #f34405; text-align: center; }
    .sms-detail-fact span { color: #999; }
    .sms-detail-action { display: flex; align-items: center; justify-content: center; gap: 9px; padding: 13px 20px; border-radius: 9px; background: #f34405; color: #fff; font-size: 12px; font-weight: 800; }
    .sms-detail-action:hover { background: #c83200; color: #fff; }
    .sms-detail-action.disabled { background: #ddd; color: #888; pointer-events: none; }
    .sms-detail-content { margin-top: 0; padding: 0 42px 35px; border-top: 1px solid #f0ecea; background: #fff; }
    .sms-detail-content .nav-tabs { gap: 8px; flex-wrap: nowrap; overflow-x: auto; border-bottom: 1px solid #eee5e1; }
    .sms-detail-content .nav-link { padding: 12px 7px; border: 0; border-bottom: 2px solid transparent; color: #777; font-size: 12px; font-weight: 700; white-space: nowrap; }
    .sms-detail-content .nav-link:hover, .sms-detail-content .nav-link.active { border-bottom-color: #f34405; color: #f34405; }
    .sms-detail-tab-pane { min-height: 110px; padding-top: 18px; color: #555; font-size: 14px; line-height: 1.8; overflow: visible; }
    .sms-detail-tab-pane img { max-width: 100%; height: auto; }

    .sms-asset-detail-card {
        overflow: hidden;
        border: 1px solid #f0e5df;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 18px 45px rgba(57, 30, 20, .09);
    }

    .sms-asset-detail-card > .row {
        display: grid;
        grid-template-columns: minmax(0, 1.08fr) minmax(0, .92fr);
        margin: 0;
    }

    .sms-asset-detail-card > .row > .col-lg-6,
    .sms-asset-detail-card .sms-detail-side {
        display: contents;
    }

    .sms-asset-detail-card > .row > .col-lg-6:first-child {
        display: block;
        width: 100%;
        min-width: 0;
    }

    .sms-asset-gallery { min-width: 0; background: #f5f5f5; }

    .sms-asset-thumbnails {
        display: flex;
        gap: 8px;
        padding: 10px;
        overflow-x: auto;
        background: #fff;
        scrollbar-width: thin;
    }

    .sms-asset-thumbnail {
        flex: 0 0 64px;
        width: 64px;
        height: 48px;
        padding: 0;
        overflow: hidden;
        border: 2px solid transparent;
        border-radius: 7px;
        background: #f5f5f5;
        cursor: pointer;
        opacity: .65;
        transition: border-color .2s ease, opacity .2s ease;
    }

    .sms-asset-thumbnail:hover,
    .sms-asset-thumbnail.active { border-color: #f34405; opacity: 1; }
    .sms-asset-thumbnail img { width: 100%; height: 100%; object-fit: cover; }

    .sms-asset-detail-card .sms-detail-copy {
        grid-column: 2;
        grid-row: 1;
        align-self: stretch;
        padding: 30px 34px 25px;
        background: #fff;
    }

    .sms-asset-detail-card .sms-detail-copy h2 {
        max-width: 470px;
        margin-bottom: 18px;
        font-size: clamp(24px, 3vw, 34px);
        letter-spacing: -.02em;
    }

    .sms-asset-detail-card .sms-detail-badge { margin-bottom: 12px; padding: 6px 11px; box-shadow: 0 5px 12px rgba(243, 68, 5, .08); }
    .sms-asset-detail-card .sms-detail-metrics { margin-bottom: 16px; }
    .sms-asset-detail-card .sms-detail-metric { padding: 11px 13px; }
    .sms-asset-detail-card .sms-detail-content { display: block; padding: 0 34px 28px; border-top: 1px solid #f0e5df; }
    .sms-asset-detail-card .sms-detail-facts { margin-bottom: 16px; padding: 4px 0 0; }
    .sms-asset-detail-card .sms-detail-fact { display: grid; grid-template-columns: 22px minmax(90px, .38fr) minmax(0, 1fr); align-items: start; gap: 10px; padding: 8px 0; }
    .sms-asset-detail-card .sms-detail-fact strong { color: #29221f; font-weight: 700; text-align: right; overflow-wrap: anywhere; }
    .sms-asset-detail-card .sms-detail-tab-pane { min-height: 100px; padding: 17px 4px 4px; }

    @media (max-width: 767px) {
        .sms-detail-copy { padding: 28px 22px 24px; }
        .sms-detail-image, .sms-detail-image img, .sms-asset-slider { height: 280px; }
        .sms-detail-content { padding: 0 22px 28px; }
        .sms-asset-detail-card > .row { display: block; }
        .sms-asset-detail-card .sms-asset-slider { height: 260px; }
        .sms-asset-detail-card .sms-detail-copy { display: block; padding: 24px 20px 20px; }
        .sms-asset-detail-card .sms-detail-content { display: block; padding: 0 20px 22px; }
        .sms-asset-detail-card .sms-detail-fact { grid-template-columns: 20px minmax(84px, .45fr) minmax(0, 1fr); gap: 8px; }
    }
</style>

<div class="breadcumb-area style2 bg-smoke4">
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('frontend/bprsms/assets/img/bg/breadcumb-bg.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $pageTitle }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ $backUrl }}">{{ $categoryLabel }}</a></li>
                    <li>{{ $pageTitle }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<main class="sms-detail-page {{ $isAsset ? 'sms-asset-detail-page' : '' }}">
    <div class="container sms-detail-shell">
        <div class="sms-detail-card {{ $isAsset ? 'sms-asset-detail-card' : '' }}">
            <div class="row g-0">
                <div class="col-lg-6">
                    @if ($isAsset)
                        <div class="sms-asset-gallery">
                            <div class="sms-asset-slider" id="smsAssetSlider" aria-label="Galeri foto {{ $lelang->title }}">
                                <div class="sms-asset-track" data-asset-track>
                                    @foreach ($assetImages as $image)
                                        <div class="sms-asset-slide {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ url('/recfil?display=true&rf=' . $image) }}" alt="{{ $lelang->title }} - foto {{ $loop->iteration }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="sms-asset-slider-button previous" type="button" data-asset-previous aria-label="Foto sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                                <button class="sms-asset-slider-button next" type="button" data-asset-next aria-label="Foto berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                                <div class="sms-asset-dots" data-asset-dots></div>
                            </div>
                            @if (count($assetImages) > 1)
                                <div class="sms-asset-thumbnails" aria-label="Pilih foto aset">
                                    @foreach ($assetImages as $image)
                                        <button class="sms-asset-thumbnail {{ $loop->first ? 'active' : '' }}" type="button" data-asset-thumbnail="{{ $loop->index }}" aria-label="Tampilkan foto {{ $loop->iteration }}">
                                            <img src="{{ url('/recfil?display=true&rf=' . $image) }}" alt="" loading="lazy">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @include('frontend.bprsms.pages.profil.detaillelang-tabs')
                    @else
                        <div class="sms-detail-image">
                            @if ($lelang->banner ?: $lelang->thumbnail)
                                <img src="{{ url('/recfil?display=true&rf=' . ($lelang->banner ?: $lelang->thumbnail)) }}" alt="{{ $lelang->title }}">
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center text-muted"><i class="fa-regular fa-image fa-3x"></i></div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="sms-detail-side">
                        <div class="sms-detail-copy">
                            <div class="sms-detail-badge"><i class="fa-solid {{ $isAsset ? 'fa-building-circle-check' : 'fa-gavel' }}"></i> {{ $categoryLabel }}</div>
                            <h2>{{ $lelang->title }}</h2>

                            @if ($isAsset)
                                <div class="sms-detail-metrics">
                                    <div class="sms-detail-metric" style="grid-column: 1 / -1;">
                                        <small>Harga Penawaran</small>
                                        <strong>{{ $lelang->harga_penawaran ? 'Rp ' . number_format($lelang->harga_penawaran, 0, ',', '.') : 'Belum tersedia' }}</strong>
                                    </div>
                                </div>
                            @else
                                <div class="sms-detail-metrics">
                                    <div class="sms-detail-metric">
                                        <small>Nilai Limit</small>
                                        <strong>{{ $lelang->limit ? 'Rp ' . number_format($lelang->limit, 0, ',', '.') : 'Tanpa nilai limit' }}</strong>
                                    </div>
                                    <div class="sms-detail-metric">
                                        <small>Uang Jaminan</small>
                                        <strong>{{ $lelang->jaminan ? 'Rp ' . number_format($lelang->jaminan, 0, ',', '.') : 'Tanpa uang jaminan' }}</strong>
                                    </div>
                                </div>
                            @endif

                            <div class="sms-detail-facts">
                                <div class="sms-detail-fact"><i class="fa-regular fa-calendar-check"></i><span>Batas akhir</span><strong>{{ $lelang->selesai ? \Carbon\Carbon::parse($lelang->selesai)->translatedFormat('d M Y') : '-' }}</strong></div>
                                <div class="sms-detail-fact"><i class="fa-solid fa-user-tie"></i><span>Penyelenggara</span><strong>{{ $lelang->penyelenggara ?: '-' }}</strong></div>
                                <div class="sms-detail-fact"><i class="fa-solid fa-location-dot"></i><span>Lokasi</span><strong>{{ $isAsset && $lelang->lokasi ? $lelang->lokasi : trim(($lelang->kota ?: '-') . ($lelang->provinsi ? ', ' . $lelang->provinsi : '')) }}</strong></div>
                                @if ($isAsset)
                                    <div class="sms-detail-fact"><i class="fa-solid fa-ruler-combined"></i><span>Luas tanah</span><strong>{{ $lelang->luas_tanah ?: '-' }}</strong></div>
                                    <div class="sms-detail-fact"><i class="fa-solid fa-house"></i><span>Luas bangunan</span><strong>{{ $lelang->luas_bangunan ?: '-' }}</strong></div>
                                    <div class="sms-detail-fact"><i class="fa-solid fa-file"></i><span>Legalitas</span><strong>{{ $lelang->legalitas ?: '-' }}</strong></div>
                                @else
                                    <div class="sms-detail-fact"><i class="fa-solid fa-hashtag"></i><span>Kode lot</span><strong>{{ $lelang->kode_lot ?: '-' }}</strong></div>
                                @endif
                            </div>

                            @if ($lelang->link)
                                <a href="{{ $lelang->link }}" target="_blank" rel="noopener" class="sms-detail-action"><i class="fa-solid {{ $actionIcon }}"></i> {{ $actionLabel }}</a>
                            @else
                                <span class="sms-detail-action disabled"><i class="fa-solid {{ $actionIcon }}"></i> {{ $actionLabel }}</span>
                            @endif
                        </div>

                        @if (!$isAsset)
                            @include('frontend.bprsms.pages.profil.detaillelang-tabs')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isAssetDetail = @json($isAsset);
        const uraian = document.getElementById('sms-uraian');
        const uraianImages = uraian ? Array.from(uraian.querySelectorAll('img')) : [];

        if (isAssetDetail && document.getElementById('smsAssetSlider')) {
            const slider = document.getElementById('smsAssetSlider');
            const track = slider.querySelector('[data-asset-track]');
            const dots = slider.querySelector('[data-asset-dots]');
            const previous = slider.querySelector('[data-asset-previous]');
            const next = slider.querySelector('[data-asset-next]');
            const thumbnails = Array.from(document.querySelectorAll('[data-asset-thumbnail]'));
            let currentSlide = 0;
            let touchStartX = 0;

            uraianImages.forEach(function (image) {
                const parent = image.parentElement;
                const slide = document.createElement('div');
                slide.className = 'sms-asset-slide';
                slide.appendChild(image);
                track.appendChild(slide);

                if (parent && ['P', 'FIGURE'].includes(parent.tagName) && !parent.textContent.trim() && !parent.children.length) {
                    parent.remove();
                }
            });

            const slides = Array.from(track.children);
            const showSlide = function (index) {
                if (!slides.length) {
                    previous.hidden = true;
                    next.hidden = true;
                    return;
                }

                currentSlide = (index + slides.length) % slides.length;
                slides.forEach(function (slide, slideIndex) {
                    slide.classList.toggle('active', slideIndex === currentSlide);
                });
                thumbnails.forEach(function (thumbnail) {
                    thumbnail.classList.toggle('active', Number(thumbnail.dataset.assetThumbnail) === currentSlide);
                });
                dots.innerHTML = '';
                slides.forEach(function (_, slideIndex) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'sms-asset-dot' + (slideIndex === currentSlide ? ' active' : '');
                    dot.setAttribute('aria-label', 'Tampilkan foto ' + (slideIndex + 1));
                    dot.addEventListener('click', function () { showSlide(slideIndex); });
                    dots.appendChild(dot);
                });
                previous.hidden = slides.length < 2;
                next.hidden = slides.length < 2;
            };

            previous.addEventListener('click', function () { showSlide(currentSlide - 1); });
            next.addEventListener('click', function () { showSlide(currentSlide + 1); });
            thumbnails.forEach(function (thumbnail) {
                thumbnail.addEventListener('click', function () {
                    showSlide(Number(thumbnail.dataset.assetThumbnail));
                });
            });
            slider.addEventListener('touchstart', function (event) { touchStartX = event.changedTouches[0].screenX; }, { passive: true });
            slider.addEventListener('touchend', function (event) {
                const distance = event.changedTouches[0].screenX - touchStartX;
                if (Math.abs(distance) > 40) {
                    showSlide(currentSlide + (distance < 0 ? 1 : -1));
                }
            }, { passive: true });
            showSlide(0);
        }

        if (typeof bootstrap !== 'undefined') {
            return;
        }

        document.querySelectorAll('#smsDetailTab [data-bs-toggle="tab"]').forEach(function (tab) {
            tab.addEventListener('click', function () {
                const target = document.querySelector(tab.dataset.bsTarget);
                document.querySelectorAll('#smsDetailTab .nav-link').forEach(function (item) {
                    item.classList.toggle('active', item === tab);
                });
                document.querySelectorAll('#smsDetailTabContent .tab-pane').forEach(function (pane) {
                    const isActive = pane === target;
                    pane.classList.toggle('show', isActive);
                    pane.classList.toggle('active', isActive);
                });
            });
        });
    });
</script>
@endpush
@endsection

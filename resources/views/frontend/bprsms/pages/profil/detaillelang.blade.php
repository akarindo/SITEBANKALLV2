@extends('frontend.bprsms.layout.main')

@section('content')
@php
    $isAsset = (int) $lelang->type === 1;
    $categoryLabel = $isAsset ? 'Jual Aset' : 'Lelang';
    $pageTitle = $isAsset ? 'Detail Jual Aset' : 'Detail Lelang';
    $actionLabel = $isAsset ? 'LIHAT INFORMASI ASET' : 'IKUTI LELANG';
    $actionIcon = $isAsset ? 'fa-arrow-up-right-from-square' : 'fa-gavel';
    $backUrl = url('/lelang-jualaset') . '?tab=' . ($isAsset ? 'jual-aset' : 'lelang');
@endphp

<style>
    .sms-detail-page { background: transparent; padding-bottom: 80px; }
    .sms-detail-shell { margin-top: 42px; position: relative; z-index: 2; }
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
    .sms-uraian-gallery { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; margin-top: 18px; }
    .sms-uraian-gallery a { position: relative; display: block; aspect-ratio: 4 / 3; overflow: hidden; border-radius: 12px; background: #f5f5f5; }
    .sms-uraian-gallery a::after { position: absolute; right: 10px; bottom: 10px; width: 28px; height: 28px; border-radius: 50%; background: rgba(0, 0, 0, .55); color: #fff; content: "\\f065"; font-family: "Font Awesome 6 Free"; font-size: 12px; font-weight: 900; line-height: 28px; text-align: center; opacity: 0; transition: opacity .2s ease; }
    .sms-uraian-gallery a:hover::after { opacity: 1; }
    .sms-uraian-gallery img { width: 100%; height: 100% !important; object-fit: cover; transition: transform .3s ease; }
    .sms-uraian-gallery a:hover img { transform: scale(1.05); }
    @media (max-width: 767px) {
        .sms-detail-copy { padding: 28px 22px 24px; }
        .sms-detail-image, .sms-detail-image img, .sms-asset-slider { height: 280px; }
        .sms-detail-content { padding: 0 22px 28px; }
        .sms-uraian-gallery { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 9px; }
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

<main class="sms-detail-page">
    <div class="container sms-detail-shell">
        <div class="sms-detail-card">
            <div class="row g-0">
                <div class="col-lg-6">
                    @if ($isAsset)
                        <div class="sms-asset-slider" id="smsAssetSlider" aria-label="Galeri foto {{ $lelang->title }}">
                            <div class="sms-asset-track" data-asset-track>
                                @if ($lelang->banner ?: $lelang->thumbnail)
                                    <div class="sms-asset-slide active">
                                        <img src="{{ url('/recfil?display=true&rf=' . ($lelang->banner ?: $lelang->thumbnail)) }}" alt="{{ $lelang->title }}">
                                    </div>
                                @endif
                            </div>
                            <button class="sms-asset-slider-button previous" type="button" data-asset-previous aria-label="Foto sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="sms-asset-slider-button next" type="button" data-asset-next aria-label="Foto berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                            <div class="sms-asset-dots" data-asset-dots></div>
                        </div>
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

                        @if (!$isAsset)
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
                            <div class="sms-detail-fact"><i class="fa-solid fa-location-dot"></i><span>Lokasi</span><strong>{{ trim(($lelang->kota ?: '-') . ($lelang->provinsi ? ', ' . $lelang->provinsi : '')) }}</strong></div>
                            @if (!$isAsset)
                                <div class="sms-detail-fact"><i class="fa-solid fa-hashtag"></i><span>Kode lot</span><strong>{{ $lelang->kode_lot ?: '-' }}</strong></div>
                            @endif
                        </div>

                        @if ($lelang->link)
                            <a href="{{ $lelang->link }}" target="_blank" rel="noopener" class="sms-detail-action"><i class="fa-solid {{ $actionIcon }}"></i> {{ $actionLabel }}</a>
                        @else
                            <span class="sms-detail-action disabled"><i class="fa-solid {{ $actionIcon }}"></i> {{ $actionLabel }}</span>
                        @endif
                        </div>

                        <div class="sms-detail-content">
                            <ul class="nav nav-tabs" id="smsDetailTab" role="tablist">
                                <li class="nav-item" role="presentation"><button class="nav-link active" id="sms-uraian-tab" data-bs-toggle="tab" data-bs-target="#sms-uraian" type="button" role="tab">Uraian</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link" id="sms-lampiran-tab" data-bs-toggle="tab" data-bs-target="#sms-lampiran" type="button" role="tab">Lampiran</button></li>
                                @if (!$isAsset)
                                    <li class="nav-item" role="presentation"><button class="nav-link" id="sms-kodelot-tab" data-bs-toggle="tab" data-bs-target="#sms-kodelot" type="button" role="tab">Kode Lot</button></li>
                                @endif
                                <li class="nav-item" role="presentation"><button class="nav-link" id="sms-penyelenggara-tab" data-bs-toggle="tab" data-bs-target="#sms-penyelenggara" type="button" role="tab">Info Penyelenggara</button></li>
                            </ul>
                            <div class="tab-content" id="smsDetailTabContent">
                                <div class="tab-pane fade show active sms-detail-tab-pane" id="sms-uraian" role="tabpanel" aria-labelledby="sms-uraian-tab">{!! $lelang->uraian ?: '<p>Belum ada uraian tersedia.</p>' !!}</div>
                                <div class="tab-pane fade sms-detail-tab-pane" id="sms-lampiran" role="tabpanel" aria-labelledby="sms-lampiran-tab">{!! $lelang->lampiran ?: '<p>Belum ada lampiran tersedia.</p>' !!}</div>
                                @if (!$isAsset)
                                    <div class="tab-pane fade sms-detail-tab-pane" id="sms-kodelot" role="tabpanel" aria-labelledby="sms-kodelot-tab"><p>{{ $lelang->kode_lot ?: '-' }}</p></div>
                                @endif
                                <div class="tab-pane fade sms-detail-tab-pane" id="sms-penyelenggara" role="tabpanel" aria-labelledby="sms-penyelenggara-tab"><p>{{ $lelang->penyelenggara ?: '-' }}</p></div>
                            </div>
                        </div>
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
            slider.addEventListener('touchstart', function (event) { touchStartX = event.changedTouches[0].screenX; }, { passive: true });
            slider.addEventListener('touchend', function (event) {
                const distance = event.changedTouches[0].screenX - touchStartX;
                if (Math.abs(distance) > 40) {
                    showSlide(currentSlide + (distance < 0 ? 1 : -1));
                }
            }, { passive: true });
            showSlide(0);
        } else if (uraianImages.length) {
            const gallery = document.createElement('div');
            gallery.className = 'sms-uraian-gallery';

            uraianImages.forEach(function (image) {
                const parent = image.parentElement;
                const link = document.createElement('a');
                link.href = image.currentSrc || image.src;
                link.target = '_blank';
                link.rel = 'noopener';
                link.appendChild(image);
                gallery.appendChild(link);

                if (parent && ['P', 'FIGURE'].includes(parent.tagName) && !parent.textContent.trim() && !parent.children.length) {
                    parent.remove();
                }
            });

            uraian.appendChild(gallery);
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

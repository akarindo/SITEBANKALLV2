@extends('frontend.bprana.layout.main')

@section('content')
<div class="pxn-page-header" data-bg-image="frontend/bprana/assets/images/profil/banertop.jpg"
    style="margin-top:120px; height:150px; display:flex; align-items:center; justify-content:center;">


    <div class="container">
        <div class="row">
            <div class="col">
                <div class="pxn_page_header_content" style="text-align: center;">
                    <h1 class="page_title">Pengurus</h1>
                    <div class="pxn_breadcrumb">
                        <span><a href="/">Profil</a></span>
                        /
                        <span class="current">Pengurus</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- start: About Section -->
<section class="pxn-h1-about-section about-page">
    <div class="bg_shape pxn-fade" data-direction="left" data-delay="1.5"><img
            src="frontend/bprana/assets/images/about/h1-about-bg-shape.png" alt="Shape"></div>
    <div class="container py-5">
        <div class="row g-5 align-items-center justify-content-center">
            <div class="col-lg-12 wow fadeInLeft" data-wow-delay="0.1s" style="max-width: 1000px;">
                @if ($pengurus)
                <article>
                    <div class="details-post-area">
                        <div class="image" style="text-align:center;">
                            <img src="/recfil?display=true&rf={{ $pengurus->banner }}" alt="{{ $pengurus->title }}"
                                style="border-radius:8px; height: 800px; width: 900px;">
                        </div>
                        <div class="space30"></div>
                        <div class="heading1">
                            <div class="event-content">
                                {!! $pengurus->content !!}
                            </div>
                        </div>
                    </div>
                </article>
                @else
                <div class="alert alert-warning text-center">
                    Data tidak ditemukan.
                </div>
                @endif
            </div>
        </div>

    </div>
</section>
<!-- end: About Section -->
@endsection
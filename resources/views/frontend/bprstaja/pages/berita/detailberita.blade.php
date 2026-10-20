@extends('frontend.bprtaruna.layout.main')

@section('content')
    <style>
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* jumlah baris yang ditampilkan */
            -webkit-box-orient: vertical;
            overflow: hidden;
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

        .post-meta {
            margin-top: 5px;
            font-size: 14px;
            color: #6c757d;
        }

        .post-meta a {
            color: #6c757d;
            text-decoration: none;
        }

        .post-meta a:hover {
            color: #007bff;
        }

        .post-item {
            display: flex;
            margin-bottom: 20px;
        }

        .post-img {
            margin-right: 15px;
            flex-shrink: 0;
        }

        .post-img img {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .post-text {
            flex-grow: 1;
        }

        .post-text a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .post-text a:hover {
            color: #007bff;
        }
    </style>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Detail Berita</h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Single Post Start-->
    <div class="single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-content wow fadeInUp">
                        <!-- Dynamic Article Image -->
                        <img src="/recfil?display=true&rf={{ $berita->banner }}" alt="{{ $berita->title }}"
                            style="width: 100%; height: auto; border-radius: 5px; margin-bottom: 20px;" />

                        <!-- Article Meta Data -->
                        <div class="article-meta" style="margin-bottom: 15px; color: #6c757d; font-size: 14px;">
                            <span>
                                <i class="fa fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($berita->tanggal_tampil)->translatedFormat('d F Y') }}
                            </span>
                            <span style="margin-left: 15px;">
                                <i class="fa fa-tag"></i>
                                {{ implode(', ', json_decode($berita->tag, true) ?? []) }}
                            </span>
                        </div>

                        <!-- Dynamic Article Title -->
                        <h2>{{ $berita->title }}</h2>

                        <!-- Dynamic Article Content -->
                        <div class="event-content">
                            {!! $berita->content !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget wow fadeInUp">
                            <div class="search-widget">
                                <form>
                                    <input class="form-control" type="text" placeholder="Search Keyword">
                                    <button class="btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="sidebar-widget wow fadeInUp">
                            <h2 class="widget-title">Berita Lain</h2>
                            <div class="recent-post">
                                @foreach ($other_beritaall as $item)
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="/recfil?display=true&rf={{ $item->thumbnail }}"
                                                alt="{{ $item->title }}" />
                                        </div>
                                        <div class="post-text">
                                            <a href="{{ route('detberita', $item->slug) }}"
                                                class="text-truncate-2">{{ $item->title }}</a>
                                            <div class="post-meta">
                                                <p>{{ \Carbon\Carbon::parse($item->tanggal_tampil)->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Post End-->
@endsection

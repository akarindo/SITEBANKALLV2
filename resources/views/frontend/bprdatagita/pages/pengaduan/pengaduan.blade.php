@extends('frontend.bprdatagita.layout.main')

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

    /* Custom Styling untuk Prosedur Pengaduan & Kerahasiaan */
    .prosedur-card {
        background: transparent;
        border: 0;
        border-radius: 0;
        box-shadow: none;
        text-align: left;
    }

    .prosedur-card h3 {
        color: #b80000;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .prosedur-card h4 {
        color: #333333;
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .prosedur-card p, .prosedur-card li {
        color: #4a4a4a;
        font-size: 15px;
        line-height: 1.6;
        text-align: justify;
    }

    .prosedur-columns {
        margin-top: 1.5rem;
        margin-right: 0;
        margin-left: 0;
    }

    .prosedur-section-wide {
        margin-top: 2rem;
    }

    .prosedur-column {
        padding: 0;
    }

    .prosedur-column:first-child {
        padding-right: 1.5rem;
    }

    .prosedur-column + .prosedur-column {
        padding-left: 1.5rem;
        border-left: 1px solid #e2e6ea;
    }

    .prosedur-card ul,
    .prosedur-card ol {
        margin-top: 0;
        margin-bottom: 1.25rem;
        padding-left: 1.75rem;
        list-style-position: outside;
    }

    .prosedur-card ul {
        list-style-type: disc;
    }

    .prosedur-card ol {
        list-style: decimal outside !important;
    }

    .prosedur-card ul > li {
        list-style: disc outside !important;
    }

    .prosedur-card ol > li {
        list-style: decimal outside !important;
    }

    .prosedur-card ol > li::marker {
        color: #b80000;
        font-weight: 700;
    }

    .prosedur-card li {
        margin-bottom: 0.5rem;
        padding-left: 0.25rem;
    }

    .prosedur-card li:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 991.98px) {
        .prosedur-column {
            padding: 0;
        }

        .prosedur-column:first-child {
            padding-right: 0;
        }

        .prosedur-column + .prosedur-column {
            margin-top: 2rem;
            padding-top: 2rem;
            padding-left: 0;
            border-top: 1px solid #e2e6ea;
            border-left: 0;
        }
    }

    .pengaduan-pdf {
        width: 100%;
        height: 720px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .pengaduan-pdf {
            height: 520px;
        }
    }
</style>

<section class="breadcrumb-area bg-img bg-overlay jarallax"
    style="background-image: url('frontend/bprdatagita/img/profil/top.jpg');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2>Pengaduan Nasabah</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengaduan Nasabah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<body class="body tg-heading-subheading animation-style3">
    <!--===== LAYANAN PENGADUAN =====-->
<<<<<<< HEAD
    <section id="pengaduan-nasabah" class="py-5 text-center pn-section" aria-labelledby="pn-title">
        <style>
            #pengaduan-nasabah {
                --pn-primary: #124b70;
                --pn-accent: #0c83a0;
                --pn-text: #243443;
                --pn-muted: #607184;
                --pn-border: #e3ebf0;
                --pn-soft: #f3f8fb;
                font-family: inherit;
                color: var(--pn-text);
                line-height: 1.75;
                padding: 48px 20px 72px;
                background: #fff;
            }

            #pengaduan-nasabah *,
            #pengaduan-nasabah *::before,
            #pengaduan-nasabah *::after {
                box-sizing: border-box;
            }

            #pengaduan-nasabah .pn-container {
                max-width: 1100px;
                margin: 0 auto;
            }

            #pengaduan-nasabah .pn-heading {
                margin: 0 0 14px;
                color: var(--pn-primary);
                font-size: clamp(26px, 3vw, 38px);
                line-height: 1.25;
                font-weight: 750;
            }

            #pengaduan-nasabah .pn-lead {
                max-width: 900px;
                color: var(--pn-muted);
                font-size: 16px;
                margin: 0 0 28px;
            }

            #pengaduan-nasabah .pn-eyebrow {
                display: inline-block;
                color: var(--pn-accent);
                font-weight: 700;
                font-size: 12px;
                letter-spacing: .09em;
                text-transform: uppercase;
                margin: 0 0 9px;
            }

            #pengaduan-nasabah .pn-card {
                border: 1px solid var(--pn-border);
                border-radius: 16px;
                padding: 26px;
                margin: 0 0 22px;
                background: #fff;
                box-shadow: 0 7px 25px rgba(20, 56, 81, .045);
            }

            #pengaduan-nasabah .pn-card h3 {
                margin: 0 0 12px;
                color: var(--pn-primary);
                font-size: 21px;
                line-height: 1.35;
            }

            #pengaduan-nasabah .pn-section-title {
                color: var(--pn-primary);
                font-size: 25px;
                line-height: 1.35;
                margin: 34px 0 18px;
            }

            #pengaduan-nasabah p {
                margin: 0 0 14px;
            }

            #pengaduan-nasabah p:last-child {
                margin-bottom: 0;
            }

            #pengaduan-nasabah ul,
            #pengaduan-nasabah ol {
                padding-left: 22px;
                margin: 12px 0 0;
            }

            #pengaduan-nasabah li {
                margin: 0 0 10px;
                padding-left: 3px;
            }

            #pengaduan-nasabah li:last-child {
                margin-bottom: 0;
            }

            #pengaduan-nasabah a {
                color: var(--pn-primary);
                text-decoration: underline;
                text-underline-offset: 3px;
                overflow-wrap: anywhere;
            }

            #pengaduan-nasabah a:hover {
                color: var(--pn-accent);
            }

            #pengaduan-nasabah .pn-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            #pengaduan-nasabah .pn-grid .pn-card {
                height: 100%;
                margin: 0;
            }

            #pengaduan-nasabah .pn-note {
                background: var(--pn-soft);
                border-left: 4px solid var(--pn-accent);
                border-radius: 8px;
                padding: 16px 20px;
                margin-top: 20px;
            }

            #pengaduan-nasabah .pn-note p {
                margin: 0;
            }

            #pengaduan-nasabah .pn-time {
                color: var(--pn-primary);
                font-weight: 750;
                font-size: 18px;
            }

            #pengaduan-nasabah .pn-steps {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
                margin: 15px 0;
                list-style: none;
                padding: 0;
                counter-reset: pn-step;
            }

            #pengaduan-nasabah .pn-steps li {
                counter-increment: pn-step;
                position: relative;
                margin: 0;
                padding: 18px 18px 18px 60px;
                background: var(--pn-soft);
                border: 1px solid var(--pn-border);
                border-radius: 12px;
            }

            #pengaduan-nasabah .pn-steps li::before {
                content: counter(pn-step);
                position: absolute;
                top: 18px;
                left: 16px;
                width: 31px;
                height: 31px;
                border-radius: 50%;
                background: var(--pn-primary);
                color: #fff;
                font-weight: 700;
                display: grid;
                place-items: center;
            }

            #pengaduan-nasabah .pn-contact {
                margin: 20px 0 0;
                padding: 20px 24px;
                border-radius: 14px;
                background: var(--pn-soft);
            }

            #pengaduan-nasabah .pn-contact p {
                margin-bottom: 8px;
            }

            #pengaduan-nasabah .pn-small {
                font-size: 14px;
                color: var(--pn-muted);
            }

            @media(max-width:720px) {
                #pengaduan-nasabah {
                    padding: 32px 16px 48px;
                }

                #pengaduan-nasabah .pn-grid,
                #pengaduan-nasabah .pn-steps {
                    grid-template-columns: 1fr;
                }

                #pengaduan-nasabah .pn-card {
                    padding: 20px;
                }

                #pengaduan-nasabah .pn-section-title {
                    font-size: 22px;
                }
            }
        </style>

        <div class="pn-container">
            <header>
                <span class="pn-eyebrow">Layanan Konsumen</span>
                <h2 id="pn-title" class="pn-heading">Prosedur Pengaduan Nasabah</h2>
                <p class="pn-lead">PT. BPR Datagita Mustika menyediakan layanan penerimaan, penanganan, dan penyelesaian
                    pengaduan nasabah sesuai dengan ketentuan perlindungan konsumen di sektor jasa keuangan.</p>
                <p>Berdasarkan Peraturan Otoritas Jasa Keuangan Nomor 22 Tahun 2023 tentang Perlindungan Konsumen dan
                    Masyarakat di Sektor Jasa Keuangan serta POJK No. 18/POJK.07/2018 tentang Layanan Pengaduan Konsumen
                    di Sektor Jasa Keuangan, berikut tata cara pelayanan dan penyelesaian pengaduan nasabah PT. BPR
                    Datagita Mustika.</p>
            </header>

            <h3 class="pn-section-title">Mekanisme Pengajuan Pengaduan</h3>
            <p>Pengaduan dapat disampaikan oleh nasabah secara langsung atau oleh perwakilan nasabah yang bertindak
                untuk dan atas nama nasabah, dengan menunjukkan surat kuasa bermeterai. Pengaduan dapat disampaikan
                secara lisan atau tertulis.</p>

            <div class="pn-grid">
                <article class="pn-card">
                    <h3>A. Pengaduan Secara Lisan</h3>
                    <p>Nasabah dapat menyampaikan pengaduan melalui:</p>
                    <ol>
                        <li>Telepon: <a href="tel:+622518647375">(0251) 8647375</a>.</li>
                        <li>WhatsApp: <a href="https://wa.me/6281314791447" target="_blank"
                                rel="noopener noreferrer">0813 1479 1447</a>.</li>
                    </ol>
                    <div class="pn-note">
                        <p><span class="pn-time">Maksimal 5 hari kerja</span><br>Pengaduan lisan ditangani dan
                            diselesaikan paling lama 5 hari kerja sejak tanggal diterima. Apabila membutuhkan waktu
                            lebih lama, Bank akan meminta nasabah menyampaikan pengaduan secara tertulis.</p>
                    </div>
                </article>

                <article class="pn-card">
                    <h3>B. Pengaduan Secara Tertulis</h3>
                    <p>Pengaduan tertulis dapat diajukan melalui:</p>
                    <ol>
                        <li>Datang ke kantor dan menyampaikan pengaduan kepada Customer Service atau petugas pelayanan
                            nasabah.</li>
                        <li>Email <a href="mailto:bprdatagita@gmail.com?subject=PENGADUAN">bprdatagita@gmail.com</a>
                            dengan subjek <strong>PENGADUAN</strong>.</li>
                        <li>WhatsApp resmi: <a href="https://wa.me/6281314791447" target="_blank"
                                rel="noopener noreferrer">0813 1479 1447</a>.</li>
                        <li>Formulir pada menu Pengaduan Nasabah di <a href="https://bprdatagitamustika.co.id"
                                target="_blank" rel="noopener noreferrer">bprdatagitamustika.co.id</a>.</li>
                        <li>Surat resmi ke PT. BPR Datagita Mustika Utama, Jl. Karehkel No. 1, Leuwiliang, Kode Pos
                            16640.</li>
                    </ol>
                </article>
            </div>

            <article class="pn-card" style="margin-top:22px;">
                <h3>Dokumen Pendukung Pengaduan Tertulis</h3>
                <p>Untuk pengaduan tertulis, nasabah wajib melampirkan fotokopi identitas dan dokumen pendukung yang
                    relevan, antara lain:</p>
                <ol>
                    <li>Fotokopi KTP nasabah dan/atau perwakilannya, apabila diwakilkan.</li>
                    <li>Surat kuasa dari nasabah, apabila pengaduan diwakilkan.</li>
                    <li>Fotokopi rekening yang diadukan.</li>
                    <li>Fotokopi bukti transaksi keuangan terkait permasalahan.</li>
                    <li>Fotokopi dokumen pendukung lainnya yang terkait permasalahan.</li>
                </ol>
                <div class="pn-note">
                    <p><span class="pn-time">10 hari kerja + perpanjangan maksimal 10 hari kerja</span><br>Pengaduan
                        tertulis ditangani dan diselesaikan dalam 10 hari kerja sejak diterima oleh Bank. Dalam kondisi
                        tertentu sesuai ketentuan hukum, waktu penyelesaian dapat diperpanjang paling lama 10 hari kerja
                        berikutnya. Bank akan memberitahukan perpanjangan tersebut secara tertulis kepada nasabah
                        sebelum jangka waktu awal berakhir.</p>
                </div>
            </article>

            <h3 class="pn-section-title">C. Alur Penanganan dan Penyelesaian Pengaduan</h3>
            <p>Pengaduan mengenai produk dan/atau layanan disampaikan oleh nasabah atau perwakilannya, baik secara lisan
                maupun tertulis, melalui tahapan berikut:</p>
            <ol class="pn-steps">
                <li><strong>Penyampaian pengaduan.</strong> Nasabah atau perwakilannya menyampaikan keluhan terkait
                    produk dan/atau layanan Bank.</li>
                <li><strong>Penerimaan dan verifikasi.</strong> PT. BPR Datagita Mustika menerima pengaduan,
                    memverifikasi data nasabah, dan membuat nomor pengaduan.</li>
                <li><strong>Nomor pengaduan.</strong> Nasabah menerima nomor pengaduan sebagai referensi proses
                    penanganan.</li>
                <li><strong>Tindak lanjut.</strong> Bank menindaklanjuti pengaduan sesuai dengan batas waktu
                    penyelesaian berdasarkan jenis pengaduan.</li>
                <li><strong>Penyampaian hasil.</strong> Bank menyampaikan hasil penyelesaian pengaduan kepada nasabah.
                </li>
                <li><strong>Konfirmasi penyelesaian.</strong> Apabila nasabah menyetujui hasil penyelesaian, pengaduan
                    dianggap selesai dan Bank menyampaikan informasi penyelesaiannya.</li>
            </ol>
            <p>Berdasarkan SE OJK No. 17/SEOJK.07/2018, informasi mengenai jangka waktu penyelesaian pengaduan
                disampaikan melalui telepon, surat, dan/atau email.</p>

            <article class="pn-card">
                <h3>Apabila Nasabah Tidak Menyetujui Hasil Penyelesaian</h3>
                <p>Apabila nasabah tidak sepakat atau tidak puas terhadap hasil penyelesaian pengaduan dari Bank,
                    nasabah dapat melanjutkan upaya penyelesaian melalui:</p>
                <ul>
                    <li><strong>Otoritas Jasa Keuangan (OJK)</strong> melalui fasilitas penyelesaian pengaduan.</li>
                    <li><strong>Bank Indonesia (BI)</strong> khusus untuk pengaduan yang berkaitan dengan jasa sistem
                        pembayaran.</li>
                    <li><strong>Lembaga Alternatif Penyelesaian Sengketa (LAPS)</strong> yang tercantum dalam daftar
                        lembaga yang ditetapkan oleh OJK.</li>
                    <li><strong>Jalur hukum</strong> sesuai dengan ketentuan yang berlaku.</li>
                </ul>
            </article>

            <h3 class="pn-section-title">Kerahasiaan Data Nasabah</h3>
            <article class="pn-card">
                <p>Bank menjaga kerahasiaan data nasabah yang mengajukan pengaduan terhadap pihak mana pun, kecuali:</p>
                <ol>
                    <li>Kepada Otoritas Jasa Keuangan.</li>
                    <li>Dalam rangka penyelesaian pengaduan.</li>
                    <li>Apabila diwajibkan oleh peraturan perundang-undangan.</li>
                    <li>Atas persetujuan nasabah yang bersangkutan.</li>
                </ol>
            </article>

            <h3 class="pn-section-title">Hal yang Perlu Diperhatikan Nasabah</h3>
            <article class="pn-card">
                <p>Untuk mendukung kelancaran proses penanganan pengaduan, nasabah diimbau untuk:</p>
                <ol>
                    <li>Menentukan inti permasalahan yang akan diadukan.</li>
                    <li>Menyiapkan dokumen pendukung terkait permasalahan yang diadukan.</li>
                    <li>Menyimpan dokumen asli dengan baik dan menyampaikan salinan dokumen kepada Bank.</li>
                    <li>Mencatat nomor register pengaduan dan nama petugas penerima pengaduan.</li>
                    <li>Menyimpan dokumen surat-menyurat, termasuk surat hasil penyelesaian pengaduan.</li>
                </ol>
            </article>

            <!-- <aside class="pn-contact" aria-label="Kontak pengaduan">
      <h3 style="margin:0 0 12px;color:var(--pn-primary);">Hubungi Layanan Pengaduan</h3>
      <p><strong>Telepon:</strong> <a href="tel:+622518647375">(0251) 8647375</a></p>
      <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281314791447" target="_blank" rel="noopener noreferrer">0813 1479 1447</a></p>
      <p><strong>Email:</strong> <a href="mailto:bprdatagita@gmail.com?subject=PENGADUAN">bprdatagita@gmail.com</a></p>
      <p><strong>Website:</strong> <a href="https://bprdatagitamustika.co.id" target="_blank" rel="noopener noreferrer">bprdatagitamustika.co.id</a></p>
      <p><strong>Alamat surat:</strong> PT. BPR Datagita Mustika Utama, Jl. Karehkel No. 1, Leuwiliang, 16640.</p>
    </aside> -->
        </div>
    </section>
    <section class="py-5 text-center" hidden>

        {{-- <h2 style="font-weight:600; color:#b80000; margin-bottom:20px; font-family:'Open Sans', sans-serif;"">
                Pengaduan Nasabah
            </h2> --}}

            <div class=" row justify-content-center mb-4" style="margin-top: 40px;">
            <div class="col-lg-8" hidden>
                <p style="color: black; font-size: 23px;">
                    Kami menyediakan sarana bagi masyarakat untuk menyampaikan pengaduan dan pelanggaran yang terjadi di
                    lingkungan sekitar secara cepat dan mudah.
                </p>
=======
    <section class="py-5 text-center">
        <div class="container">
            <!-- 5 Baris Deskripsi Pertama -->
            <div class="row justify-content-center mb-4" style="margin-top: 20px;">
                <div class="col-12">
                    <p style="color: #333; font-size: 18px; line-height: 1.8; text-align: justify;">
                        Kami menyediakan sarana bagi masyarakat untuk menyampaikan pengaduan dan pelanggaran yang terjadi di lingkungan sekitar secara cepat dan mudah.
                    </p>
                    <p style="color: #333; font-size: 18px; line-height: 1.8; text-align: justify;">
                        Berdasarkan Peraturan Otoritas Jasa Keuangan Nomor 22 Tahun 2023 tentang Perlindungan
Konsumen dan Masyarakat di Sektor Jasa Keuangan dan POJK No. 18/POJK.07/2018 tentang
Layanan Pengaduan Konsumen di Sektor Jasa Keuangan, dengan ini menginformasikan Tata
Cara Pelayanan dan Penyelesaian Pengaduan Nasabah PT. BPR DATAGITA MUSTIKA.
                    </p>
                </div>
>>>>>>> a79f53c (add tab jual aset and lelang bprsms)
            </div>

            <!-- Konten Hard Code HTML Prosedur & Mekanisme Pengaduan -->
            <div class="row justify-content-center mb-5">
                <div class="col-12">
                    <div class="prosedur-card">

                        <!-- Judul Pertama -->
                        <h3 class="border-bottom pb-3 mb-4">Mekanisme Pengajuan Pengaduan</h3>
                        <p class="mb-4">
                           Pengajuan pengaduan nasabah kepada BPR Datagita Mustika dapat dilakukan oleh nasabah
atau perwakilan nasabah yang bertindak untuk dan atas nama nasabah (ditunjukkan dengan
surat kuasa bermaterai). Nasabah dapat menyampaikan pengaduan kepada BPR Datagita
Mustika melalui 2 (dua) cara sebagai berikut :

                        </p>

                        <!-- Poin A: Pengaduan Secara Lisan -->
                        <div class="prosedur-section">
                            <h4>A. Pengaduan Secara Lisan</h4>
                           
                            <ol class="mb-4">
                                <li>Nasabah menelpon dan menyampaikan pengaduannya melalui no telp (0251)8647375</i>.</li>
                                <li>Nasabah menyampaikan pengaduan dengan mengirim Whatsapp ke nomor 08131479
1447
.</li>
                            </ol>
                            <p>Pengaduan secara lisan dari nasabah akan ditangani dan diselesaikan maksimal dalam 5 (lima)
hari kerja setelah tanggal pengaduan diterima. Apabila pengaduan yang diajukan oleh
nasabah memerlukan penanganan dan penyelesaian lebih dari 5 (lima) hari kerja, maka BPR
Datagita Mustika akan menyampaikan kepada nasabah agar mengajukan pengaduannya
secara tertulis.</p>
                        </div>

                        <!-- Poin B: Pengaduan Secara Tertulis -->
                        <div class="prosedur-section prosedur-section-wide">
                            <h4>B. Pengaduan Secara Tertulis</h4>
                            <p>Pengaduan secara tertulis dapat disampaikan melalui beberapa media diantaranya :
</p>
                            <ol class="mb-4">
                                <li> Nasabah mendatangi kantor dan menyampaikan pengaduan melalui Customer service/
Petugas pelayanan nasabah.</li>
                                <li>Mengirim email ke alamat: bprdatagita@gmail.com dengan subjek “PENGADUAN”</li>
                                <li>Mengirim pesan melalui whatsapp resmi PT. BPR Datagita Mustika di nomor:
081314791447</li>
                                <li>Mengisi formulir pengaduan melalui menu Pengaduan Nasabah pada website
bprdatagitamustika.co.id</li>
                                <li>Bersurat resmi ke PT. BPR Datagita Mustika Utama Jl. Karehkel No.1 Leuwiliang Kode Pos
16640.</li>
                            </ol>

                            <p>Dalam hal pengaduan diajukan secara tertulis, maka nasabah wajib melampirkan fotokopi
identitas dan dokumen pendukung lainnya seperti :
</p>
                            <ol>
                                <li>Foto copy KTP nasabah dan/atau perwakilannya (jika diwakilkan)</li>
                                <li>Surat kuasa dari nasabah yang diwakilkan (jika diwakilkan)</li>
                                <li>Foto copy rekening yang diadukan</li>
                                <li>Foto copy bukti transaksi keuangan yang terkait permasalahan</li>
                                <li>Foto copy dokumen pendukung lainnya yang terkait permasalahan</li>
                            </ol>

                            <p>Pengaduan secara tertulis akan ditangani dan diselesaikan dalam 10 (sepuluh) hari kerja
setelah tanggal penerimaan pengaduan diterima oleh Bank dan dapat diperpanjang sampai
dengan paling lama 10 (sepuluh) hari kerja berikutnya apabila Bank memerlukan
perpanjangan waktu untuk penyelesaian pengaduan nasabah yang disebabkan oleh kondisi
tertentu dengan memperhatikan ketentuan hukum yang berlaku. Dalam hal ini Bank akan
memberitahukan secara tertulis kepada nasabah sebelum jangka waktu berakhir.</p>
<p>Bank akan menjaga kerahasiaan data nasabah yang melakukan pengaduan kepada Bank
terhadap pihak manapun, kecuali :</p>
                            <ol>
                                <li>Kepada pihak Otoritas Jasa Keuangan;</li>
                                <li>Dalam rangka penyelesaian pengaduan;</li>
                                <li>Diwajibkan oleh peraturan perundang-undangan dan/atau;</li>
                                <li>Atas persetujuan nasabah yang bersangkutan.</li>
                            </ol>

                            <p>Demi kelancaran proses pengaduan dan penanganan pengaduan maka nasabah perlu
memperhatikan hal-hal berikut :</p>
                            <ol>
                                <li>Tentukan inti permasalahan yang akan diadukan.</li>
                                <li>Siapkan dokumen pendukung yang terkait permasalahan yang akan diadukan.</li>
                                <li>Simpan dengan baik dokumen-dokumen asli yang dimiliki dan sampaikan kepada bank
salinan/copy dokumen tersebut saat melakukan pengaduan</li>
                                <li>Catatlah nomor register yang diberikan Bank dan nama petugas yang menerima
pengaduan.</li>
                                <li>Simpan dokumen surat-menyurat yang ada termasuk surat hasil penyelesaian
pengaduan</li>
                            </ol>
                        </div>

                        <div class="row prosedur-columns">
                            <div class="col-lg-6 prosedur-column">
                                <!-- Poin C: Alur Pengaduan Nasabah -->
                                <h4>C. Alur Pengaduan Nasabah</h4>
                                <ol class="mb-3">
                                    <li>Penyampaian Pengaduan mengenai produk dan/atau layanan kepada BPR Datagita
Mustika hanya dapat disampaikan oleh Nasabah/Perwakilan Nasabah yang bertindak
untuk untuk dan/atau atas nama Nasabah.</li>
                                    <li>Nasabah/Perwakilan Nasabah dapat menyampaikan pengaduan (lisan / tertulis)</li>
                                    <li>Prosedur Penanganan dan Penyelesaian Pengaduan adalah sebagai berikut :
</li>
<ul>
    <li>Nasabah menyampaikan pengaduan
</li>
    <li>BPR Datagita Mustika menerima pengaduan, melakukan verifikasi data nasabah
dan membuat nomor pengaduan</li>
    <li>Nasabah menerima nomor pengaduan</li>
    <li>BPR Datagita Mustika menindaklanjuti pengaduan nasabah sesuai jangka waktu
penyelesaian berdasarkan jenis pengaduan yang disampaikan.</li>
</ul>
                                    <li>BPR Datagita Mustika menyampaikan hasil penyelesaian pengaduan, jika nasabah
sepakat atas penyelesaian pengaduan maka pengaduan dianggap selesai.</li>
                                    <li>BPR Datagita Mustika menyampaikan informasi bahwa pengaduan Nasabah telah
diselesaikan</li>
                                </ol>
                                <p class="text-muted">
                                   Sesuai Surat Edaran OJK (SE OJK) No. 17/SEOJK.07/2018 tentang Pedoman Pelaksanaan
Layanan Pengaduan Konsumen di Sektor Jasa Keuangan, BPR Datagita Mustika akan
memberikan informasi mengenai jangka waktu penyelesaian pengaduan nasabah melalui
telepon, surat dan/atau surat elektronik (email). Jika nasabah sepakat atas hasil penyelesaian
maka pengaduan nasabah dianggap selesai. Namun jika nasabah tidak sepakat dengan hasil
penyelesaian yang disampaikan maka nasabah dapat melanjutkan upaya penyelesaian
pengaduan melalui fasilitasi penyelesaian baik melalui Bank Indonesia (BI) khusus untuk
pengaduan yang terkait dengan jasa Sistem Pembayaran, melalui Otoritas Jasa keuangan (OJK)
atau melalui lembaga alternatif penyelesaian sengketa lainnya
                                </p>
                                <p>Penyelesaian sengketa di luar pengadilan dapat dilakukan melalui Otoritas Jasa
Keuangan/Bank Indonesia/Lembaga Alternatif Penyelesaian Sengketa yang dimuat dalam
Daftar Lembaga Alternatif Penyelesaian Sengketa yang ditetapkan oleh Otoritas Jasa
Keuangan.</p>
                            </div>

                            <div class="col-lg-6 prosedur-column">
                                <!-- Judul Kedua: KERAHASIAAN DATA NASABAH -->
                                <h3 class="border-bottom pb-3 mb-4">KERAHASIAAN DATA NASABAH</h3>
                                <p class="mb-3">
                                   Bank akan menjaga kerahasian data nasabah yang melakukan pengaduan kepada Bank
terhadap pihak manapun, kecuali :
                                </p>

                                <!-- 8 Poin Menggunakan Bullet/Radio Button -->
                                <ul class="mb-4">
                                    <li>Kepada pihak Otoritas Jasa Keuangan;</li>
                                    <li>Dalam rangka penyelesaian pengaduan;</li>
                                    <li>Diwajibkan oleh peraturan perundang-undangan dan / atau;</li>
                                    <li>Atas persetujuan nasabah yang bersangkutan</li>
                                </ul>
                                <p>Demi kelancaran proses pengaduan dan penanganan pengaduan maka nasabah perlu
memperhatikan hal-hal berikut:</p>
                                <ul>
                                    <li>Tentukan inti permasalahan yang akan diadukan</li>
                                    <li>Siapkan dokumen pendukung yang terkait permasalahan yang akan diadukan.</li>
                                    <li>Simpan dengan baik dokumen-dokumen asli yang dimiliki dan sampaikan kepada bank
salinan / copy dokumen tersebut saat melakukan pengaduan.
</li>
                                    <li>Catatlah nomor register yang diberikan Bank dan nama petugas yang menerima
pengaduan.</li>
<li>Simpan dokumen surat – menyurat yang ada termasuk surat hasil penyelesaian
pengaduan.</li>
                                </ul>

                                <!-- Deskripsi Pendek Penutup -->
                                <p class="text-muted mb-0" style="font-size: 14px;">
                                    * Apabila nasabah tidak puas dengan hasil penyelesaian yang disampaikan Bank, Nasabah dapat
melanjutkan upaya penyelesaian melalui fasilitas penyelesaian melalui Otoritas Jasa Keuangan
(OJK), Lembaga Alternatif Penyelesaian Sengketa (LAPS) atau ke jalur hukum
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
<<<<<<< HEAD

            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <iframe class="pengaduan-pdf" src="{{ asset('frontend/bprdatagita/prosedur_pengaduan.pdf') }}"
                        title="Prosedur Pengaduan Nasabah">
                        <p>PDF tidak dapat ditampilkan. <a
                                href="{{ asset('frontend/bprdatagita/prosedur_pengaduan.pdf') }}" target="_blank"
                                rel="noopener">Buka PDF Prosedur Pengaduan</a>.</p>
                    </iframe>
                </div>
            </div>
=======
            <!-- End Konten Hard Code -->

>>>>>>> a79f53c (add tab jual aset and lelang bprsms)
            <!-- TEKS + IKON ARAH -->
            <div class="row justify-content-center mb-3" style="margin-top: 20px">
                <div class="col-md-6 text-center">
                    <div style="font-size:18px; color:#333;">
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
                        style="width: 80%; padding: 15px 7px; background-color: #ff5500; color: #ffffff; font-size: 25px; border-radius: 30px;">
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
                                    {{-- <label for="login_identifier">Email / Nomor HP</label> --}}
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control rounded-pill" id="login_password"
                                        name="password" placeholder="Password" required>
                                    {{-- <label for="login_password">Password</label> --}}
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
                                        class="text-decoration-none fw-bold" style="color: #ff5500 ">Daftar sekarang</a>
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
                                        class="text-decoration-none fw-bold" style="color: #ff5500 ">Masuk</a></p>
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
                                                value="{{ ENV('APP_NAME') }}" readonly>
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

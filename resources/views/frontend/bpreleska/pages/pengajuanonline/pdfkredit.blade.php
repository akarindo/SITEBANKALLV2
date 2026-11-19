@php
    $attachments = json_decode($data->lampiran ?? '[]', true) ?: [];
    $number = fn ($value) => number_format((float) ($value ?? 0), 0, ',', '.');
    $value = fn ($item) => filled($item) ? $item : '-';
    $checkbox = fn ($checked) => '<span class="checkbox' . ($checked ? ' checked' : '') . '"></span>';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulir Permohonan Kredit - {{ $data->no_registrasi }}</title>
    <style>
        @page { size: A4 portrait; margin: 6mm 15mm 5mm 15mm; }

        body {
            color: #111;
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            font-weight: normal;
            line-height: 1.1;
        }

        h1, h2, p { margin: 0; }

        strong { font-weight: normal; }

        .header {
            margin-bottom: 4px;
            padding-bottom: 2px;
            text-align: left;
        }

        .brand-table {
            width: auto;
        }

        .brand-table td {
            padding: 0 3px 0 0;
            vertical-align: middle;
        }

        .brand-logo {
            width: 24mm;
        }

        .brand-logo img {
            height: 22mm;
            width: 22mm;
        }

        .brand-name {
            color: #111;
            font-size: 20px;
            font-weight: bold;
            line-height: 1.05;
        }

        .header p {
            font-size: 13px;
            font-weight: bold;
            margin-top: 2px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 1px 2px;
            vertical-align: top;
        }

        .top-table td {
            padding: 1px 2px;
        }

        .top-label { width: 17%; }
        .top-value {
            border-bottom: 1px solid #111;
            width: 25%;
        }
        .option { width: 19%; }

        .section {
            margin-top: 2.5px;
        }

        .section-title {
            background: #b3202a;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 2px 3px;
            text-align: center;
            text-transform: uppercase;
        }

        .field-table td {
            padding-bottom: 1px;
            padding-top: 1px;
        }

        .entry {
            border-bottom: 1px solid #111;
        }

        .checkbox {
            border: 1px solid #111;
            display: inline-block;
            height: 9px;
            margin-right: 3px;
            vertical-align: -1px;
            width: 9px;
        }

        .checkbox.checked {
            background: #111;
        }

        .label { width: 28%; }
        .label-wide { width: 36%; }
        .value { width: 72%; }
        .two-col { width: 50%; }
        .financial-table { table-layout: fixed; }
        .financial-table td { padding: 1px 2px; }
        .financial-label { width: 28%; }
        .financial-value { width: 20%; }
        .amount-entry {
            border-bottom: 1px solid #111;
            display: inline-block;
            min-width: 22mm;
        }
        .option-cell {
            white-space: nowrap;
        }

        .check-table td {
            width: 50%;
        }

        .statement {
            padding: 2px;
            text-align: justify;
        }

        .approval {
            margin-top: 4px;
        }

        .signatures {
            margin-top: 10px;
            text-align: center;
        }

        .signature-space {
            height: 43px;
            margin: 0 20px 3px;
        }

        .footer {
            bottom: -8mm;
            color: #666;
            font-size: 7px;
            left: 0;
            position: fixed;
            right: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <table class="brand-table">
            <tr>
                <td class="brand-logo"><img src="{{ public_path('frontend/bpreleska/assets/img/logo/logo2.png') }}" alt="Logo BPR Eleska Artha"></td>
                <td class="brand-name">BPR<br>ELESKA ARTHA</td>
            </tr>
        </table>
        <p>FORMULIR PERMOHONAN KREDIT</p>
    </div>

    <table class="top-table">
        <tr>
            <td class="top-label">No. Register</td>
            <td class="top-value">{{ $value($data->no_registrasi) }}</td>
            <td class="option">{!! $checkbox($data->permohonan_kredit === 'Permohonan Baru') !!}Permohonan Baru</td>
            <td class="option">{!! $checkbox($data->permohonan_kredit === 'Top Up') !!}Top Up</td>
            <td class="option">{!! $checkbox($data->permohonan_kredit === 'Restruk') !!}Restruk</td>
        </tr>
    </table>

    <div class="section">
        <div class="section-title">Data Pemohon</div>
        <table class="field-table">
            <tr><td class="label">Nama Calon Debitur</td><td class="value entry">{{ $value($data->nm_lengkap) }}</td></tr>
            <tr><td class="label">Tempat/Tgl Lahir</td><td class="entry">{{ $value($data->tempat_tgl_lahir) }}</td></tr>
            <tr><td class="label">No. KTP</td><td class="entry">{{ $value($data->no_ktp) }}</td></tr>
            <tr>
                <td class="label">Status Pernikahan</td>
                <td class="option-cell">
                    @foreach (['Menikah', 'Lajang', 'Cerai Hidup', 'Cerai Mati'] as $option)
                        {!! $checkbox($data->status_pernikahan === $option) !!}{{ $option }}&nbsp;&nbsp;
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="label">Pendidikan Tertinggi</td>
                <td class="option-cell">
                    @foreach (['SD', 'SMP', 'SMA', 'D3', 'S1', 'Lainnya'] as $option)
                        {!! $checkbox($data->pendidikan_tertinggi === $option) !!}{{ $option }}&nbsp;&nbsp;
                    @endforeach
                </td>
            </tr>
            <tr><td class="label">Alamat Rumah Tinggal</td><td class="entry">{{ $value($data->alamat) }}</td></tr>
            <tr>
                <td class="label">Status Rumah Tinggal</td>
                <td class="option-cell">
                    @foreach (['Milik Sendiri', 'Sewa', 'Angsuran', 'Milik Orangtua'] as $option)
                        {!! $checkbox($data->status_rumah_tinggal === $option) !!}{{ $option }}&nbsp;&nbsp;
                    @endforeach
                </td>
            </tr>
            <tr><td class="label">Lama Domisili</td><td class="entry">{{ $value($data->lama_domisili_tahun) }} tahun {{ $value($data->lama_domisili_bulan) }} bulan</td></tr>
            <tr><td class="label">Nama Ibu Kandung</td><td class="entry">{{ $value($data->nama_ibu_kandung) }}</td></tr>
            <tr><td class="label">No. Tlp/HP</td><td class="entry">{{ $value($data->no_hp) }}</td></tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Data Suami/Istri/Pendamping Lainnya</div>
        <table class="field-table">
            <tr><td class="label">Nama</td><td class="entry">{{ $value($data->nama_pendamping) }}</td></tr>
            <tr><td class="label">Tempat/Tgl Lahir</td><td class="entry">{{ $value($data->tempat_tgl_lahir_pendamping) }}</td></tr>
            <tr><td class="label">No. KTP</td><td class="entry">{{ $value($data->no_ktp_pendamping) }}</td></tr>
            <tr><td class="label">Pekerjaan</td><td class="entry">{{ $value($data->pekerjaan_pendamping) }}</td></tr>
            <tr><td class="label">Penghasilan/bulan</td><td>Rp <span class="amount-entry">{{ $number($data->penghasilan_pendamping) }}</span></td></tr>
            <tr><td class="label">No. Tlp/HP</td><td class="entry">{{ $value($data->no_hp_pendamping) }}</td></tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Data Usaha/Pekerjaan Calon Debitur</div>
        <table class="field-table">
            <tr><td class="label">Nama Tempat Usaha/Bekerja</td><td class="entry">{{ $value($data->nama_tempat_usaha) }}</td></tr>
            <tr><td class="label">Bidang Usaha/Lama Usaha</td><td class="entry">{{ $value($data->bidang_usaha_lama_usaha) }}</td></tr>
            <tr><td class="label">Alamat Tempat Usaha/Bekerja</td><td class="entry">{{ $value($data->alamat_tempat_usaha) }}</td></tr>
            <tr><td class="label">No. Tlp/HP Perusahaan</td><td class="entry">{{ $value($data->no_tlp_perusahaan) }}</td></tr>
            <tr>
                <td colspan="2">
                            <table class="financial-table">
                                <tr>
                            <td class="financial-label">Penjualan/Pendapatan/bulan:</td>
                            <td class="financial-value">Rp <span class="amount-entry">{{ $number($data->penjualan_pendapatan) }}</span></td>
                            <td class="financial-label">Jumlah Tanggungan:</td>
                            <td class="financial-value entry">{{ $value($data->jumlah_tanggungan) }}</td>
                                </tr>
                                <tr>
                            <td class="financial-label">Modal/bulan:</td>
                            <td class="financial-value">Rp <span class="amount-entry">{{ $number($data->modal_per_bulan) }}</span></td>
                            <td class="financial-label">Pendapatan lainnya (bila ada):</td>
                            <td class="financial-value">Rp <span class="amount-entry">{{ $number($data->pendapatan_lainnya) }}</span></td>
                                </tr>
                                <tr>
                            <td class="financial-label">Biaya usaha/bulan:</td>
                            <td class="financial-value">Rp <span class="amount-entry">{{ $number($data->biaya_usaha_per_bulan) }}</span></td>
                            <td class="financial-label">Kesanggupan angsuran/bulan:</td>
                            <td class="financial-value">Rp <span class="amount-entry">{{ $number($data->kesanggupan_angsuran) }}</span></td>
                                </tr>
                                <tr>
                            <td class="financial-label">Laba usaha/bulan:</td>
                            <td colspan="3" class="financial-value">Rp <span class="amount-entry">{{ $number($data->laba_usaha_per_bulan) }}</span></td>
                                </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Permohonan Kredit Yang Diajukan</div>
        <table class="field-table">
            <tr><td class="label">Jumlah Pinjaman</td><td>Rp <span class="amount-entry">{{ $number($data->jml_kredit) }}</span></td></tr>
            <tr><td class="label">Jangka Waktu</td><td class="entry">{{ $value($data->jngka_wkt) }} bulan</td></tr>
            <tr><td class="label">Tujuan Penggunaan Kredit</td><td class="entry">{{ $value($data->tujuan_penggunaan_kredit ?: $data->tujuan_kredit) }}</td></tr>
            <tr><td class="label">Agunan 1</td><td class="entry">{{ $value($data->agunan_1) }}</td></tr>
            <tr><td class="label">Agunan 2</td><td class="entry">{{ $value($data->agunan_2) }}</td></tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Lampiran Aplikasi Yang Diserahkan</div>
        <table class="check-table">
            <tr>
                <td>{!! $checkbox(in_array('FC KTP, KK & Surat Nikah', $attachments)) !!}FC KTP, KK & Surat Nikah*)</td>
                <td>{!! $checkbox(in_array('FC BPKB & STNK Terbaru', $attachments)) !!}FC BPKB & STNK Terbaru**)</td>
            </tr>
            <tr>
                <td>{!! $checkbox(in_array('FC NPWP (Apabila ada)', $attachments)) !!}FC NPWP (Apabila ada)*)</td>
                <td>{!! $checkbox(in_array('FC SHM & SPPT Terbaru', $attachments)) !!}FC SHM & SPPT Terbaru**)</td>
            </tr>
            <tr>
                <td>{!! $checkbox(in_array('Asli Surat Keterangan Usaha/SIUP/NIB', $attachments)) !!}Asli Surat Keterangan Usaha/SIUP/NIB</td>
                <td>{!! $checkbox(in_array('Asli Slip Gaji/Bukti Pendapatan Lainnya', $attachments)) !!}Asli Slip Gaji/Bukti Pendapatan Lainnya</td>
            </tr>
        </table>
        <p style="padding: 5px 7px;">*) Asli diperlihatkan kepada petugas. &nbsp; **) Asli diserahkan kepada PT BPR Eleska Artha apabila disetujui.</p>
    </div>

    <div class="section">
        <div class="section-title">Pernyataan Calon Debitur</div>
        <p class="statement">
            Dengan ini saya menyatakan bahwa data yang saya berikan adalah benar dan saya tidak menyembunyikan fakta yang sesungguhnya. Saya memberi kuasa kepada PT. BPR Eleska Artha untuk memeriksa dan mencari informasi yang diperlukan terkait informasi keuangan melalui Sistem Layanan Informasi Keuangan (SLIK) sesuai dengan penjelasan dari petugas PT. BPR Eleska Artha. Keputusan atas pengajuan kredit ini sepenuhnya menjadi kewenangan PT BPR Eleska Artha untuk menyetujui atau menolak tanpa perlu mengemukakan alasannya.
        </p>
        <p class="approval">{!! $checkbox((bool) $data->menyetujui_pernyataan) !!}Saya menyetujui pernyataan di atas.</p>
    </div>

    <table class="signatures">
        <tr>
            <td>Calon Debitur<div class="signature-space"></div>(_______________________________________)</td>
            <td>Suami/Istri/Pendamping<div class="signature-space"></div>(_______________________________________)</td>
        </tr>
    </table>

    <div class="footer">No. Register: {{ $value($data->no_registrasi) }} | Diunduh pada: {{ now()->format('d M Y H:i') }}</div>
</body>
</html>

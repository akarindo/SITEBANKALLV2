@extends('frontend.bpreleska.layout.main')

@section('content')
    <style>
        .eleska-credit-form {
            max-width: 1180px;
            margin: 0 auto 50px;
            color: #25334a;
        }

        .eleska-credit-form .form-card {
            background: #fff;
            border: 1px solid #e5eaf0;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(28, 53, 82, .08);
            padding: 30px;
        }

        .eleska-credit-form .form-section {
            border: 1px solid #e5eaf0;
            border-radius: 8px;
            margin-top: 14px;
            overflow: hidden;
        }

        .eleska-credit-form .form-section summary {
            align-items: center;
            background: #f8fafc;
            color: #b3202a;
            cursor: pointer;
            display: flex;
            font-size: 16px;
            font-weight: 700;
            justify-content: space-between;
            list-style: none;
            padding: 15px 18px;
            text-transform: uppercase;
        }

        .eleska-credit-form .form-section summary::-webkit-details-marker {
            display: none;
        }

        .eleska-credit-form .form-section summary::after {
            content: '+';
            font-size: 24px;
            font-weight: 400;
            line-height: 1;
        }

        .eleska-credit-form .form-section[open] summary {
            border-bottom: 1px solid #e5eaf0;
        }

        .eleska-credit-form .form-section[open] summary::after {
            content: '\2212';
        }

        .eleska-credit-form .section-content {
            padding: 20px;
        }

        .eleska-credit-form label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .eleska-credit-form .form-control,
        .eleska-credit-form .form-select {
            border-color: #cbd5e1;
            border-radius: 6px;
            min-height: 44px;
        }

        .eleska-credit-form textarea.form-control {
            min-height: 90px;
        }

        .eleska-credit-form .option-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 18px;
            padding-top: 7px;
        }

        .eleska-credit-form .option-list label,
        .eleska-credit-form .check-list label {
            align-items: center;
            display: flex;
            font-weight: 400;
            gap: 6px;
            margin: 0;
        }

        .eleska-credit-form .option-list input,
        .eleska-credit-form .check-list input {
            accent-color: #b3202a;
        }

        .eleska-credit-form .register-line {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 12px 26px;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .eleska-credit-form .application-type {
            justify-content: flex-start;
        }

        .eleska-credit-form .application-type .option-list {
            padding-top: 0;
        }

        .eleska-credit-form .feedback-alert {
            align-items: flex-start;
            border: 0;
            border-radius: 10px;
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            padding: 15px 18px;
        }

        .eleska-credit-form .feedback-alert i {
            font-size: 20px;
            line-height: 1.2;
        }

        .eleska-credit-form .feedback-alert ul {
            margin: 5px 0 0;
            padding-left: 18px;
        }

        .eleska-credit-form .client-validation-alert {
            background: #fff3cd;
            color: #664d03;
        }

        .eleska-credit-form .is-invalid {
            border-color: #dc3545 !important;
        }

        .eleska-credit-form .register-number {
            border-bottom: 1px solid #25334a;
            display: inline-block;
            min-width: 220px;
            padding: 0 6px 4px;
        }

        .eleska-credit-form .check-list {
            display: grid;
            gap: 10px 24px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .eleska-credit-form .statement {
            background: #f8fafc;
            border-left: 4px solid #b3202a;
            line-height: 1.7;
            padding: 16px;
            text-align: justify;
        }

        @media (max-width: 768px) {
            .eleska-credit-form {
                padding: 0 10px;
            }

            .eleska-credit-form .form-card {
                padding: 18px 14px;
            }

            .eleska-credit-form .form-section summary {
                font-size: 14px;
                padding: 14px;
            }

            .eleska-credit-form .section-content {
                padding: 16px 12px;
            }

            .eleska-credit-form .check-list {
                grid-template-columns: 1fr;
            }

            .eleska-credit-form .register-line {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="container-fluid bg-breadcrumb">
        <img src="{{ asset('frontend/bpreleska/assets/img/banner/banner2.jpg') }}" alt="Breadcrumb" class="breadcrumb-img" />
    </div>

    <div class="eleska-credit-form">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="javascript:history.back()" aria-label="Kembali" style="color:#b3202a;text-decoration:none;">
                <i class="bi bi-arrow-left" style="font-size:26px;"></i>
            </a>
            <h1 class="h4 mb-0">Formulir Permohonan Kredit</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger feedback-alert" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>
                    <strong>Formulir belum dapat dikirim</strong>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success feedback-alert" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <div>
                    <strong>Pengajuan berhasil dikirim.</strong>
                    <div>{{ session('success') }}</div>
                    <small>Data Anda akan segera diproses oleh petugas BPR Eleska Artha.</small>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger feedback-alert" role="alert">
                <i class="bi bi-x-circle-fill"></i>
                <div>
                    <strong>Pengajuan belum berhasil dikirim.</strong>
                    <div>{{ session('error') }}</div>
                    <small>Silakan periksa kembali data Anda lalu coba lagi.</small>
                </div>
            </div>
        @endif

        <div id="clientValidationAlert" class="alert feedback-alert client-validation-alert d-none" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <div>
                <strong>Data belum lengkap</strong>
                <div id="clientValidationMessage">Lengkapi data yang masih kosong sebelum mengirim formulir.</div>
            </div>
        </div>

        <form id="creditApplicationForm" action="{{ url('/simpan-data-pengajuan') }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="jenis_pengajuan" value="kredit">

            <div class="form-card">
                <div class="register-line application-type">
                    <div class="option-list" aria-label="Jenis permohonan">
                        <label><input type="radio" name="permohonan_kredit" value="Permohonan Baru" @checked(old('permohonan_kredit', 'Permohonan Baru') === 'Permohonan Baru') required> Permohonan Baru</label>
                        <label><input type="radio" name="permohonan_kredit" value="Top Up" @checked(old('permohonan_kredit') === 'Top Up')> Top Up</label>
                        <label><input type="radio" name="permohonan_kredit" value="Restruk" @checked(old('permohonan_kredit') === 'Restruk')> Restruk</label>
                    </div>
                </div>

                <details class="form-section" open>
                    <summary>Data Pemohon</summary>
                    <div class="section-content">
                    <div class="row g-3">
                    <div class="col-12">
                        <label for="nm_lengkap">Nama Calon Debitur</label>
                        <input id="nm_lengkap" class="form-control" type="text" name="nm_lengkap" value="{{ old('nm_lengkap') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tempat_tgl_lahir">Tempat/Tgl Lahir</label>
                        <input id="tempat_tgl_lahir" class="form-control" type="text" name="tempat_tgl_lahir" value="{{ old('tempat_tgl_lahir') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="no_ktp">No. KTP</label>
                        <input id="no_ktp" class="form-control" type="text" name="no_ktp" value="{{ old('no_ktp') }}" maxlength="16" inputmode="numeric" pattern="[0-9]{16}" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" required>
                    </div>
                    <div class="col-md-6">
                        <label>Status Pernikahan</label>
                        <div class="option-list">
                            @foreach (['Menikah', 'Lajang', 'Cerai Hidup', 'Cerai Mati'] as $option)
                                <label><input type="radio" name="status_pernikahan" value="{{ $option }}" @checked(old('status_pernikahan') === $option) required> {{ $option }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Pendidikan Tertinggi</label>
                        <div class="option-list">
                            @foreach (['SD', 'SMP', 'SMA', 'D3', 'S1', 'Lainnya'] as $option)
                                <label><input type="radio" name="pendidikan_tertinggi" value="{{ $option }}" @checked(old('pendidikan_tertinggi') === $option) required> {{ $option }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="alamat">Alamat Rumah Tinggal</label>
                        <textarea id="alamat" class="form-control" name="alamat" required>{{ old('alamat') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Status Rumah Tinggal</label>
                        <div class="option-list">
                            @foreach (['Milik Sendiri', 'Sewa', 'Angsuran', 'Milik Orangtua'] as $option)
                                <label><input type="radio" name="status_rumah_tinggal" value="{{ $option }}" @checked(old('status_rumah_tinggal') === $option) required> {{ $option }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Lama Domisili</label>
                        <div class="row g-2">
                            <div class="col-6"><input class="form-control" type="number" min="0" name="lama_domisili_tahun" value="{{ old('lama_domisili_tahun') }}" placeholder="Tahun" required></div>
                            <div class="col-6"><input class="form-control" type="number" min="0" max="11" name="lama_domisili_bulan" value="{{ old('lama_domisili_bulan') }}" placeholder="Bulan" required></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_ibu_kandung">Nama Ibu Kandung</label>
                        <input id="nama_ibu_kandung" class="form-control" type="text" name="nama_ibu_kandung" value="{{ old('nama_ibu_kandung') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp">No. Tlp/HP</label>
                        <input id="no_hp" class="form-control" type="text" name="no_hp" value="{{ old('no_hp') }}" maxlength="15" inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,15)" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    </div>
                    </div>
                </details>

                <details class="form-section">
                    <summary>Data Suami/Istri/Pendamping Lainnya</summary>
                    <div class="section-content">
                    <div class="row g-3">
                    <div class="col-md-6"><label for="nama_pendamping">Nama</label><input id="nama_pendamping" class="form-control" type="text" name="nama_pendamping" value="{{ old('nama_pendamping') }}" required></div>
                    <div class="col-md-6"><label for="tempat_tgl_lahir_pendamping">Tempat/Tgl Lahir</label><input id="tempat_tgl_lahir_pendamping" class="form-control" type="text" name="tempat_tgl_lahir_pendamping" value="{{ old('tempat_tgl_lahir_pendamping') }}" required></div>
                    <div class="col-md-6"><label for="no_ktp_pendamping">No. KTP</label><input id="no_ktp_pendamping" class="form-control" type="text" name="no_ktp_pendamping" value="{{ old('no_ktp_pendamping') }}" maxlength="16" inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" required></div>
                    <div class="col-md-6"><label for="pekerjaan_pendamping">Pekerjaan</label><input id="pekerjaan_pendamping" class="form-control" type="text" name="pekerjaan_pendamping" value="{{ old('pekerjaan_pendamping') }}" required></div>
                    <div class="col-md-6"><label for="penghasilan_pendamping">Penghasilan/bulan</label><div class="input-group"><span class="input-group-text">Rp</span><input id="penghasilan_pendamping" class="form-control money" type="text" name="penghasilan_pendamping" value="{{ old('penghasilan_pendamping') }}" inputmode="numeric" required></div></div>
                    <div class="col-md-6"><label for="no_hp_pendamping">No. Tlp/HP</label><input id="no_hp_pendamping" class="form-control" type="text" name="no_hp_pendamping" value="{{ old('no_hp_pendamping') }}" maxlength="15" inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,15)" required></div>
                    </div>
                    </div>
                </details>

                <details class="form-section">
                    <summary>Data Usaha/Pekerjaan Calon Debitur</summary>
                    <div class="section-content">
                    <div class="row g-3">
                    <div class="col-12"><label for="nama_tempat_usaha">Nama Tempat Usaha/Bekerja</label><input id="nama_tempat_usaha" class="form-control" type="text" name="nama_tempat_usaha" value="{{ old('nama_tempat_usaha') }}" required></div>
                    <div class="col-12"><label for="bidang_usaha_lama_usaha">Bidang Usaha/Lama Usaha</label><input id="bidang_usaha_lama_usaha" class="form-control" type="text" name="bidang_usaha_lama_usaha" value="{{ old('bidang_usaha_lama_usaha') }}" required></div>
                    <div class="col-12"><label for="alamat_tempat_usaha">Alamat Tempat Usaha/Bekerja</label><textarea id="alamat_tempat_usaha" class="form-control" name="alamat_tempat_usaha" required>{{ old('alamat_tempat_usaha') }}</textarea></div>
                    <div class="col-md-6"><label for="no_tlp_perusahaan">No. Tlp/HP Perusahaan</label><input id="no_tlp_perusahaan" class="form-control" type="text" name="no_tlp_perusahaan" value="{{ old('no_tlp_perusahaan') }}" required></div>
                    <div class="col-md-6"><label for="jumlah_tanggungan">Jumlah Tanggungan</label><input id="jumlah_tanggungan" class="form-control" type="number" min="0" name="jumlah_tanggungan" value="{{ old('jumlah_tanggungan') }}" required></div>
                    <div class="col-md-6"><label for="penjualan_pendapatan">Penjualan/Pendapatan/bulan</label><div class="input-group"><span class="input-group-text">Rp</span><input id="penjualan_pendapatan" class="form-control money" type="text" name="penjualan_pendapatan" value="{{ old('penjualan_pendapatan') }}" inputmode="numeric" required></div></div>
                    <div class="col-md-6"><label for="modal_per_bulan">Modal/bulan</label><div class="input-group"><span class="input-group-text">Rp</span><input id="modal_per_bulan" class="form-control money" type="text" name="modal_per_bulan" value="{{ old('modal_per_bulan') }}" inputmode="numeric" required></div></div>
                    <div class="col-md-6"><label for="pendapatan_lainnya">Pendapatan lainnya</label><div class="input-group"><span class="input-group-text">Rp</span><input id="pendapatan_lainnya" class="form-control money" type="text" name="pendapatan_lainnya" value="{{ old('pendapatan_lainnya') }}" inputmode="numeric" required></div></div>
                    <div class="col-md-6"><label for="biaya_usaha_per_bulan">Biaya usaha/bulan</label><div class="input-group"><span class="input-group-text">Rp</span><input id="biaya_usaha_per_bulan" class="form-control money" type="text" name="biaya_usaha_per_bulan" value="{{ old('biaya_usaha_per_bulan') }}" inputmode="numeric" required></div></div>
                    <div class="col-md-6"><label for="laba_usaha_per_bulan">Laba usaha/bulan</label><div class="input-group"><span class="input-group-text">Rp</span><input id="laba_usaha_per_bulan" class="form-control money" type="text" name="laba_usaha_per_bulan" value="{{ old('laba_usaha_per_bulan') }}" inputmode="numeric" required></div></div>
                    <div class="col-md-6"><label for="kesanggupan_angsuran">Kesanggupan angsuran/bulan</label><div class="input-group"><span class="input-group-text">Rp</span><input id="kesanggupan_angsuran" class="form-control money" type="text" name="kesanggupan_angsuran" value="{{ old('kesanggupan_angsuran') }}" inputmode="numeric" required></div></div>
                    </div>
                    </div>
                </details>

                <details class="form-section">
                    <summary>Permohonan Kredit Yang Diajukan</summary>
                    <div class="section-content">
                    <div class="row g-3">
                    <div class="col-md-6"><label for="jml_kredit">Jumlah Pinjaman</label><div class="input-group"><span class="input-group-text">Rp</span><input id="jml_kredit" class="form-control money" type="text" name="jml_kredit" value="{{ old('jml_kredit') }}" inputmode="numeric" required></div></div>
                    <div class="col-md-6"><label for="jngka_wkt">Jangka Waktu</label><div class="input-group"><input id="jngka_wkt" class="form-control" type="number" name="jngka_wkt" value="{{ old('jngka_wkt') }}" min="1" required><span class="input-group-text">bulan</span></div></div>
                    <div class="col-12"><label for="tujuan_penggunaan_kredit">Tujuan Penggunaan Kredit</label><textarea id="tujuan_penggunaan_kredit" class="form-control" name="tujuan_penggunaan_kredit" required>{{ old('tujuan_penggunaan_kredit') }}</textarea></div>
                    <div class="col-md-6"><label for="agunan_1">Agunan 1</label><input id="agunan_1" class="form-control" type="text" name="agunan_1" value="{{ old('agunan_1') }}" required></div>
                    <div class="col-md-6"><label for="agunan_2">Agunan 2</label><input id="agunan_2" class="form-control" type="text" name="agunan_2" value="{{ old('agunan_2') }}" required></div>
                    </div>
                    </div>
                </details>

                <details class="form-section">
                    <summary>Lampiran Aplikasi Yang Diserahkan</summary>
                    <div class="section-content">
                    <div class="check-list">
                    @foreach ([
                        ['text' => 'FC KTP, KK & Surat Nikah', 'marker' => '*)'],
                        ['text' => 'FC BPKB & STNK Terbaru', 'marker' => '**)'],
                        ['text' => 'FC NPWP (Apabila ada)', 'marker' => '*)'],
                        ['text' => 'FC SHM & SPPT Terbaru', 'marker' => '**)'],
                        ['text' => 'Asli Surat Keterangan Usaha/SIUP/NIB', 'marker' => ''],
                        ['text' => 'Asli Slip Gaji/Bukti Pendapatan Lainnya', 'marker' => ''],
                    ] as $attachment)
                        <label><input type="checkbox" name="lampiran[]" value="{{ $attachment['text'] }}" @checked(in_array($attachment['text'], old('lampiran', [])))> {{ $attachment['text'] }}{{ $attachment['marker'] }}</label>
                    @endforeach
                    </div>
                    <p class="small text-muted mt-3 mb-0">*) Asli diperlihatkan kepada petugas. &nbsp; **) Asli diserahkan kepada PT BPR Eleska Artha apabila disetujui.</p>
                    </div>
                </details>

                <details class="form-section">
                    <summary>Pernyataan Calon Debitur</summary>
                    <div class="section-content">
                    <div class="statement">
                    Dengan ini saya menyatakan bahwa data yang saya berikan adalah benar dan saya tidak menyembunyikan fakta yang sesungguhnya. Saya memberi kuasa kepada PT. BPR Eleska Artha untuk memeriksa dan mencari informasi yang diperlukan terkait informasi keuangan melalui Sistem Layanan Informasi Keuangan (SLIK) sesuai dengan penjelasan dari petugas PT. BPR Eleska Artha. Keputusan atas pengajuan kredit ini sepenuhnya menjadi kewenangan PT BPR Eleska Artha untuk menyetujui atau menolak tanpa perlu mengemukakan alasannya.
                    </div>
                    <label class="mt-3"><input type="checkbox" name="menyetujui_pernyataan" value="1" required> Saya menyetujui pernyataan di atas.</label>

                    </div>
                </details>

                <div class="d-flex flex-column flex-md-row gap-2 justify-content-end mt-4">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn px-4" style="background:#b3202a;color:#fff;">Kirim Formulir</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const creditForm = document.getElementById('creditApplicationForm');
        const validationAlert = document.getElementById('clientValidationAlert');
        const validationMessage = document.getElementById('clientValidationMessage');

        document.querySelectorAll('.money').forEach(function (input) {
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        creditForm.addEventListener('submit', function (event) {
            const invalidFields = Array.from(this.elements).filter(function (field) {
                return field.willValidate && !field.checkValidity();
            });

            if (invalidFields.length === 0) {
                validationAlert.classList.add('d-none');
                return;
            }

            event.preventDefault();

            const firstInvalid = invalidFields[0];
            const invalidSection = firstInvalid.closest('details');

            document.querySelectorAll('.form-section').forEach(function (section) {
                section.removeAttribute('open');
            });

            if (invalidSection) {
                invalidSection.setAttribute('open', '');
            }

            this.querySelectorAll('.is-invalid').forEach(function (field) {
                field.classList.remove('is-invalid');
            });
            firstInvalid.classList.add('is-invalid');

            const fieldLabel = firstInvalid.closest('.col-12, .col-md-6')?.querySelector('label')?.textContent?.trim();
            validationMessage.textContent = fieldLabel
                ? 'Lengkapi field: ' + fieldLabel.replace('*', '').trim() + '.'
                : 'Lengkapi semua field wajib pada bagian yang terbuka.';
            validationAlert.classList.remove('d-none');
            validationAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });

            setTimeout(function () {
                firstInvalid.focus({ preventScroll: true });
            }, 250);
        });

        creditForm.addEventListener('input', function (event) {
            if (event.target.matches('.is-invalid')) {
                event.target.classList.remove('is-invalid');
            }
        });

        creditForm.addEventListener('change', function (event) {
            if (event.target.matches('.is-invalid')) {
                event.target.classList.remove('is-invalid');
            }
        });
    </script>
@endsection

@extends('frontend.nusaintim.layout.main')

@section('content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  /* ... (Semua style CSS Anda yang ada tetap di sini) ... */
  .common-hero {
    background: url('{{ asset(env(' GLOBAL_TOPPAGE')) }}') no-repeat center center;
    background-size: contain;
    background-position: center;
    color: #fff;
    padding: 40px 0;
    position: relative;
    margin-top: 70px;
    text-align: center;
  }

  @media (max-width: 768px) {
    .common-hero {
      background: url('{{ asset(env(' GLOBAL_TOPMOBILE')) }}') no-repeat center center;
      background-size: cover;
      min-height: 180px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }

    .common-hero h1,
    .common-hero h2,
    .common-hero .title {
      font-size: 20px;
      font-weight: bold;
      color: #000;
    }
  }

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
</style>

<body class="body tg-heading-subheading animation-style3">

  <!--===== HERO AREA START =====-->
  <div class="common-hero">
    <div class="container">
      <div class="row align-items-center text-center">
        <div class="col-lg-8 m-auto">
          <div class="main-heading">
            <h1 style="font-size: 35px">PENGADUAN NASABAH</h1>
            <span class="span">
              <span class="span"><img src="frontend/bprjas/assets/img/icons/span1.png" alt=""> <a href="/">Home</a>
                <span class="arrow"><i class="fa-regular fa-angle-right"></i></span> Pengaduan Online</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== HERO AREA END =====-->

  <!--===== LAYANAN PENGADUAN =====-->
  <section class="py-5 bg-light text-center">
    <div class="container">
      <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
          <p class="lead text-muted">
            Kami menyediakan sarana bagi masyarakat untuk menyampaikan pengaduan dan pelanggaran yang terjadi di
            lingkungan sekitar secara cepat dan mudah.
          </p>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
          <a href="#" class="btn btn-primary btn-lg" id="btnPengaduan">
            <i class="fas fa-edit mr-2"></i> Pengaduan Nasabah
          </a>
        </div>
      </div>


    </div>
  </section>

  <!--===== ALUR PENANGANAN PENGADUAN =====-->
  <section class="py-5">
    <div class="container">

      <h2 class="text-center mb-5 font-weight-bold" style="color:#007BFF;">
        Alur Penanganan Pengaduan <span style="font-weight:300;">Konsumen</span>
      </h2>

      <div class="row text-center align-items-start">

        <div class="col-md-3 mb-4">
          <img src="/frontend/nusaintim/assets/img/logo/alur1.png" class="alur-icon mb-3" alt="step1"
            style="height: 150px; width: 150px;">
          <h5 class="font-weight-bold">Konsumen Menyampaikan Pengaduan</h5>
          <p class="text-muted">
            Konsumen menyampaikan pengaduan melalui sarana yang tersedia dengan dilengkapi informasi identitas,
            kronologi kejadian dan dokumen pendukung lainnya.
          </p>
        </div>

        <div class="col-md-3 mb-4">
          <img src="/frontend/nusaintim/assets/img/logo/alur2.png" class="alur-icon mb-3" alt="step2"
            style="height: 150px; width: 150px;">
          <h5 class="font-weight-bold">Pencatatan Pengaduan dan Verifikasi Data</h5>
          <p class="text-muted">
            Petugas melakukan pencatatan pengaduan dan verifikasi data laporan pengaduan.
          </p>
        </div>

        <div class="col-md-3 mb-4">
          <img src="/frontend/nusaintim/assets/img/logo/alur3.png" class="alur-icon mb-3" alt="step3"
            style="height: 150px; width: 150px;">
          <h5 class="font-weight-bold">Tindak Lanjut Pengaduan</h5>
          <p class="text-muted">
            Petugas menindaklanjuti pengaduan dengan melakukan penelitian berdasarkan data/informasi pengaduan.
          </p>
        </div>

        <div class="col-md-3 mb-4">
          <img src="/frontend/nusaintim/assets/img/logo/alur4.png" class="alur-icon mb-3" alt="step4"
            style="height: 150px; width: 150px;">
          <h5 class="font-weight-bold">Penyelesaian Pengaduan</h5>
          <p class="text-muted">
            Bila konsumen menyepakati hasil penelitian maka pengaduan dianggap selesai. Bila tidak, konsumen dapat
            melakukan penyelesaian sengketa ke lembaga terkait.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!--===== MODAL AUTHENTICATION =====-->
  <div class="modal fade" id="modalAuth" tabindex="-1" role="dialog" aria-labelledby="modalAuthLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-user-lock mr-2"></i> Masuk / Daftar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 15px;"></button>
        </div>

        <div class="modal-body">
          <!-- Step Indicator -->
          <div class="step-indicator">
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
                <div class="form-group">
                  <label for="login_identifier">Email / Nomor HP</label>
                  <input type="text" class="form-control" id="login_identifier" name="email" required>
                </div>
                <div class="form-group">
                  <label for="login_password">Password</label>
                  <input type="password" class="form-control" id="login_password" name="password" required>
                </div>
                <div id="login_errors" class="text-danger mb-2" style="display:none"></div>

                <div class="text-right">
                  <button type="submit" class="btn btn-primary" id="btnLoginx">Masuk</button>
                </div>
              </form>

              <div class="text-center mt-3">
                <p>Belum punya akun? <a href="#" id="showRegister">Daftar sekarang</a></p>
              </div>
            </div>

            <!-- REGISTER -->
            <div class="tab-pane" id="registerTab" role="tabpanel">
              <form id="formRegister" method="POST" action="{{ route('register.process') }}">
                @csrf
                <div class="form-group">
                  <label for="reg_name">Nama Lengkap</label>
                  <input type="text" class="form-control" id="reg_name" name="name" required>
                </div>
                <div class="form-group">
                  <label for="reg_email">Email</label>
                  <input type="email" class="form-control" id="reg_email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="reg_phone">Nomor HP</label>
                  <input type="text" class="form-control" id="reg_phone" name="phone" required>
                </div>
                <div class="form-group">
                  <label for="reg_alamat">Alamat</label>
                  <textarea type="text" class="form-control" id="reg_alamat" name="alamat" required> </textarea>
                </div>
                <div class="form-group">
                  <label for="reg_password">Password</label>
                  <input type="password" class="form-control" id="reg_password" name="password" required>
                </div>
                <div class="form-group">
                  <label for="reg_password_confirmation">Konfirmasi Password</label>
                  <input type="password" class="form-control" id="reg_password_confirmation"
                    name="password_confirmation" required>
                </div>
                <div id="reg_errors" class="text-danger mb-2" style="display:none"></div>

                <div class="text-right">
                  <button type="submit" class="btn btn-success" id="btnRegister">Daftar</button>
                </div>
              </form>

              <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="#" id="showLogin">Masuk</a></p>
              </div>
            </div>

            <!-- OTP VERIFICATION -->
            <div class="tab-pane" id="otpTab" role="tabpanel">
              <div class="text-center mb-3">
                <p>Kami telah mengirim kode OTP ke email Anda. Silakan masukkan kode tersebut di bawah ini:</p>
                <p class="font-weight-bold" id="otpEmail"></p>
              </div>

              <form id="formOtp">
                <div class="form-group">
                  <label for="otp_code">Kode OTP</label>
                  <input type="text" class="form-control" id="otp_code" placeholder="Masukkan 6 digit kode OTP"
                    maxlength="6" required>
                </div>
                <div id="otp_errors" class="text-danger mb-2" style="display:none"></div>

                <div class="text-right">
                  <button type="button" class="btn btn-secondary mr-2" id="btnResendOtp">Kirim Ulang OTP</button>
                  <button type="submit" class="btn btn-primary" id="btnVerifyOtp">Verifikasi</button>
                </div>
              </form>

              <div class="text-center mt-3">
                <p>Tidak menerima email? Periksa folder spam atau <a href="#" id="btnResendOtpLink">kirim ulang OTP</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <small class="text-muted">Setelah masuk, Anda akan diarahkan kembali ke form pengaduan.</small>
        </div>
      </div>
    </div>
  </div>

  <!--===== MODAL FORM PENGADUAN =====-->
  <div class="modal fade" id="modalFormAduan" tabindex="-1" role="dialog" aria-labelledby="modalFormAduanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" id="formPengaduan">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-edit mr-2"></i> Form Pengaduan Nasabah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 15px;"></button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Jenis Aduan</label>
                  <select name="jenis_aduan" id="jenis_aduan" class="form-control">
                    <option value="">Pilih Jenis Aduan</option>
                    @foreach ($jenis_aduan as $v)
                    <option value="{{ $v->form }}">{{ $v->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Sub Aduan</label>
                  <select name="sub_aduan" id="sub_aduan" class="form-control">
                    <option value="">Pilih Sub Aduan</option>
                  </select>
                </div>
              </div>
            </div>

            <div id="form-placeholder" class="text-center text-muted my-4">
              <i class="fas fa-arrow-up fa-2x mb-2"></i>
              <p>Silakan pilih Jenis Aduan terlebih dahulu untuk melanjutkan pengisian form.</p>
            </div>

            <div class="col-md-12" id="jenis_opsi_container" style="display:none;">
              <div class="form-group">
                <div class="form-check form-check-inline">
                  <input class="form-check-input kategoriCheck" type="checkbox" id="opsi_perusahaan" name="kategori[]"
                    value="Perusahaan">
                  <label class="form-check-label" for="opsi_perusahaan">Perusahaan</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input kategoriCheck" type="checkbox" id="opsi_perorangan" name="kategori[]"
                    value="Perorangan">
                  <label class="form-check-label" for="opsi_perorangan">Perorangan</label>
                </div>
              </div>
            </div>

            <!-- Form Jenis Aduan dengan ID 1 -->
            <div class="form-section-dinamis" data-jenis-id="1">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Pihak Yang dilaporkan</label>
                    <input type="text" name="nama" class="form-control">
                  </div>
                </div>

                <div class="col-md-6" id="jabatan_container" style="display:none;">
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jbt_plg" class="form-control">
                      <option value="">Pilih Jabatan</option>
                      @foreach ($jabatan as $p)
                      <option value="{{ $p->id }}">{{ $p->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal & Jam Pelanggaran</label>
                    <input type="datetime-local" name="waktu_plg" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Kerugian Yang dialami</label>
                    <input type="text" name="rugi" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Uraian Pengaduan</label>
                    <textarea type="text" name="uraian" class="form-control"> </textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bukti Gambar (maks 5 file)</label>
                    <input type="file" class="form-control-file" accept="image/*" name="bukti1[]" id="bukti1_input">
                    <ul id="bukti1_list" class="file-list"></ul>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bukti Suara/Video (maks 5 file)</label>
                    <input type="file" class="form-control-file" accept="audio/*,video/*" name="bukti2[]"
                      id="bukti2_input">
                    <ul id="bukti2_list" class="file-list"></ul>
                  </div>
                </div>
              </div>
            </div>


            <!-- Form Jenis Aduan dengan ID 2 -->
            <div class="form-section-dinamis" data-jenis-id="2">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama BPR</label>
                    <input type="text" name="namaxx" class="form-control" value="{{ config('subdomain.APP_NAME') }}">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Alamat Kantor</label>
                    <input type="text" name="lokasixx" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Jenis Produk/Layanan</label>
                    <select name="jenis_pl" class="form-control">
                      <option value="">Pilih Produk/Layanan</option>
                      @foreach ($produk as $p)
                      <option value="{{ $p->id }}">{{ $p->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Kerugian Yang dialami</label>
                    <input type="text" name="rugixx" class="form-control">

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tuntutan Nasabah</label>
                    <input type="text" name="tuntutan_pl" class="form-control">

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Uraian Pengaduan</label>
                    <textarea name="uraianxx" class="form-control" rows="4"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bukti Gambar (maks 5 file)</label>
                    <input type="file" class="form-control-file" accept="image/*" name="bukti1xx[]" id="bukti1_input">
                    <ul id="bukti1_list" class="file-list"></ul>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bukti Suara/Video (maks 5 file)</label>
                    <input type="file" class="form-control-file" accept="audio/*,video/*" name="bukti2xx[]"
                      id="bukti2_input">
                    <ul id="bukti2_list" class="file-list"></ul>
                  </div>
                </div>
              </div>
            </div>



            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
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
        $('#login_errors').show().text(response.message || 'Login gagal. Periksa kredensial Anda.');
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
      const toast = $('<div class="toast-notification">OTP telah dikirim ulang ke ' + email + '</div>');
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
                const toast = $('<div class="toast-notification success">' + response.message + '</div>');
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
                    $('#sub_aduan').html(`<option value="${res.sub_tujuan}" selected>${res.sub_tujuan}</option>`);
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





@endsection
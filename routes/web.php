<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\JaringanKantorController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\LelangController;
use App\Http\Controllers\admin\MasterJenisPengaduanController;
use App\Http\Controllers\admin\OurContactController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\PengajuanOnlineController;
use App\Http\Controllers\admin\ProdukLayananController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\RekruitmenController;
use App\Http\Controllers\admin\SeoSettingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\CounterRateController;
use App\Http\Controllers\frontend\BerandaController;
use App\Http\Controllers\frontend\DashboardUserController;
use App\Http\Controllers\frontend\EmailOtpController;
use App\Http\Controllers\frontend\Fe_JaringanKantorController;
use App\Http\Controllers\frontend\Fe_RekruitmenController;
use App\Http\Controllers\frontend\InformasiController;
use App\Http\Controllers\frontend\PengaduanController;
use App\Http\Controllers\frontend\WbsController;
use App\Http\Controllers\frontend\LayananLainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterPengajuanDepositoController;
use App\Http\Controllers\MasterPengajuanKreditController;
use App\Http\Controllers\MasterPengajuanTabunganController;
use App\Http\Controllers\UMKMController;
use App\Models\MasterJenisPengaduanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;



// GET FILE
Route::get('recfil', function (Request $r) {
    if ($r->display == true) {
        $file = Storage::get($r->rf);
        $type = Storage::mimeType($r->rf);
        return response($file, 200)->header('Content-Type', $type);
    }
    return Storage::download($r->rf);
});

// ADMIN ROUTE START ................
Route::prefix('salamprofit')->middleware(['admin'])->group(function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::get('/homeadmin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/export-visitor-bulanan', [HomeController::class, 'exportVisitorMonthlyPDF'])->name('exportvisitor.monthly');
    Route::get('/export-visitor-tahunan', [HomeController::class, 'exportVisitorYearlyPDF'])->name('exportvisitor.yearly');


    // Hapus route lama dan ganti dengan ini
    // Route::get('/export/visitor/monthly/{year}/{month}', [HomeController::class, 'exportVisitorMonthlyExcel'])->name('export.visitor.monthly');
    Route::resource('banner', BannerController::class)->middleware('auth');
    Route::resource('user', UserController::class)->middleware('auth');
    Route::resource('master-produk-kredit', \App\Http\Controllers\admin\MasterPengajuanKreditController::class)->middleware('auth');
    Route::resource('master-produk-deposito', \App\Http\Controllers\admin\MasterPengajuanDepositoController::class)->middleware('auth');
    Route::resource('master-produk-tabungan', \App\Http\Controllers\admin\MasterPengajuanTabunganController::class)->middleware('auth');
    Route::resource('master-produk-pinjaman', \App\Http\Controllers\admin\MaterProdukPinjamanController::class)->middleware('auth');
    Route::resource('master-jenis-agunan', \App\Http\Controllers\admin\MasterJenisAgunanController::class)->middleware('auth');
    Route::resource('master-jenis-pengaduan', \App\Http\Controllers\admin\MasterJenisPengaduanController::class)->middleware('auth');
    Route::resource('master-jabatan', \App\Http\Controllers\admin\MasterJabatanController::class)->middleware('auth');
    Route::resource('pages', PagesController::class)->middleware('auth');
    Route::resource('produklayanan', ProdukLayananController::class)->middleware('auth');
    Route::resource('wbs', WbsController::class);
    Route::get('/wbs/{id}/download', [WbsController::class, 'download'])->name('wbs.download');
    Route::resource('gallery', GalleryController::class);
    Route::resource('jaringan-kantor', JaringanKantorController::class);
    Route::resource('lelang', LelangController::class)->middleware('auth');
    Route::resource('profile', ProfileController::class);
    Route::resource('rekruitmen', RekruitmenController::class)->middleware('auth');
    Route::get('rekruitmen-data', [RekruitmenController::class, 'lamaran']);
    Route::resource('laporan', LaporanController::class);
    Route::resource('website', OurContactController::class);
    Route::resource('seo-setting', SeoSettingController::class);
    Route::get('data-pengajuan-kredit', [PengajuanOnlineController::class, 'showkredit']);
    Route::get('data-pengajuan-deposito', [PengajuanOnlineController::class, 'showdeposito']);
    Route::get('data-pengajuan-tabungan', [PengajuanOnlineController::class, 'showtabungan']);
    Route::get('data-jenis-pengaduan', [MasterJenisPengaduanController::class, 'showformpengaduan']);

    Route::get('/pengaduan/detail/{id}', [MasterJenisPengaduanController::class, 'detail']);

    Route::post('/pengaduan/simpan-data/{id}', [MasterJenisPengaduanController::class, 'simpandatastep1']);
    Route::post('/pengaduan/perpanjangan-step1/{id}', [MasterJenisPengaduanController::class, 'perpanjanganStep1']);
    Route::post('/pengaduan/perpanjangan-step2/{id}', [MasterJenisPengaduanController::class, 'perpanjanganStep2']);

    Route::post('/pengaduan/simpan-data-validasi/{id}', [MasterJenisPengaduanController::class, 'simpandatastep2']);

    Route::post('/pengaduan/simpan-data-penyelesaian/{id}', [MasterJenisPengaduanController::class, 'simpandatastep4']);
    Route::post('/pengaduan/simpan-proses/{id}', [MasterJenisPengaduanController::class, 'simpanProsesPenanganan']);

    Route::post('pengaduan/simpan-proses-penanganan/{id}', [MasterJenisPengaduanController::class, 'simpanProsesPenanganan']);
    Route::post('pengaduan/perpanjangan-waktu-proses/{id}', [MasterJenisPengaduanController::class, 'perpanjanganWaktuProses']);

    Route::post('pengaduan/SimpanSelesaiPenanganan/{id}', [MasterJenisPengaduanController::class, 'SimpanSelesaiPenanganan']);
    Route::post('pengaduan/set-gugur/{id}', [MasterJenisPengaduanController::class, 'SetingGugur']);


    Route::resource('data-umkm', UMKMController::class);
    Route::resource('rate', UMKMController::class);

    Route::resource('counter-rate', CounterRateController::class);
});
// ADMIN ROUTE END




// FRONTEND USER  ................

// informasi
Route::resource('/', BerandaController::class);
Route::get('detevent/{id}', [InformasiController::class, 'detevent'])->name('detevent');
Route::get('detberita/{id}', [InformasiController::class, 'detberita'])->name('detberita');
Route::get('detliterasi/{id}', [InformasiController::class, 'detliterasi'])->name('detliterasi');
Route::get('informasi', [InformasiController::class, 'informasi']);
Route::resource('umkm', \App\Http\Controllers\frontend\UmkmController::class);
Route::get('detumkm/{id}', [\App\Http\Controllers\frontend\UmkmController::class, 'detumkm'])->name('detumkm');

// Produk
Route::get('kredit', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'kredit']);
Route::get('detkredit/{id}', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'detkredit'])->name('detkredit');
Route::get('deposito', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'deposito']);
Route::get('detdeposito/{id}', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'detdeposito'])->name('detdeposito');
Route::get('tabungan', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'tabungan']);
Route::get('dettabungan/{id}', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'dettabungan'])->name('dettabungan');
Route::get('/simulasi-kredit', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'simulasiKredit']);
Route::get('/simulasi-tabungan', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'simulasiTabungan']);
Route::get('/simulasi-deposito', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'simulasiDeposito']);
if (env('DATA_PAGE') == 'BPREMAS') {
    Route::get('/pengajuanonline', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'index']);
    Route::get('/simulasi', [\App\Http\Controllers\frontend\ProdukLayananController::class, 'simulasi']);
} else {
    Route::get('/pengajuanonline', function () {
    return view(config('subdomain.GLOBAL_PENGAJUANONLINE'));
});
};
Route::get('/programmagang', function () {
    return view(config('subdomain.GLOBAL_MAGANG'));
});

Route::get('/tatakelolapage', function () {
    return view(config('subdomain.GLOBAL_TATAKELOLAPAGE'));
});

Route::get('/newformtabungan', function () {
    return view('frontend.bprmekar.pages.pengajuanonline.newformtabungan');
});
Route::get('/formpengajuankredit', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'formpengajuankredit']);
Route::get('/formpengajuandeposito', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'formpengajuandeposito']);
Route::get('/formpengajuantabungan', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'formpengajuantabungan']);
Route::post('/simpan-data-pengajuan', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'savedata']);
Route::get('/formkredit/{id}/download', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'downloadformkredit'])->name('formkredit.download');
Route::get('/formdeposito/{id}/download', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'downloadformdeposito'])->name('formdeposito.download');
Route::get('/formktabungan/{id}/download', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'downloadformtabungan'])->name('formtabungan.download');

Route::get('/newformpengajuantabungan', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'newformpengajuantabungan']);
Route::post('/pembukaan-rekening/simpan', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'savetabungan'])->name('pembukaanrekening.simpan');
// Route::get('/pembukaan-rekening/download/{id}', [\App\Http\Controllers\frontend\PengajuanOnlineController::class, 'downloadformpembukaanrekening'])->name('download.pembukaanrekening');

Route::get('/layananlain', function () {
    return view(config('subdomain.GLOBAL_LAYANANLAIN'));
});

// PENGHARGAAN
Route::get('/penghargaan', function () {
    return view('frontend.bprjas.pages.profil.penghargaan');
});
Route::get('eventkegiatan', [InformasiController::class, 'eventkegiatan']);

Route::get('/infolps', function () {
    return view('frontend.bprjas.pages.profil.infolps');
});
Route::get('/tinjauankeuangan', function () {
    return view('frontend.bprjas.pages.profil.tinjauankeuangan');
});

// PROFIL & TAUTAN
Route::get('sejarah', [\App\Http\Controllers\frontend\ProfileController::class, 'sejarah']);
Route::get('pengurus', [\App\Http\Controllers\frontend\ProfileController::class, 'pengurus']);
Route::get('organisasi', [\App\Http\Controllers\frontend\ProfileController::class, 'organisasi']);
Route::get('visimisi', [\App\Http\Controllers\frontend\ProfileController::class, 'visimisi']);
Route::get('profile', [\App\Http\Controllers\frontend\ProfileController::class, 'profile']);
Route::get('corevalue', [\App\Http\Controllers\frontend\ProfileController::class, 'corevalue']);
Route::resource('jaringankantor', Fe_JaringanKantorController::class);
Route::resource('galery', \App\Http\Controllers\frontend\GalleryController::class);
Route::get('detgallery/{id}', [\App\Http\Controllers\frontend\GalleryController::class, 'detgallery'])->name('detgallery');
Route::resource('lelang-jualaset', \App\Http\Controllers\frontend\LelangController::class);
Route::get('detlelang/{id}', [\App\Http\Controllers\frontend\LelangController::class, 'detlelang'])->name('detlelang');
// Route::get('/detlelang', [\App\Http\Controllers\frontend\LelangController::class, 'detlelang']);

Route::resource('rekrutmen', Fe_RekruitmenController::class);
Route::get('detrekrutmen/{id}', [Fe_RekruitmenController::class, 'detrekrutmen'])->name('detrekrutmen');
Route::get('/faq', function () {
    return view(config('subdomain.GLOBAL_FAQ'));
});
Route::get('contact', [InformasiController::class, 'contact']);
Route::post('/kirim-pesan', [InformasiController::class, 'kirim'])->name('kirim.pesan');


// PENGADUAN/WBS FRONTEND
Route::resource('/pengaduan', controller: PengaduanController::class);
Route::post('/register/process', [RegisterController::class, 'register'])->name('register.process');
Route::prefix('api')->middleware('api')->group(function () {
    Route::post('/send-otp', [PengaduanController::class, 'sendOtp']);
    Route::post('/verify-otp', [PengaduanController::class, 'verifyOtp']);
    Route::get('/check-auth', [PengaduanController::class, 'checkAuth']);
});
Route::get('/pengaduan/get-sub/{form_identifier}', function ($form_identifier) {
    // Cari data berdasarkan kolom 'form'
    $jenisPengaduan = App\Models\MasterJenisPengaduanModel::where('form', $form_identifier)->first();

    // Jika tidak ditemukan, kembalikan response kosong
    if (!$jenisPengaduan) {
        return response()->json(null);
    }

    return $jenisPengaduan;
});
Route::get('cek-saldo', [PengaduanController::class, 'ceksaldo']);

Route::middleware('auth')->group(function () {
    Route::get('lacak-pengaduan', [PengaduanController::class, 'lacakpengaduan']);

    Route::get('pengaduan/detail-lacak-pengaduan/{id}', [PengaduanController::class, 'getDetail'])->name('pengaduan.detail-lacak-pengaduan');
});


// DASHBOARD USER
Route::resource('/dashboarduser', DashboardUserController::class);

// LAPORAN
Route::get('publikasi', [\App\Http\Controllers\frontend\LaporanController::class, 'publikasi'])->name('publikasi');
Route::get('tahunan', [\App\Http\Controllers\frontend\LaporanController::class, 'tahunan'])->name('tahunan');
Route::get('tatakelola', [\App\Http\Controllers\frontend\LaporanController::class, 'tatakelola'])->name('tatakelola');
Route::get('keberlanjutan', [\App\Http\Controllers\frontend\LaporanController::class, 'keberlanjutan'])->name('keberlanjutan');
Route::get('akb', [\App\Http\Controllers\frontend\LaporanController::class, 'akb'])->name('akb');
Route::get('piagamaudit', [\App\Http\Controllers\frontend\LaporanController::class, 'piagamaudit'])->name('piagamaudit');
Route::get('laporan-lainnya', [\App\Http\Controllers\frontend\LaporanController::class, 'lainnya'])->name('lainnya');
Route::get('laporanall', [\App\Http\Controllers\frontend\LaporanController::class, 'laporanall'])->name('laporanall');

Route::post('/getlaporan-pisah', [\App\Http\Controllers\frontend\LaporanController::class, 'getlaporanfront']);
Route::get('/terms', function () {
    return view(env('GLOBAL_TERMS'));
});
Route::get('/privasipolicy', function () {
    return view(env('GLOBAL_PRIVASIPOLICY'));
});
Route::get('/prime-landing-rate', function () {
    return view(env('GLOBAL_PRIMELANDINGRATE'));
});
Route::get('/haha', function () {
    return config('subdomain.name');
    return 'HAHAHAHAHAHAHAHA';
});
// ENDFRONTEND

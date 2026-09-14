<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\JabatanModel;
use App\Models\MasterJenisPengaduanModel;
use App\Models\OtpCode;
use App\Models\PengaduanModel;
use App\Models\ProdukLayananModel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PengaduanController extends Controller
{

    public function index()
    {

        $data['jenis_aduan'] = MasterJenisPengaduanModel::get();
        $data['produk'] = ProdukLayananModel::get();
        $data['jabatan'] = JabatanModel::get();

        return view(config('subdomain.GLOBAL_PENGADUAN'), $data);
    }

    public function getSub($form)
    {
        $data = MasterJenisPengaduanModel::where('form', $form)->get();
        return response()->json($data);
    }

    public function checkAuth(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 1) {
                return response()->json([
                    'authenticated' => true,
                    'user' => Auth::user()
                ]);
            }
        }

        return response()->json([
            'authenticated' => false
        ]);
    }

    /**
     * Send OTP to user email
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate new OTP
        $otpCode = rand(100000, 999999);

        // Save OTP to database
        OtpCode::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'otp_code' => $otpCode,
            'expires_at' => now()->addMinutes(15),
        ]);

        // Send OTP email
        try {
            Mail::to($user->email)->send(new OtpMail($otpCode));

            return response()->json([
                'success' => true,
                'message' => 'OTP has been sent to your email',
                'debug' => 'Email sent to: ' . $user->email . ' with OTP: ' . $otpCode
            ]);
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Email sending failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage(),
                'debug' => 'Failed to send email to: ' . $user->email . ' with OTP: ' . $otpCode
            ]);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp_code' => 'required|numeric|digits:6'
        ]);

        $user = User::where('email', $request->email)->first();

        // Find valid OTP
        $otp = OtpCode::where('user_id', $user->id)
            ->where('otp_code', $request->otp_code)
            ->where('expires_at', '>', now())
            ->whereNull('used_at')
            ->first();

        if (!$otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP code',
                'debug' => 'No valid OTP found for: ' . $request->email . ' with code: ' . $request->otp_code
            ]);
        }

        // Mark OTP as used
        $otp->used_at = now();
        $otp->save();

        // Verify user email
        $user->email_verified_at = now();
        $user->save();

        // Log user in
        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully',
            'debug' => 'User ' . $user->email . ' verified successfully'
        ]);
    }

    /**
     * Store pengaduan
     */
    public function store(Request $request)
    {

        $request->validate([
            'jenis_aduan' => 'required|in:1,2',
            'sub_aduan' => 'required'
        ]);

        $nama = $lokasi = $uraian = $rugi = null;
        $kategori = $jbt_plg = $waktu_plg = null;
        $jenis_pl = $tuntutan_pl = null;

        $bukti1_input = null;
        $bukti2_input = null;


        if ($request->jenis_aduan == 1) {

            $request->validate([
                'nama' => 'required|string|max:255',
                'lokasi' => 'required|string',
                'uraian' => 'required|string',
                'rugi' => 'nullable|string',
                'kategori' => 'nullable|array',
                'jbt_plg' => 'nullable',
                'waktu_plg' => 'nullable',
                'bukti1.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'bukti2.*' => 'nullable|file|mimes:mp3,wav,mp4,mov|max:50240'
            ]);

            $nama = $request->nama;
            $lokasi = $request->lokasi;
            $uraian = $request->uraian;
            $rugi = $request->rugi;
            $kategori = $request->kategori;
            $jbt_plg = $request->jbt_plg;
            $waktu_plg = $request->waktu_plg;

            $bukti1_input = 'bukti1';
            $bukti2_input = 'bukti2';
        }


        if ($request->jenis_aduan == 2) {

            $request->validate([
                'namaxx' => 'required|string|max:255',
                'jenis_pl' => 'required|string',
                'tuntutan_pl' => 'required|string',
                'lokasixx' => 'required|string',
                'uraianxx' => 'required|string',
                'rugixx' => 'nullable|string',
                'bukti1xx.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'bukti2xx.*' => 'nullable|file|mimes:mp3,wav,mp4,mov|max:50240'
            ]);

            $nama = $request->namaxx;
            $jenis_pl = $request->jenis_pl;
            $tuntutan_pl = $request->tuntutan_pl;
            $lokasi = $request->lokasixx;
            $uraian = $request->uraianxx;
            $rugi = $request->rugixx;

            $bukti1_input = 'bukti1xx';
            $bukti2_input = 'bukti2xx';
        }


        $data = new PengaduanModel();
        $data->user_id = auth()->id();
        $data->jenis_aduan = $request->jenis_aduan;
        $data->sub_aduan = $request->sub_aduan;

        $data->no_registrasi = PengaduanModel::generateNoRegistrasi();


        $data->nama = $nama;
        $data->lokasi = $lokasi;
        $data->uraian = $uraian;
        $data->rugi = $rugi;

        $data->kategori = $kategori ? json_encode($kategori) : null;
        $data->jbt_plg = $jbt_plg;
        $data->waktu_plg = $waktu_plg;

        $data->jenis_pl = $jenis_pl;
        $data->tuntutan_pl = $tuntutan_pl;

        // Upload bukti gambar
        $bukti1 = [];
        if ($bukti1_input && $request->hasFile($bukti1_input)) {
            foreach ($request->file($bukti1_input) as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('pengaduan/bukti1', $name, 'public');
                $bukti1[] = $name;
            }
        }
        $data->bukti1 = json_encode($bukti1);

        // Upload bukti video/audio
        $bukti2 = [];
        if ($bukti2_input && $request->hasFile($bukti2_input)) {
            foreach ($request->file($bukti2_input) as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('pengaduan/bukti2', $name, 'public');
                $bukti2[] = $name;
            }
        }
        $data->bukti2 = json_encode($bukti2);



        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Laporan Anda sudah dikirimkan, mohon menunggu informasi selanjutnya.',
            'no_registrasi' => $data->no_registrasi
        ]);
    }




    /**
     * HANDLE MULTIPLE UPLOAD
     */
    private function handleMultipleFiles(Request $request, $fieldName)
    {
        $paths = [];
        if ($request->hasFile($fieldName)) {
            $files = $request->file($fieldName);
            foreach ($files as $file) {
                // Generate nama file unik untuk menghindari konflik
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Simpan file ke storage/app/public/pengaduan/bukti
                $path = $file->storeAs('pengaduan/bukti', $filename, 'public');
                $paths[] = $path;
            }
        }
        // Kembalikan sebagai JSON array
        return json_encode($paths);
    }

    public function ceksaldo()
    {



        return view('frontend.bprjas.pages.pengaduan.dashboarduser.ceksaldo');
    }
    public function lacakpengaduan()
    {
        $userId = Auth::id();

        // Data list dan terakhir (sudah benar)
        $data['pengaduan'] = PengaduanModel::where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->get();


        $data['lastPengaduan'] = PengaduanModel::where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->firstOrNew();

        // 🔥 TAMBAHAN untuk dashboard
        $data['pengaduan_count'] = PengaduanModel::where('user_id', $userId)->count();

        $data['pengaduan_proses'] = PengaduanModel::where('user_id', $userId)
            ->where('status', 1)
            ->count();

        $data['pengaduan_tolak'] = PengaduanModel::where('user_id', $userId)
            ->where('status', 3)
            ->count();
        $data['jabatan'] = JabatanModel::orderBy('nama')->get();
        $data['produk'] = ProdukLayananModel::get();

        return view('frontend.bprjas.pages.pengaduan.dashboarduser.lacakpengaduan', $data);
    }


    public function getDetail($id)
    {
        $data = PengaduanModel::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan atau bukan milik Anda.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ]);
    }
}

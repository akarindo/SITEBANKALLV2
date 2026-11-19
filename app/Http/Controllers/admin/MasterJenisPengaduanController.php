<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisPengaduanModel;
use App\Models\PengaduanModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MasterJenisPengaduanController extends Controller
{
    public function index(Request $r)
    {
        $str = Carbon::now()->startOfMonth()->format('Y-m-d');
        if ($r->str) {
            $str = Carbon::parse($r->str)->format('Y-m-d');
        }
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');
        if ($r->end) {
            $end = Carbon::parse($r->end)->format('Y-m-d');
        }
        $data['date_start'] = $str;
        $data['date_end'] = $end;

        $data['data'] = MasterJenisPengaduanModel::get();

        // return $r;

        return view('admin.pengaduan.jenispengaduan', $data);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $valid = Validator::make($request->all(), [
            'nama' => 'required',
            'form' => 'required',
            'sub_tujuan' => 'required',

        ]);
        if ($valid->fails()) {
            return Redirect::back()->withErrors($valid)->withInput($request->all())->with('error', 'Terjadi kesalahan validasi data');
        }
        $input = [
            'nama' => $request->nama,
            'form' => $request->form,
            'sub_tujuan' => $request->sub_tujuan,

        ];

        $i = MasterJenisPengaduanModel::updateOrCreate(['id' => $request->txtId], $input);
        if ($i) {
            return Redirect::back()->with('success', 'Data Berhasil Disimpan');
        }

        return Redirect::back()->withInput($request->all())->with('error', 'Data Gagal Disimpan');
    }

    public function destroy($id)
    {
        $d = MasterJenisPengaduanModel::find($id);
        if ($d) {
            $d->delete();

            return Redirect::back()->with('success', 'Data Berhasil Dihapus');
        }

        return Redirect::back()->with('error', 'Data Gagal Dihapus');
    }

    public function showformpengaduan(Request $r)
    {
        $str = Carbon::now()->startOfYear()->format('Y-m-d');
        if ($r->str) {
            $str = Carbon::parse($r->str)->format('Y-m-d');
        }
        $end = Carbon::now()->endOfYear()->format('Y-m-d');
        if ($r->end) {
            $end = Carbon::parse($r->end)->format('Y-m-d');
        }
        $data['date_start'] = $str;
        $data['date_end'] = $end;

        $pengaduanList = PengaduanModel::with('jenis')

            ->orderBy('created_at', 'DESC')
            ->get();
        $data['pengaduan'] = $pengaduanList;

        $data['p_jangkawaktudata'] = PengaduanModel::whereNotNull('p_data1')->orWhereNotNull('p_data2')->exists();

        // return $data;
        return view('admin.pengaduan.index', $data);
    }

    public function detail($id)
    {
        $p = PengaduanModel::with('jenis')->find($id);
        $p = PengaduanModel::with(['jenis', 'produkLayanan'])->find($id);

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $pelapor = User::find($p->user_id);

        return response()->json([
            // IDENTITAS PELAPOR
            'nama' => $p->nama_pelapor ?? $pelapor->name ?? '-',
            'hp' => $p->no_hp_pelapor ?? $pelapor->phone ?? '-',
            'email' => $p->email_pelapor ?? $pelapor->email ?? '-',
            'alamat' => $pelapor->alamat ?? '-',
            'regis' => $p->created_at ? $p->created_at->format('d-m-Y H:i') : '-',

            'jenis_aduan' => $p->jenis->nama ?? '-',
            'sub_aduan' => $p->sub_aduan,
            'kategori' => $p->kategori,
            'terlapor' => $p->nama,
            'jabatan' => $p->jbt_plg,
            'lokasi' => $p->lokasi,
            'rugi' => $p->rugi,
            'produk' => $p->produkLayanan->title ?? '-',
            'waktu' => $p->waktu_plg,
            'tuntutan' => $p->tuntutan_pl,
            'uraian' => $p->uraian,

            'bukti1' => $this->decodeBukti($p->bukti1),
            'bukti2' => $this->decodeBukti($p->bukti2),

            'step_data' => $p->step_data ?? '0',
            'p_data1' => $p->p_data1,
            'p_data2' => $p->p_data2,

            'v_jenis_konfir' => $p->v_jenis_konfir,
            'v_waktu_konfir' => $p->v_waktu_konfir,
            'v_uraian_konfir' => $p->v_uraian_konfir,
            'v_bukti_konfir' => $p->v_bukti_konfir,
            'v_mulaipenanganan' => $p->v_mulaipenanganan,
            'v_selesaipenanganan' => $p->v_selesaipenanganan,

            'p_proses_penanganan' => $p->p_proses_penanganan_decode ?? [],
            'p_perpanjanganpenanganan' => $p->p_perpanjanganpenanganan,
            'p_berakhirpenanganan' => $p->p_berakhirpenanganan,

            's_w_selesai' => $p->s_w_selesai,
            's_ket_selesai' => $p->s_ket_selesai,

        ]);
    }

    private function decodeBukti($data)
    {
        if (empty($data)) {
            return [];
        }

        // Kalau sudah array
        if (is_array($data)) {
            return $data;
        }

        // Decode pertama
        $decoded = json_decode($data, true);

        // Kalau masih string, decode lagi
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        return is_array($decoded) ? $decoded : [];
    }

    public function simpandatastep1($id)
    {
        // 1. Ambil data pengaduan berdasarkan ID
        $p = PengaduanModel::where('id', $id)->first();

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data pengaduan tidak ditemukan'], 404);
        }

        $p->update([
            'status' => 0,
            'step_data' => '2',

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Identitas berhasil disimpan. Lanjut ke langkah Validasi.',
        ]);
    }

    // Di PengaduanController.php
    public function perpanjanganStep1($id)
    {
        $p = PengaduanModel::find($id);

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        // Asumsi: menghitung 10 hari kerja (business days)
        $dueDate = Carbon::now()->addDays(10); // Ganti dengan logika 10 hari kerja yang akurat jika perlu

        $p->update([
            'p_data1' => $dueDate,
            // Anda mungkin ingin menambahkan kolom status lain di sini
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perpanjangan Data 1 berhasil disimpan. Tenggat waktu: '.$dueDate->format('d M Y'),
        ]);
    }

    // Di PengaduanController.php
    public function perpanjanganStep2($id)
    {
        DB::beginTransaction(); // 1. Mulai transaksi untuk mengamankan proses

        try {
            // 2. Kunci baris data (Database Locking)
            // Ini MENCEGAH dua request masuk pada waktu yang sama dan menyebabkan double save.
            $p = PengaduanModel::where('id', $id)->lockForUpdate()->first();

            if (! $p) {
                DB::rollBack();

                return response()->json(['success' => false, 'message' => 'Data pengaduan tidak ditemukan.'], 404);
            }

            // 3. Validasi: Pastikan Perpanjangan 1 sudah dilakukan
            if (empty($p->p_data1)) {
                DB::rollBack();

                return response()->json(['success' => false, 'message' => 'Perpanjangan Data 1 harus diselesaikan terlebih dahulu.'], 400);
            }

            // 4. Validasi: Cegah Perpanjangan 2 diisi lebih dari sekali
            if (! empty($p->p_data2)) {
                DB::rollBack();

                return response()->json(['success' => false, 'message' => 'Perpanjangan Data 2 sudah pernah dilakukan.'], 400);
            }

            // 5. Logika Perhitungan Tanggal (Telah Dikonfirmasi Benar)
            $oldDueDate = Carbon::parse($p->p_data1);
            $newDueDate = $oldDueDate->addDays(10);

            // 6. Update data
            $p->p_data2 = $newDueDate;
            $p->save();

            DB::commit(); // 7. Commit dan lepaskan kunci

            return response()->json([
                'success' => true,
                'message' => 'Perpanjangan Data 2 berhasil disimpan. Tenggat waktu berakhir pada: '.$newDueDate->format('d M Y'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error

            // Anda bisa log $e->getMessage() di sini untuk debugging
            return response()->json(['success' => false, 'message' => 'Gagal memproses perpanjangan due to server error.'], 500);
        }
    }

    public function simpandatastep2(Request $request, $id)
    {
        $p = PengaduanModel::find($id);

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $filename = $p->v_bukti_konfir;

        if ($request->hasFile('v_bukti_konfir')) {
            $file = $request->file('v_bukti_konfir');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/konfirmasi'), $filename);
        }

        // Tentukan tanggal mulai penanganan (hari ini)
        $tanggalMulai = Carbon::now();

        // Tentukan tenggat 10 hari kerja dari mulai penanganan
        $tanggalAkhir = $tanggalMulai->copy()->addDays(10);
        $waktuKonfirmasi = null;
        if ($request->filled('v_waktu_konfir')) {
            $waktuKonfirmasi = Carbon::parse($request->v_waktu_konfir);
        }

        $p->update([
            'v_jenis_konfir' => $request->v_jenis_konfir,
            'v_waktu_konfir' => $waktuKonfirmasi,
            'v_uraian_konfir' => $request->v_uraian_konfir,
            'v_bukti_konfir' => $filename,
            'status' => 1,
            'step_data' => 3,
            'v_mulaipenanganan' => $tanggalMulai,
            'v_selesaipenanganan' => $tanggalAkhir, // optional, simpan tenggat 10 hari
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data validasi berhasil disimpan!',
        ]);
    }

    public function simpanProsesPenanganan(Request $request, $id)
    {
        $p = PengaduanModel::find($id);

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        $prosesBaru = $request->proses;

        if (! $prosesBaru || ! is_array($prosesBaru)) {
            return response()->json(['success' => false, 'message' => 'Format proses tidak valid']);
        }

        foreach ($prosesBaru as $item) {
            if (empty($item['waktu']) || empty($item['deskripsi'])) {
                return response()->json(['success' => false, 'message' => 'Semua field wajib diisi']);
            }
        }

        // Ambil data lama dari DB, decode JSON-nya, jika kosong jadikan array kosong
        $prosesLama = json_decode($p->p_proses_penanganan, true);
        if (! is_array($prosesLama)) {
            $prosesLama = [];
        }

        // Gabungkan data lama dan baru
        $gabunganProses = array_merge($prosesLama, $prosesBaru);

        // Simpan gabungan ke DB
        $p->p_proses_penanganan = json_encode($gabunganProses);
        $p->save();

        return response()->json([
            'success' => true,
            'message' => 'Proses penanganan berhasil disimpan!',
        ]);
    }

    public function perpanjanganWaktuProses($id)
    {
        $p = PengaduanModel::find($id);

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $now = Carbon::now();

        // Ambil tanggal akhir saat ini (bisa dari p_perpanjanganpenanganan atau v_akhirpenanganan)
        $currentEnd = $p->p_perpanjanganpenanganan ?? $p->v_akhirpenanganan ?? $now;

        // Jika tenggat lama masih di masa depan, hitung dari tanggal akhir lama
        if (Carbon::parse($currentEnd)->greaterThan($now)) {
            $baseDate = Carbon::parse($currentEnd);
        } else {
            // Jika sudah lewat, hitung dari hari ini
            $baseDate = $now;
        }

        // Tambahkan 10 hari kerja (kalau mau skip weekend, bisa pakai loop)
        $newDueDate = $baseDate->copy()->addDays(10);

        $p->update([
            'p_perpanjanganpenanganan' => $newDueDate,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perpanjangan waktu berhasil. Tenggat baru: '.$newDueDate->format('d M Y'),
        ]);
    }

    public function SimpanSelesaiPenanganan($id)
    {
        // 1. Ambil data pengaduan berdasarkan ID
        $p = PengaduanModel::where('id', $id)->first();

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data pengaduan tidak ditemukan'], 404);
        }

        $p->update([
            'status' => 1,
            'step_data' => '4',
            'p_berakhirpenanganan' => now(),

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Proses Penanganan berhasil disimpan. Lanjut ke langkah Penyelesaian.',
        ]);
    }

    public function simpandatastep4(Request $request, $id)
    {
        $p = PengaduanModel::find($id);

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        // Validasi input (optional tapi direkomendasikan)
        $request->validate([
            's_w_selesai' => 'required|date',
            's_ket_selesai' => 'required|string|max:1000',
        ]);

        $p->update([
            's_w_selesai' => $request->s_w_selesai,       // waktu selesai dari input
            's_ket_selesai' => $request->s_ket_selesai,   // keterangan selesai
            'status' => 2,                                 // update status menjadi selesai
            'step_data' => 5,                               // step data 4
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data penyelesaian berhasil disimpan!',
        ]);
    }

    public function SetingGugur($id)
    {
        $p = PengaduanModel::find($id);

        if (! $p) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        $p->update([
            'status' => 3,     // status GUGUR
            'step_data' => 999,   // kunci semua step
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan telah digugurkan.',
        ]);
    }
}

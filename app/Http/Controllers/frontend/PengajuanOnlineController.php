<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\MastePengajuanKreditModel;
use App\Models\MasterPengajuanTabunganModel;
use App\Models\PengajuanModel;
use App\Models\ProdukLayananModel;
use App\Models\PembukaanRekeningModel;
use Illuminate\Http\Request;
use PDF;

class PengajuanOnlineController extends Controller
{
    public function index()
    {
        return view('frontend.bpremas.pages.pengajuanonline.index', [
            'produkkredit' => ProdukLayananModel::where('kategori', 0)->get(),
            'produktabungan' => ProdukLayananModel::where('kategori', 2)->get(),
        ]);
    }

    public function formpengajuankredit()
    {
        $data['produkkredit'] = ProdukLayananModel::where('kategori', 0)
            ->get();
        return view(config('subdomain.FORMPENGAJUANKREDIT'), $data);
    }

    public function formpengajuandeposito()
    {

        return view(config('subdomain.FORMPENGAJUANDEPOSITO'));
    }

    public function formpengajuantabungan()
    {
        $data['produktabungan'] = ProdukLayananModel::where('kategori', 2)
            ->get();
        return view(config('subdomain.FORMPENGAJUANTABUNGAN'), $data);
    }

    public function newformpengajuantabungan()
    {
        return view(config('subdomain.NEWFORMPENGAJUANTABUNGAN'), $data);
    }

    public function savedata(Request $request)
    {
        $isEleskaCredit = config('subdomain.FORMPENGAJUANKREDIT') === 'frontend.bpreleska.pages.pengajuanonline.formkredit'
            && $request->input('jenis_pengajuan') === 'kredit';

        // Validasi umum (semua form)
        $rules = [
            'jenis_pengajuan' => 'required',
            'nm_lengkap' => 'required',
            'no_ktp' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ];

        if ($isEleskaCredit) {
            $rules += [
                'permohonan_kredit' => 'required|in:Permohonan Baru,Top Up,Restruk',
                'tempat_tgl_lahir' => 'required|string|max:255',
                'status_pernikahan' => 'required|string|max:50',
                'pendidikan_tertinggi' => 'required|string|max:50',
                'status_rumah_tinggal' => 'required|string|max:100',
                'lama_domisili_tahun' => 'required|integer|min:0',
                'lama_domisili_bulan' => 'required|integer|min:0|max:11',
                'nama_ibu_kandung' => 'required|string|max:255',
                'nama_pendamping' => 'required|string|max:255',
                'tempat_tgl_lahir_pendamping' => 'required|string|max:255',
                'no_ktp_pendamping' => 'required|digits:16',
                'pekerjaan_pendamping' => 'required|string|max:255',
                'penghasilan_pendamping' => 'required|numeric|min:0',
                'no_hp_pendamping' => 'required|string|max:15',
                'nama_tempat_usaha' => 'required|string|max:255',
                'bidang_usaha_lama_usaha' => 'required|string|max:255',
                'alamat_tempat_usaha' => 'required|string|max:1000',
                'no_tlp_perusahaan' => 'required|string|max:30',
                'penjualan_pendapatan' => 'required|numeric|min:0',
                'jumlah_tanggungan' => 'required|integer|min:0',
                'modal_per_bulan' => 'required|numeric|min:0',
                'pendapatan_lainnya' => 'required|numeric|min:0',
                'biaya_usaha_per_bulan' => 'required|numeric|min:0',
                'kesanggupan_angsuran' => 'required|numeric|min:0',
                'laba_usaha_per_bulan' => 'required|numeric|min:0',
                'jml_kredit' => 'required|numeric|min:0',
                'jngka_wkt' => 'required|integer|min:1',
                'tujuan_penggunaan_kredit' => 'required|string|max:1000',
                'agunan_1' => 'required|string|max:1000',
                'agunan_2' => 'required|string|max:1000',
                'lampiran' => 'nullable|array',
                'lampiran.*' => 'string|max:255',
                'menyetujui_pernyataan' => 'required|accepted',
            ];
        }

        $request->validate($rules);

        // Data dasar (dipakai semua)
        $data = [
            'no_registrasi'   => PengajuanModel::generateNoRegistrasi(),
            'nm_lengkap' => $request->nm_lengkap,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'email' => $request->input('email'),
            'alamat' => $request->alamat,
            'jenis_pengajuan' => $request->jenis_pengajuan,
        ];

        // KHUSUS KREDIT
        if ($request->jenis_pengajuan == 'kredit') {
            $data += [

                'pekerjaan' => $isEleskaCredit ? $request->bidang_usaha_lama_usaha : $request->pekerjaan,
                'penghasilan' => $isEleskaCredit ? $request->laba_usaha_per_bulan : $request->penghasilan,
                'alamat' => $request->alamat,
                'jns_kredit' => $request->jns_kredit,
                'jml_kredit' => $request->jml_kredit,
                'jngka_wkt' => $request->jngka_wkt,
                'tujuan_kredit' => $isEleskaCredit ? $request->tujuan_penggunaan_kredit : $request->tujuan_kredit,
            ];

            if ($isEleskaCredit) {
                $data += [
                    'permohonan_kredit' => $request->permohonan_kredit,
                    'tempat_tgl_lahir' => $request->tempat_tgl_lahir,
                    'status_pernikahan' => $request->status_pernikahan,
                    'pendidikan_tertinggi' => $request->pendidikan_tertinggi,
                    'status_rumah_tinggal' => $request->status_rumah_tinggal,
                    'lama_domisili_tahun' => $request->lama_domisili_tahun,
                    'lama_domisili_bulan' => $request->lama_domisili_bulan,
                    'nama_ibu_kandung' => $request->nama_ibu_kandung,
                    'nama_pendamping' => $request->nama_pendamping,
                    'tempat_tgl_lahir_pendamping' => $request->tempat_tgl_lahir_pendamping,
                    'no_ktp_pendamping' => $request->no_ktp_pendamping,
                    'pekerjaan_pendamping' => $request->pekerjaan_pendamping,
                    'penghasilan_pendamping' => $request->penghasilan_pendamping,
                    'no_hp_pendamping' => $request->no_hp_pendamping,
                    'nama_tempat_usaha' => $request->nama_tempat_usaha,
                    'bidang_usaha_lama_usaha' => $request->bidang_usaha_lama_usaha,
                    'alamat_tempat_usaha' => $request->alamat_tempat_usaha,
                    'no_tlp_perusahaan' => $request->no_tlp_perusahaan,
                    'penjualan_pendapatan' => $request->penjualan_pendapatan,
                    'jumlah_tanggungan' => $request->jumlah_tanggungan,
                    'modal_per_bulan' => $request->modal_per_bulan,
                    'pendapatan_lainnya' => $request->pendapatan_lainnya,
                    'biaya_usaha_per_bulan' => $request->biaya_usaha_per_bulan,
                    'kesanggupan_angsuran' => $request->kesanggupan_angsuran,
                    'laba_usaha_per_bulan' => $request->laba_usaha_per_bulan,
                    'tujuan_penggunaan_kredit' => $request->tujuan_penggunaan_kredit,
                    'agunan_1' => $request->agunan_1,
                    'agunan_2' => $request->agunan_2,
                    'lampiran' => json_encode($request->input('lampiran', [])),
                    'menyetujui_pernyataan' => true,
                ];
            }
        }

        // KHUSUS TABUNGAN
        if ($request->jenis_pengajuan == 'tabungan') {
            $data += [
                'jns_tab' => $request->jns_tab,
                'setor_awal' => $request->setor_awal,
                'sumber_dn' => $request->sumber_dn,
                'tujuan_bk_rek' => $request->tujuan_bk_rek,
                'cat_tmbhn' => $request->cat_tmbhn,
            ];
        }

        // KHUSUS DEPOSITO
        if ($request->jenis_pengajuan == 'deposito') {
            $data += [
                'nmnl_depo' => $request->nmnl_depo,
                'jngka_wkt' => $request->jngka_wkt,
                'sumber_dn' => $request->sumber_dn,
                'rek_pencairan' => $request->rek_pencairan,
                'cat_tmbhn' => $request->cat_tmbhn,
            ];
        }


        PengajuanModel::create($data);

        return redirect()->back()->with('success', 'Data pengajuan berhasil dikirim');
    }


    public function savetabungan(Request $request)
    {
        $request->validate([
            // Section 1 - Informasi Umum
            'nama_cabang'            => 'required|string|max:255',
            'tanggal'                => 'required|date',
            'jenis_rekening'         => 'required|in:tunggal,gabungan_qq,gabungan_or,gabungan_and,lainnya',
            'hubungan'               => 'nullable|string',
            'tujuan'                 => 'required|string',
            'rek_a'                  => 'nullable|array|max:3',
            'rek_a.*'                => 'nullable|digits:1',
            'rek_b'                  => 'nullable|array|max:3',
            'rek_b.*'                => 'nullable|digits:1',
            'rek_c'                  => 'nullable|array|max:6',
            'rek_c.*'                => 'nullable|digits:1',

            // Section 2 - Data Nasabah
            'no_cif'                 => 'nullable|string|max:50',
            'nama_lengkap'           => 'required|string|max:255',
            'alamat_ktp'             => 'required|string|max:500',
            'rt_rw'                  => 'nullable|string|max:20',
            'kelurahan'              => 'nullable|string|max:100',
            'kecamatan'              => 'nullable|string|max:100',
            'negara'                 => 'nullable|string|max:100',
            'provinsi'               => 'nullable|string|max:100',
            'kode_pos'               => 'nullable|digits:5',
            'npwp'                   => 'nullable|string|max:20',
            'sudah_rekening'         => 'required|in:ya,tidak',
            'no_rekening_existing'   => 'nullable|string|max:50',
            'bertindak_untuk'        => 'required|in:diri_sendiri,wakil,wali_alamat,lainnya',

            // Section 3 - Pemegang Rekening ke 2
            'no_cif_2'               => 'nullable|string|max:50',
            'nama_lengkap_2'         => 'nullable|string|max:255',
            'alamat_ktp_2'           => 'nullable|string|max:500',
            'rt_rw_2'                => 'nullable|string|max:20',
            'kelurahan_2'            => 'nullable|string|max:100',
            'kecamatan_2'            => 'nullable|string|max:100',
            'negara_2'               => 'nullable|string|max:100',
            'provinsi_2'             => 'nullable|string|max:100',
            'kode_pos_2'             => 'nullable|digits:5',
            'npwp_2'                 => 'nullable|string|max:20',
            'sudah_rekening_2'       => 'nullable|in:ya,tidak',
            'no_rekening_existing_2' => 'nullable|string|max:50',
            'bertindak_untuk_2'      => 'nullable|in:diri_sendiri,wakil,wali_alamat,lainnya',

            // Section 4 - Tabungan
            'jenis_tabungan'         => 'nullable|in:mekar,taraku,nugraha,rejeki,kurban,cinta_fitri,pendidikan,simpel,bungah,mekar_premio',

            // Section 5 - Deposito
            'nominal_deposito'       => 'nullable|numeric|min:0',
            'terbilang'              => 'nullable|string|max:500',
            'jangka_waktu'           => 'nullable|integer|min:1',
            'suku_bunga'             => 'nullable|numeric|min:0',
            'perpanjangan'           => 'nullable|in:otomatis,non_otomatis',
            'pembayaran_bunga'       => 'nullable|in:tunai,transfer',
            'atas_nama'              => 'nullable|string|max:255',
            'no_rek_tujuan'          => 'nullable|string|max:50',
            'nama_bank'              => 'nullable|string|max:100',

            // Section 6 - Auto Debet
            'angsuran_kredit'        => 'nullable|string|max:255',
            'auto_debet_lainnya'     => 'nullable|string|max:255',
        ]);

        // Gabungkan kotak nomor rekening 
        $rekA = implode('', array_filter($request->input('rek_a', [])));
        $rekB = implode('', array_filter($request->input('rek_b', [])));
        $rekC = implode('', array_filter($request->input('rek_c', [])));
        $nomorRekening = ($rekA || $rekB || $rekC) ? "{$rekA}-{$rekB}-{$rekC}" : null;

        PembukaanRekeningModel::create([
            // Section 1
            'nama_cabang'            => $request->nama_cabang,
            'tanggal'                => $request->tanggal,
            'jenis_rekening'         => $request->jenis_rekening,
            'hubungan'               => $request->hubungan,
            'nomor_rekening'         => $nomorRekening,
            'tujuan'                 => $request->tujuan,

            // Section 2
            'no_cif'                 => $request->no_cif,
            'nama_lengkap'           => $request->nama_lengkap,
            'alamat_ktp'             => $request->alamat_ktp,
            'rt_rw'                  => $request->rt_rw,
            'kelurahan'              => $request->kelurahan,
            'kecamatan'              => $request->kecamatan,
            'negara'                 => $request->negara,
            'provinsi'               => $request->provinsi,
            'kode_pos'               => $request->kode_pos,
            'npwp'                   => $request->npwp,
            'sudah_rekening'         => $request->sudah_rekening,
            'no_rekening_existing'   => $request->no_rekening_existing,
            'bertindak_untuk'        => $request->bertindak_untuk,

            // Section 3
            'no_cif_2'               => $request->no_cif_2,
            'nama_lengkap_2'         => $request->nama_lengkap_2,
            'alamat_ktp_2'           => $request->alamat_ktp_2,
            'rt_rw_2'                => $request->rt_rw_2,
            'kelurahan_2'            => $request->kelurahan_2,
            'kecamatan_2'            => $request->kecamatan_2,
            'negara_2'               => $request->negara_2,
            'provinsi_2'             => $request->provinsi_2,
            'kode_pos_2'             => $request->kode_pos_2,
            'npwp_2'                 => $request->npwp_2,
            'sudah_rekening_2'       => $request->sudah_rekening_2,
            'no_rekening_existing_2' => $request->no_rekening_existing_2,
            'bertindak_untuk_2'      => $request->bertindak_untuk_2,

            // Section 4
            'jenis_tabungan'         => $request->jenis_tabungan,

            // Section 5
            'nominal_deposito'       => $request->nominal_deposito,
            'terbilang'              => $request->terbilang,
            'jangka_waktu'           => $request->jangka_waktu,
            'suku_bunga'             => $request->suku_bunga,
            'perpanjangan'           => $request->perpanjangan,
            'pembayaran_bunga'       => $request->pembayaran_bunga,
            'atas_nama'              => $request->atas_nama,
            'no_rek_tujuan'          => $request->no_rek_tujuan,
            'nama_bank'              => $request->nama_bank,

            // Section 6
            'angsuran_kredit'        => $request->angsuran_kredit,
            'auto_debet_lainnya'     => $request->auto_debet_lainnya,
        ]);

        return redirect()->back()->with('success', 'Formulir pembukaan rekening berhasil disimpan.');
    }

    public function downloadformkredit($id)
    {
        $data = PengajuanModel::with('masterKredit')->findOrFail($id);
        $view = config('subdomain.FORMPENGAJUANKREDIT') === 'frontend.bpreleska.pages.pengajuanonline.formkredit'
            ? 'frontend.bpreleska.pages.pengajuanonline.pdfkredit'
            : 'frontend.bprtaruna.pages.pengajuanonline.pdfkredit';

        $pdf = Pdf::loadView($view, compact('data'));

        return $pdf->stream('pengajuan_kredit' . $data->id . '.pdf');
    }

    public function downloadformdeposito($id)
    {
        $data = PengajuanModel::findOrFail($id);

        $pdf = Pdf::loadView('frontend.bprtaruna.pages.pengajuanonline.pdfdeposito', compact('data'));

        return $pdf->stream('pengajuan_kredit' . $data->id . '.pdf');
    }

    public function downloadformtabungan($id)
    {
        $data = PengajuanModel::with('masterTabungan')->findOrFail($id);
        $pdf = Pdf::loadView('frontend.bprtaruna.pages.pengajuanonline.pdftabungan', compact('data'));

        return $pdf->stream('pengajuan_kredit' . $data->id . '.pdf');
    }
}

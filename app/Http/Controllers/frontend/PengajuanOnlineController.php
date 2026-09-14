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
        // Validasi umum (semua form)
        $request->validate([
            'jenis_pengajuan' => 'required',
            'nm_lengkap' => 'required',
            'no_ktp' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        // Data dasar (dipakai semua)
        $data = [
            'no_registrasi'   => PengajuanModel::generateNoRegistrasi(),
            'nm_lengkap' => $request->nm_lengkap,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jenis_pengajuan' => $request->jenis_pengajuan,
        ];

        // KHUSUS KREDIT
        if ($request->jenis_pengajuan == 'kredit') {
            $data += [

                'pekerjaan' => $request->pekerjaan,
                'penghasilan' => $request->penghasilan,
                'alamat' => $request->alamat,
                'jns_kredit' => $request->jns_kredit,
                'jml_kredit' => $request->jml_kredit,
                'jngka_wkt' => $request->jngka_wkt,
                'tujuan_kredit' => $request->tujuan_kredit,
            ];
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

        $pdf = Pdf::loadView('frontend.bprtaruna.pages.pengajuanonline.pdfkredit', compact('data'));

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

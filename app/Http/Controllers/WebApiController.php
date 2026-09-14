<?php

namespace App\Http\Controllers;

use App\Models\Backend\Berita;
use App\Models\Backend\BungaPinjaman;
use App\Models\Backend\Layanan;
use App\Models\Backend\Profile;
use App\Models\Backend\Rekruitmen;
use App\Models\Backend\LaporanPublikasi;
use App\Models\Backend\LaporanLain;
use App\Models\Backend\Umkm;
use App\Models\BannerModel;
use App\Models\CommonPagesModel;
use App\Models\Frontend\Dashboard;
use App\Models\Frontend\Lelang;
use App\Models\Frontend\RekruitmenData;
use App\Models\JaringanKantorModel;
use App\Models\LaporanModel;
use App\Models\LelangModel;
use App\Models\MasterPengajuanDepositoModel;
use App\Models\MasterPengajuanTabunganModel;
use App\Models\PengajuanModel;
use App\Models\ProdukLayananModel;
use App\Models\ProfileModel;
use App\Models\RekruitmenModel;
use App\Models\UMKMModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebApiController extends Controller
{
	public function getdashboard(Request $r)
	{
		// TOP BANNER

		$banner = BannerModel::where('type', 0)   // 0 = top	             // 1 = aktif (sesuaikan dengan sistem kamu)
			->where(function ($q) {
				$q->whereNull('tampil_start')
					->orWhere('tampil_start', '<=', now());
			})
			->where(function ($q) {
				$q->whereNull('tampil_end')
					->orWhere('tampil_end', '>=', now());
			})
			->orderBy('created_at', 'desc')
			->get();

		$topbannercontent = $banner->map(function ($b) {
			return [
				'id' => $b->id,
				'name' => $b->name,
				'type' => $b->type,
				'url' => $b->url_mobile
					? asset($b->url_mobile)
					: asset($b->url),
			];
		});

		// PRODUK $ LAYANAN

		$produk = ProdukLayananModel::where('type', 0)
			->orderBy('urutan', 'asc')
			->orderBy('created_at', 'desc')
			->get();

		$produkcontent = $produk->map(function ($p) {
			return [
				'id' => $p->id,
				'title' => $p->title,
				'type' => $p->type,
				'kategori' => $p->kategori,
				'url' => $p->thumbnail
					? asset('storage/' . $p->thumbnail)
					: null,
			];
		});


		// UMKM

		$umkm = UMKMModel::latest()->limit(6)->get();

		$umkmitem = [];

		foreach ($umkm as $u) {
			$umkmitem[] = [
				'uuid' => $u->id,
				'judul' => $u->title,
				'lokasi' => $u->lokasi,
				'no_telp' => $u->no_telp,
				'alamat' => $u->alamat,
				'nilai_discount' => $u->nilai_discount,
				'rating' => $u->rating,
				'layanan' => $u->layanan,
				'deskripsi' => $u->deskripsi,
				'type_pilihan' => $u->type_pilihan,
				'thumbnail' => $u->thumbnail
					? asset('storage/' . $u->thumbnail)
					: 'https://placehold.co/100x300.png',
				'gambar' => $u->gambar
					? asset('storage/' . $u->gambar)
					: 'https://placehold.co/100x300.png',
			];
		}


		return response()->json([
			'success' => true,
			'topbanner' => $topbannercontent,
			'produk' => $produkcontent,
			'umkmitem' => $umkmitem,
		]);
	}

	public function getfooterbanner(Request $r)
	{
		$banner = BannerModel::where('type', 1)
			->where(function ($q) {
				$q->whereNull('tampil_start')
					->orWhere('tampil_start', '<=', now());
			})
			->where(function ($q) {
				$q->whereNull('tampil_end')
					->orWhere('tampil_end', '>=', now());
			})
			->orderBy('created_at', 'desc')
			->get();

		$bottombannercontent = $banner->map(function ($b) {
			return [
				'id' => $b->id,
				'name' => $b->name,
				'type' => $b->type,
				'url' => $b->url_mobile
					? asset($b->url_mobile)
					: asset($b->url),
			];
		});
		return response()->json([

			'bottombanner' => $bottombannercontent,

		]);
	}


	public function getberita(Request $r)
	{
		$berita = CommonPagesModel::where(function ($q) {
			$q->whereNull('tanggal_tampil')
				->orWhere('tanggal_tampil', '<=', now());
		})
			->orderBy('tanggal_tampil', 'desc')
			->paginate(15);

		$berita->getCollection()->transform(function ($b) {
			return [
				'id' => $b->id,
				'judul' => $b->title,
				'tag' => $b->tag,
				'kategori' => $b->kategori,
				'thumbnail' => $b->thumbnail
					? asset('storage/' . $b->thumbnail)
					: null,
				'banner' => $b->banner
					? asset('storage/' . $b->banner)
					: null,
				'tanggal' => $b->tanggal_tampil,
				'content' => $b->content,
			];
		});

		return response()->json([
			'success' => true,
			'message' => 'Data berita berhasil diambil',
			'berita' => $berita,
		]);
	}


	// public function getberita(Request $r)
	// {
	// 	$berita = CommonPagesModel::where(function ($q) {
	// 		$q->whereNull('tanggal_tampil')
	// 			->orWhere('tanggal_tampil', '<=', now());
	// 	})
	// 		->orderBy('tanggal_tampil', 'desc')
	// 		->paginate(15);

	// 	$berita->getCollection()->transform(function ($b) {

	// 		$clean = $b->content;

	// 		// 1️⃣ Hapus attribute class & style
	// 		$clean = preg_replace('/\s*(class|style)="[^"]*"/i', '', $clean);

	// 		// 2️⃣ Hapus tag span tapi pertahankan isinya
	// 		$clean = preg_replace('/<\/?span[^>]*>/', '', $clean);

	// 		// 3️⃣ Ubah &nbsp; jadi spasi biasa
	// 		$clean = str_replace('&nbsp;', ' ', $clean);

	// 		return [
	// 			'id' => $b->id,
	// 			'judul' => $b->title,
	// 			'tag' => $b->tag,
	// 			'kategori' => $b->kategori,
	// 			'thumbnail' => $b->thumbnail
	// 				? asset('storage/' . $b->thumbnail)
	// 				: null,
	// 			'banner' => $b->banner
	// 				? asset('storage/' . $b->banner)
	// 				: null,
	// 			'tanggal' => $b->tanggal_tampil,
	// 			'content' => $clean,
	// 		];
	// 	});

	// 	return response()->json([
	// 		'success' => true,
	// 		'message' => 'Data berita berhasil diambil',
	// 		'berita' => $berita,
	// 	], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	// }

	public function getlelang(Request $r)
	{
		$lelang = LelangModel::where(function ($q) {
			$q->whereNull('mulai')
				->orWhere('mulai', '<=', now());
		})
			->where(function ($q) {
				$q->whereNull('selesai')
					->orWhere('selesai', '>=', now());
			})
			->orderBy('created_at', 'desc')
			->paginate(15);

		return response()->json([
			'success' => true,
			'message' => 'Data Lelang berhasil diambil',
			'lelang' => $lelang,
		]);
	}

	public function getkarir(Request $r)
	{
		$karir = RekruitmenModel::select(
			'id',
			'judul',
			'deskripsi',
			'lokasi',
			'tipe_pekerjaan',
			'gaji_min',
			'gaji_max',
			'tanggal_posting',
			'tanggal_berakhir',
			'gambar'
		)
			->where(function ($q) {
				$q->whereNull('tanggal_posting')
					->orWhere('tanggal_posting', '<=', now());
			})
			->where(function ($q) {
				$q->whereNull('tanggal_berakhir')
					->orWhere('tanggal_berakhir', '>=', now());
			})
			->orderBy('tanggal_posting', 'desc')
			->paginate(15);

		// Ubah gambar jadi full URL
		$karir->getCollection()->transform(function ($k) {

			$k->gambar = $k->gambar
				? asset('storage/' . $k->gambar)
				: null;

			return $k;
		});

		return response()->json([
			'success' => true,
			'message' => 'Data Karir berhasil diambil',
			'karir' => $karir,
		]);
	}

	public function getkantor(Request $r)
	{
		$kantor = JaringanKantorModel::select(
			'id',
			'kantor',
			'alamat',
			'latitude',
			'longitude',
			'thumbnail',
			'no_telp'

		)
			->orderBy('kantor', 'asc')
			->get();

		$kantor->transform(function ($k) {

			$k->thumbnail = $k->thumbnail
				? asset('storage/' . $k->thumbnail)
				: null;

			return $k;
		});

		return response()->json([
			'success' => true,
			'message' => 'Data Kantor berhasil diambil',
			'kantor' => $kantor,
		]);
	}
	public function getlaporan(Request $r)
	{
		$laporan = LaporanModel::select(
			'id',
			'type',
			'tanggal',
			'title',
			'thumbnail',
			'url'
		)
			->get();

		$laporan->transform(function ($l) {
			$l->thumbnail = $l->thumbnail
				? asset('storage/' . $l->thumbnail)
				: null;
			return $l;
		});

		return response()->json([
			'success' => true,
			'message' => 'Data Laporan berhasil diambil',
			'laporan' => $laporan,
		]);
	}


	public function getsimulasi(Request $r)
	{
		$deposito = MasterPengajuanDepositoModel::select(
			'id',
			'nama',
			'tenor',
			'bunga',
			'image'
		)
			->orderBy('created_at', 'desc')
			->get();

		$tabungan = MasterPengajuanTabunganModel::select(
			'id',
			'nama',
			'bunga',
			'min',
			'image'
		)
			->orderBy('created_at', 'desc')
			->get();

		$deposito->transform(function ($d) {
			$d->image = $d->image
				? asset('storage/' . $d->image)
				: null;
			return $d;
		});

		$tabungan->transform(function ($t) {
			$t->image = $t->image
				? asset('storage/' . $t->image)
				: null;
			return $t;
		});

		return response()->json([
			'success' => true,
			'deposito' => $deposito,
			'tabungan' => $tabungan,
		]);
	}



	public function getprofil(Request $request)
	{
		$query = ProfileModel::select(
			'id',
			'type',
			'title',
			'slug',
			'banner',
			'thumbnail',
			'content',
			'created_at'
		);

		if ($request->filled('type')) {
			$query->where('type', $request->type);
		}

		$profile = $query->orderBy('created_at', 'desc')->first();

		if (!$profile) {
			return response()->json([
				'success' => false,
				'message' => 'Profile tidak ditemukan',
			]);
		}

		$profile->banner = $profile->banner
			? asset('storage/' . $profile->banner)
			: null;

		$profile->thumbnail = $profile->thumbnail
			? asset('storage/' . $profile->thumbnail)
			: null;

		return response()->json([
			'success' => true,
			'message' => 'Data Profile berhasil diambil',
			'data' => $profile
		]);
	}

	public function getumkm(Request $request)
	{
		$umkm = UMKMModel::latest()->limit(6)->get();

		$umkmitem = [];

		foreach ($umkm as $u) {
			$umkmitem[] = [
				'uuid' => $u->id,
				'judul' => $u->title,
				'lokasi' => $u->lokasi,
				'no_telp' => $u->no_telp,
				'alamat' => $u->alamat,
				'nilai_discount' => $u->nilai_discount,
				'rating' => $u->rating,
				'layanan' => $u->layanan,
				'deskripsi' => $u->deskripsi,
				'type_pilihan' => $u->type_pilihan,
				'jam_buka' => $u->jam_buka,
				'jam_tutup' => $u->jam_tutup,
				'website' => $u->website,
				'sosmed' => $u->sosmed,
				'thumbnail' => $u->thumbnail
					? asset('storage/' . $u->thumbnail)
					: 'https://placehold.co/100x300.png',
				'gambar' => $u->gambar
					? asset('storage/' . $u->gambar)
					: 'https://placehold.co/100x300.png',
			];
		}


		return response()->json([
			'success' => true,
			'message' => 'Data UMKM berhasil diambil',
			'umkmitem' => $umkmitem,
		]);
	}

	public function getdashboardv2(Request $r)
	{
		$data['banners'] = BannerModel::where('type', 0)
			->where(function ($q) {
				$q->whereNull('tampil_start')
					->orWhere('tampil_start', '<=', now());
			})
			->where(function ($q) {
				$q->whereNull('tampil_end')
					->orWhere('tampil_end', '>=', now());
			})
			->where('tampil', 1) // Only show banners that are active
			->orderBy('created_at', 'desc')
			->get();
		$data['product'] = ProdukLayananModel::where('type', 0)
			// ->orderBy('urutan', 'asc')
			->orderBy('created_at', 'desc')
			->get();
		$data['news'] = CommonPagesModel::where(function ($q) {
			$q->whereNull('tanggal_tampil')
				->orWhere('tanggal_tampil', '<=', now());
		})
			->where('type', 0) // Filter by type 'berita'
			->orderBy('tanggal_tampil', 'desc')
			->limit(3)
			->get();

		// icon taruna
		$icondeposito = 'https://drive.google.com/uc?export=view&id=1soJp6HnayB_8QT0xPpVQpspCqHh9z0n1';
		$icontabungan = 'https://drive.google.com/uc?export=view&id=11SH8WBGqsgv72UIGZYhC5mkURPq5lPKl';
		$iconkredit = 'https://drive.google.com/uc?export=view&id=14V5F4zScr49Ohb9QFV1HtG519R_OAgUx';

		// banner taruna
		$bannerkredit = 'https://drive.google.com/uc?export=view&id=1NYJXvllYDZ0bNY8omeuJ0ayJ6XC5DFrp';
		$bannertabungan = 'https://drive.google.com/uc?export=view&id=1y4YMgYFZ2DVzt--mW93mQ8CQ5dT27gud';
		$bannerdeposito = 'https://drive.google.com/uc?export=view&id=1kWXNnt0ZIfXzsXotQNgYgpVPH862thZT';
		return response()->json([
			'success' => true,
			'profile' => '',
			'visi' => 'Menjadi BPR yang Bersih, Sehat, dan Terpercaya.',
			'misi' => 'Memberikan pelayanan terbaik kepada nasabah serta berperan aktif membantu pemerintah dalam pengembangan UMKM.
    Meningkatkan kinerja BPR yang sehat, kuat, efisien, profesional, dan berkesinambungan.
    Memberikan pengetahuan tentang manajemen keuangan kepada nasabah.
    Menjadikan pemasaran sebagai konsultan keuangan dan produk bagi nasabah.',
			'phone' => '(0291) 4311911',
			'whatsapp_display' => '085727144255',
			'email' => 'banktaruna@gmail.com',
			'message' => 'Data berhasil diambil',
			'data' => $data,
			'icontabungan' => $icontabungan,
			'icondeposito' => $icondeposito,
			'iconkredit' => $iconkredit,
			'bannerkredit' => $bannerkredit,
			'bannertabungan' => $bannertabungan,
			'bannerdeposito' => $bannerdeposito,
		]);
	}

	public function getjenisproduk(Request $r, $jenis)
	{
		$j = 0;
		if ($jenis == 'kredit') {
			$j = 0;
		} elseif ($jenis == 'tabungan') {
			$j = 2;
		} elseif ($jenis == 'deposito') {
			$j = 1;
		}

		$data = ProdukLayananModel::where('type', 0) // Produk: 0, Layanan: 1
			->where(function ($q) use ($r, $j) {
				if ($r->id) {
					return $q->where('id', $r->id);
				} else {
					return 	$q->where('kategori', $j); // Kredit: 0, Tabungan: 2, Deposito: 1
				}
			})
			->get();

		return response()->json([
			'success' => true,
			'message' => 'Data berhasil diambil',
			'data' => $data,
		]);
	}
	public function formpengajuankredit(Request $r)
	{
		$data = [
			'no_registrasi' => PengajuanModel::generateNoRegistrasi(),
			'jenis_pengajuan' =>  '',
			'nm_lengkap' => $r->nama_lengkap,
			'no_ktp' => $r->no_ktp,
			'no_hp' => $r->no_handphone,
			'email' => $r->email,
			'pekerjaan' => $r->pekerjaan,
			'penghasilan' => $r->penghasilan_bulan,
			'alamat' => $r->alamat_lengkap,

			'jns_kredit' => null,
			'jml_kredit' => null,
			'jngka_wkt' => null,
			'tujuan_kredit' => null,

			'jns_tab' => null,
			'setor_awal' => null,
			'sumber_dn' => null,
			'tujuan_bk_rek' => null,

			'jns_depo' => null,
			'nmnl_depo' => null,
			'rek_pencairan' => null,
			'cat_tmbhn' => null,
		];

		if ($r->jenis_produk == 'Kredit') {
			$data['jenis_pengajuan'] = 'kredit';
			$data['jenis_produk'] = 'kredit';
			$data['jns_kredit'] = $r->jenis_kredit;
			$data['jml_kredit'] = $r->jumlah_kredit;
			$data['jngka_wkt'] = $r->jangka_waktu;
			$data['tujuan_kredit'] = $r->tujuan_kredit;
		}
		if ($r->jenis_produk == 'Tabungan') {
			$data['jenis_pengajuan'] = 'tabungan';
			$data['jenis_produk'] = 'tabungan';
			$data['jns_tab'] = $r->jenis_kredit;
			$data['setor_awal'] = $r->jumlah_kredit;
			$data['sumber_dn'] = $r->sumber_dn;
			$data['cat_tmbhn'] = $r->cat_tmbhn;
			$data['tujuan_bk_rek'] = $r->tujuan_kredit;
		}
		if ($r->jenis_produk == 'Deposito') {
			$data['jenis_pengajuan'] = 'deposito';
			$data['jenis_produk'] = 'deposito';
			$data['jns_depo'] = $r->jenis_kredit;
			$data['nmnl_depo'] = $r->jumlah_kredit;
			$data['rek_pencairan'] = $r->rek_pencairan;
			$data['cat_tmbhn'] = $r->cat_tmbhn;
			$data['jngka_wkt'] = $r->jangka_waktu;
		}

		PengajuanModel::create($data);
		return response()->json([
			'success' => true,
			'message' => 'Pengajuan berhasil terkirim',
			'data' => $r->all(),
		]);
	}
}

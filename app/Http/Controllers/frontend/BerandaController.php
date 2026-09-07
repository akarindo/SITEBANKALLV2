<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\CommonPagesModel;
use App\Models\CounterRateModel;
use App\Models\GalleryModel;
use App\Models\JaringanKantorModel;
use App\Models\UMKMModel;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BerandaController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $data['baner'] = BannerModel::where('type', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        $data['berita'] = CommonPagesModel::where('type', 0)
            ->whereDate('tanggal_tampil', '<=', $today)
            ->orderBy('tanggal_tampil', 'desc')
            ->take(3)
            ->get();
        $data['event'] = CommonPagesModel::where('type', 1)->get();
        $data['allinfo'] = CommonPagesModel::orderBy('id', 'desc')
            ->take(3)
            ->get();
        $data['galery'] = GalleryModel::orderBy('id', 'desc')
            ->take(3)
            ->get();
        $data['galerymulti'] = GalleryModel::orderBy('id', 'desc')
            ->get()
            ->groupBy('title');

        $data['kantor'] = JaringanKantorModel::orderBy('id', 'asc')->get();
        $data['umkm'] = UMKMModel::orderBy('id', 'desc')
            ->take(4)
            ->get();

        $data['kredit']   = CounterRateModel::where('type', 1)->get();
        $data['deposito'] = CounterRateModel::where('type', 2)->get();
        $data['tabungan'] = CounterRateModel::where('type', 3)->get();

        if (env('DATA_PAGE') == 'BPREMAS') {
            $data['kategori_slug'] = CommonPagesModel::where('type', 1)
                ->pluck('kategori')
                ->filter()
                ->unique()
                ->map(fn($kategori) => Str::slug($kategori))
                ->values();
            $data['kategori_slug_implode'] = implode(',', $data['kategori_slug']->all());

            $data['kategori_slug_berita'] = CommonPagesModel::where('type', 0)
                ->pluck('kategori')
                ->filter()
                ->unique()
                ->map(fn($kategori) => Str::slug($kategori))
                ->values();
            $data['kategori_slug_implode_berita'] = implode(',', $data['kategori_slug_berita']->all());
        }

        // return $data;

        return view(config('subdomain.CUSTOM_PAGE_BERANDA'), $data);
    }
}

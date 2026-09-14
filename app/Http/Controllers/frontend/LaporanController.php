<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\LaporanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    public function publikasi()
    {
        $publikasi = LaporanModel::where('type', 0)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) {
                $month = \Carbon\Carbon::parse($item->tanggal)->month;

                if ($month >= 1 && $month <= 3) {
                    $item->triwulan = 'Triwulan I';
                } elseif ($month >= 4 && $month <= 6) {
                    $item->triwulan = 'Triwulan II';
                } elseif ($month >= 7 && $month <= 9) {
                    $item->triwulan = 'Triwulan III';
                } else {
                    $item->triwulan = 'Triwulan IV';
                }

                $item->tahun = \Carbon\Carbon::parse($item->tanggal)->year;
                return $item;
            })
            ->groupBy('tahun'); // Grouping pertama by tahun

        return view(config('subdomain.GLOBAL_PUBLIKASI'), compact('publikasi'));
    }


    public function tahunan()
    {
        // detail event
        $data['tahunan'] = LaporanModel::where('type', 1)->get();


        return view(config('subdomain.GLOBAL_TAHUNAN'), $data);
    }

    public function tatakelola()
    {
        // detail event
        $data['tatakelola'] = LaporanModel::where('type', 2)->get();


        return view(config('subdomain.GLOBAL_TATAKELOLA'), $data);
    }

    public function keberlanjutan()
    {
        // detail event
        $data['keberlanjutan'] = LaporanModel::where('type', 3)->get();


        return view(config('subdomain.GLOBAL_KEBERLANJUTAN'), $data);
    }
    public function akb()
    {
        // detail event
        $data['akb'] = LaporanModel::where('type', 4)->get();


        return view(config('subdomain.GLOBAL_AKB'), $data);
    }

    public function piagamaudit()
    {

        $data['piagamaudit'] = LaporanModel::where('type', 5)->get();

        return view(config('subdomain.GLOBAL_PIAGAMAUDIT'), $data);
    }

    public function lainnya()
    {

        $data['lainnya'] = LaporanModel::where('type', 6)->get();

        return view(config('subdomain.GLOBAL_LAPORAN_LAINNYA'), $data);
    }

    public function laporanall()
    {
        $data['publikasi'] = LaporanModel::where('type', 0)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) {
                $month = \Carbon\Carbon::parse($item->tanggal)->month;

                if ($month >= 1 && $month <= 3) {
                    $item->triwulan = 'Triwulan I';
                } elseif ($month >= 4 && $month <= 6) {
                    $item->triwulan = 'Triwulan II';
                } elseif ($month >= 7 && $month <= 9) {
                    $item->triwulan = 'Triwulan III';
                } else {
                    $item->triwulan = 'Triwulan IV';
                }

                $item->tahun = \Carbon\Carbon::parse($item->tanggal)->year;
                return $item;
            })
            ->groupBy('tahun'); // Grouping pertama by tahun
        $data['tahunan'] = LaporanModel::where('type', 1)->get();
        $data['tatakelola'] = LaporanModel::where('type', 2)->get();
        $data['keberlanjutan'] = LaporanModel::where('type', 3)->get();
        $data['akb'] = LaporanModel::where('type', 4)->get();
        $data['lainnya'] = LaporanModel::where('type', 6)->get();
        $data['all'] = LaporanModel::orderBy('created_at', 'DESC')->paginate(6);


        return view(config('subdomain.GLOBAL_LAPORANALL'), $data);
    }

    public function getlaporanfront(Request $request)
    {
        $query = LaporanModel::query();

        if ($request->type !== null && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->tahun) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->bulan && $request->bulan !== '') {
            $bulan    = (int) $request->bulan;
            $bulanAwal = $bulan - 2;
            $query->whereMonth('tanggal', '>=', $bulanAwal)
                ->whereMonth('tanggal', '<=', $bulan);
        }

        $data = $query->orderBy('tanggal', 'desc')->get()
            ->map(function ($item) {
                $item->bulan = (int) Carbon::parse($item->tanggal)->format('n');
                return $item;
            });

        return response()->json($data->values());
    }
}

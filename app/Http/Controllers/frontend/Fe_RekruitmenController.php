<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\RekruitmenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Fe_RekruitmenController extends Controller
{

    public function index()
    {
        $today = Carbon::today();

        $rekruitmen = RekruitmenModel::whereDate('tanggal_posting', '<=', $today)
            ->whereDate('tanggal_berakhir', '>=', $today)
            ->orderBy('tanggal_posting', 'desc')
            ->get();

        // Mapping tipe_pekerjaan ke text
        foreach ($rekruitmen as $item) {
            $item->tipe_pekerjaan_text = match ($item->tipe_pekerjaan) {
                1 => 'Fulltime',
                2 => 'Part Time',
                3 => 'Kontrak',
                4 => 'Lainnya',
                default => 'Tidak Diketahui',
            };
        }

        return view(env('GLOBAL_KARIR'), [
            'rekruitmen' => $rekruitmen
        ]);
    }

    public function detrekrutmen($id)
    {
        $detrekrutmen = RekruitmenModel::findOrFail($id);

        // Tambahkan mapping tipe_pekerjaan ke text
        $detrekrutmen->tipe_pekerjaan_text = match ($detrekrutmen->tipe_pekerjaan) {
            1 => 'Fulltime',
            2 => 'Part Time',
            3 => 'Kontrak',
            4 => 'Lainnya',
            default => 'Tidak Diketahui',
        };

        return view(config('subdomain.GLOBAL_DETAILKARIR'), [
            'detrekrutmen' => $detrekrutmen
        ]);
    }

    // 

}

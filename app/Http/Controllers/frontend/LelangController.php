<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\LelangModel;
use DB;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    public function index(Request $request)
    {
        $data['lelang'] = LelangModel::select('*')
            ->addSelect(DB::raw("CASE 
                WHEN type = 0 THEN 'Lelang'
                WHEN type = 1 THEN 'Jual Aset'
                ELSE 'Tidak Diketahui'
            END as type_text"))
            ->whereDate('mulai', '<=', now())
            ->whereDate('selesai', '>=', now())
            ->orderBy('mulai', 'desc')
            ->get();

        // Keep the combined collection for other brands, while BPR SMS gets
        // separate collections so each tab only shows its own content.
        $data['lelangItems'] = $data['lelang']->where('type', 0)->values();
        $data['jualAsetItems'] = $data['lelang']->where('type', 1)->values();
        $data['activeTab'] = $request->query('tab') === 'jual-aset' ? 'jual-aset' : 'lelang';

        return view(env('GLOBAL_LELANG'), $data);
    }

    public function detlelang($id)
    {

        $data['lelang'] = LelangModel::findOrFail($id);

        return view(env('GLOBAL_DETAILLELANG'), $data);
    }

    // public function detlelang() {

    //     return view(config('subdomain.GLOBAL_DETAILLELANG'));

    // }
}

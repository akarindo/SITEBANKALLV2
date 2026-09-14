<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\LelangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class LelangController extends Controller
{


    public function index()
    {

        $today = Carbon::today();

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

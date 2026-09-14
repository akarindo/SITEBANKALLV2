<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\UMKMModel;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $data['all'] = UMKMModel::whereIn('type_pilihan', [0, 1, 2])->get();
        $data['rekomendasi'] = UMKMModel::where('type_pilihan', 0)->get();
        $data['terlaris'] = UMKMModel::where('type_pilihan', 1)->get();
        $data['toprating'] = UMKMModel::where('type_pilihan', 2)
            ->get();



        return view(config('subdomain.GLOBAL_UMKM'), $data);
    }
    public function detumkm($id)
    {
        $first = UMKMModel::findOrFail($id);

        $data['umkm'] = $first;

        return view(config('subdomain.GLOBAL_DETAILUMKM'), $data);
    }
}

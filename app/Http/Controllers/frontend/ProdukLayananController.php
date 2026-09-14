<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\MasterPengajuanDepositoModel;
use App\Models\MasterPengajuanTabunganModel;
use App\Models\ProdukLayananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukLayananController extends Controller
{
    public function kredit()
    {
        $data['kredit'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 0)
            ->get();

        return view(config('subdomain.GLOBAL_KREDIT'), $data);
    }

    public function detkredit($id)
    {
        // detail event
        $data['kredit'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 0)
            ->where('id', $id)
            ->firstOrFail();

        $data['other_kredit'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 0)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            //  ->take(5)
            ->get();

        return view(config('subdomain.GLOBAL_DETAILKREDIT'), $data);
    }

    public function deposito()
    {
        // detail event
        $data['deposito'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 1)
            ->get();

        return view(config('subdomain.GLOBAL_DEPOSITO'), $data);
    }

    public function detdeposito($id)
    {
        // detail event
        $data['deposito'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 1)
            ->where('id', $id)
            ->firstOrFail();

        $data['other_deposito'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 1)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            //  ->take(5)
            ->get();
        return view(config('subdomain.GLOBAL_DETAILDEPOSITO'), $data);
    }

    public function tabungan()
    {
        $data['tabungan'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 2)
            ->get();

        if (env('DATA_PAGE') === 'BPREMAS') {
            $data['deposito'] = ProdukLayananModel::where('type', 0)
                ->where('kategori', 1)
                ->get();
        }

        return view(config('subdomain.GLOBAL_TABUNGAN'), $data);
    }
    public function dettabungan($id)
    {
        // detail event
        $data['tabungan'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 2)
            ->where('id', $id)
            ->firstOrFail();

        $data['other_tabungan'] = ProdukLayananModel::where('type', 0)
            ->where('kategori', 2)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            //  ->take(5)
            ->get();
        return view(config('subdomain.GLOBAL_DETAILTABUNGAN'), $data);
    }

    public function simulasiKredit()
    {

        return view(config('subdomain.SIMULASI_KREDIT'));
    }

    public function simulasi()
    {
        return view('frontend.bpremas.pages.simulasi.index');
    }

    public function simulasiTabungan()
    {
        $data['tabungan'] = MasterPengajuanTabunganModel::get();

        return view(config('subdomain.SIMULASI_TABUNGAN'), $data);
    }

    public function simulasiDeposito()
    {
        $data['deposito'] = MasterPengajuanDepositoModel::get();

        return view(config('subdomain.SIMULASI_DEPOSITO'), $data);
    }
}

<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\JaringanKantorModel;
use Illuminate\Http\Request;

class Fe_JaringanKantorController extends Controller
{
    public function index()
    {
        // ambil semua data urut sesuai inputan
        $data['kantor'] = JaringanKantorModel::orderBy('id', 'asc')->get();

        return view(config('subdomain.GLOBAL_KANTOR'), $data);
    }
}

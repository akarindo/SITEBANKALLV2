<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index()
    {
        // ambil semua data urut sesuai inputan


        return view(config('subdomain.GLOBAL_DASHBOARDUSER'));
    }
}

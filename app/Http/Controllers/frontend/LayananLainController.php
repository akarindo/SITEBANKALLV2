<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
// use App\Models\Frontend\Lelang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayananLainController extends Controller
{
	public function index()
	{

		return view(config('subdomain.GLOBAL_LAYANANLAIN'));
	}
}

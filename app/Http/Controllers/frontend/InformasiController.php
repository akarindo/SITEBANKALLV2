<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CommonPagesModel;
use App\Models\JaringanKantorModel;
use App\Models\MultiBannerPagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class InformasiController extends Controller
{
    public function detevent($id)
    {
        // detail event
        $data['event'] = CommonPagesModel::findOrFail($id);;
        $data['eventberita'] = CommonPagesModel::findOrFail($id);;
        $data['multibaner'] = MultiBannerPagesModel::where('page_id', $id)->get();


        // Ambil berita lain (kecuali berita yg sedang dibuka)
        $data['other_event'] = CommonPagesModel::where('type', 1)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view(config('subdomain.GLOBAL_DETAILEVENT'), $data);
    }

    public function detberita($id)
    {
        // Ambil berita berdasarkan idp
        $data['berita'] = CommonPagesModel::findOrFail($id);

        // Ambil berita lain (kecuali berita yg sedang dibuka)
        $data['other_berita'] = CommonPagesModel::where('type', 0)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $data['other_beritaall'] = CommonPagesModel::where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view(config('subdomain.GLOBAL_DETAILBERITA'), $data);
    }

    public function detliterasi($id)
    {
        // Ambil berita berdasarkan id
        $data['literasi'] = CommonPagesModel::findOrFail($id);

        // Ambil berita lain (kecuali berita yg sedang dibuka)
        $data['other_literasi'] = CommonPagesModel::where('type', 2)
            ->where('kategori', 'literasi')
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('frontend.bprjas.pages.berita.detailliterasi', data: $data);
    }

    public function informasi()
    {
        $data['all'] = CommonPagesModel::whereIn('type', [0, 1, 2])->get();
        $data['berita'] = CommonPagesModel::where('type', 0)->get();
        $data['event'] = CommonPagesModel::where('type', 1)->get();
        $data['literasi'] = CommonPagesModel::where('type', 2)
            ->where('kategori', 'literasi')
            ->get();

        $data['multibaner'] = MultiBannerPagesModel::get();


        return view(config('subdomain.GLOBAL_INFORMASI'), $data);
    }

    public function eventkegiatan()
    {

        $data['event'] = CommonPagesModel::where('type', 1)->get();
        $data['eventberita'] = CommonPagesModel::whereDate('tanggal_tampil', '<=', Carbon::today())
            ->orderBy('tanggal_tampil', 'desc')
            ->get();

        $data['multibaner'] = MultiBannerPagesModel::get();

        return view(config('subdomain.GLOBAL_EVENT'), $data);
    }

    function contact(Request $r)
    {
        // $str = Carbon::now()->startOfMonth()->format('Y-m-d');
        // if ($r->str) {
        //     $str = Carbon::parse($r->str)->format('Y-m-d');
        // }
        // $end = Carbon::now()->endOfMonth()->format('Y-m-d');
        // if ($r->end) {
        //     $end = Carbon::parse($r->end)->format('Y-m-d');
        // }
        // $data['date_start'] = $str;
        // $data['date_end'] = $end;

        $data['kantor'] = JaringanKantorModel::get();
        // return view('frontend.bprjas.pages.profil.contact', $data);
        return view('frontend.bprstaja.pages.profil.contact', $data);
    }

    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama_panggilan' => 'required|string|max:100',
            'nama_panjang' => 'required|string|max:150',
            'email' => 'required|email',
            'telepon' => 'required',
            'pesan' => 'required|string',
        ]);
        $data['kantor'] = JaringanKantorModel::get();
        Mail::send('frontend.bprjas.pages.profil.contact', $data, function ($message) use ($data) {
            $message->to('iskandarrizqi13@gmail.com') // ganti dengan email tujuan
                ->subject('Pesan Baru dari Form Kontak Website');
        });


        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}

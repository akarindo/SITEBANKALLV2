<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LelangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LelangController extends Controller
{
    public function index(Request $r)
    {
        $str = Carbon::now()->startOfMonth()->format('Y-m-d');
        if ($r->str) {
            $str = Carbon::parse($r->str)->format('Y-m-d');
        }
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');
        if ($r->end) {
            $end = Carbon::parse($r->end)->format('Y-m-d');
        }
        $data['date_start'] = $str;
        $data['date_end'] = $end;

        $data['data'] = LelangModel::whereBetween('created_at', [$str, $end])->get();
        $data['tag'] = [];
        $data['kategori'] = [];
        foreach ($data['data'] as $v) {

            if (is_array($v->tag)) {
                foreach ($v->tag as $t) {

                    if (! in_array($t, $data['tag'])) {
                        $data['tag'][] = $t;
                    }
                }
            }

            if (is_array($v->kategori)) {
                foreach ($v->kategori as $k) {
                    if (! in_array($k, $data['kategori'])) {
                        $data['kategori'][] = $k;
                    }
                }
            }
        }

        return view('admin.lelang.index', $data);
    }

    public function store(Request $r)
    {
        $isBprSmsAsset = config('subdomain.CUSTOM_PAGE_BERANDA') === 'frontend.bprsms.index'
            && (int) $r->input('type') === 1;

        $rules = [
            'type' => 'required',
            'urutan' => 'required|numeric',
            'tag' => 'required',
            'kategori' => 'required',
            'title' => ['required', Rule::unique('lelangs')->where(function ($query) use ($r) {
                if ($r->txtId) {
                    return $query->where('id', '!=', $r->txtId);
                }
            }), ],
            'cara_penawaran' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'penyelenggara' => 'required',
            'kode_lot' => 'required',
            // 'uraian' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
        ];

        if ($isBprSmsAsset) {
            $rules['harga_penawaran'] = 'required|numeric|min:0';
            $rules['lokasi'] = 'nullable|string';
            $rules['luas_tanah'] = 'nullable|string';
            $rules['luas_bangunan'] = 'nullable|string';
            $rules['legalitas'] = 'nullable|string';
            $rules['album.*'] = 'image|mimes:jpg,jpeg,png,webp|max:2048';
        } else {
            $rules['limit'] = 'required|numeric';
            $rules['jaminan'] = 'required|numeric';
            $rules['batas_akhir_jaminan'] = 'required|date';
        }

        $valid = Validator::make($r->all(), $rules);
        if ($valid->fails()) {
            return Redirect::back()->withErrors($valid)->withInput($r->all())->with('error', 'Terjadi kesalahan pada pengisian form');
        }
        $input = [
            'type' => $r->type,
            'urutan' => $r->urutan,
            'tag' => json_encode($r->tag),
            'kategori' => json_encode($r->kategori),
            'title' => $r->title,
            'slug' => Str::slug($r->title),
            'limit' => $isBprSmsAsset ? 0 : $r->limit,
            'lampiran' => $r->lampiran,
            'cara_penawaran' => $r->cara_penawaran,
            'jaminan' => $isBprSmsAsset ? 0 : $r->jaminan,
            'batas_akhir_jaminan' => $isBprSmsAsset
                ? Carbon::parse($r->selesai)->format('Y-m-d')
                : Carbon::parse($r->batas_akhir_jaminan)->format('Y-m-d'),
            'mulai' => Carbon::parse($r->mulai)->format('Y-m-d'),
            'selesai' => Carbon::parse($r->selesai)->format('Y-m-d'),
            'penyelenggara' => $r->penyelenggara,
            'kode_lot' => $r->kode_lot,
            'uraian' => $r->uraian,
            'provinsi' => $r->provinsi,
            'kota' => $r->kota,
            'link' => $r->link,
        ];

        if (config('subdomain.CUSTOM_PAGE_BERANDA') === 'frontend.bprsms.index') {
            $input['harga_penawaran'] = $isBprSmsAsset ? $r->harga_penawaran : null;
            $input['lokasi'] = $isBprSmsAsset ? $r->lokasi : null;
            $input['luas_tanah'] = $isBprSmsAsset ? $r->luas_tanah : null;
            $input['luas_bangunan'] = $isBprSmsAsset ? $r->luas_bangunan : null;
            $input['legalitas'] = $isBprSmsAsset ? $r->legalitas : null;
        }

        if ($isBprSmsAsset && $r->hasFile('album')) {
            $album = [];
            foreach ($r->file('album') as $image) {
                $album[] = $image->store('lelang/'.time());
            }
            $input['album'] = $album;
        }

        // upload image
        if ($r->file('banner')) {
            // validasi image
            $valbanner = Validator::make($r->all(), [
                'banner' => 'required|mimes:jpg,jpeg,png|max:2048',
            ]);
            // validasi gagal
            if ($valbanner->fails()) {
                return back()->with('error', 'Gambar Harus JPG, JPEG, PNG')->withInput();
            }
            // proses upload
            $filedesktop = $r->file('banner')->store('lelang/'.time());
            $input['banner'] = $filedesktop;
        }
        // upload image
        if ($r->file('thumbnail')) {
            // validasi image
            $valimage = Validator::make($r->all(), [
                'thumbnail' => 'required|mimes:jpg,jpeg,png|max:2048',
            ]);
            // validasi gagal
            if ($valimage->fails()) {
                return back()->with('error', 'Gambar Harus JPG, JPEG, PNG')->withInput();
            }
            // proses upload
            $filedesktop = $r->file('thumbnail')->store('lelang/'.time());
            $input['thumbnail'] = $filedesktop;
        }
        $i = LelangModel::updateOrCreate(['id' => $r->txtId], $input);
        if ($i) {
            return Redirect::back()->with('success', 'Data berhasil disimpan');
        }

        return Redirect::back()->withInput($r->all())->with('error', 'Data gagal disimpan');
    }

    public function destroy($i)
    {
        $data = LelangModel::find($i);
        if ($data) {
            $data->delete();

            return back()->with('success', 'Data berhasil dihapus');
        }

        return back()->with('info', 'Data gagal dihapus');
    }
}

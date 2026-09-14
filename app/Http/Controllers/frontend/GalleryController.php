<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryModel;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {

        $data['gallery'] = GalleryModel::get();

        $data['onegallery'] = GalleryModel::whereIn('id', function ($q) {
            $q->selectRaw('MIN(id)')
                ->from('gallery_models')
                ->groupBy('kategori');
        })->get();

        return view(config('subdomain.GLOBAL_GALLERY'), $data);
    }

    public function detgallery($id)
    {
        $first = GalleryModel::findOrFail($id);

        $data['gallery'] = GalleryModel::where('kategori', $first->kategori)->get();

        $data['header'] = $first;

        return view(config('subdomain.GLOBAL_DETAILGALLERY'), $data);
    }
}

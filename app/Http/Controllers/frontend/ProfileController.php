<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ProfileModel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {

        $data['profil'] = ProfileModel::where('type', 0)
            ->first();

        return view(config('subdomain.GLOBAL_PROFILE'), $data);
    }

    public function sejarah()
    {

        $data['sejarah'] = ProfileModel::where('type', 1)
            ->first();

        return view(config('subdomain.GLOBAL_SEJARAH'), $data);
    }

    public function pengurus()
    {

        $data['pengurus'] = ProfileModel::where('type', 2)
            ->first();


        return view(config('subdomain.GLOBAL_PENGURUS'), $data);
    }

    public function organisasi()
    {

        $data['organisasi'] = ProfileModel::where('type', 3)
            ->first();


        return view(config('subdomain.GLOBAL_ORGANISASI'), $data);
    }

    public function visimisi()
    {


        return view(config('subdomain.GLOBAL_VISIMISI'));
    }

    public function corevalue()
    {


        return view(config('subdomain.GLOBAL_COREVALUE'));
    }
}

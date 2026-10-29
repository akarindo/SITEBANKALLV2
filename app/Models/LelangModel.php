<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LelangModel extends Model
{
    use SoftDeletes;

    protected $table = 'lelangs';

    protected $fillable = [
        'type',
        'urutan',
        'tag',
        'kategori',
        'title',
        'slug',
        'banner',
        'thumbnail',
        'album',
        'limit',
        'harga_penawaran',
        'cara_penawaran',
        'jaminan',
        'batas_akhir_jaminan',
        'mulai',
        'selesai',
        'penyelenggara',
        'kode_lot',
        'uraian',
        'lampiran',
        'provinsi',
        'kota',
        'lokasi',
        'luas_tanah',
        'luas_bangunan',
        'legalitas',
        'link',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tag' => 'array',
        'kategori' => 'array',
        'album' => 'array',
    ];

    protected $appends = ['tags', 'kategoris'];

    public function getTagsAttribute()
    {
        $tags = $this->getAttribute('tag');

        if (is_string($tags)) {
            $tags = json_decode($tags, true);
        }

        return is_array($tags) ? array_values($tags) : [];
    }

    public function getKategorisAttribute()
    {
        $categories = $this->getAttribute('kategori');

        if (is_string($categories)) {
            $categories = json_decode($categories, true);
        }

        return is_array($categories) ? array_values($categories) : [];
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

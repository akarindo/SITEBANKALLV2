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
        'album' => 'array',
    ];

    protected $appends = ['tags', 'kategoris'];

    public function getTagsAttribute()
    {
        return json_decode($this->tag);
    }

    public function getKategorisAttribute()
    {
        return json_decode($this->kategori);
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

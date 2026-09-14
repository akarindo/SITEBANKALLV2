<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanModel extends Model
{
    use SoftDeletes;
    protected $table = 'pengajuan_online';
    protected $fillable = [
        'no_registrasi',
        'jenis_pengajuan',
        'nm_lengkap',
        'no_ktp',
        'no_hp',
        'email',
        'pekerjaan',
        'penghasilan',
        'alamat',

        'jns_kredit',
        'jml_kredit',
        'jngka_wkt',
        'tujuan_kredit',

        'jns_tab',
        'setor_awal',
        'sumber_dn',
        'tujuan_bk_rek',

        'jns_depo',
        'nmnl_depo',
        'rek_pencairan',
        'cat_tmbhn',

    ];

    public static function generateNoRegistrasi()
    {
        // Ambil data terakhir berdasarkan id
        $last = self::orderBy('id', 'DESC')->first();
        $year = date('Y');

        if (!$last || !$last->no_registrasi) {
            $number = 1;
        } else {
            // Ambil 4 digit terakhir lalu +1
            $number = (int) substr($last->no_registrasi, -4) + 1;
        }

        return 'REG-PENGAJUAN-' . $year . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function masterKredit()
    {
        if ($this->jns_depo != null) {
            return $this->belongsTo(
                \App\Models\MastePengajuanKreditModel::class,
                'jns_depo',
                'id'
            );
        }
        if ($this->jns_tab != null) {
            return $this->belongsTo(
                \App\Models\MastePengajuanKreditModel::class,
                'jns_tab',
                'id'
            );
        }
        return $this->belongsTo(
            \App\Models\MastePengajuanKreditModel::class,
            'jns_kredit',
            'id'
        );
    }


    public function masterTabungan()
    {
        return $this->belongsTo(
            \App\Models\MasterPengajuanTabunganModel::class,
            'jns_tab',
            'id'
        );
    }
}

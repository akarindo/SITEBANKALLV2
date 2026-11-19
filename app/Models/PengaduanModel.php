<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengaduanModel extends Model
{
    use SoftDeletes;

    protected $table = 'pengaduan_nasabah';

    protected $fillable = [
        'no_registrasi',
        'user_id',
        'jenis_aduan',
        'sub_aduan',
        'nama_pelapor',
        'email_pelapor',
        'no_hp_pelapor',
        'kategori',
        'nama',
        'jbt_plg',
        'lokasi',
        'waktu_plg',
        'rugi',
        'uraian',
        'bukti1',
        'bukti2',
        'jenis_pl',
        'tuntutan_pl',
        'status',
        'p_data1',
        'p_data2',
        'ket_perpanjangan1',
        'ket_perpanjangan2',
        'step_data',

        'v_jenis_konfir',
        'v_waktu_konfir',
        'v_uraian_konfir',
        'v_bukti_konfir',
        'v_mulaipenanganan',
        'v_selesaipenanganan',

        'p_proses_penanganan',
        'p_perpanjanganpenanganan',
        'p_berakhirpenanganan',

        's_w_selesai',
        's_ket_selesai',

    ];

    /**,
     *
     * Get the user that owns the pengaduan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'kategori' => 'array',
        'bukti1' => 'array',
        'bukti2' => 'array',
        'mulai_penanganan' => 'array',
        'p_proses_penanganan' => 'array',

    ];

    public function getProsesPenangananDecodeAttribute()
    {
        return $this->p_proses_penanganan ?? [];
    }

    public function jenis()
    {
        return $this->belongsTo(MasterJenisPengaduanModel::class, 'jenis_aduan', 'form');
    }

    public function produkLayanan()
    {
        return $this->belongsTo(ProdukLayananModel::class, 'jenis_pl', 'id');
    }

    public static function generateNoRegistrasi()
    {
        // Ambil data terakhir berdasarkan id
        $last = self::orderBy('id', 'DESC')->first();
        $year = date('Y');

        if (! $last || ! $last->no_registrasi) {
            $number = 1;
        } else {
            // Ambil 4 digit terakhir lalu +1
            $number = (int) substr($last->no_registrasi, -4) + 1;
        }

        return 'REG-PENGADUAN-'.$year.'-'.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}

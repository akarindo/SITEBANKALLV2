<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_online', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('permohonan_kredit')->nullable();
            $table->string('tempat_tgl_lahir')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->string('pendidikan_tertinggi')->nullable();
            $table->string('status_rumah_tinggal')->nullable();
            $table->unsignedInteger('lama_domisili_tahun')->nullable();
            $table->unsignedTinyInteger('lama_domisili_bulan')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->string('nama_pendamping')->nullable();
            $table->string('tempat_tgl_lahir_pendamping')->nullable();
            $table->string('no_ktp_pendamping', 16)->nullable();
            $table->string('pekerjaan_pendamping')->nullable();
            $table->double('penghasilan_pendamping')->nullable();
            $table->string('no_hp_pendamping', 15)->nullable();
            $table->string('nama_tempat_usaha')->nullable();
            $table->string('bidang_usaha_lama_usaha')->nullable();
            $table->text('alamat_tempat_usaha')->nullable();
            $table->string('no_tlp_perusahaan')->nullable();
            $table->double('penjualan_pendapatan')->nullable();
            $table->unsignedInteger('jumlah_tanggungan')->nullable();
            $table->double('modal_per_bulan')->nullable();
            $table->double('pendapatan_lainnya')->nullable();
            $table->double('biaya_usaha_per_bulan')->nullable();
            $table->double('kesanggupan_angsuran')->nullable();
            $table->double('laba_usaha_per_bulan')->nullable();
            $table->text('tujuan_penggunaan_kredit')->nullable();
            $table->text('agunan_1')->nullable();
            $table->text('agunan_2')->nullable();
            $table->text('lampiran')->nullable();
            $table->boolean('menyetujui_pernyataan')->default(false);
        });
    }

    public function down(): void
    {
        DB::table('pengajuan_online')->whereNull('email')->update(['email' => '']);

        Schema::table('pengajuan_online', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->dropColumn([
                'permohonan_kredit',
                'tempat_tgl_lahir',
                'status_pernikahan',
                'pendidikan_tertinggi',
                'status_rumah_tinggal',
                'lama_domisili_tahun',
                'lama_domisili_bulan',
                'nama_ibu_kandung',
                'nama_pendamping',
                'tempat_tgl_lahir_pendamping',
                'no_ktp_pendamping',
                'pekerjaan_pendamping',
                'penghasilan_pendamping',
                'no_hp_pendamping',
                'nama_tempat_usaha',
                'bidang_usaha_lama_usaha',
                'alamat_tempat_usaha',
                'no_tlp_perusahaan',
                'penjualan_pendapatan',
                'jumlah_tanggungan',
                'modal_per_bulan',
                'pendapatan_lainnya',
                'biaya_usaha_per_bulan',
                'kesanggupan_angsuran',
                'laba_usaha_per_bulan',
                'tujuan_penggunaan_kredit',
                'agunan_1',
                'agunan_2',
                'lampiran',
                'menyetujui_pernyataan',
            ]);
        });
    }
};

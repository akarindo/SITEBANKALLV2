<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('lelangs')) {
            Schema::create('lelangs', function (Blueprint $table) {
                $table->id();
                $table->integer('type')->default(0)->comment('0:Lelang; 1:Jual Aset;');
                $table->integer('urutan')->default(0);
                $table->json('tag')->nullable();
                $table->text('kategori')->nullable();
                $table->string('title')->unique();
                $table->string('slug')->unique();
                $table->text('banner')->nullable();
                $table->text('thumbnail')->nullable();
                $table->double('limit')->default(0);
                $table->text('cara_penawaran');
                $table->double('jaminan');
                $table->datetime('batas_akhir_jaminan');
                $table->datetime('mulai');
                $table->datetime('selesai');
                $table->text('penyelenggara');
                $table->text('kode_lot');
                $table->longText('uraian');
                $table->longText('lampiran');
                $table->text('provinsi');
                $table->text('kota');
                $table->text('link');
                $table->bigInteger('created_by')->nullable();
                $table->bigInteger('updated_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelangs');
    }
};

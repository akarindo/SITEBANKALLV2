<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('lelangs')) {
            return;
        }

        Schema::table('lelangs', function (Blueprint $table) {
            $table->json('album')->nullable();
            $table->double('harga_penawaran')->nullable();
            $table->text('lokasi')->nullable();
            $table->text('luas_tanah')->nullable();
            $table->text('luas_bangunan')->nullable();
            $table->text('legalitas')->nullable();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('lelangs')) {
            return;
        }

        Schema::table('lelangs', function (Blueprint $table) {
            $table->dropColumn([
                'album',
                'harga_penawaran',
                'lokasi',
                'luas_tanah',
                'luas_bangunan',
                'legalitas',
            ]);
        });
    }
};

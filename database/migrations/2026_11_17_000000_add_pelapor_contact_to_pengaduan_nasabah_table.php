<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan_nasabah', function (Blueprint $table) {
            $table->string('nama_pelapor')->nullable()->after('sub_aduan');
            $table->string('email_pelapor')->nullable()->after('nama_pelapor');
            $table->string('no_hp_pelapor', 30)->nullable()->after('email_pelapor');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan_nasabah', function (Blueprint $table) {
            $table->dropColumn(['nama_pelapor', 'email_pelapor', 'no_hp_pelapor']);
        });
    }
};

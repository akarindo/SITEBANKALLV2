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
        if (!Schema::hasTable('produk_layanan')) {
            Schema::create('produk_layanan', function (Blueprint $table) {
                $table->id();
                $table->integer('type')->default(0)->comment('0:Produk; 1:Layanan; 2:Lainnya');
                $table->integer('kategori')->default(0)->comment('0:Kredit; 1:Deposito; 2:Tabungan; 3:Layanan; 4:Lainnya;');
                $table->integer('urutan')->default(0);
                $table->json('tag')->nullable();
                $table->string('title')->unique();
                $table->string('slug')->unique();
                $table->string('banner');
                $table->string('thumbnail')->nullable();
                $table->longText('content');
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
        Schema::dropIfExists('produk_layanan');
    }
};

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
        if (!Schema::hasTable('common_pages')) {
            Schema::create('common_pages', function (Blueprint $table) {
                $table->id();
                $table->integer('type')->default(0)->comment('0:Berita; 1:Event; 2:Lainnya');
                $table->integer('urutan')->default(0);
                $table->json('tag')->nullable();
                $table->text('kategori')->nullable();
                // $table->text('title')->unique();
                $table->text('title')->nullable();
                $table->string('slug')->unique();
                $table->text('banner');
                $table->text('thumbnail')->nullable();
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
        Schema::dropIfExists('common_pages');
    }
};

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
        if (!Schema::hasTable('jaringan_kantors')) {
            Schema::create('jaringan_kantors', function (Blueprint $table) {
                $table->id();
                $table->text('kantor');
                $table->decimal('latitude')->default('0');
                $table->decimal('longitude')->default('0');
                $table->text('alamat');
                $table->text('thumbnail')->nullable();
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
        Schema::dropIfExists('jaringan_kantors');
    }
};

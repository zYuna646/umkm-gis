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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('gambar');
            $table->string('keywords');
            $table->string('deskripsi');
            $table->string('isi_artikel');
            $table->unsignedBigInteger('kategori_artikel_id');
            $table->timestamps();

            $table->foreign('kategori_artikel_id')->references('id')->on('kategori_artikels');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};

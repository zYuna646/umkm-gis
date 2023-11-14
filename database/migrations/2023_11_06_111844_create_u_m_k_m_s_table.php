<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('u_m_k_m_s', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_Aktif')->default(false);
            $table->boolean('is_Umum')->default(false);
            $table->boolean('is_Bantuan')->default(false);
            $table->string('nama_pemilik');
            $table->string('alamat');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->integer('pendapatan_aset');
            $table->integer('pendapatan_omset');
            $table->integer('tenaga_kerja_l');
            $table->integer('tenaga_kerja_p');
            $table->integer('jumlah_tenaga_kerja');
            $table->string('keterangan_jenis_usaha');
            $table->string('keterangan');
            $table->point('kordinat');
            $table->foreignId('jenis_usaha_id')->constrained('jenis_usahas')->onDelete('cascade');
            $table->foreignId('klasifikasi_usaha_id')->constrained('klasifikasi_usahas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('u_m_k_m_s');
    }
};

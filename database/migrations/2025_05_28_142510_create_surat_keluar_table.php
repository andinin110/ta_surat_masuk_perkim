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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('dikirim_melalui');
            $table->string('jenis_naskah');
            $table->string('sifat_naskah');
            $table->string('klasifikasi');
            $table->string('hal');
            $table->string('isi_ringkasan');
            $table->string('tujuan');
            $table->string('verifikator');
            $table->date('tanggal_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};

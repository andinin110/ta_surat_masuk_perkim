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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('sifat_surat');
            $table->string('isi_ringkasan');
            $table->string('dari');
            $table->string('kepada');
            $table->date('tanggal_terima');
            $table->date('tanggal_berakhir');
            $table->string('catatan');
            $table->unsignedBigInteger('id_bidang')->nullable(); // tambahkan ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};

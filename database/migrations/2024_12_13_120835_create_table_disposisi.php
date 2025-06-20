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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Belum Diproses');
            $table->string('eviden');
            $table->unsignedBigInteger('id_bidang');
            $table->unsignedBigInteger('id_surat');
            $table->timestamps();

            $table->foreign('id_bidang')->references('id')->on('bidang')->onDelete('cascade');
            $table->foreign('id_surat')->references('id')->on('surat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};

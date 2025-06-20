<?php

use Carbon\Carbon;
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
        Schema::table('users', function (Blueprint $table) {
            $table->char('nip', 18)->after('name');  // Mengubah kolom nip menjadi char(18) untuk memastikan hanya 18 karakter
            $table->string('role')->after('name'); // Tambahkan kolom role setelah kolom name
            $table->unsignedBigInteger('id_bidang')->after('role');
            $table->foreign('id_bidang')->references('id')->on('bidang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

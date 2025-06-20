<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'dikirim_melalui',
        'jenis_naskah',
        'sifat_naskah',
        'klasifikasi',
        'hal',
        'isi_ringkasan',
        'tujuan',
        'verifikator',
        'tanggal_keluar',
    ];

    protected $dates = [
        'tanggal_keluar',
        'created_at',
        'updated_at',
    ];
}

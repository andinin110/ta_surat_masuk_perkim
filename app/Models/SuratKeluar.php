<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'sifat_naskah',
        'isi_ringkasan',
        'asal_surat',
        'tujuan',
        'tanggal_terima',
        'waktu_terima',
        'batas_berakhir',
        'waktu_berakhir',
        'catatan',
        'eviden',
    ];

    protected $dates = [
        'tanggal_terima',
        'batas_berakhir',
        'created_at',
        'updated_at',
    ];
}

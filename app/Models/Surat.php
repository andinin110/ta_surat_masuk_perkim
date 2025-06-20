<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $fillable = [
        'no',
        'nomor_surat',
        'sifat_surat',
        'isi_ringkasan',
        'dari',
        'kepada',
        'tanggal_terima',
        'tanggal_berakhir',
        'catatan',
    ];

    protected $casts = [
        'tanggal_terima' => 'datetime',
        'tanggal_berakhir' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'id_surat', 'id');
    }
}

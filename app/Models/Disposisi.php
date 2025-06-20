<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'disposisi';

    // Menentukan kolom mana yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'status',
        'eviden',
        'id_bidang',
        'id_sub_bidang',
        'id_surat',
    ];

    // Menentukan apakah kolom 'created_at' dan 'updated_at' otomatis diisi
    public $timestamps = true;

    // Menentukan relasi dengan model Surat
    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
}

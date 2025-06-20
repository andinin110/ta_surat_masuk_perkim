<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'instansi';

    // Menentukan kolom mana yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'name',
    ];

    // Menentukan apakah kolom 'created_at' dan 'updated_at' otomatis diisi
    public $timestamps = true;

    // Contoh relasi (jika nanti instansi berelasi dengan disposisi, bisa aktifkan)
    // public function disposisi()
    // {
    //     return $this->hasMany(Disposisi::class, 'id_instansi');
    // }
}

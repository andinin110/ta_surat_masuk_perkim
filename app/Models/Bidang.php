<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'bidang';

    // Menentukan kolom mana yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'name',
    ];

    // Menentukan apakah kolom 'created_at' dan 'updated_at' otomatis diisi
    public $timestamps = true;

    // Relasi dengan disposisi
    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'id_bidang');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeran extends Model
{
    use HasFactory;

    protected $table = 'peran';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public $timestamps = true;

}

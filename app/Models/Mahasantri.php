<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasantri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mhs',
        'alamat_mhs',
        'umur_mhs',
        'id_jrs',
    ];
}

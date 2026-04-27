<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nim',
        'no_wa',
        'ttl',
        'alamat',
        'kelamin',
        'agama',
        'fakultas',
        'jurusan',
        'email',
        'metode',
        'bukti', 
        'status',
    ];
}

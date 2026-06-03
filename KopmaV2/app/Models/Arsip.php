<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $fillable = [
    'nomor_arsip',
    'judul',
    'bidang',
    'status',
    'link'
];
}
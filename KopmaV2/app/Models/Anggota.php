<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// /**
//  * 
//  *
//  * @property int $id
//  * @property string $no_anggota
//  * @property string $nama
//  * @property int $nim
//  * @property int $no_wa
//  * @property string $ttl
//  * @property string $alamat
//  * @property string $kelamin
//  * @property string $agama
//  * @property string $fakultas
//  * @property string $jurusan
//  * @property string $email
//  * @property \Illuminate\Support\Carbon|null $created_at
//  * @property \Illuminate\Support\Carbon|null $updated_at
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota newModelQuery()
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota newQuery()
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota query()
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereAgama($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereAlamat($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereCreatedAt($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereEmail($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereFakultas($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereId($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereJurusan($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereKelamin($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereNama($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereNim($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereNoAnggota($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereNoWa($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereTtl($value)
//  * @method static \Illuminate\Database\Eloquent\Builder<static>|Anggota whereUpdatedAt($value)
//  * @mixin \Eloquent
//  */
class Anggota extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_anggota',
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
        'diklat',
    ];
}
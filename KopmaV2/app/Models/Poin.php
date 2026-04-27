<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $nama
 * @property string $no_anggota
 * @property int|null $point
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin whereNoAnggota($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Poin extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'no_anggota', 'point'];

    // Method untuk menambah point berdasarkan opsi
    public function addPoints($option)
    {
        $pointValues = [
            1 => 100,
            2 => 85,
            3 => 80,
            4 => 75,
            5 => 65,
            6 => 55,
            7 => 45,
            8 => 35,
            9 => 30,
            10 => 25,
            11 => 20,
            12 => 15,

        ];

        if (isset($pointValues[$option])) {
            $this->point += $pointValues[$option];
            $this->save();
            return $pointValues[$option];
        }
        return 0;
    }
}

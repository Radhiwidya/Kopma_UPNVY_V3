<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'no_anggota',
        'no_wa',
        '2016',
        '2017',
        '2018',
        '2019',
        '2020',
        '2021',
        '2022',
        '2023',
        '2024',
        '2025',
        '2026',
        '2027',
        '2028',
        '2029',
        '2030',
        '2031',
        '2032',
        '2033',
        '2034',
        '2035',
        'sp',
        'ss',
        'shu',
        'total',
    ];
    
    /**
     * Kolom-kolom yang akan dijumlahkan untuk total
     */
    public static function getCalculableColumns()
    {
        return [
            '2016', '2017', '2018', '2019', '2020',
            '2021', '2022', '2023', '2024', '2025',
            '2026', '2027', '2028', '2029', '2030',
            '2031', '2032', '2033', '2034', '2035',
            'sp', 'ss', 'shu'
        ];
    }

    /**
     * Hitung ulang total dari semua kolom
     */
    public function calculateTotal()
    {
        $total = 0;
        foreach (self::getCalculableColumns() as $column) {
            $total += $this->$column ?? 0;
        }
        
        $this->total = $total;
        return $this;
    }

    /**
     * Update nilai kolom tertentu dan hitung ulang total
     */
    public function updateColumnValue($column, $value)
    {
        // Validasi kolom yang diizinkan
        $allowedColumns = self::getCalculableColumns();
        
        if (!in_array($column, $allowedColumns)) {
            throw new \InvalidArgumentException("Kolom '$column' tidak diizinkan untuk diupdate");
        }

        // Update nilai kolom (tambah/kurang dari nilai sebelumnya)
        $currentValue = $this->$column ?? 0;
        $this->$column = $currentValue + $value;

        // Hitung ulang total
        $this->calculateTotal();

        return $this;
    }

    /**
     * Boot method untuk auto-calculate saat model disimpan
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->calculateTotal();
        });
    }
}
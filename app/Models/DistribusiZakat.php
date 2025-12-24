<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiZakat extends Model
{
    use HasFactory;

    protected $table = 'distribusi_zakat';

    /**
     * Field yang boleh di-mass assign
     */
    protected $fillable = [
        'mustahik_id',
        'kategori_mustahik',
        'jumlah_hak',
        'jenis_zakat',
        'distribusi_beras',
        'distribusi_uang',
    ];

    /**
     * Relasi ke tabel Mustahik
     * Setiap DistribusiZakat dimiliki oleh satu Mustahik
     */
    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class, 'mustahik_id', 'id');
    }
}

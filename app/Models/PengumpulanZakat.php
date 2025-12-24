<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanZakat extends Model
{
    use HasFactory;

    protected $table = 'pengumpulan_zakat';

    /**
     * Field yang boleh di-mass assign
     */
    protected $fillable = [
        'muzakki_id',
        'jumlah_tanggungan',
        'jumlah_tanggungandibayar',
        'jenis_bayar',
        'bayar_beras',
        'bayar_uang',
    ];

    /**
     * Relasi ke tabel Muzakki
     * Setiap PengumpulanZakat dimiliki oleh satu Muzakki
     */
    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class, 'muzakki_id', 'id');
    }
}
